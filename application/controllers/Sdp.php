<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Sdp extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->helper('form');
        $this->load->model('sdp_model', 'sdp');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->vars('base_url', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/');
        $this->load->vars('includes_dir', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/resources/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
    }

    public function index() {
        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['username'] = $this->ion_auth->user()->row()->username;
            $this->data['sdp'] = $this->tabledata->selectRecords(array(), 'sdp_table', array());
            $this->data['county'] = $this->tabledata->selectRecords(array(), 'm_counties', array('nilinde' => 1));

            $this->_render_page('sdp/index', $this->data);
        }
    }

    public function ajax_list() {
        $this->load->helper('url');

        $list = $this->sdp->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $sdp) {
            $no++;
            $row = array();
           
            $cbo=$this->db->query("SELECT * FROM cbo_table WHERE sdp_id='".$sdp->sdp_name."'")->num_rows();
            $row[] = $no;
            $row[] = $sdp->sdp_name;
            $row[] = $sdp->county;
            $row[] = $sdp->county_coordinator;
            //onclick="show_cbos(' . "'" . $sdp->name . "'" . ')"
            $row[] = '<a href="javascript:;"  onclick="show_cbos(' . "'" . $sdp->sdp_name. "'" . ')">'.$cbo.'</a>';
            if ($sdp->stato == 1) {
               $row[] = 'Active'; 
            } elseif ($sdp->stato == 0) {
                $row[] = 'Deactivated';
            }
            //add html for action
            $row[] = '<a href="javascript:;" class="btn btn-outline btn-circle btn-xs purple" title="Edit" onclick="edit_sdp(' . "'" . $sdp->id . "'" . ')"><i class="fa fa-edit"></i> Edit</a>
				  <a href="javascript:;" class="btn btn-outline btn-circle btn-xs red" onclick="delete_sdp(' . "'" . $sdp->id . "'" . ')"><i class="fa fa-trash"></i> Delete</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->sdp->count_all(),
            "recordsFiltered" => $this->sdp->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_edit($id) {
        $data = $this->sdp->get_by_id($id);
        echo json_encode($data);
    }

    public function ajax_add() {
        $this->_validate();

        $data = array(
            'sdp_name' => $this->input->post('sdp_name'),
            'county' => $this->input->post('county'),
            'county_coordinator' => $this->input->post('county_coordinator'),
            'date_added' => DATE_TIME,
            'stato' => 1,
        );



        $insert = $this->sdp->save($data);

        echo json_encode(array("status" => TRUE));
    }

    public function ajax_update() {
        $this->_validate();
        $data = array(
            'sdp_name' => $this->input->post('sdp_name'),
            'county' => $this->input->post('county'),
            'county_coordinator' => $this->input->post('county_coordinator'),
        );


        $this->sdp->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_delete($id) {
        //delete file
        $sdp = $this->sdp->get_by_id($id);

        $this->sdp->delete_by_id($id);
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

        if ($this->input->post('sdp_name') == '') {
            $data['inputerror'][] = 'sdpName';
            $data['error_string'][] = 'SDP name is required';
            $data['status'] = FALSE;
        }

        if ($this->input->post('county') == '') {
            $data['inputerror'][] = 'county';
            $data['error_string'][] = 'County name is required';
            $data['status'] = FALSE;
        }

        /*         * if($this->input->post('county_coordinator') == '')
          {
          $data['inputerror'][] = 'coordinator';
          $data['error_string'][] = 'County Coordinator is required';
          $data['status'] = FALSE;
          }
         * */


        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }

    function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

}
?>



