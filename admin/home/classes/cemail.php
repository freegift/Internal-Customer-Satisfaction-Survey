<?php

class cEmail extends Connect {
    //put your code here
    
//    public function NewWhistleAlertUsers($s = 'N') {
//        $s = ($s == 'Y')? 'Y':'N';
//        if($res = $this->Select("SELECT l_email, l_fullname FROM login WHERE"
//                . " l_is_alert_new_entry = '".ENABLE."' AND l_is_special = '$s' AND l_is_enable = '".ENABLE."'"))
//        {
//            return $res;
//        }
//    }
    
}

$cEmail = new cEmail();