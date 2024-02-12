<?php include_once '../pages/email/eheader.php'; ?>
<p>Dear <?php echo $_SESSION["LOGIN"]["l_fullname"] .' <'.$_SESSION["LOGIN"]["l_email"].'>';?>,</p>
       
        <p>Please be informed that you logged on to cornerstone internal survey application at
             <?php echo date("Y-m-d H:i:s", strtotime("+8 hours")), ', IP address : '.$_SERVER['REMOTE_ADDR'];?>.</p>
        <p>If you did not log on to your profile at the time detailed above, please call CORNSERSTONE;
            our 24 hour interactive contact centre on: +234 703 6689116, +234 1 2806500, or send an
            email to support@cornerstone.com.ng immediately.
        </p>
        
        <p>Thank you.</p>
       
<?php include_once '../pages/email/efooter.php';?> 