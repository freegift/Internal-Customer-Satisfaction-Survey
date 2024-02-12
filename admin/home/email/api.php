<?php
if (!isset($_REQUEST["m"])) exit ();
if (!isset($_SESSION)){
    session_start();
}
require_once '../../app/connect.php';
require_once '../../home/classes/cemail.php';
require_once '../../app/capp.php';
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo cApp::AppTitle() ;?></title>
<!--        
<link href="<?php echo BASE_DIR ;?>web/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASE_DIR ;?>web/css/css.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/js.js"></script>
-->
</head>
<body>
    <?php
//$MESSAGE[] = NULL;
//require_once '../../web/selfconfig.php';
switch ($_REQUEST["m"]) {
    case "ur":
        $cmd = $_REQUEST["cmd"];
        $rid = $_REQUEST["rid"];
        $sender = $_REQUEST["u"];
        if (strtoupper($cmd) === APPROVE){
            $cmd = APPROVE;
            $cmd_ = "APPROVED";
            //===================
            if ($cEmail->Update("UPDATE requests SET REQ_APPROVE_STATUS = '".$cmd."' "
                    . ", REQ_APPROVE_DATE = '".A_DATE."', REQ_APPROVE_TIME = '".A_TIME."' "
                    . "WHERE REQ_ID = $rid AND REQ_APPROVE_STATUS = '".PENDING."' AND REQ_APPROVE_USER = '$sender'"))
             {
                if($cEmail->affected_rows > 0 ){
                    $MESSAGE[] = "Request $cmd_ successfully";
                    $t = implode('',@file( BASE_DIR . "home/email/email.php?module=Requisition&cmd=approve&id=$rid&user_name="));
                }else{
                    $MESSAGE[] = 'Action already completed';
                }
             }else{
                 $MESSAGE[] = 'Action not completed';
             }
        } elseif (strtoupper($cmd) === DECLINE){
            $cmd = DECLINE;
            $cmd_ = "DECLINED";
            //========================================
            if ($cEmail->Update("UPDATE requests SET REQ_APPROVE_STATUS = '".$cmd."' "
                    . ", REQ_APPROVE_DATE = '".A_DATE."', REQ_APPROVE_TIME = '".A_TIME."' "
                    . "WHERE REQ_ID = $rid AND REQ_APPROVE_STATUS = '".PENDING."' AND REQ_APPROVE_USER = '$sender'"))
             {
                if($cEmail->affected_rows > 0 ){
                    $MESSAGE[] = "Request $cmd_ successfully";
                    $t = implode('',@file( BASE_DIR . "home/email/email.php?module=Requisition&cmd=decline&id=$rid&user_name=$user"));
                }else{
                    $MESSAGE[] = 'Action already completed';
                } 
            }else{
             $MESSAGE[] = 'Action not completed';
            }
        } elseif (strtoupper($cmd) === "Y"){
            $cmd = ENABLE;
            $cmd_ = "COLLECTED/ACKNOWLEGDE";
            //========================================
            if ($cEmail->Update("UPDATE requests SET REQ_COLLECTED = '".$cmd."' "
                    . "WHERE REQ_ID = $rid AND REQ_STOCK_OUT_STATUS = '".ENABLE."'"))
             {
                if($cEmail->affected_rows > 0 ){
                    $MESSAGE[] = "Request $cmd_ successfully";
                    //$t = implode('',@file( BASE_DIR . "home/email/email.php?module=Requisition&cmd=decline&id=$rid&user_name=$user"));
                }else{
                    $MESSAGE[] = 'Action already completed';
                } 
                }else{
                 $MESSAGE[] = 'Action not completed';
             }
        } else {
            $MESSAGE[] = "Invalid command parameters";
            break;
        }
        
//        var_dump($MESSAGE);
        break;

    default:
        break;
}
?>
<div id="header" class=" ui-widget">
    <div style="/*width: 500px;*/ float: left;background-color: #1a206d; color: white;">
    <div style="float: left; ">
    <img src="<?php echo BASE_DIR ;?>web/images/logo-only.png" width="65" height="65" alt=""
         style=" border-radius: 4px; float: left; vertical-align: top; margin-right: 5px; margin-left: 10px; margin-top: 3px; z-index: 3"/>
    </div>
    <div class="" style="padding: 1px 5px; margin-top: 7px; /*color:white; */
        position:relative; font-weight: normal; /*width: 100%; */ z-index: 1; float: left;">
        <h1 style="margin: 0px; padding: 0px; "><?php echo $MESSAGE[0] ;?></h1>
    </div>
    </div>
</div>
<div class="message1" style="clear: both;"></div>

</body>