<?php ob_start();
require_once 'connect.php';
require_once 'config.php';
//$_SESSION["EMP"]["ID"] = 1;
include 'capp.php';
$cApp->IsLoginSession();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo cApp::AppTitle() ;?></title>
        
    <link href="<?php echo BASE_DIR ;?>web/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" />
    <link href="<?php echo BASE_DIR ;?>web/css/css.css" rel="stylesheet" type="text/css" />

    <script src="<?php echo BASE_DIR ;?>web/js/jquery-1.8.3.js"></script>
    <script src="<?php echo BASE_DIR ;?>web/js/jquery-ui-1.9.2.custom.js"></script>
    <script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/js.js"></script>
    <style>
@font-face {
    font-family: FBNIFont;
    src: url(<?php echo BASE_DIR ?>web/fonts/FrutigerLTStd-Light.otf)?>);
}
*{font-family: FBNIFont}
</style>
</head>

<body class="body" oncontextmenu="return false">
<?php
include_once 'header.php';
?><script>
    $(function(){
        $.post('../home/email/email.php?module=Login&cmd=success&option=view',
        function(data) {
        $('.message').html(data);
        });
    });
</script><!--";//run in background, send email -->

</body>
</html>
<?php ob_end_flush();?>