<?php
include_once '../app/config.php';
include_once '../app/connect.php';
//include_once 'config.php';

$cConnect->AuditLog("users","LOGOUT","Logout Successful");
session_destroy(); //destroy all data registered to a session
header("Location: ".BASE_DIR."");
exit();
?>