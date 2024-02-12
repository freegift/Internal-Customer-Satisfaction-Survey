<?php include_once '../pages/email/eheader.php'; ?>
<p>Dear User,</p>
       
<p>Please be informed that a new verification code has been sent to you on the portal at 
     <?php echo date("Y-m-d H:i:s", strtotime("+8 hours"));// ', IP address : '.$_SERVER['REMOTE_ADDR'];?>
     <?php // echo 'Computer Name: '.gethostbyaddr($_SERVER["REMOTE_ADDR"]);?>
</p>
<p>Please copy the verification code below to your current login screen for access.</p>

<hr>
<div style=" font-size: 1.5em; font-weight: bolder;">
    Code : 
        <?php echo $data["v_code"];?>
</div>

<hr>
<p>Thank you.</p>       
<?php include_once '../pages/email/efooter.php';?> 