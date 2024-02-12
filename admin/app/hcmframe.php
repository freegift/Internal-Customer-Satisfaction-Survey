<?php 
require_once 'connect.php';
require_once 'config.php';
include_once 'capp.php';
$cApp->IsLoginSession(TRUE);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo cApp::AppTitle() ;?></title>
</head>
<frameset rows="70,*" cols="*" frameborder="no" border="0" framespacing="0">
  <frame src="../app/top.php" name="topFrame" scrolling="No" noresize="noresize" id="topFrame" title="topFrame" />
  <frameset rows="*" cols="240,*" framespacing="0" frameborder="no" border="0">
    <frame src="../app/left.php" name="leftFrame" scrolling="No" noresize="noresize" id="leftFrame" title="leftFrame" />
    <frame src="../app/right.php" name="rightFrame" scrolling="Yes" noresize="noresize" id="rightFrame" title="rightFrame" />
  </frameset>
</frameset>
<noframes>
    <body oncontextmenu="return false"></body>
</noframes>
</html>