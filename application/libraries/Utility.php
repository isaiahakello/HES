<?php

class Utility {

    var $skey = "nikunjJ_Shingala"; // you can change it

    //default construction

    public function __construct() {
    //   $this->load->database();  
    }
  /*  function get_gri_code() {

        $rsnx = "";
        $rs = "";
        $counts=$this->db->query("SELECT * FROM gri_unique_codes")->num_rows();
        
        
        if ($counts >0) {
            
            
                $max = $this->db->query("SELECT MAX(gri_code) as maxNo FROM gri_unique_codes")->row()->maxNo;
                
               // $cur = substr($max, -4);
                $rs = sprintf("%06d", $max + 1);
                $rsn =$rs;
             
            if ($this->chkDuplicates($rsn) == false) {
                $rsnx = $rsn;
            } else {
                $rsnx = $this->gri_code();
            }
        } else {
               
                $rsnx = '000001';
           
        }
        return  $rsnx;
    }*/

    function chkDuplicates($rsn) {
        $result = true;
        $count1 = $this->db->query("select * FROM gri_unique_codes where gri_code= '" . $rsn . "'")->num_rows();
       
        if ($count1 == 0) {
            $result = false;
        }
        return $result;
    }
    function rsg($length = 10, $complexity = 2) {
        //available 'complexity' subsets of characters
        $charSubSets = array(
            'abcdefghijklmnopqrstuvwxyz',
            'ABCDEFGHIJKLMNOPQRSTUVWXYZ',
            '0123456789',
            '!@#$%^&*()_+{}|:">?<[]\\\';,.`~',
            'µñ©æáßðøäåé®þüúíóö'
        );

        // will be filled with subsets from above $charSubsets
        $chars = '';

        //concact each subset until complexity is reached onto the $chars variable
        for ($i = 0; $i < $complexity; $i++)
            $chars .= $charSubSets[$i];

        //create array containing a single char per entry from the combined subset in the $chars variable.
        $chars = str_split($chars);
        //define length of array for mt_rand limit
        $charCount = (count($chars) - 1);
        //create string to return
        $string = '';
        //idk why I used a while but it won't really hurt you when the string is less than 100000 chars long ;)
        $i = 0;
        while ($i < $length) {
            $randomNumber = mt_rand(0, $charCount); //generate number within array index range
            $string .= $chars[$randomNumber]; //get that character out of the array
            $i++; //increment counter
        }

        return $string; //return string created from random characters
    }
    public function safe_b64encode($string) {

        $data = base64_encode($string);
        $data = str_replace(array('+', '/', '='), array('-', '_', ''), $data);
        return $data;
    }

    public function safe_b64decode($string) {
        $data = str_replace(array('-', '_'), array('+', '/'), $string);
        $mod4 = strlen($data) % 4;
        if ($mod4) {
            $data .= substr('====', $mod4);
        }
        return base64_decode($data);
    }

    public function encode($value) {

        if (!$value) {
            return false;
        }
        $text = $value;
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $crypttext = mcrypt_encrypt(MCRYPT_RIJNDAEL_256, $this->skey, $text, MCRYPT_MODE_ECB, $iv);
        return trim($this->safe_b64encode($crypttext));
    }

    public function decode($value) {

        if (!$value) {
            return false;
        }
        $crypttext = $this->safe_b64decode($value);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypttext = mcrypt_decrypt(MCRYPT_RIJNDAEL_256, $this->skey, $crypttext, MCRYPT_MODE_ECB, $iv);
        return trim($decrypttext);
    }

    //function for encode text
    public function encodeTex($text) {
        return addslashes(trim($text));
    }

    //function for decode text
    public function decodeText($text) {
        return stripcslashes($text);
    }

    
  public function strafter($string, $substring) {
  $pos = strpos($string, $substring);
  if ($pos === false)
   return $string;
  else  
   return(substr($string, $pos+strlen($substring)));
}

public function strbefore($string, $substring) {
  $pos = strpos($string, $substring);
  if ($pos === false)
   return $string;
  else  
   return(substr($string, 0, $pos));
} 
}

?>