<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Caregivers extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('url', 'language'));
        $this->load->helper('form');
         $this->load->model(array('hes_model'));
         $this->load->model('caregiver_model','caregiver');
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
           $this->hes_model->upload_caregivers();   
        }
        else {
            // set the flash data error message if there is one
            $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->data['username']=$this->ion_auth->user()->row()->username;
            $this->data['cbos']=$this->tabledata->selectRecords(array(),'cbo_table',array());
            $this->data['file_name']='caregivers_upload_sample.xls';
           // $this->_render_page('caregivers/index',$this->data);
            
            $this->load->view('caregivers/index',$this->data);
        }   
}
public function ajax_list()
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

	public function ajax_edit($id)
	{
		$data = $this->caregiver->get_by_id($id);
		$data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_add()
	{
		//$this->_validate();
		$data = array(
				'first_name' => $this->input->post('first_name'),
				'middle_name' => $this->input->post('middle_name'),
				'surname' => $this->input->post('last_name'),
				'national_id' => $this->input->post('idnum'),
				'dob' => $this->input->post('dob'),
                                'role' => $this->input->post('role'),
                     'phone_number' => $this->input->post('phone'),
                     'hiv_status' => $this->input->post('hiv_status'),
                     'date_added'=>DATE_TIME,
                     'added_by'=>$this->ion_auth->user()->row()->id,
                     'cbo'=> $this->input->post('cbo'),
			);

		

		$insert = $this->caregiver->save($data);

		echo json_encode(array("status" => TRUE));
	}

	public function ajax_update()
	{
		$this->_validate();
		$data = array(
				'firstName' => $this->input->post('firstName'),
				'lastName' => $this->input->post('lastName'),
				'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'dob' => $this->input->post('dob'),
			);

		if($this->input->post('remove_photo')) // if remove photo checked
		{
			if(file_exists('upload/'.$this->input->post('remove_photo')) && $this->input->post('remove_photo'))
				unlink('upload/'.$this->input->post('remove_photo'));
			$data['photo'] = '';
		}

		if(!empty($_FILES['photo']['name']))
		{
			$upload = $this->_do_upload();
			
			//delete file
			$caregiver = $this->caregiver->get_by_id($this->input->post('id'));
			if(file_exists('upload/'.$caregiver->photo) && $caregiver->photo)
				unlink('upload/'.$caregiver->photo);

			$data['photo'] = $upload;
		}

		$this->caregiver->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_delete($id)
	{
		//delete file
		$caregiver = $this->caregiver->get_by_id($id);
		if(file_exists('upload/'.$caregiver->photo) && $caregiver->photo)
			unlink('upload/'.$caregiver->photo);
		
		$this->caregiver->delete_by_id($id);
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

		if($this->input->post('first_name') == '')
		{
			$data['inputerror'][] = 'first_name';
			$data['error_string'][] = 'First name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('middle_name') == '')
		{
			$data['inputerror'][] = 'middle_name';
			$data['error_string'][] = 'Middlename is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('last_name') == '')
		{
			$data['inputerror'][] = 'dob';
			$data['error_string'][] = 'Last Name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('idnum') == '')
		{
			$data['inputerror'][] = 'id_num';
			$data['error_string'][] = 'ID Number is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('dob') == '')
		{
			$data['inputerror'][] = 'dob';
			$data['error_string'][] = 'DOB is required';
			$data['status'] = FALSE;
		}
                		if($this->input->post('role') == '')
		{
			$data['inputerror'][] = 'role';
			$data['error_string'][] = 'Role is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('phone') == '')
		{
			$data['inputerror'][] = 'phone';
			$data['error_string'][] = 'Phone is required';
			$data['status'] = FALSE;
		}
                		if($this->input->post('hiv_status') == '')
		{
			$data['inputerror'][] = 'hiv_status';
			$data['error_string'][] = 'HIV status is required';
			$data['status'] = FALSE;
		}
                		if($this->input->post('cbo') == '')
		{
			$data['inputerror'][] = 'cbo';
			$data['error_string'][] = 'CBO is required';
			$data['status'] = FALSE;
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

        


function download() {
        $this->load->helper('download');
        $name = 'caregivers_upload_sample.xls';
        $data = file_get_contents("./resources/downloads/caregivers_upload_sample.xls"); // Read the file's contents

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



