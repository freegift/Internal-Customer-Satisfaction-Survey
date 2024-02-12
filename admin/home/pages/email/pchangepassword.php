<?php
include_once '../pages/email/eheader.php';

?>
        Dear <?php echo $_SESSION["LOGIN"]["US_FULLNAME"] .' - '.$_SESSION["LOGIN"]["US_EMAIL"];?>,<br>
       
        <p>Please be informed that your password has been changed on <?php echo date("Y-m-d H:i:s", strtotime("+8 hours"));?>.</p>
        <p>Username: <?php echo $_SESSION["LOGIN"]["US_NAME"];?><br>
            Password: <?php echo $_SESSION["LOGIN"]["US_PASSWORD"];?><br>
            IP Address: <?php echo $_SERVER['REMOTE_ADDR'];?><br>
        </p>
        <p>If you did not perform the above operation at the time detailed above, please call CORNSERSTONE;
            our 24 hour interactive contact centre on: +234 703 6689116, +234 1 2806500, or send an
            email to support@cornerstone.com.ng immediately.
        </p>
        
        <p>Thank you for using our system.</p><br>
       
<?php include_once '../pages/email/efooter.php';?> 