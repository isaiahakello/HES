<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));

        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->vars('base_url', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/');
        $this->load->vars('includes_dir', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/resources/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
    }

    function getConstituencies() {
        $countyId = $this->input->post('countyId');
        $getSiteData = $this->tabledata->selectRecords(array(), 'm_constituencies', array('county_code' => $countyId));

        foreach ($getSiteData as $key => $value) {
            $constName[$value->id] = $this->tabledata->getSingleRecord('m_constituencies', array('id' => $value->id), 'name');
            $constId[$value->id] = $value->id;
        }

        $data['constituency'] = $constName;
        $data['constituencyId'] = $constId;
        echo $this->load->view('ajax/loadConstituencies.php', $data, true);
    }

    function getwards() {

        $constituencyId = $this->input->post('constId');

        $cname = $this->tabledata->getSingleRecord(' m_constituencies', array('id' => $constituencyId), 'name');

        $getSiteData = $this->db->query("SELECT * FROM m_wards WHERE Constituency='" . $cname . "'")->result();
        //$getSiteData = $this->tabledata->selectRecords(array(), 'm_wards', array('Constituency' => $cname));

        foreach ($getSiteData as $key => $value) {
            $wardName[$value->id] = $this->tabledata->getSingleRecord('m_wards', array('id' => $value->id), 'ward_name');
            $wardId[$value->id] = $value->id;
        }

        $data['ward'] = $wardName;
        $data['wardId'] = $wardId;
        echo $this->load->view('ajax/loadWards.php', $data, true);
    }
        function getwards_hva() {

        $constituencyId = $this->input->post('constId');

        $cname = $this->tabledata->getSingleRecord(' m_constituencies', array('id' => $constituencyId), 'name');

        $getSiteData = $this->db->query("SELECT * FROM m_wards WHERE Constituency='" . $cname . "'")->result();
        //$getSiteData = $this->tabledata->selectRecords(array(), 'm_wards', array('Constituency' => $cname));

        foreach ($getSiteData as $key => $value) {
            $wardName[$value->id] = $this->tabledata->getSingleRecord('m_wards', array('id' => $value->id), 'ward_name');
            $wardId[$value->id] = $value->id;
        }

        $data['ward'] = $wardName;
        $data['wardId'] = $wardId;
        echo $this->load->view('ajax/loadWards_hva.php', $data, true);
    }
function ajax_modal()
{
 $data['ovcs']='tables';
 echo $this->load->view('ajax/ajax_modal.php', $data, true);   
}

function get_ovcs()
{
      $id= $this->input->post('caregiver');
       $data['ovcs']= $this->tabledata->selectRecords(array(), 'ovc_table', array('caregiver_id'=>$id));
       $this->load->view('ajaxTemplate/dependants', $data);
}


//HVA TOOL

    function loadDistricts() {
        $countyId = $this->input->post('countyId');
        $getSiteData = $this->db->query("SELECT district FROM cbo_table WHERE sub_county='".$countyId."' GROUP BY district")->result();

        foreach ($getSiteData as $key => $value) {
            $dName[$value->district] = $value->district;
        }

        $data['districts'] = $dName;
        
        echo $this->load->view('ajax/loadDistricts.php', $data, true);
    }

    function loadCBO()
    {
        
        $ward= preg_replace('~\x{00a0}~', '', str_replace(' ', '', $this->input->post('ward') ));
        $warddb= preg_replace('/\s+/', '', $ward);
        
       
       // $getSiteData = $this->db->query("SELECT cbo_name FROM cbo_table WHERE ward like '%".$warddb."%'")->result();
      $getSiteData = $this->db->query("SELECT cbo_name FROM cbo_table WHERE ward='".$warddb."'")->result();

        foreach ($getSiteData as $key => $value) 
        {
            $cboName[$value->cbo_name] = $value->cbo_name;
        }

        $data['cbos'] = $cboName;
       // print_r($data);
        echo $this->load->view('ajax/loadCBO.php', $data, true);
    }

    
    function newoutput()
    {
        $data[]='';
        echo $this->load->view('ajax/loadoutput.php',$data, true);
    }
    function newoutcome()
    {
         $data[]='';
        echo $this->load->view('ajax/loadoutcome.php',$data, true);
    }
    function newintermediary()
    {
       $data[]='';
        echo $this->load->view('ajax/loadintermediary.php',$data, true);  
    }
    function saveoutput()
    {
        $id = $this->input->post('rowid');
        $out = $this->input->post('output');
        
        //check duplicate
        $dupResult = $this->db->query('SELECT * FROM interventions_output WHERE output like "%'.$out.'%" AND intervention_id="'.$id.'" ')->num_rows();

        if ($dupResult == 1) {
       

            $dataX = array(
                'output' => $out,
                'date_added' =>DATE_TIME
                
            );
            $result = $this->tabledata->updateRecord($dataX, 'interventions_output', array('intervention_id' => $id));

            if ($result) {
                $data['outputs'] = $this->tabledata->selectRecords(array(), 'interventions_output', array('intervention_id' => $id));

                $this->load->view('ajax/outputlist.php', $data);
            }
        } elseif ($dupResult == 0) {
            $dataZ = array(array(
                   'intervention_id' => $id,
                'output' => $out,
                'date_added' =>DATE_TIME,
                'stato ' => 1
            ));

            $result = $this->tabledata->insertTableData($dataZ, 'interventions_output');
            if ($result) {
                $data['outputs'] = $this->tabledata->selectRecords(array(), 'interventions_output', array('intervention_id' => $id));

                $this->load->view('ajax/outputlist.php', $data);
            }
        }
    }
    
    function saveintermediary()
    {
        $id = $this->input->post('rowid');
        $intermediary = $this->input->post('intermediary');
        
        //check duplicate
        $dupResult = $this->db->query('SELECT * FROM interventions_intermediary_outcomes WHERE intermediary_outcome like "%'.$intermediary.'%" AND intervention_id="'.$id.'" ')->num_rows();

        if ($dupResult == 1) {
       

            $dataX = array(
                'intermediary_outcome' => $intermediary,
                'date_added' =>DATE_TIME
                
            );
            $result = $this->tabledata->updateRecord($dataX, 'interventions_intermediary_outcomes', array('intervention_id' => $id));

            if ($result) {
                $data['intermediary'] = $this->tabledata->selectRecords(array(), 'interventions_intermediary_outcomes', array('intervention_id' => $id));

                $this->load->view('ajax/intermediarylist.php', $data);
            }
        } elseif ($dupResult == 0) {
            $dataZ = array(array(
                   'intervention_id' => $id,
                'intermediary_outcome' => $intermediary,
                'date_added' =>DATE_TIME,
                'stato ' => 1
            ));

            $result = $this->tabledata->insertTableData($dataZ, 'interventions_intermediary_outcomes');
            if ($result) {
                $data['intermediary'] = $this->tabledata->selectRecords(array(), 'interventions_intermediary_outcomes', array('intervention_id' => $id));

                $this->load->view('ajax/intermediarylist.php', $data);
            }
        }
    }
    
     function saveoutcome()
    {
        $id = $this->input->post('rowid');
        $outcome = $this->input->post('outcome');
        
        //check duplicate
        $dupResult = $this->db->query('SELECT * FROM interventions_outcomes WHERE outcome like "%'.$outcome.'%" AND intervention_id="'.$id.'" ')->num_rows();

        if ($dupResult == 1) {
       

            $dataX = array(
                'outcome' => $outcome,
                'date_added' =>DATE_TIME
                
            );
            $result = $this->tabledata->updateRecord($dataX, 'interventions_outcomes', array('intervention_id' => $id));

            if ($result) {
                $data['outcomes'] = $this->tabledata->selectRecords(array(), 'interventions_outcomes', array('intervention_id' => $id));

                $this->load->view('ajax/outcomelist.php', $data);
            }
        } elseif ($dupResult == 0) {
            $dataZ = array(array(
                   'intervention_id' => $id,
                'outcome' => $outcome,
                'date_added' =>DATE_TIME,
                'stato ' => 1
            ));

            $result = $this->tabledata->insertTableData($dataZ, 'interventions_outcomes');
            if ($result) {
                $data['outcomes'] = $this->tabledata->selectRecords(array(), 'interventions_outcomes', array('intervention_id' => $id));

                $this->load->view('ajax/outcomelist.php', $data);
            }
        }
    }
    
    function step_one()
    {
        $level = $this->input->post('level');
        $activity = $this->input->post('activity');
        $user=$this->ion_auth->user()->row()->id;
        //check duplicate
        $dupResult = $this->db->query('SELECT * FROM interventions_table WHERE activity like "%'.$activity.'%" AND level_id="'.$level.'" ')->num_rows();
        if($dupResult==0)
        {
            $dataZ = array(array(
                   'level_id' => $level,
                'activity' => $activity,
                'date_added' =>DATE_TIME,
                'added_by' =>$user,
                'stato'=>1
            ));

            $result = $this->tabledata->insertTableData($dataZ, 'interventions_table');
            if ($result) {
             $data['rowid'] = $this->db->query("SELECT MAX(id) as id FROM interventions_table WHERE activity='" . $activity . "' AND level_id='" . $level . "'")->row()->id;


            $this->load->view('ajax/rowid.php', $data);
            }
        }
 /*else {
     
     echo '';
 }*/
    }   
    
    
   public function show_cbos()
   {
     $sdp= $this->input->post('sdpname'); 
      $getSiteData = $this->db->query("SELECT * FROM cbo_table WHERE sdp_id='".$sdp."'")->result();

       
        $data['cbos'] =$getSiteData;
        
        echo $this->load->view('ajax/show_cbos.php', $data, true);
   }
   
   //HVA WIZARD
   
   public function initiate_wizard()
   {
      $cbo=$this->input->post('cbo'); 
      $serial=$this->input->post('serial');
      $chv=$this->input->post('chv');
      $date=$this->input->post('datez');
   // echo $serial.' '.$cbo;
    
     $data=array(
         array(
             'cbo_name'=>$cbo,
             'serial_no'=>$serial,
             'lead_chv'=>$chv,
             'date_conducted'=>$date
             )
     );
      $insert=$this->tabledata->insertTableData($data, 'cbo_characteristics');
      
      if($insert){
       $datax['id']=$this->tabledata->getSingleRecord('cbo_characteristics',array('serial_no'=>$serial),'id');  
       $this->load->view('ajax/wizard_row.php',$datax);   
      }
   }
   
  public function search_household()
  {
       $var = $this->input->post('searchval');
       $records="SELECT * FROM caregivers WHERE (national_id='".$var."' OR cbo='".$var."')";
       if($records)
       {
       $data['households']=$this->db->query($records)->result();
       //print_r($data);
       $this->load->view('ajax/search_results.php', $data);
       }
       else
           {
           echo 'Unknown error occured';
       }
  }
  
  public function save_activity()
  {
      $caregiver=$this->input->post('caregiver');
      $activity=$this->input->post('activity');
      $status='1';
      $user=$this->ion_auth->user()->row()->id;
            foreach($activity as $key => $value)
{
					//save
  $activity_id = $value;
  $data=array(
      array(
          'caregiver_id'=>$caregiver,
          'intervention_id'=>$activity_id,
          'date_assigned'=>DATE_TIME,
          'intervention_status'=>$status,
          'assigned_by'=>$user,
          	
  )
  );
  
  $request=$this->tabledata->insertTableData($data, 'household_interventions');
  
  if($request)
  {
      echo '<br>'.'<b class="font-green">Data Entry Successful</b>';  
  }
  else{
      echo '<br>'.'<b class="font-red">Unknown error occured</b>';  
  }
 
} 
      
  }
 



  public function search_household_gri()
  {
       $var = $this->input->post('searchval');
       $records="SELECT * FROM caregivers WHERE (national_id='".$var."')";
       $count=$this->db->query("SELECT * FROM caregivers WHERE national_id='".$var."'")->num_rows();
       if($count==1)
       {
       if($records)
       {
       $check_level=$this->tabledata->getSingleRecord('caregivers',array('national_id'=>$var),'category');
       if($check_level=='3')
       {
       $data['households']=$this->db->query($records)->result();
       
       $this->load->view('ajax/search_results_gri.php', $data);
       }
       else{
           
           echo '<div class="alert alert-warning alert-dismissable">
                                        <button class="close" aria-hidden="true" type="button" data-dismiss="alert"></button>
                                        <strong>Warning!</strong> The household is not eligible for graduation. Only least vulnerable households can be analysed for graduation. </div>';
       }
       }
       else
           {
           echo 'Unknown error occured';
       }
  }
  elseif($count>1){
     echo '<div class="alert alert-warning alert-dismissable">
                                        <button class="close" aria-hidden="true" type="button" data-dismiss="alert"></button>
                                        <strong>Warning!</strong> There exists more than one records with ID number'.' '.$var.'.Try using an alternative search criteria </div>'; 
  }
  elseif($count==0)
  {
      echo '<div class="alert alert-danger alert-dismissable">
                                        <button class="close" aria-hidden="true" type="button" data-dismiss="alert"></button>
                                        <strong>Error!</strong> There ID number'.' <strong>'.$var.'</strong> Does not exist</div>'; 
     
  }
  }
}
?>



