<?php 
include_once '../../admin/app/config.php';
include_once '../../admin/app/connect.php';
include_once '../../admin/app/capp.php';

//$cApp->IsLoginSession();//triger login

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo APP ;?> Survey - Cornerstone Insurance Plc</title>
        
        <link href="<?php echo BASE_DIR ;?>web/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" />
        <link href="<?php echo BASE_DIR ;?>web/css/css.css" rel="stylesheet" type="text/css" />

        <script src="<?php echo BASE_DIR ;?>web/js/jquery-1.8.3.js"></script>
        <script src="<?php echo BASE_DIR ;?>web/js/jquery-ui-1.9.2.custom.js"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/js.js"></script>
        
        <style>
            body { font-size: 100%;}
            .col { /*border: 1px red solid;*/ padding: 5px; margin: 0px; margin-bottom: 50px;border-radius: 5px; }
            .sub-title { font-size: 1.8em; font-weight: bold; margin: 10px 0px; }
            .input { width: 300px !important;}
            input[type="file"] { width: 300px !important;}
            fieldset { border: 1px blue solid; border-radius: 5px; margin-bottom: 15px; }
            .sub-title-qty { font-size: 16px; font-weight: bold; margin: 10px 0px; }
            legend { font-style: italic; font-weight: bold; font-size: 16px;}
            dl {margin: 5px; max-width: 180px;}
            dd { margin-left: 200px; margin-top: -23px; margin-bottom: 20px;}
            .spam_key { font-size: 20px; font-style: italic; font-weight: bolder;}
            .text { line-height: 1.8em; margin-bottom: 20px; margin-top: 5px;}
            /*input[type="reset"] {margin-top: 0px; padding: 3px 10px; box-shadow: 0px 3px 3px #777;*/
    /*background-image: url(custom-theme/images/ui-bg_highlight-hard_70_b85700_1x100.png); border-radius: 4px;}*/
        </style>
    </head>
    <body>
        
<div id="header" class=" ui-widget">
    <div style="/*width: 500px;*/ float: left;">
        <div style="float: left; background-color: white;">
        <img src="<?php echo BASE_DIR ;?>web/images/logo-only.png" width="65" height="65" alt=""
             style=" border-radius: 4px; float: left; vertical-align: top; margin-right: 5px; margin-left: 10px; margin-top: 3px; z-index: 3"/>
        </div>
        <div class="" style="padding: 1px 5px; margin-top: 7px; color:white; 
            position:relative; font-weight: normal; /*width: 100%; */ z-index: 1; float: left;">
            <h1 style="margin: 0px; padding: 0px; "><?php echo cApp::AppTitle() ;?></h1>
            <span class="bold"><?php echo APP;?> Customer</span>
            <!--<span>Department / Unit: <strong><?php // echo $_SESSION["LOGIN"]["US_DEPT_NAME"];?></strong></span><br>-->
            <!--<br><span>Welcome ! <strong><?php // echo $_SESSION["LOGIN"]["l_full_name"];?></strong> </span>-->
                <!--<span><?php // echo isset($_SESSION["ROLE"])?$_SESSION["ROLE"]["NAME"]:'';?></span>-->
        </div>
    </div>

<!--    <div class="" style="z-index: 0; float: right; width: auto; /*border-color: red; border-width: 1px; border-style: dotted;*/
         margin-right: 10px; margin-top: 5px; height: 70px; font-weight: normal; text-align: right; /*position: absolute; margin-left: 600px;*/">
        <a target="_parent" href="<?php // echo BASE_DIR."login/logout.php" ;?>" title="logout here" class="button"><span class="ui-icon ui-icon-power" style="float:left; margin:0 0px 0px 0;"></span>Logout</a><br>
        <div id="timer"></div>
    </div>-->
<br class="cls">
</div>  
   