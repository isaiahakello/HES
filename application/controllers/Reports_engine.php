<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_engine extends CI_Controller {

    public function __construct() 
    {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('household_classification_model','caregiver');
        $this->load->model('interventions_report_model','interventions');
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->vars('base_url', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/');
        $this->load->vars('includes_dir', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/resources/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
    }
    
 //Standard Reports
  function household_classfication()
  {
  $this->data['username'] = $this->ion_auth->user()->row()->username;
  $this->load->view('reports/standard/household_classification_view');    
  }
   public function household_graduation()
   {
       $this->load->view('reports/standard/household_graduation_view');
   }
  public function classification_ajax_list()
	{
 $this->load->helper('url');

		$list = $this->caregiver->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $caregiver) 
                    {
			$no++;
			$row = array();
                       
                       // $level=$this->tabledata->getSingleRecord('hva_levels',array('id'=>$caregiver->category),'level_name');
			if($caregiver->category==0)
                        {
                          $cat='Uncategorized';  
                        }
                        elseif($caregiver->category==1)
                        {
                         $cat='Highly Vulnerable';    
                        }
                        elseif($caregiver->category==2)
                        {
                         $cat='Moderately Vulnerable';    
                        }
                        elseif($caregiver->category==3)
                        {
                         $cat='Least Vulnerable';    
                        }
                        $row[]=$no;
                        $row[] = $caregiver->first_name.' '.$caregiver->middle_name.' '.$caregiver->surname;			
                        $row[] = $caregiver->national_id;
			$row[] = $caregiver->hiv_status;
                        $row[] = $caregiver->cbo;
                        $row[]='';
			$row[]=$cat;
			//add html for action
			$row[] = '<a href="javascript:;" class="btn btn-outline btn-circle btn-xs purple" title="Edit" onclick="edit_caregiver('."'".$caregiver->id."'".')"><i class="glyphicon glyphicon-pencil"></i> Edit</a>
				  <a href="javascript:;" class="btn btn-outline btn-circle btn-xs red" title="Delete" onclick="delete_caregiver('."'".$caregiver->id."'".')"><i class="glyphicon glyphicon-trash"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->caregiver->count_all(),
						"recordsFiltered" => $this->caregiver->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	} 
 
  function interventions_ajax_list()
  {
   $this->load->helper('url');

		$list = $this->interventions->get_datatables();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $caregiver) 
                    {
			$no++;
			$row = array();
                       
                       
                        $row[]=$no;
                        $row[] =$this->tabledata->getSingleRecord('caregivers',array('id'=>$caregiver->caregiver_id),'first_name').' '.$this->tabledata->getSingleRecord('caregivers',array('id'=>$caregiver->caregiver_id),'middle_name').' '.$this->tabledata->getSingleRecord('caregivers',array('id'=>$caregiver->caregiver_id),'surname') ;			
                        $row[] =$this->tabledata->getSingleRecord('caregivers',array('id'=>$caregiver->caregiver_id),'national_id');
			$row[] =$this->tabledata->getSingleRecord('hva_levels',array('id'=>$this->tabledata->getSingleRecord('interventions_table',array('id'=>$caregiver->intervention_id),'level_id')),'level_name');
                        $row[] = $this->tabledata->getSingleRecord('interventions_table',array('id'=>$caregiver->intervention_id),'activity');
			
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->interventions->count_all(),
						"recordsFiltered" => $this->interventions->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);    
  }
        
  function household_interventions()
  {
  $this->load->view('reports/standard/household_interventions_view');  
  }
 
  //Custom Reports


public function household_ranking()
{
  //$this->load->view('reports/custom/household_rankings');  
    
    $this->load->view('reports/custom/household_longitudinal_view');  
}  
}

