<?php
if (!isset($_REQUEST["module"])) exit ();

include_once '../../app/connect.php';
$email = array();

$tval = 60;// my max exec time in seconds, default is 30
$max = ini_get('max_execution_time');
if ($max != 0 && $tval > $max) { // don't bother if unlimited
 @set_time_limit($tval);
}

class cEmail extends Connect
{
    public function SendEmail($param = array()) {
        $param["headers"] = $this->Headers();
        
        if(@mail($param["to"], $param["subject"], $param["template"], $param["headers"])){ 
            echo "sent";
        }else{            
            //print_r($param);
        }
    }
    
    private function Headers() {
        $head = array();
        $head["headers"]  = 'From: info@advert-space.com ' . "\r\n";
        $head["headers"] .= 'MIME-Version: 1.0 ' . "\r\n";
        $head["headers"] .= 'Bcc: freeg.research@gmail.com ' . "\r\n";
        $head["headers"] .= 'Content-type: text/html; charset=iso-8859-1 ' . "\r\n"
                    . "X-Mailer: PHP/" . phpversion();
        return $head["headers"];
    }
}
$cEmail = new cEmail();


switch ($_REQUEST["module"]) {
    case "Login":
        $cmd = $_REQUEST["cmd"];
        if ($cmd === "success"){
            $email["subject"] = "INVENTORY LOGIN CONFIRMATION";
            $email["to"] = $_SESSION["LOGIN"]["US_EMAIL"];//"freegiftudourom@yahoo.com, uenomfon@cornerstone.com.ng";
            $email["user"] = $_SESSION["LOGIN"]["US_FULLNAME"];
            
            ob_start();
            require_once "../pages/email/LoginSuccess.php";//get template file
            $email["template"] = ob_get_contents(); //file_get_contents("../pages/email/NewItemAlert.php");
            ob_end_clean();
            
            $cEmail->SendEmail($email);//send the compose email
        }
        break;
    case "Orders":
    case "Re-Stocking":
        $cmd = $_REQUEST["cmd"];
        if ($cmd === "approved"){
            
        }
        break;
    default:
        echo 'not seen';
        break;
}
