<?php

defined('BASEPATH') OR exit('No direct script access allowed');
class Support extends CI_Controller 
{
 	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));
                $this->load->model(array('hes_model'));
                
		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), $this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('auth');
                $this->load->vars('base_url','http://'.$_SERVER['HTTP_HOST'].'/hes/');
		$this->load->vars('includes_dir', 'http://'.$_SERVER['HTTP_HOST'].'/hes/resources/');
		$this->load->vars('current_url', $this->uri->uri_to_assoc(1));
	} 

       public function  index()
       {
           
       }
       
       public function faq()
       {
            $this->data['username']=$this->ion_auth->user()->row()->username;
            $this->_render_page('support/faq_view',$this->data);
          
       }
       public function tasks()
       {
           $this->data['username']=$this->ion_auth->user()->row()->username;
            $this->_render_page('support/tasks_view',$this->data);
             
       }
       function _render_page($view, $data=null, $render=false)
    {

        $this->viewdata = (empty($data)) ? $this->data: $data;

        $view_html = $this->load->view($view, $this->viewdata, $render);

        if (!$render) return $view_html;
    }
    
}



?>
