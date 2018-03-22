<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Analytics extends CI_Controller {

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
    
    function household_classification()
{
        $query = $this->db->query("SELECT hva_levels.level_name as name ,COUNT(caregivers.id) as total FROM caregivers JOIN hva_levels ON(hva_levels.id=caregivers.category) GROUP BY name")->result();
    // print_r(json_encode($query,JSON_NUMERIC_CHECK));


$rows = array();
//flag is not needed
$flag = true;
$table = array();
$table['cols'] = array(

    // Labels for your chart, these represent the column titles
    // Note that one column is in "string" format and another one is in "number" format as pie chart only required "numbers" for calculating percentage and string will be used for column title
    array('label' => 'HVA Level', 'type' => 'string'),
    array('label' => 'No.Of Households', 'type' => 'number')

);

foreach($query as $key=>$value) {
    $temp = array();
    // the following line will be used to slice the Pie chart
    $temp[] = array('v' => (string) $value->name); 

    // Values of each slice
    $temp[] = array('v' => (int) $value->total); 
    $rows[] = array('c' => $temp);
}

$table['rows'] = $rows;
$jsonTable = json_encode($table);   
print_r($jsonTable);  
}
    
}

?>

