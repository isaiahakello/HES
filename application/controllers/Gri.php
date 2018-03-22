<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Gri extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));

        $this->load->model(array('gri_model'));
        $this->load->model(array('tabledata'));
        $this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

        $this->lang->load('auth');
        $this->load->vars('base_url', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/');
        $this->load->vars('includes_dir', 'http://' . $_SERVER['HTTP_HOST'] . '/hes/resources/');
        $this->load->vars('current_url', $this->uri->uri_to_assoc(1));
    }

    public function index() {

        $this->data['username'] = $this->ion_auth->user()->row()->username;
        $this->data['sdps'] = $this->tabledata->selectRecords(array(), 'sdp_table', array());
        $this->data['criteriaA'] = $this->db->query("SELECT * FROM gri_indicators WHERE criteria_id='1'")->result();
        $this->data['criteriaB'] = $this->db->query("SELECT * FROM gri_indicators WHERE criteria_id='2'")->result();
        $this->data['criteriaC'] = $this->db->query("SELECT * FROM gri_indicators WHERE criteria_id='3'")->result();
        $this->data['criteriaD'] = $this->db->query("SELECT * FROM gri_indicators WHERE criteria_id='4'")->result();
        $this->_render_page('gri/gri_wizard', $this->data);
    }
   public function save_data()
   {
               //if ($this->input->post('save')) {

                $options=$this->input->post('opt');
                $household=$this->input->post('rowid');
                //$gri_code=$this->utility->get_gri_code();
                $gri_code=$this->utility->rsg();
                //print_r($options);
               // exit();
                if($household!="")
                {
                foreach ($options as $k => $v) 
                {
                    
                $substring='M';  
                $score=$this->utility->strafter($v, $substring);  
                $optionz=$this->utility->strbefore($v, $substring);    
                $indicator=$this->tabledata->getSingleRecord('gri_indicator_options',array('id'=> $optionz),'indicator_id');
                
                $data=array(array( 
                     'household_id'=>$household,
                     'indicator_id'=>$indicator,
                     'option_id'=>$optionz,
                     'score'=> $score,
                     'date_added'=>DATE_TIME,
                     'stato'=>1,
                    'gri_code'=>$gri_code
                     
                 ));
                // print_r($data);
                //exit();
                $save=$this->tabledata->insertTableData($data,'gri_scoring_meta'); 
                 if($save)
                 {
                   $this->session->set_flashdata('dispMessage', '<div class=" alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>GRI evaluation completed successfully</div>');

                  redirect('gri/index', 'location');   
                 }
                 
                }
                }
                else
                {
                $this->session->set_flashdata('dispMessage', '<div class=" alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Error occured.Household is Missing</div>');
               redirect('gri/index', 'location');
                }
            
                   // }
   }
   
   public function results()
   {
       $this->load->view('gri/gri_results_view');
   }
   
     public function search_household()
  {
       //$data='';
       $var = $this->input->post('searchval');
       //$var='9773019';
       $query="SELECT * FROM caregivers WHERE national_id='".$var."'";
       $records=$this->db->query($query)->num_rows();
       if($records==1)
       {
       
       $id=$this->tabledata->getSingleRecord('caregivers',array('national_id'=>$var),'id');
       $data['households']=$this->db->query("SELECT c.indicator_title,i.indicator_desc,i.code,i.max_score,s.score,s.household_id,o.option_name FROM gri_scoring_meta s JOIN gri_indicator_options o ON(s.option_id=o.id)JOIN gri_indicators i  ON(s.indicator_id=i.id) JOIN gri_criteria c ON(i.criteria_id=c.id) AND s.household_id='".$id."'")->result();
       $data['household']= $id;
       $this->load->view('gri/search_results.php', $data);
       
       
       }
       elseif($records>1)
       {
           echo 'There exists more than one records with that ID Number'.' '.$var;
       }
       elseif($records==0)
       {
         echo 'Household Not Found';  
       }
  }
  


  
  
  
  
  
  
    function _render_page($view, $data = null, $render = false) {

        $this->viewdata = (empty($data)) ? $this->data : $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render)
            return $view_html;
    }

}
