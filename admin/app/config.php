<?php if (!isset($_SESSION)){
    ob_clean();
    session_start();
}

//configuration starts here;
//setup type of application to run [ DEVELOPMENT, DEMO, LIVE ]
$APPLICATION_STATUS = "DEVELOPMENT";



//general status
define("ENABLE", "Y");
define("DISABLE", "N");


//transactional/operational status
define("APPROVE", "A"); 
define("PENDING", "P");
define("CANCEL", "C");
define("DECLINE", "D");
define("TREATED", "T");

define("ROWSIZE", 30);

//refer manual to relative formats
define("A_DATE", date("Y-m-d", strtotime("+7 hours")));
define("A_DATE_FROM", date("Y-m-d", strtotime("14 days ago")));//"2014-01-01");
define("A_TIME", date("H:i:s", strtotime("+7 hours")));

//message / information display
$MESSAGE = array();
$ERROR = array();


switch ($APPLICATION_STATUS) {
    case "DEVELOPMENT":
        define("BASE_DIR_CLIENT", "http://localhost:82/fbniicss2/");
        define("BASE_DIR", "http://localhost:82/fbniicss2/admin/");
        define("SERVER", "localhost");
        define("USERNAME", "root");
        define("PASSWORD", "");
        define("DATABASE", "fbniicss2");//define("DATABASE", "survey");
        
        define("DEBUG", FALSE);
        define("EMAIL", TRUE);
//        define("MGT_SER_MAIL", "uenomfon@cornerstone.com.ng");
        break;
    case "DEMO":
        define("BASE_DIR_CLIENT", "http://apps.cornerstone.com.ng/survey/");
        define("BASE_DIR", "http://apps.cornerstone.com.ng/survey/admin/");
        define("SERVER", "localhost");
        define("USERNAME", "cornerst_demo");
        define("PASSWORD", "pass=123");
        define("DATABASE", "cornerst_survey");
        
        define("DEBUG", FALSE);
        define("EMAIL", TRUE);
//        define("MGT_SER_MAIL", "mgt_services@cornerstone.com.ng");
        break;
    case "LIVE":
        define("BASE_DIR_CLIENT", "http://apps.cornerstone.com.ng/survey/");
        define("BASE_DIR", "http://apps.cornerstone.com.ng/survey/admin/");
        define("SERVER", "localhost");
        define("USERNAME", "cornerst_demo");
        define("PASSWORD", "pass=123");
        define("DATABASE", "cornerst_survey");
        
        define("DEBUG", FALSE);
        define("EMAIL", TRUE);
//        define("MGT_SER_MAIL", "mgt_services@cornerstone.com.ng");
        
        break;
    default:
        die("Could not find application setup function.");
        break;
}

define("UPLOAD_DIR_FILES", "admin/Uploads/");

define("SUPER_ADMIN", "1");
$_SESSION["report_record"] = NULL;