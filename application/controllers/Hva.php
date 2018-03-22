<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Hva extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));

        $this->load->model(array('hes_model'));
         $this->load->model(array('tabledata'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->vars('base_url', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/');
        $this->load->vars('includes_dir', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/resources/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
    }

    public function index() {

        $this->data['username'] = $this->ion_auth->user()->row()->username;
        $this->data['household_types'] = $this->db->query("SELECT * FROM hva_levels")->result();
        $this->data['county'] = $this->db->query("SELECT county FROM cbo_table GROUP BY county")->result();
        $this->data['cbos'] = $this->db->query("SELECT * FROM cbo_table WHERE stato='1'")->result();
        $this->data['sdps'] = $this->tabledata->selectRecords(array(), 'sdp_table', array());
        $this->data['county'] = $this->tabledata->selectRecords(array(), 'm_counties', array('nilinde' => 1));
        $this->data['constituency'] = $this->tabledata->selectRecords(array(), 'm_constituencies', array());
        $this->data['ward'] = $this->tabledata->selectRecords(array(), 'm_wards', array());
        $this->data['criteriaA'] = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='1'")->result();
        $this->data['criteriaB'] = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='2'")->result();
        $this->data['criteriaC'] = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='3'")->result();
        $this->data['criteriaD'] = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='4'")->result();
        $this->data['criteriaE'] = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='5'")->result();
        $this->data['criteriaF'] = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='6'")->result();
        $this->_render_page('households/hva_wizard', $this->data);
    }
   public function save_data()
   {
               if ($this->input->post('save')) {

            $a = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='1'")->result();
            $b = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='2'")->result();
            $c = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='3'")->result();
            $d = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='4'")->result();
            $e = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='5'")->result();
            $f = $this->db->query("SELECT * FROM hva_indicators WHERE criteria_id='6'")->result();
            $rowid=$this->input->post('rowid');
            
            $household_types= $this->db->query("SELECT * FROM hva_levels")->result();
            foreach ($a as $key => $value) {
                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                $sname = substr($criteria_name, -1);
                $snameZ = $sname . $value->id;

                foreach ($household_types as $k => $v) 
                    {
                    //B7A criteria/indicator/level
                    $desc_a = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $snameZ.$v->level));
                    $input=$this->input->post($desc_a);
                    $criteria='Criteria'.' '.substr($desc_a,0,1);
                    $criteria_id=$this->tabledata->getSingleRecord('hva_criteria',array('criteria_name'=>$criteria),'id');
                    $indicator=substr($desc_a,1,1);
                    
                    $level=substr($desc_a,2,1);
                    //$level_id=$this->tabledata->getSingleRecord('hva_levels',array('level'=>$level),'id');
                    //$level_id=$v->id;
                    $data_a=array(
                        array(
                            'characteristic_fk'=>$rowid,
                            'level_id'=>$v->id,
                            'criteria_id'=>$criteria_id,
                            'indicator_id'=>$indicator,
                            'description'=>$input
                        )
                        
                    );
                    
                     $insert_a=$this->tabledata->insertTableData($data_a, 'cbo_characteristic_indicators');
                }
            }
            
     //Savings And Assets
                        foreach ($b as $key => $value) {
                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                $sname = substr($criteria_name, -1);
                $snameZ = $sname . $value->id;

                foreach ($household_types as $k => $v) 
                    {
                    //B7A criteria/indicator/level
                    $desc_b = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $snameZ.$v->level));
                    $input=$this->input->post($desc_b);
                    $criteria='Criteria'.' '.substr($desc_b,0,1);
                    $criteria_id=$this->tabledata->getSingleRecord('hva_criteria',array('criteria_name'=>$criteria),'id');
                    $indicator=substr($desc_b,1,1);
                    
                    $level=substr($desc_b,2,1);
                    //$level_id=$this->tabledata->getSingleRecord('hva_levels',array('level'=>$level),'id');
                    
                    $data_b=array(
                        array(
                            'characteristic_fk'=>$rowid,
                            'level_id'=>$v->id,
                            'criteria_id'=>$criteria_id,
                            'indicator_id'=>$indicator,
                            'description'=>$input
                        )
                        
                    );
                    
                     $insert_b=$this->tabledata->insertTableData($data_b, 'cbo_characteristic_indicators');
                }
            }
   //Shelter And Dwellings
            
                        foreach ($c as $key => $value) {
                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                $sname = substr($criteria_name, -1);
                $snameZ = $sname . $value->id;

                foreach ($household_types as $k => $v) 
                    {
                    //B7A criteria/indicator/level
                    $desc_c= preg_replace('~\x{00a0}~', '', str_replace(' ', '', $snameZ.$v->level));
                    $input=$this->input->post($desc_c);
                    $criteria='Criteria'.' '.substr($desc_c,0,1);
                    $criteria_id=$this->tabledata->getSingleRecord('hva_criteria',array('criteria_name'=>$criteria),'id');
                    $indicator=substr($desc_c,1,1);
                    
                    $level=substr($desc_c,2,1);
                    //$level_id=$this->tabledata->getSingleRecord('hva_levels',array('level'=>$level),'id');
                    
                    $data_c=array(
                        array(
                            'characteristic_fk'=>$rowid,
                            'level_id'=>$v->id,
                            'criteria_id'=>$criteria_id,
                            'indicator_id'=>$indicator,
                            'description'=>$input
                        )
                        
                    );
                    
                     $insert_c=$this->tabledata->insertTableData($data_c, 'cbo_characteristic_indicators');
                }
            }
            
            
         //Health   
                  foreach ($d as $key => $value) {
                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                $sname = substr($criteria_name, -1);
                $snameZ = $sname . $value->id;

                foreach ($household_types as $k => $v) 
                    {
                    //B7A criteria/indicator/level
                    $desc_d = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $snameZ.$v->level));
                    $input=$this->input->post($desc_d);
                    $criteria='Criteria'.' '.substr($desc_d,0,1);
                    $criteria_id=$this->tabledata->getSingleRecord('hva_criteria',array('criteria_name'=>$criteria),'id');
                    $indicator=substr($desc_d,1,1);
                    
                    $level=substr($desc_d,2,1);
                    //$level_id=$this->tabledata->getSingleRecord('hva_levels',array('level'=>$level),'id');
                    
                    $data_d=array(
                        array(
                            'characteristic_fk'=>$rowid,
                            'level_id'=>$v->id,
                            'criteria_id'=>$criteria_id,
                            'indicator_id'=>$indicator,
                            'description'=>$input
                        )
                        
                    );
                    
                     $insert_d=$this->tabledata->insertTableData($data_d, 'cbo_characteristic_indicators');
                }
            }
            
     //self-esteem/self-confidence/Agency
            
                            foreach ($e as $key => $value) {
                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                $sname = substr($criteria_name, -1);
                $snameZ = $sname . $value->id;

                foreach ($household_types as $k => $v) 
                    {
                    //B7A criteria/indicator/level
                    $desc_e = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $snameZ.$v->level));
                    $input=$this->input->post($desc_e);
                    $criteria='Criteria'.' '.substr($desc_e,0,1);
                    $criteria_id=$this->tabledata->getSingleRecord('hva_criteria',array('criteria_name'=>$criteria),'id');
                    $indicator=substr($desc_e,1,1);
                    
                    $level=substr($desc_e,2,1);
                    //$level_id=$this->tabledata->getSingleRecord('hva_levels',array('level'=>$level),'id');
                    
                    $data_e=array(
                        array(
                            'characteristic_fk'=>$rowid,
                            'level_id'=>$v->id,
                            'criteria_id'=>$criteria_id,
                            'indicator_id'=>$indicator,
                            'description'=>$input
                        )
                        
                    );
                    
                     $insert_e=$this->tabledata->insertTableData($data_e, 'cbo_characteristic_indicators');
                }
            }
      
   //Social
            
                            foreach ($f as $key => $value) {
                $criteria_name = $this->tabledata->getSingleRecord('hva_criteria', array('id' => $value->criteria_id), 'criteria_name');
                $sname = substr($criteria_name, -1);
                $snameZ = $sname . $value->id;

                foreach ($household_types as $k => $v) 
                    {
                    //B7A criteria/indicator/level
                    $desc_f = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $snameZ.$v->level));
                    $input=$this->input->post($desc_f);
                    $criteria='Criteria'.' '.substr($desc_f,0,1);
                    $criteria_id=$this->tabledata->getSingleRecord('hva_criteria',array('criteria_name'=>$criteria),'id');
                    $indicator=substr($desc_f,1,1);
                    
                    $level=substr($desc_f,2,1);
                    //$level_id=$this->tabledata->getSingleRecord('hva_levels',array('level'=>$level),'id');
                    
                    $data_f=array(
                        array(
                            'characteristic_fk'=>$rowid,
                            'level_id'=>$v->id,
                            'criteria_id'=>$criteria_id,
                            'indicator_id'=>$indicator,
                            'description'=>$input
                        )
                        
                    );
                    
                     $insert_f=$this->tabledata->insertTableData($data_f, 'cbo_characteristic_indicators');
                }
            }
       
            if($insert_a && $insert_b && $insert_c && $insert_d && $insert_e && $insert_f)
            {
            $this->session->set_flashdata('dispMessage', '<div class=" alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Cbo household characteristics have been saved.You can now classify households within the CBO</div>');

           // redirect('hva/index', 'location'); 
             redirect('hva/classification/' . $rowid, 'location');
            }
            
                    }
   }
   
   public function classification($id)
   {
            if($this->input->post('level'))
     {
      
      $pool=$this->input->post('level');
      $no_of_households=  count($pool);
      $rowid=$this->input->post('last');
      foreach($pool as $key => $value)
				{
					//save
  
  $ln= (strlen( $value)-1);
  $level=substr( $value,0,1);
  $household=substr($value,1,$ln);
  $data=array(
      array(
          'caregiver_id'=>$household,
          'level_id'=>$level,
          'date_added'=>DATE_TIME
  )
  );
  
  $request=$this->tabledata->insertTableData($data, 'household_vulnerability_levels');
  $update=$this->db->query("UPDATE caregivers SET category='".$level."' WHERE id='".$household."'"); 
} 
                                
    if($request)
  {
       
   $this->session->set_flashdata('dispMessage', '<div class=" alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button><strong>SUCCESS!&nbsp;&nbsp;</strong> '.$no_of_households.' '.'households have been classified.</div>');
   redirect('hva/classification/' . $rowid, 'location');
  }
  else{
   $this->session->set_flashdata('dispMessage', '<strong>ERROR!&nbsp;&nbsp;</strong>Request was unsuccessful.Try again later');
    redirect('hva/classification/' . $rowid, 'location');    
  }
     }      
        $rowid = $id;        
        $cbo= $this->tabledata->getSingleRecord('cbo_characteristics', array('id' => $rowid), 'cbo_name');
        $data['caregivers'] = $this->tabledata->selectRecords(array(), 'caregivers', array('cbo' => $cbo));
        $data['groups']= $this->db->query("SELECT * FROM hva_levels")->result();
        $data['username'] = $this->ion_auth->user()->row()->username;
        $data['cboz']=$cbo;
        $this->load->view('households/cbo_household_classification', $data);
    }
   
   
    /*public function household_classification() {

        if ($this->input->post('upload')) {
            $this->hes_model->do_classification();
        }
        $this->data['username'] = $this->ion_auth->user()->row()->username;
        $this->data['caregivers'] = $this->db->query("SELECT * FROM caregivers LIMIT 500")->result();
        $this->_render_page('households/classification_view', $this->data);
    }*/

    function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

}
