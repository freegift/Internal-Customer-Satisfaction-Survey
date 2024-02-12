<?php //ob_start();
require_once '../app/connect.php';
require_once '../app/config.php';
//$MODULE = "Setup";

//load global classes for employee
include_once '../app/capp.php';

$cApp->IsLoginSession();//triger login
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo cApp::AppTitle() ;?></title>
        
<link href="<?php echo BASE_DIR ;?>web/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASE_DIR ;?>web/css/css.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/js.js"></script>
<style>
@font-face {
    font-family: FBNIFont;
    src: url(<?php echo BASE_DIR ?>web/fonts/FrutigerLTStd-Light.otf)?>);
}
*{font-family: FBNIFont; font-size:16px; }
</style>
</head>

<body class="body-container" oncontextmenu="return false">
    <div style="margin: 5px; /* min-height: 540px; height: 540px; overflow: auto;*/">
       
      <!--<script type="text/javascript" src="Js/Employee.js"></script>-->