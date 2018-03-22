<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ovc extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model(array('hes_model','ovc_model'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->vars('base_url', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/');
        $this->load->vars('includes_dir', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/resources/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
    }
    


public function index()
{
         if (!$this->ion_auth->logged_in())
        {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
        if($this->input->post('upload'))
        {
           $this->hes_model->upload_ovc();   
        }
        else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['username']=$this->ion_auth->user()->row()->username;
            $this->data['ovcs']=$this->tabledata->selectRecords(array(),'ovc_table',array());
            $this->data['county']=$this->tabledata->selectRecords(array(),'m_counties',array());
            $this->data['constituency']=$this->tabledata->selectRecords(array(),'m_constituencies',array());
            $this->data['ward']=$this->tabledata->selectRecords(array(),'m_wards',array());
            $this->data['file_name']='ovc_upload_sample.xls';
            $this->_render_page('ovc/index',$this->data);
        }   
}

  public function ajax_list() {
        $this->load->helper('url');

        $list = $this->chv_model->get_datatables();
        //print_r($list);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $chv) {
            $no++;
            $row = array();
            if($chv->stato==1)
            {
             $stato='Active';   
            }
            elseif($chv->stato==0)
            {
             $stato='Inactive';    
            }
            $row[] = $no;
            $row[] = $chv->first_name.' '.$chv->middle_name.' '.$chv->surname;
            $row[] = $chv->id_number;
            $row[] = $chv->cbo;            
            $row[] = $stato;

            //add html for action
            $row[] = '<a href="javascript:;" class="btn btn-outline btn-circle btn-xs purple" onclick="edit_chv(' . "'" . $chv->id . "'" . ')"><i class="fa fa-edit"></i>  Edit</a>
				  <a href="javascript:;" class="btn btn-outline btn-circle btn-xs red" title="Delete" onclick="delete_chv(' . "'" . $chv->id . "'" . ')"><i class="fa fa-trash"></i>  Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->ovc_model->count_all(),
            "recordsFiltered" => $this->ovc_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id)
            {
        $data = $this->ovc_model->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $this->_validate();
        $county = $this->tabledata->getSingleRecord('m_counties', array('id' => $this->input->post('county')), 'county_name');
        $subcounty = $this->tabledata->getSingleRecord('m_constituencies', array('id' => $this->input->post('constituency')), 'name');
        $ward = $this->tabledata->getSingleRecord('m_wards', array('id' => $this->input->post('ward')), 'ward_name');
        $data = array(
            'sdp_id' => $this->input->post('sdp_name'),
            'cbo_name' => $this->input->post('cbo_name'),
            'county' => $county,
            'sub_county' => $subcounty,
            'ward' => $ward,
            'date_created' => DATE_TIME,
            'stato' => 1
        );


        $insert = $this->cbo_model->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $this->_validate();
        $data = array(
            'sdp_id' => $this->input->post('sdp_name'),
            'cbo_name' => $this->input->post('cbo_name'),
            'county' => $county,
            'sub_county' => $subcounty,
            'ward' => $ward,
        );



        $this->cbo->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        //delete file
        $cbo = $this->cbo_model->get_by_id($id);


        $this->cbo_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _do_upload() {
        $config['upload_path'] = 'upload/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 100; //set max size allowed in Kilobyte
        $config['max_width'] = 1000; // set max width image allowed
        $config['max_height'] = 1000; // set max height allowed
        $config['file_name'] = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('photo')) { //upload and validate
            $data['inputerror'][] = 'photo';
            $data['error_string'][] = 'Upload error: ' . $this->upload->display_errors('', ''); //show ajax error
            $data['status'] = FALSE;
            echo json_encode($data);
            exit();
        }
        return $this->upload->data('file_name');
    }

    private function _validate() {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if ($this->input->post('cbo_name') == '') {
            $data['inputerror'][] = 'cbo_name';
            $data['error_string'][] = 'CBO name is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('sdp_name') == '') {
            $data['inputerror'][] = 'sdp_name';
            $data['error_string'][] = 'SDP name is required';
            $data['status'] = FALSE;
        }
        if ($this->input->post('county') == '') {
            $data['inputerror'][] = 'county';
            $data['error_string'][] = 'County is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('constituency') == '') {
            $data['inputerror'][] = 'constituency';
            $data['error_string'][] = 'Sub-County is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('ward') == '') {
            $data['inputerror'][] = 'ward';
            $data['error_string'][] = 'Please select ward';
            $data['status'] = FALSE;
        }



        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

/**
public function deactivate_ovc($id)
{
  $ovc=$this->utility->decode($id);
  
}

public function edit_ovc_account()
{
  $ovc=$this->utility->decode($id); 
  
    
}
 * 
 */


function download() {
        $this->load->helper('download');
        $name = 'ovc_upload_sample.xls';
        $data = file_get_contents("./resources/downloads/ovc_upload_sample.xls"); // Read the file's contents

        force_download($name, $data);
    } 
function _render_page($view, $data=null, $render=false)
    {

        $this->viewdata = (empty($data)) ? $this->data: $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render) return $view_html;
    }
}
?>



