<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cbo extends CI_Controller {

    public function __construct() 
            {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->helper('form');
        $this->load->model(array('hes_model','cbo_model'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->vars('base_url', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/');
        $this->load->vars('includes_dir', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/resources/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
    }
    


public function index()
{
         if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } 
         if($this->input->post('upload'))
        {
           $this->hes_model->upload_cbo(); 

        
        } 
        
        else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['username']=$this->ion_auth->user()->row()->username;
            $this->data['sdps']=$this->tabledata->selectRecords(array(),'sdp_table',array());
            $this->data['county']=$this->tabledata->selectRecords(array(),'m_counties',array('nilinde'=>1));
            $this->data['constituency']=$this->tabledata->selectRecords(array(),'m_constituencies',array());
            $this->data['ward']=$this->tabledata->selectRecords(array(),'m_wards',array());
            $this->data['file_name']='cbo_upload_sample.xls';
            $this->_render_page('cbo/index',$this->data);
        }   
}

public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->cbo_model->get_datatables();
                //print_r($list);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $cbo) {
			$no++;
			$row = array();
			$caregivers=$this->db->query("SELECT * FROM caregivers WHERE cbo='".$cbo->cbo_name."'")->num_rows();
                         if ($cbo->stato == 1) {
                $stato = 'Active';
            } elseif ($value->stato == 0) {
                $stato = 'Inactive';
            }
                        $row[]=$no;
                        $row[] = $cbo->cbo_name;
			$row[] = $cbo->sdp_id;
			$row[] = $cbo->county;
                        $row[] = $cbo->sub_county;
			$row[] = $cbo->ward;
                        $row[] = '<a href="'. SITEURLADM.'cbo/households/'.$cbo->id.' ">'.$caregivers.'</a>';
                        //$row[] ='';
                        $row[] = $stato;
			
			//add html for action
			$row[] = '<a href="javascript:;" class="btn btn-outline btn-circle btn-xs purple" onclick="edit_cbo('."'".$cbo->id."'".')"><i class="fa fa-edit"></i>  Edit</a>
				  <a href="javascript:;" class="btn btn-outline btn-circle btn-xs red" title="Delete" onclick="delete_cbo('."'".$cbo->id."'".')"><i class="fa fa-trash"></i>  Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->cbo_model->count_all(),
						"recordsFiltered" => $this->cbo_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->cbo_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		$county=$this->tabledata->getSingleRecord('m_counties',array('id'=>$this->input->post('county')),'county_name');
                $subcounty=$this->tabledata->getSingleRecord('m_constituencies',array('id'=>$this->input->post('constituency')),'name');
                $ward=$this->tabledata->getSingleRecord('m_wards',array('id'=>$this->input->post('ward')),'ward_name');
		$data = array(
				'sdp_id' => $this->input->post('sdp_name'),
				'cbo_name' => $this->input->post('cbo_name'),
				'county' => $county,
				'sub_county' => $subcounty,
				'ward' => $ward,
                                'date_created'=>DATE_TIME,
                               'stato'=>1
			);

		
		$insert = $this->cbo_model->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
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

	public function ajax_delete($id)
	{
		//delete file
		$cbo = $this->cbo_model->get_by_id($id);
		
		
		$this->cbo_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	private function _do_upload()
	{
		$config['upload_path']          = 'upload/';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 100; //set max size allowed in Kilobyte
        $config['max_width']            = 1000; // set max width image allowed
        $config['max_height']           = 1000; // set max height allowed
        $config['file_name']            = round(microtime(true) * 1000); //just milisecond timestamp fot unique name

        $this->load->library('upload', $config);

        if(!$this->upload->do_upload('photo')) //upload and validate
        {
            $data['inputerror'][] = 'photo';
			$data['error_string'][] = 'Upload error: '.$this->upload->display_errors('',''); //show ajax error
			$data['status'] = FALSE;
			echo json_encode($data);
			exit();
		}
		return $this->upload->data('file_name');
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('cbo_name') == '')
		{
			$data['inputerror'][] = 'cbo_name';
			$data['error_string'][] = 'CBO name is required';
			$data['status'] = FALSE;
		}
               if($this->input->post('sdp_name') == '')
		{
			$data['inputerror'][] = 'sdp_name';
			$data['error_string'][] = 'SDP name is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('county') == '')
		{
			$data['inputerror'][] = 'county';
			$data['error_string'][] = 'County is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('constituency') == '')
		{
			$data['inputerror'][] = 'constituency';
			$data['error_string'][] = 'Sub-County is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('ward') == '')
		{
			$data['inputerror'][] = 'ward';
			$data['error_string'][] = 'Please select ward';
			$data['status'] = FALSE;
		}

		

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

        
         function download()
{
        $this->load->helper('download');
        $name = 'cbo_upload_sample.xls';
        $data = file_get_contents("./resources/downloads/cbo_upload_sample.xls"); // Read the file's contents

        force_download($name, $data);
    } 
    
function households($id)
{
   $cbo=$this->tabledata->getSingleRecord('cbo_table',array('id'=>$id),'cbo_name');
   $this->data['username']=$this->ion_auth->user()->row()->username;
   $this->data['households']=$this->tabledata->selectRecords(array(),'caregivers',array('cbo'=>$cbo));
   $this->_render_page('cbo/households',$this->data);
}
function _render_page($view, $data=null, $render=false)
    {

        $this->viewdata = (empty($data)) ? $this->data: $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render) return $view_html;
    }
}
?>



