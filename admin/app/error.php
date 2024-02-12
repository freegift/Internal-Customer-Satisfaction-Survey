<?php 
require_once 'connect.php';
require_once 'config.php';
$_SESSION["EMP"]["ID"] = 1;
include_once 'capp.php';
//$cApp->IsLoginSession();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Error - <?php echo cApp::AppTitle() ;?></title>
        
    <link href="<?php echo BASE_DIR ;?>web/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" />
    <link href="<?php echo BASE_DIR ;?>web/css/css.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo BASE_DIR ;?>web/js/jquery-1.8.3.js"></script>
    <script src="<?php echo BASE_DIR ;?>web/js/jquery-ui-1.9.2.custom.js"></script>
    <script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/js.js"></script>
</head>

    <body class="body" oncontextmenu="return false"> 
        <div style="margin: 30px;">
            <h2>ERROR!</h2>
            <p><em style="font-size: 18px;">Sorry, your action could not be completed.
                    A support email has been sent to the Administrator for update.</em>
            </p>
            
            <h3>Thank you!</h3>
            <?php echo 'PORT : '.$_SERVER["SERVER_PORT"];
            var_dump($_SESSION["ERROR"]);
            /*
            $eheader = "From: info@advert-space.com \r\n";
            $eheader.= "Reply-To: info@advert-space.com \r\n";
            $eheader.= "Return-Path: info@advert-space.com \r\n";
            $eheader.= "X-Mailer: PHP/" . phpversion() . "\r\n";
            $eheader.= "MIME-Version: 1.0\r\n";
            $eheader .= "Bcc: insuranceexpertnigeria@yahoo.com \r\n";
            $eheader.= "Content-type: text/html; charset=UTF-8\r\n";//ISO-8859-1\r\n";
            $eheader .= 'Cc: freegiftudourom@yahoo.com ' . "\r\n";
            $res = mail('uenomfon@cornerstone.com.ng', 'Testing Inventory', wordwrap('Congratulations here...',70));
            echo $res.'DONE!';
           */
            $err = NULL;
            foreach ($_SESSION["ERROR"] as $key => $value) {
                $err .= $key . ' => ' . $value . "<br>";
    
}
/*
            $html = "<html><body>@@message@@</body></html>";
            $to       = 'freegiftudourom@yahoo.com';
$subject  = 'Testing sendmail.exe';
$message  = 'Hi, you just received an email using sendmail! OK <br>Congratulations!!!<br>'. $err;
$headers  = 'From: uenomfon@cornerstone.com.ng' . "\r\n" .
            'Reply-To: uenomfon@cornerstone.com.ng' . "\r\n" .
            'Cc: freeg.research@gmail.com' . "\r\n" .
            'Bcc: info@advert-space.com' . "\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=UTF-8' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            $message = str_replace("@@message@@", $message, $html);
            //echo $message;
if(mail($to, $subject, $message, $headers))
    echo "Email sent";
else
    echo "Email sending failed";
  */          ?>
        </div>

</body>
</html>