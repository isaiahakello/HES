<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Interventions extends CI_Controller 
{
     public function __construct()
     {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model(array('hes_model','interventions_model'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->vars('base_url', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/');
        $this->load->vars('includes_dir', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/resources/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
    }   
   public function manage_interventions()
    {
         if($this->input->post('save'))
         {
          $this->hes_model->save_intervention();   
         }
        
            $this->data['username']=$this->ion_auth->user()->row()->username;
            $this->data['interventions']= $this->tabledata->selectRecords(array(),'interventions_table',array());
            $this->data['levels']= $this->tabledata->selectRecords(array(),'hva_levels',array());
            $this->_render_page('interventions/interventions_view',$this->data);   
    }
  /*  public function new_intervention()
    {
        
        
            $this->data['username']=$this->ion_auth->user()->row()->username;
            $this->data['interventions']= $this->tabledata->selectRecords(array(),'interventions_table',array());
            $this->data['levels']= $this->tabledata->selectRecords(array(),'hva_levels',array());
            $this->_render_page('interventions/add_intervention_view',$this->data);   
    }*/
     public function monitoring()
    {
        
        
            $this->data['username']=$this->ion_auth->user()->row()->username;
            $this->data['interventions']= $this->tabledata->selectRecords(array(),'interventions_table',array());
            $this->data['levels']= $this->tabledata->selectRecords(array(),'hva_levels',array());
            $this->_render_page('interventions/monitoring_view',$this->data);   
    }
    public function ajax_list()
	{
		$this->load->helper('url');

		$list = $this->interventions_model->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $value) {
			$no++;
                        $level=$this->tabledata->getSingleRecord('hva_levels',array('id'=>$value->level_id),'level_name');
			if($value->stato==1)
                        {
                          $stato='Active'; 
                           
                        }
                        elseif($value->stato==0)
                        {
                          $stato='Inactive';   
                        }
                        
                        $row = array();
			$row[]=$no;                        
			$row[] = $value->activity;
                        $row[] = $level;
			$row[]='<a href="javascript:;" class="btn btn-link" href="javascript:;" onclick="monitoring('."'".$value->id."'".')">View</a>';
                        $row[] =$stato;
			//add html for action
			$row[] = '<a href="javascript:;" class="btn btn-outline btn-circle btn-xs purple" title="Edit" onclick="edit_intervention('."'".$value->id."'".')"><i class="fa fa-edit"></i> Edit</a>
				  <a href="javascript:;" class="btn btn-outline btn-circle btn-xs red" title="Delete" onclick="delete_intervention('."'".$value->id."'".')"><i class="fa fa-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->interventions_model->count_all(),
						"recordsFiltered" => $this->interventions_model->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->interventions_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		$this->_validate();
		
		$data = array(
				'level_id' => $this->input->post('level'),
				'activity' => $this->input->post('activity'),
				'date_added' => DATE_TIME,
				'stato' =>1,
			);

		

		$insert = $this->interventions_model->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'level_id' => $this->input->post('level'),
				'activity' => $this->input->post('activity'),
                    );


		$this->interventions_model->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$intervention= $this->interventions_model->get_by_id($id);
		
		$this->interventions_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	
	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('level') == '')
		{
			$data['inputerror'][] = 'level';
			$data['error_string'][] = 'Level is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('activity') == '')
		{
			$data['inputerror'][] = 'activity';
			$data['error_string'][] = 'Activity is required';
			$data['status'] = FALSE;
		}

		

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

        
    
    function _render_page($view, $data=null, $render=false)
    {

        $this->viewdata = (empty($data)) ? $this->data: $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render) return $view_html;
    }
}
