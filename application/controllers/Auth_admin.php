<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Auth_admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model(array('hes_model','gri_model'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->vars('base_url', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/');
        $this->load->vars('includes_dir', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/resources/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
    }

    public function index() {

        if (!$this->ion_auth->logged_in()) {
            // redirect them to the login page
            redirect('auth/login', 'refresh');
        } else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['username'] = $this->ion_auth->user()->row()->username;
            $this->_render_page('analytics/index', $this->data);
        }
    }

    function user_accounts() {
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['username'] = $this->ion_auth->user()->row()->username;
        //list the users
        $this->data['users'] = $this->ion_auth->users()->result();
        foreach ($this->data['users'] as $k => $user) {
            $this->data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
        }

        $this->_render_page('auth/index', $this->data);
    }

    function user_groups() {
        // set the flash data error message if there is one
        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
        $this->data['username'] = $this->ion_auth->user()->row()->username;
        //list the users
        $this->data['groups'] = $this->ion_auth->groups()->result();

        $this->_render_page('auth/user_groups_view', $this->data);
    }

    function settings() {
        if ($this->input->post('save_indicator')) {
            $this->hes_model->save_indicator();
        }
        if ($this->input->post('save_gri_indicator')) {
            $this->hes_model->save_gri_indicator();
        }
        if ($this->input->post('classify')) {
            $this->hes_model->do_classification();
        }
        if ($this->input->post('upload')) 
        {
            $this->hes_model->upload_interventions();
        }
        $this->data['criteria'] = $this->db->query("SELECT * FROM hva_criteria WHERE status='1'")->result();
        $this->data['indicators'] = $this->db->query("SELECT * FROM hva_indicators WHERE stato='1'")->result();

        //GRI
        $this->data['criteria_g'] = $this->db->query("SELECT * FROM gri_criteria WHERE status='1'")->result();
        $this->data['indicators_g'] = $this->db->query("SELECT * FROM gri_indicators WHERE stato='1'")->result();
        $this->data['username'] = $this->ion_auth->user()->row()->username;
        //list the users
        $this->data['groups'] = $this->ion_auth->groups()->result();
        $this->_render_page('auth_admin/settings_view', $this->data);
    }

    public function gri_list() {
        $this->load->helper('url');

        $list = $this->gri_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $value)
            {
            $no++;
            
            $criteriz=$this->tabledata->getSingleRecord('gri_criteria',array('id'=>$value->criteria_id),'indicator_title');
                                                 
            $row = array();
            $row[] = $criteriz;
            $row[] = $value->indicator_desc;
            $row[] = $value->max_score;
            $row[] = '<a href="javascript:;" class="btn btn-link" href="javascript:;" onclick="add_option(' . "'" . $value->id . "'" . ')">&nbsp;Add</a>';
            
            //add html for action
            $row[] = '<a href="javascript:;"  title="Edit" onclick="edit_gri(' . "'" . $value->id . "'" . ')"><i class="fa fa-edit red"></i></a>
		      <a href="javascript:;" title="Delete" onclick="delete_gri(' . "'" . $value->id . "'" . ')"><i class="fa fa-trash red"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->gri_model->count_all(),
            "recordsFiltered" => $this->gri_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function gri_edit($id) {
        $data = $this->gri_model->get_by_id($id);
        echo json_encode($data);
    }

    public function gri_add() {
        //$this->_validate();

        $data = array(array(
            'indicator_id' => $this->input->post('rowid'),
            'option_name' => $this->input->post('option'),
            'points'=> $this->input->post('score'),
            'date_added' => DATE_TIME,
            'stato' => 1
        ));



        $save = $this->tabledata->insertTableData($data, 'gri_indicator_options');

        echo json_encode(array("status" => TRUE));
    }

    public function gri_update() {
        $this->_validate();
        $data = array(
            'level_id' => $this->input->post('level'),
            'activity' => $this->input->post('activity'),
        );


        $this->gri_model->update(array('id' => $this->input->post('id')), $data);
        echo json_encode(array("status" => TRUE));
    }

    public function gri_delete($id) {
        //delete file
        $intervention = $this->gri_model->get_by_id($id);

        $this->gri_model->delete_by_id($id);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('option') == '')
		{
			$data['inputerror'][] = 'option';
			$data['error_string'][] = 'Indicator option is required';
			$data['status'] = FALSE;
		}
               if($this->input->post('score') == '' || !is_numeric($this->input->post('score')))
		{
			$data['inputerror'][] = 'score';
			$data['error_string'][] = 'Score is required';
			$data['status'] = FALSE;
		}
		
		

		if($data['status'] === FALSE)
		{
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

