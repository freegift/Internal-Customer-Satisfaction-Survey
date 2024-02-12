<?php ob_start();
require_once 'connect.php';
require_once 'config.php';
include 'capp.php';
$cApp->IsLoginSession();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo cApp::AppTitle() ;?></title>
        
<link href="<?php echo BASE_DIR ;?>web/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo BASE_DIR ;?>web/css/css.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo BASE_DIR ;?>web/js/jquery-1.8.3.js"></script>
    <script src="<?php echo BASE_DIR ;?>web/js/jquery-ui-1.9.2.custom.js"></script>
    <script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/js.js"></script>
</head>

<body class="body" oncontextmenu="return false">
    
<?php
//switch ($_SESSION['LOGIN']['US_ROLE_ID']) {
//    case 1:
//        include_once '../home/menu/menu.php';
//        break;
//    case 2:
//        include_once '../home/menu/Menu_admin.php';
//        break;
//    case 3:
//        include_once '../home/menu/Menu_user.php';
//        break;
//    default:
//        include_once '../home/menu/Menu_user.php';
//        break;
//}
include_once '../home/menu/menu.php';
?>
    <img src="<?php echo BASE_DIR ;?>web/images/fbn-logo.png" width="225" height="" alt=""
             style=" border-radius: 4px; vertical-align: top; margin-right: 5px; margin-left: 10px; margin-top: 3px;"/>
    <br /><?php // echo time();// + (60*60);//A_DATE . ' ' .A_TIME .' ';//. time() + (60*60) ;//.' '. microtime() ;?>
    <!--<div align="center" class="" style="padding: 2px; font-size: 13px;">support@cornerstone.com.ng</div>-->

</body>
</html>
<?php ob_end_flush();?>