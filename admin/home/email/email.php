<?php //echo 'sent here';
if (!isset($_REQUEST["module"]))
{
    exit('exit');
}
if (!isset($_SESSION)){
    session_start();
}
?>
<html>
<head>
<title>Whistle Blower - Cornerstone Insurance Plc</title>
<script type="text/javascript">
function link_direct(link){
    window.open(link, '_self');
}

function aprint(){
    window.print();
}
</script>
</head>
<body><?php
//echo 'top area';
require_once '../../app/connect.php';
require_once '../../home/classes/cemail.php';
$data = array();
//echo 'connected';
//require_once('class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
//$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch
//$mail->IsSMTP(); // telling the class to use SMTP
//$mail->IsSendmail();

require_once '../../../../PHPMailer5.2.10/apps.php'; //Global Email configuration class
$mail->FromName = "Internal Customer Satisfaction Survey";
try {
    switch ($_REQUEST["module"]) {
        case "Login":
            $cmd = $_REQUEST["cmd"];
            if ($cmd === "success"){
                $mail->AddAddress($_SESSION["LOGIN"]["l_email"], $_SESSION["LOGIN"]["l_fullname"]);
                $mail->Subject = $data["subject"] = 'LOG IN CONFIRMATION';
                ob_start();
                require_once "../pages/email/ploginsuccess.php";//get template file
                $data["template"] = ob_get_contents(); //file_get_contents("../pages/email/NewItemAlert.php");
                ob_end_clean();
                $mail->MsgHTML($data["template"]);
                if (DEBUG === TRUE){
//                    echo $data["template"];
                }
                if (EMAIL === TRUE){
                    $mail->Send(); //send mail here
                }
            }
            break;
        case "verifycode":
            $email = (string)$_REQUEST["email"];
            $code = (string)$_REQUEST["code"];
            if ($email !== '' && $code !== ''){

                $mail->AddAddress($email);
                $mail->Subject = $data["subject"] = 'VERIFICATION ACCESS CODE';
                ob_start();
//                include_once '../classes/cEntries.php';
                $data["v_code"] = $code;
                
                require_once "../pages/email/pverificationcode.php";//get template file
                $data["template"] = ob_get_contents(); 
                
                ob_end_clean();
                $mail->MsgHTML($data["template"]);

                if (DEBUG === TRUE){
                    echo $data["template"];
                }
                if (EMAIL === TRUE){
                    $mail->Send(); //send mail here
                }
            }else{
//                echo 'bad data';
            }
            break;
        default:
            break;
    }

} catch (phpmailerException $e) {
  echo (DEBUG === TRUE)? $e->errorMessage():''; //Pretty error messages from PHPMailer
} catch (Exception $e) {
  echo (DEBUG === TRUE)? $e->getMessage():''; //Boring error messages from anything else!
}
?>
</body>
</html>
