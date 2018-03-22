<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Hes_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function save_intervention() {
        $level = $this->input->post('level');
        // $title = $this->input->post('title');
        $activity = $this->input->post('activity');
        $added = $this->ion_auth->user()->row()->id;
        $checkdupz = $this->tabledata->checkDuplicate('interventions_table', array('level_id ' => $level, 'activity' => $activity));

        if (!$checkdupz) {
            $data = array(array(
                    'level_id ' => $level,
                    'activity' => $activity,
                    'date_added' => DATE_TIME,
                    'added_by' => $added,
                    'stato' => 1
            ));

            $save = $this->tabledata->insertTableData($data, 'interventions_table');

            if ($save) {
                $this->session->set_flashdata('dispMessage', '<div class=" alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Worker has been added successfully</div>');

                redirect('interventions/manage_interventions', 'location');
            } else {
                $this->session->set_flashdata('dispMessage', '<div class=" alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Error occured.Worker not added</div>');

                redirect('interventions/manage_interventions', 'location');
            }
        } else {
            $this->session->set_flashdata('dispMessage', '<div class=" alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Interventions already exists</div>');

            redirect('interventions/manage_interventions', 'location');
        }
    }

    public function upload_ovc() {

        require(APPPATH . 'third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php');
        require(APPPATH . 'third_party/spreadsheet-reader/SpreadsheetReader.php');
        $allowedExts = array("xls", "csv");
        $temp = explode(".", $_FILES['excel']['name']);
        $extension = end($temp);

        if (($_FILES['excel']['size'] < 2000000000000) && in_array($extension, $allowedExts)) {
            if ($_FILES['excel']['error'] > 0) {
                $msg = "Error: " . $_FILES['excel']['error'] . "";
            } else {
                $file = $_FILES['excel']['tmp_name'];
                if ($_FILES['excel']['size'] > 0) {
                    //echo $file;
                    if ($extension == "xls") {

                        $excel = new Spreadsheet_Excel_Reader;
                        $excel->read($file);
                        $nr_sheets = count($excel->sheets);       // gets the number of worksheets
                        $excel_data = '';              // to store the the html tables with data of each sheet

                        $fileErr = 0;
                        $Total = 0;
                        $duplR = 0;
                        $inval = 0;
                        $failz = 0;
                        $errrors = 0;
                        for ($i = 0; $i < $nr_sheets; $i++) {
                            $sheet = $excel->sheets[$i];
                            if ($sheet['numRows'] > 0) {

                                $x = 1;
                                while ($x <= $sheet['numRows']) {
                                    //$y = 1;
                                    //while($y <= $sheet['numCols']) {
                                    $out = array();
                                    for ($y = 1; $y <= 26; $y++) {
                                        $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
                                        //echo $cell;
                                        $out[] = $cell;
                                    }

                                    $ovc_id = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[0]));
                                    $first_name = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[1]));
                                    $middle_name = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[2]));
                                    $surname = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[3]));
                                    $gender = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[4]));
                                    $dob = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[5]));
                                    $birth_cert = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[6]));
                                    $birth_cert_no = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[7]));
                                    $disability = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[8]));
                                    $pwd_no = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[9]));
                                    $hiv_status = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[10]));
                                    $art_status = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[11]));
                                    $facility = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[12]));
                                    $ccc_number = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[13]));
                                    $date_of_linkage = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[14]));
                                    $school_level = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[15]));
                                    $school_name = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[16]));
                                    $class = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[17]));
                                    $reg_date = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[18]));
                                    $exit_status = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[19]));
                                    $exit_reason = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[20]));
                                    $exit_date = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[21]));
                                    $immunization_status = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[22]));
                                    $caregiver_id = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[23]));
                                    $cbo_id = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[24]));
                                    $chw_id = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[25]));



                                    /* print_r($out);
                                      exit(); */

                                    // if (is_numeric($idnumber) && is_numeric($phonenumber)) {

                                    $checkdupz = $this->tabledata->checkDuplicate('ovc_table', array('ovc_id' => $ovc_id));

                                    if (!$checkdupz) {
                                        $c_count = $this->db->query("SELECT * FROM caregivers WHERE national_id='" . $caregiver_id . "'")->num_rows();




                                        if ($c_count >= 1) {

                                            $cbo_idX = $this->tabledata->getSingleRecord('cbo_table', array('cbo_name' => $cbo_id), 'id');
                                            $caregiver_idX = $this->tabledata->getSingleRecord('caregivers', array('national_id' => $caregiver_id), 'id');
                                            $chw_idX = $this->tabledata->getSingleRecord('chw_table', array('id_number' => $chw_id), 'id');
                                            $data = array(array(
                                                    'ovc_id' => $ovc_id,
                                                    'first_name' => $first_name,
                                                    'middle_name' => $middle_name,
                                                    'surname' => $surname,
                                                    'gender' => $gender,
                                                    'dob' => $dob,
                                                    'birth_cert' => $birth_cert,
                                                    'birth_cert_no' => $birth_cert_no,
                                                    'disability' => $disability,
                                                    'pwd_no' => $pwd_no,
                                                    'hiv_status' => $hiv_status,
                                                    'art_status' => $art_status,
                                                    'facility' => $facility,
                                                    'ccc_number' => $ccc_number,
                                                    'date_of_linkage' => $date_of_linkage,
                                                    'school_level' => $school_level,
                                                    'school_name' => $school_name,
                                                    'class ' => $class,
                                                    'reg_date' => $reg_date,
                                                    'exit_status' => $exit_status,
                                                    'exit_reason' => $exit_reason,
                                                    'exit_date' => $exit_date,
                                                    'immunization_status' => $immunization_status,
                                                    'caregiver_id' => $caregiver_idX,
                                                    'cbo_id' => $cbo_idX,
                                                    'chw_id' => $chw_idX
                                            ));
                                            $this->db->trans_begin();
                                            $reslti = $this->tabledata->insertTableData($data, 'ovc_table');
                                            if ($this->db->trans_status() == FALSE) {
                                                $this->db->trans_rollback();
                                            } else {
                                                $this->db->trans_commit();
                                            }
                                            if ($reslti) {
                                                $Total = $Total + 1;
                                            } else {
                                                $failz = $failz + 1;
                                            }
                                        } else {
                                            $data = array(array(
                                                    'ovc_id' => $ovc_id,
                                                    'first_name' => $first_name,
                                                    'middle_name' => $middle_name,
                                                    'surname' => $surname,
                                                    'gender' => $gender,
                                                    'dob' => $dob,
                                                    'birth_cert' => $birth_cert,
                                                    'birth_cert_no' => $birth_cert_no,
                                                    'disability' => $disability,
                                                    'pwd_no' => $pwd_no,
                                                    'hiv_status' => $hiv_status,
                                                    'art_status' => $art_status,
                                                    'facility' => $facility,
                                                    'ccc_number' => $ccc_number,
                                                    'date_of_linkage' => $date_of_linkage,
                                                    'school_level' => $school_level,
                                                    'school_name' => $school_name,
                                                    'class ' => $class,
                                                    'reg_date' => $reg_date,
                                                    'exit_status' => $exit_status,
                                                    'exit_reason' => $exit_reason,
                                                    'exit_date' => $exit_date,
                                                    'immunization_status' => $immunization_status,
                                                    'caregiver_id' => $caregiver_id,
                                                    'cbo_id' => $cbo_id,
                                                    'chw_id' => $chw_id
                                            ));


                                            $this->db->trans_begin();
                                            //$reslti = $this->tabledata->insertTableData($data, 'ovc_table');
                                            $reslti = $this->tabledata->insertTableData($data, 'ovc_table_temp');
                                            if ($this->db->trans_status() == FALSE) {
                                                $this->db->trans_rollback();
                                            } else {
                                                $this->db->trans_commit();
                                            }

                                            $errrors = $errrors + 1;
                                        }
                                    } else {
                                        $duplR = $duplR + 1;
                                    }

                                    $x++;
                                }
                            }/* else{
                              $msg = "Empty Excel file selected!";
                              } */
                        }
                        $msg = "<span style=\"color:blue;font-weight:bold\"><b>" . $Total . "</b> Numbers registered, <b>" . $failz . "</b> Failed, <b>" . $duplR . "</b> Duplicates & <b>" . $inval . "</b> Invalid numbers" . "<b>" . $errrors . "</b>Missing Matching Caregiver</span>";
                        $this->session->set_flashdata('dispMessage', $msg);

                        redirect('ovc/index', 'location');
                    }
                } else {

                    $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Empty file selected!');

                    redirect('ovc/index', 'location');
                }
            }
        } else {


            $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Invalid Group or oversize file selected!');

            redirect('ovc/index', 'location');
        }
    }

    public function upload_caregivers() {


        require(APPPATH . 'third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php');
        require(APPPATH . 'third_party/spreadsheet-reader/SpreadsheetReader.php');
        ini_set('memory_limit', '-1');
        $allowedExts = array("xls", "csv");
        $temp = explode(".", $_FILES['excel']['name']);
        $extension = end($temp);

        if (($_FILES['excel']['size'] < 2000000000000000) && in_array($extension, $allowedExts)) {
            if ($_FILES['excel']['error'] > 0) {
                $msg = "Error: " . $_FILES['excel']['error'] . "";
            } else {
                $file = $_FILES['excel']['tmp_name'];
                if ($_FILES['excel']['size'] > 0) {
                    //echo $file;
                    if ($extension == "xls") {

                        $excel = new Spreadsheet_Excel_Reader;
                        $excel->read($file);
                        $nr_sheets = count($excel->sheets);       // gets the number of worksheets
                        $excel_data = '';              // to store the the html tables with data of each sheet

                        $fileErr = 0;
                        $Total = 0;
                        $duplR = 0;
                        $inval = 0;
                        $failz = 0;
                        for ($i = 0; $i < $nr_sheets; $i++) {
                            $sheet = $excel->sheets[$i];
                            if ($sheet['numRows'] > 0) {

                                $x = 1;
                                while ($x <= $sheet['numRows']) {
                                    //$y = 1;
                                    //while($y <= $sheet['numCols']) {
                                    $out = array();
                                    for ($y = 1; $y <= 6; $y++) {
                                        $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';
                                        //echo $cell;
                                        $out[] = $cell;
                                    }

                                    $cbo = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[0]));
                                    $national_idZ = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[1]));
                                    $national_id = preg_replace('/\s+/', '', $national_idZ);
                                    $first_name = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[2]));
                                    $middle_name = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[3]));
                                    $surname = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[4]));
                                    $hiv_status = $out[5];
                                    $uploader = $this->ion_auth->user()->row()->id;
                                    if (!empty($first_name)) {

                                        $checkdupz = $this->tabledata->checkDuplicate('caregivers', array('national_id' => $national_id, 'cbo' => $cbo, 'first_name' => $first_name, 'middle_name' => $middle_name, 'surname' => $surname));

                                        if (!$checkdupz) {


                                            $data = array(array(
                                                    'national_id' => $national_id,
                                                    'first_name' => $first_name,
                                                    'middle_name' => $middle_name,
                                                    'surname' => $surname,
                                                    'hiv_status ' => $hiv_status,
                                                    'date_added ' => DATE_TIME,
                                                    'added_by' => $uploader,
                                                    'cbo' => $cbo,
                                                    'stato ' => 1
                                            ));

                                            /* print_r($data);
                                              exit(); */

                                            $reslti = $this->tabledata->insertTableData($data, 'caregivers');
                                            if ($reslti) {
                                                $Total = $Total + 1;
                                            } else {
                                                $failz = $failz + 1;
                                            }
                                        } else {
                                            $duplR = $duplR + 1;
                                        }
                                    } else {
                                        $inval = $inval + 1;
                                    }
                                    //$y++;
                                    //}  
                                    $x++;
                                }
                            }/* else{
                              $msg = "Empty Excel file selected!";
                              } */
                        }
                        $msg = "<span style=\"color:blue;font-weight:bold\"><b>" . $Total . "</b> Numbers registered, <b>" . $failz . "</b> Failed, <b>" . $duplR . "</b> Duplicates & <b>" . $inval . "</b> Invalid numbers</span>";
                        $this->session->set_flashdata('dispMessage', $msg);

                        redirect('caregivers/index', 'location');
                    }
                } else {

                    $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Empty file selected!');

                    redirect('caregivers/index', 'location');
                }
            }
        } else {


            $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Invalid Group or oversize file selected!');

            redirect('caregivers/index', 'location');
        }
    }

    public function upload_cbo() {


        require(APPPATH . 'third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php');
        require(APPPATH . 'third_party/spreadsheet-reader/SpreadsheetReader.php');
        // ini_set('memory_limit', '-1');
        $allowedExts = array("xls", "csv");
        $temp = explode(".", $_FILES['excel']['name']);
        $extension = end($temp);

        if (($_FILES['excel']['size'] < 10000000000000000000000) && in_array($extension, $allowedExts)) {
            if ($_FILES['excel']['error'] > 0) {
                $msg = "Error: " . $_FILES['excel']['error'] . "";
            } else {
                $file = $_FILES['excel']['tmp_name'];
                if ($_FILES['excel']['size'] > 0) {
                    //echo $file;
                    if ($extension == "xls") {

                        $excel = new Spreadsheet_Excel_Reader;
                        $excel->read($file);
                        $nr_sheets = count($excel->sheets);       // gets the number of worksheets
                        $excel_data = '';              // to store the the html tables with data of each sheet

                        $fileErr = 0;
                        $Total = 0;
                        $duplR = 0;
                        $inval = 0;
                        $failz = 0;
                        for ($i = 0; $i < $nr_sheets; $i++) {
                            $sheet = $excel->sheets[$i];


                            if ($sheet['numRows'] > 0) {

                                $x = 1;
                                while ($x <= $sheet['numRows']) {

                                    $out = array();
                                    for ($y = 1; $y <= 5; $y++) {
                                        $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';

                                        $out[] = $cell;
                                    }

                                    $sdp_name = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[0]));
                                    $cbo_name = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[1]));
                                    $county = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[2]));
                                    $subcounty = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[3]));
                                    $ward = preg_replace('~\x{00a0}~', ' ', str_replace(' ', ' ', $out[4]));

                                    $uploader = $this->ion_auth->user()->row()->id;

                                    $checkdupz = $this->tabledata->checkDuplicate('cbo_table', array('cbo_name' => $cbo_name, 'sdp_id' => $sdp_name, 'county' => $county, 'sub_county' => $subcounty, 'ward' => $ward));

                                    if (!$checkdupz) {


                                        $data = array(array(
                                                'sdp_id' => $sdp_name,
                                                'cbo_name' => $cbo_name,
                                                'county' => $county,
                                                'sub_county' => $subcounty,
                                                'ward' => $ward,
                                                'date_created' => DATE_TIME,
                                                'created_by' => $uploader,
                                                'stato ' => 1
                                        ));

                                        $reslti = $this->tabledata->insertTableData($data, 'cbo_table');
                                        if ($reslti) {
                                            $Total = $Total + 1;
                                        } else {
                                            $failz = $failz + 1;
                                        }
                                    } else {
                                        $duplR = $duplR + 1;
                                    }

                                    $x++;
                                }
                            }/* else{
                              $msg = "Empty Excel file selected!";
                              } */
                        }
                        $msg = "<span style=\"color:blue;font-weight:bold\"><b>" . $Total . "</b> Numbers registered, <b>" . $failz . "</b> Failed, <b>" . $duplR . "</b> Duplicates</span>";
                        $this->session->set_flashdata('dispMessage', $msg);

                        redirect('cbo/index', 'location');
                    }
                } else {

                    $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Empty file selected!');

                    redirect('cbo/index', 'location');
                }
            }
        } else {


            $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Invalid Group or oversize file selected!');

            redirect('cbo/index', 'location');
        }
    }

    public function upload_chv() {


        require(APPPATH . 'third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php');
        require(APPPATH . 'third_party/spreadsheet-reader/SpreadsheetReader.php');
        // ini_set('memory_limit', '-1');
        $allowedExts = array("xls", "csv");
        $temp = explode(".", $_FILES['excel']['name']);
        $extension = end($temp);

        if (($_FILES['excel']['size'] < 10000000000000000000000) && in_array($extension, $allowedExts)) {
            if ($_FILES['excel']['error'] > 0) {
                $msg = "Error: " . $_FILES['excel']['error'] . "";
            } else {
                $file = $_FILES['excel']['tmp_name'];
                if ($_FILES['excel']['size'] > 0) {
                    //echo $file;
                    if ($extension == "xls") {

                        $excel = new Spreadsheet_Excel_Reader;
                        $excel->read($file);
                        $nr_sheets = count($excel->sheets);       // gets the number of worksheets
                        $excel_data = '';              // to store the the html tables with data of each sheet

                        $fileErr = 0;
                        $Total = 0;
                        $duplR = 0;
                        $inval = 0;
                        $failz = 0;
                        for ($i = 0; $i < $nr_sheets; $i++) {
                            $sheet = $excel->sheets[$i];


                            if ($sheet['numRows'] > 0) {

                                $x = 1;
                                while ($x <= $sheet['numRows']) {

                                    $out = array();
                                    for ($y = 1; $y <= 5; $y++) {
                                        $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';

                                        $out[] = $cell;
                                    }

                                    $cbo_name = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[0]));
                                    $fname = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[1]));
                                    $mname = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[2]));
                                    $surname = preg_replace('~\x{00a0}~', ' ', str_replace(' ', ' ', $out[3]));
                                    $idnum = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[4]));

                                    $uploader = $this->ion_auth->user()->row()->id;

                                    $checkdupz = $this->tabledata->checkDuplicate('chw_table', array('id_number' => $idnum));

                                    if (!$checkdupz) {


                                        $data = array(array(
                                                'id_number' => $idnum,
                                                'first_name' => $fname,
                                                'middle_name' => $mname,
                                                'surname' => $surname,
                                                'cbo ' => $cbo_name,
                                                'date_added' => DATE_TIME,
                                                'created_by' => $uploader,
                                                'stato ' => 1
                                        ));

                                        $reslti = $this->tabledata->insertTableData($data, 'chw_table');

                                        if ($reslti) {
                                            $Total = $Total + 1;
                                        } else {
                                            $failz = $failz + 1;
                                        }
                                    } else {
                                        $duplR = $duplR + 1;
                                    }

                                    $x++;
                                }
                            }/* else{
                              $msg = "Empty Excel file selected!";
                              } */
                        }
                        $msg = "<span style=\"color:blue;font-weight:bold\"><b>" . $Total . "</b> Numbers registered, <b>" . $failz . "</b> Failed, <b>" . $duplR . "</b> Duplicates</span>";
                        $this->session->set_flashdata('dispMessage', $msg);

                        redirect('chv/index', 'location');
                    }
                } else {

                    $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Empty file selected!');

                    redirect('chv/index', 'location');
                }
            }
        } else {


            $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Invalid Group or oversize file selected!');

            redirect('chv/index', 'location');
        }
    }

    public function save_indicator() {
        $criteria = $this->input->post('criteria');
        $indicator = $this->input->post('desc');

        $checkdupz = $this->tabledata->checkDuplicate('hva_indicators', array('criteria_id' => $criteria, 'indicators_desc' => $indicator));

        if (!$checkdupz) {

            $data = array(array(
                    'criteria_id' => $criteria,
                    'indicators_desc' => $indicator,
                    'date_added' => DATE_TIME,
                    'stato' => 1
                )
            );
            $save = $this->tabledata->insertTableData($data, 'hva_indicators');
            if ($save) {
                $this->session->set_flashdata('dispMessage', '<div class=" alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Indicator has been added successfully</div>');

                redirect('auth_admin/settings', 'location');
            } else {
                $this->session->set_flashdata('dispMessage', '<div class=" alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Error occured.Indicator not added</div>');

                redirect('auth_admin/settings', 'location');
            }
        } else {
            $this->session->set_flashdata('dispMessage', '<div class=" alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Indicator already exists</div>');

            redirect('auth_admin/settings', 'location');
        }
    }
    public function save_gri_indicator() {
        $criteria = $this->input->post('criteria');
        $indicator = $this->input->post('desc');
        $code = $this->input->post('code');
        $score=$this->input->post('score');
        $checkdupz = $this->tabledata->checkDuplicate('gri_indicators', array('criteria_id' => $criteria, 'indicator_desc' => $indicator));

        if (!$checkdupz) {

            $data = array(array(
                    'criteria_id' => $criteria,
                    'code'=>$code,
                    'indicator_desc' => $indicator,
                    'max_score'=>$score,
                    'date_added' => DATE_TIME,
                    'stato' => 1
                )
            );
            $save = $this->tabledata->insertTableData($data, 'gri_indicators');
            if ($save) {
                $this->session->set_flashdata('dispMessage', '<div class=" alert alert-success fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>GRI Indicator has been added successfully</div>');

                redirect('auth_admin/settings', 'location');
            } else {
                $this->session->set_flashdata('dispMessage', '<div class=" alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Error occured.GRI Indicator not added</div>');

                redirect('auth_admin/settings', 'location');
            }
        } else {
            $this->session->set_flashdata('dispMessage', '<div class=" alert alert-danger fade in"><button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>GRI Indicator already exists</div>');

            redirect('auth_admin/settings', 'location');
        }
    }
    public function do_classification_withnames() {


        require(APPPATH . 'third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php');
        require(APPPATH . 'third_party/spreadsheet-reader/SpreadsheetReader.php');
        // ini_set('memory_limit', '-1');
        $allowedExts = array("xls", "csv");
        $temp = explode(".", $_FILES['excel']['name']);
        $extension = end($temp);

        if (($_FILES['excel']['size'] < 1000000000) && in_array($extension, $allowedExts)) {
            if ($_FILES['excel']['error'] > 0) {
                $msg = "Error: " . $_FILES['excel']['error'] . "";
            } else {
                $file = $_FILES['excel']['tmp_name'];
                if ($_FILES['excel']['size'] > 0) {
                    //echo $file;
                    if ($extension == "xls") {

                        $excel = new Spreadsheet_Excel_Reader;
                        $excel->read($file);
                        $nr_sheets = count($excel->sheets);       // gets the number of worksheets
                        $excel_data = '';              // to store the the html tables with data of each sheet

                        $fileErr = 0;
                        $Total = 0;
                        $duplR = 0;
                        $inval = 0;
                        $failz = 0;
                        for ($i = 0; $i < $nr_sheets; $i++) {
                            $sheet = $excel->sheets[$i];


                            if ($sheet['numRows'] > 0) {

                                $x = 1;
                                while ($x <= $sheet['numRows']) {

                                    $out = array();
                                    for ($y = 1; $y <= 5; $y++) {
                                        $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';

                                        $out[] = $cell;
                                    }

                                    $sdp_name = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[0]));
                                    $fname = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[1]));
                                    $mname = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[2]));
                                    $surname = preg_replace('~\x{00a0}~', ' ', str_replace(' ', ' ', $out[3]));
                                    $level = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[4]));

                                    if (!empty($level)) {
                                        $count = $this->db->query("SELECT * FROM caregivers WHERE first_name='" . $fname . "' AND middle_name='" . $mname . "' AND surname='" . $surname . "'")->num_rows();

                                        if ($count == 1) {

                                            $caregiver = $this->db->query("SELECT * FROM caregivers WHERE first_name='" . $fname . "' AND middle_name='" . $mname . "' AND surname='" . $surname . "'")->row()->id;

                                            if ($level == 'Highly Vulnerable') {
                                                $leveldb = 1;
                                            } elseif ($level == 'Moderately Vulnerable') {
                                                $leveldb = 2;
                                            } elseif ($level == 'Least Vulnerable') {
                                                $leveldb = 3;
                                            }


                                            $reslti = $this->db->query("UPDATE caregivers SET category='" . $leveldb . "' WHERE  id='" . $caregiver . "'");

                                            if ($reslti) {
                                                $Total = $Total + 1;
                                            } else {
                                                $failz = $failz + 1;
                                            }
                                        } elseif ($count == 0) {
                                            $duplR = $duplR + 1;

                                            $dataTT = array(array(
                                                    'sdp' => $sdp_name,
                                                    'fname' => $fname,
                                                    'mname' => $mname,
                                                    'lname' => $surname,
                                                    'level' => $level,
                                                )
                                            );

                                            $reslti = $this->tabledata->insertTableData($dataTT, 'hva_classification_temp');
                                        }
                                    }
                                    $x++;
                                }
                            }/* else{
                              $msg = "Empty Excel file selected!";
                              } */
                        }
                        $msg = "<span style=\"color:blue;font-weight:bold\"><b>" . $Total . "</b> Numbers registered, <b>" . $failz . "</b> Failed, <b>" . $duplR . "</b> No Match</span>";
                        $this->session->set_flashdata('dispMessage', $msg);

                        redirect('chv/index', 'location');
                    }
                } else {

                    $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Empty file selected!');

                    redirect('chv/index', 'location');
                }
            }
        } else {


            $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Invalid Group or oversize file selected!');

            redirect('chv/index', 'location');
        }
    }

    public function do_classification() {


        require(APPPATH . 'third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php');
        require(APPPATH . 'third_party/spreadsheet-reader/SpreadsheetReader.php');
        // ini_set('memory_limit', '-1');
        $allowedExts = array("xls", "csv");
        $temp = explode(".", $_FILES['excel']['name']);
        $extension = end($temp);

        if (($_FILES['excel']['size'] < 1000000000) && in_array($extension, $allowedExts)) {
            if ($_FILES['excel']['error'] > 0) {
                $msg = "Error: " . $_FILES['excel']['error'] . "";
            } else {
                $file = $_FILES['excel']['tmp_name'];
                if ($_FILES['excel']['size'] > 0) {
                    //echo $file;
                    if ($extension == "xls") {

                        $excel = new Spreadsheet_Excel_Reader;
                        $excel->read($file);
                        $nr_sheets = count($excel->sheets);       // gets the number of worksheets
                        $excel_data = '';              // to store the the html tables with data of each sheet

                        $fileErr = 0;
                        $Total = 0;
                        $duplR = 0;
                        $inval = 0;
                        $failz = 0;
                        for ($i = 0; $i < $nr_sheets; $i++) {
                            $sheet = $excel->sheets[$i];


                            if ($sheet['numRows'] > 0) {

                                $x = 1;
                                while ($x <= $sheet['numRows']) {

                                    $out = array();
                                    for ($y = 1; $y <=2; $y++) {
                                        $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';

                                        $out[] = $cell;
                                    }

                                    $idnumber = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[0]));
                                    //$name = preg_replace('~\x{00a0}~', '', str_replace(' ', ' ', $out[1]));
                                    $level = strtolower(preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[1])));
                                    $hva = $this->input->post("hva");
                                    if (!empty($idnumber)) {
                                        $count = $this->db->query("SELECT * FROM caregivers WHERE national_id='" . $idnumber . "'")->num_rows();

                                        if ($count == 1) {

                                            $caregiver = $this->db->query("SELECT * FROM caregivers WHERE national_id='" . $idnumber . "'")->row()->id;

                                            if ($level == 'hv-highlyvulnerable')
                                            {
                                                $leveldb = 1;
                                            } 
                                            elseif ($level == 'mv-moderatelyvulnerable') 
                                           {
                                                $leveldb = 2;
                                            } 
                                            elseif ($level == 'hv-highlyvulnerable') 
                                            {
                                                $leveldb = 3;
                                            } 
                                            elseif ($level =='') {
                                                $leveldb = 0;
                                            }
                                            $hva_data = array(
                                                array(
                                                    'caregiver_id' => $caregiver,
                                                    'level_id' => $leveldb,
                                                    'date_added' => DATE_TIME,
                                                    'hva' => $hva
                                                )
                                            );
                                            $save_record = $this->tabledata->insertTableData($hva_data, 'household_vulnerability_levels');

                                            if ($save_record) {
                                                $reslti = $this->db->query("UPDATE caregivers SET category='" . $leveldb . "' WHERE  id='" . $caregiver . "'");
                                            }
                                            if ($reslti) {
                                                $Total = $Total + 1;
                                            } else {
                                                $failz = $failz + 1;
                                            }
                                        } elseif ($count == 0) {
                                            $duplR = $duplR + 1;

                                            $hva_data = array(
                                                array(
                                                    'caregiver_id' => $idnumber,
                                                    'level_id' => $leveldb,
                                                    'date_added' => DATE_TIME,
                                                    'hva' => $hva
                                                )
                                            );
                                            $save_record = $this->tabledata->insertTableData($hva_data, 'household_vulnerability_levels_temp');
                                        }
                                    }
                                    $x++;
                                }
                            }/* else{
                              $msg = "Empty Excel file selected!";
                              } */
                        }
                        $msg = "<span style=\"color:blue;font-weight:bold\"><b>" . $Total . "</b> Numbers registered, <b>" . $failz . "</b> Failed, <b>" . $duplR . "</b> No Match</span>";
                        $this->session->set_flashdata('dispMessage', $msg);

                        redirect('auth_admin/settings', 'location');
                    }
                } else {

                    $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Empty file selected!');

                    redirect('auth_admin/settings', 'location');
                }
            }
        } else {


            $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Invalid Group or oversize file selected!');

            redirect('auth_admin/settings', 'location');
        }
    }

    public function upload_interventions() {


        require(APPPATH . 'third_party/spreadsheet-reader/php-excel-reader/excel_reader2.php');
        require(APPPATH . 'third_party/spreadsheet-reader/SpreadsheetReader.php');
        // ini_set('memory_limit', '-1');
        $allowedExts = array("xls", "csv");
        $temp = explode(".", $_FILES['excel']['name']);
        $extension = end($temp);

        if (($_FILES['excel']['size'] < 1000000000) && in_array($extension, $allowedExts)) {
            if ($_FILES['excel']['error'] > 0) {
                $msg = "Error: " . $_FILES['excel']['error'] . "";
            } else {
                $file = $_FILES['excel']['tmp_name'];
                if ($_FILES['excel']['size'] > 0) {
                    //echo $file;
                    if ($extension == "xls") {

                        $excel = new Spreadsheet_Excel_Reader;
                        $excel->read($file);
                        $nr_sheets = count($excel->sheets);       // gets the number of worksheets
                        $excel_data = '';              // to store the the html tables with data of each sheet

                        $fileErr = 0;
                        $Total = 0;
                        $duplR = 0;
                        $inval = 0;
                        $failz = 0;
                        $missing = 0;
                        for ($i = 0; $i < $nr_sheets; $i++) {
                            $sheet = $excel->sheets[$i];


                            if ($sheet['numRows'] > 0) {

                                $x = 1;
                                while ($x <= $sheet['numRows']) {

                                    $out = array();
                                    for ($y = 1; $y <= 25; $y++) {
                                        $cell = isset($sheet['cells'][$x][$y]) ? $sheet['cells'][$x][$y] : '';

                                        $out[] = $cell;
                                    }

                                    $idnumber = preg_replace('~\x{00a0}~', '', str_replace(' ', '', $out[0]));
                                    $h1 = $out[1];
                                    $h2 = $out[2];
                                    $h3 = $out[3];
                                    $h4 = $out[4];
                                    $h5 = $out[5];
                                    $h6 = $out[6];
                                    $h7 = $out[7];
                                    $m1 = $out[8];
                                    $m2 = $out[9];
                                    $m3 = $out[10];
                                    $m4 = $out[11];
                                    $m5 = $out[12];
                                    $l1 = $out[13];
                                    $l2 = $out[14];
                                    $l3 = $out[15];
                                    $l4 = $out[16];
                                    $l5 = $out[17];
                                    $l6 = $out[18];
                                    $l7 = $out[19];
                                    $l8 = $out[20];
                                    $l9 = $out[21];
                                    $l10 = $out[22];


                                    if (!empty($idnumber) && is_numeric($idnumber)) {
                                        $count = $this->db->query("SELECT * FROM caregivers WHERE national_id='" . $idnumber . "'")->num_rows();
                                        if ($count == 1) {
                                            $caregiver = $this->db->query("SELECT * FROM caregivers WHERE national_id='" . $idnumber . "'")->row()->id;
                                            $status = '1';
                                            $user = $this->ion_auth->user()->row()->id;
                                            if (!empty($h1) && strtolower($h1) == 'yes') {
                                                $activity_id = 1;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save1 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            
                                            if (!empty($h2) && strtolower($h2) == 'yes') {
                                            $activity_id = 2;
                                            $data = array(
                                                array(
                                                    'caregiver_id' => $caregiver,
                                                    'intervention_id' => $activity_id,
                                                    'date_assigned' => DATE_TIME,
                                                    'intervention_status' => $status,
                                                    'assigned_by' => $user,
                                                )
                                            );

                                            $save2 = $this->tabledata->insertTableData($data, 'household_interventions');    
                                            }
                                            if (!empty($h3) && strtolower($h3) == 'yes') {
                                                $activity_id = 3;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save3 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($h4) && strtolower($h4) == 'yes') {
                                                $activity_id = 4;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save4 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($h5) && strtolower($h5) == 'yes') {
                                                $activity_id = 5;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save5 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($h6) && strtolower($h6) == 'yes') {
                                                $activity_id = 6;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save6 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($h7) && strtolower($h7) == 'yes') {
                                                $activity_id = 7;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save7 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($m1) && strtolower($m1) == 'yes') {
                                                $activity_id = 8;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save8 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($m2) && strtolower($m2) == 'yes') {
                                                $activity_id = 9;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save9 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($m3) && strtolower($m3) == 'yes') {
                                                $activity_id = 10;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save10 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($m4) && strtolower($m4) == 'yes') {
                                                $activity_id = 11;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save11 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($m5) && strtolower($m5) == 'yes') {
                                                $activity_id = 12;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save12 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }

                                            if (!empty($l1) && strtolower($l1) == 'yes') {
                                                $activity_id = 13;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save13 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($l2) && strtolower($l2) == 'yes') {
                                                $activity_id = 14;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save14 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($l3) && strtolower($l3) == 'yes') {
                                                $activity_id = 15;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save15 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($l4) && strtolower($l4) == 'yes') {
                                                $activity_id = 16;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save16 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($l5) && strtolower($l5) == 'yes') {
                                                $activity_id = 17;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save17 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($l6) && strtolower($l6) == 'yes') {
                                                $activity_id = 18;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save18 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($l7) && strtolower($l7) == 'yes') {
                                                $activity_id = 19;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save19 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($l8) && strtolower($l8) == 'yes') {
                                                $activity_id = 20;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save20 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($l9) && strtolower($l9) == 'yes') {
                                                $activity_id = 21;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save21 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }
                                            if (!empty($l10) && strtolower($l10) == 'yes') {
                                                $activity_id = 22;
                                                $data = array(
                                                    array(
                                                        'caregiver_id' => $caregiver,
                                                        'intervention_id' => $activity_id,
                                                        'date_assigned' => DATE_TIME,
                                                        'intervention_status' => $status,
                                                        'assigned_by' => $user,
                                                    )
                                                );

                                                $save22 = $this->tabledata->insertTableData($data, 'household_interventions');
                                            }

                                           
                                        } else {
                                            $missing = $missing + 1;
                                        }
                                    }
                                    $x++;
                                }
                            }
                        }
                        $msg = "<span style=\"color:blue;font-weight:bold\"><b>Upload Succesful."  . $missing . "<b> Missing/Unmatched</b></span>";
                        $this->session->set_flashdata('dispMessage', $msg);

                        redirect('auth_admin/settings', 'location');
                    }
                } else {

                    $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Empty file selected!');

                    redirect('auth_admin/settings', 'location');
                }
            }
        } else {


            $this->session->set_flashdata('dispMessage', '<strong>Error!</strong>Invalid Group or oversize file selected!');

            redirect('auth_admin/settings', 'location');
        }
    }

}
