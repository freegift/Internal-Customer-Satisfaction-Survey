<?php  //error_reporting(E_ALL | E_WARNING | E_PARSE | E_NOTICE);
 include_once '../app/config.php';
 include_once '../app/connect.php';
 include_once '../app/capp.php';
 include_once 'config.php'; 
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>User Login - <?php echo $cApp::AppTitle();?></title>
        <link href="<?php echo BASE_DIR ;?>web/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo BASE_DIR ;?>web/css/css.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/jquery-1.8.3.js"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/jquery-ui-1.9.2.custom.js"></script>
        <script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/js.js"></script>
        <style type="text/css">
            body { /*font-family: arial;*/ background-color: #a8b400;}
            .formtitle { padding: 3px; font-weight: bold; font-size: 18px; padding-bottom: 20px;}
            .input {margin-left: 0px; margin-top: 10px; margin-bottom: 10px; padding: 7px; position: relative;
                   border-radius: 3px; text-align: center; width: 150px;}
            .login {margin-left: 0px; margin-top: 10px; margin-bottom: 10px; padding: 5px;  border-radius: 3px;}
            .errors_ { color: red; font-size: 13px; padding: 5px; border-radius: 3px; border: 1px solid red;}
        </style>
        <style>
@font-face {
    font-family: FBNIFont;
    src: url(<?php echo BASE_DIR ?>web/fonts/FrutigerLTStd-Light.otf)?>);
}
*{font-family: FBNIFont}
</style>
    </head>
    <body>
        <div id="header" class=" ui-widget">
            <div style="/*width: 500px;*/ float: left;">
                <div style="float: left; background-color: white;">
                <img src="<?php echo BASE_DIR ;?>web/images/fbn-logo.png" height="65" alt=""
                     style=" border-radius: 4px; float: left; vertical-align: top; margin-right: 5px; margin-left: 10px; margin-top: 3px; z-index: 3"/>
                </div>
                <div class="" style="padding: 1px 5px; margin-top: 7px; color:white; 
                    position:relative; font-weight: normal; /*width: 100%; */ z-index: 1; float: left;">
                    <h1 style="margin: 0px; padding: 0px; "><?php echo cApp::AppTitle() ;?></h1>
                    <span class=""><?php //echo $_SESSION["LOGIN"]["US_ID"];?></span>
                    <!--<span>Department / Unit: <strong><?php // echo $_SESSION["LOGIN"]["US_DEPT_NAME"];?></strong></span><br>-->
                    <!--<br><span>Welcome ! <strong><?php // echo $_SESSION["LOGIN"]["l_full_name"];?></strong> </span>-->
                        <!--<span><?php // echo isset($_SESSION["ROLE"])?$_SESSION["ROLE"]["NAME"]:'';?></span>-->
                </div>
            </div>
        </div>
        <div align="center">
            <div style="margin: 30px; padding: 30px; width: 600px">
            <?php $cApp->ShowInfo();?>
                <table class="form-table" style="/*margin: 30px; padding: 30px;*/ border-radius: 10px; background: url(<?php echo BASE_DIR ;?>web/images/bg102.png) repeat;">
            <tr style="vertical-align: top;">
                <td style="height: 250px; width: 220px;"><img src="<?php echo BASE_DIR ;?>web/images/fbn-logo.png" alt="" width="230" height="250" /></td>
                <td>
                    <div style="background-color: #1a206d; color: #ffffff; border-radius: 5px; width: 250px; padding: 5px; /*background: url(../web/images/bg12.png) repeat;*/ text-align: center;">
                        <div class="formtitle">USER LOGIN</div>
                           
                        <br>
                            <form action="" method="POST" name="login">
                                <span class="label"> Email</span><br>
                                <input name="us_username" id="us_username" class="input ui-widget-content ui-corner-all" type="text" /><br>
                                <span class="label"> Password</span><br>
                                <input name="us_password" id="us_password" class="input ui-widget-content ui-corner-all" type="password" /><br>
                                <input name="btnlogin" class="login" type="submit" value="Login" >
                                
                            </form>
                        <br>
                    </div>
                </td>
            </tr>
        </table>
            </div>
        </div>
    </body>
</html>