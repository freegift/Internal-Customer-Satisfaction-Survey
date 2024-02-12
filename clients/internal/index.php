<?php include_once 'header.php';
if (isset($_SESSION["index"]["no_back"])){
    echo "<script> history.go(1); </script>";
}

?>

<!--<div align="center"><br>
    <h1 style=" font-size: 30px; color: red;">Survey Now Closed...!<br>Thank you.</h1>
</div>-->
<?php // exit();?>

<div align="center">
    <div style="margin: 0px 30px; padding: 30px; width: 600px"><?php $cApp->ShowInfo();?>
        
        <table class="form-table" style="/*margin: 30px; padding: 30px;*/ border-radius: 10px; background: url(<?php echo BASE_DIR ;?>web/images/bg102.png) repeat;">
        <tr style="vertical-align: top;">
            <td>
                <div style="background-color: #1a206d; color: #ffffff; border-radius: 5px; padding: 15px; width: 500px;  /*height: 350px;*/ text-align: center;">
                    <div class="formtitle" style="font-size: 22px; font-weight: bold;">USER LOGIN</div>
                    <hr class="hr" /><br>
<!--                    <span style="font-size: 20px; font-style: italic;">Please you are required to authenticate your identity in this portal before continuing on the survey questions</span>
                    <br><br><br>    -->
                    <form action="" method="POST" name="login">
                        <input name="form" value="email"  type="hidden" />
                        <span class="label" style=" font-size: 20px;">Please Enter Valid FIC/FICC Number</span><br>
                        <input name="u_username" id="us_username" class="input ui-widget-content ui-corner-all td-center" type="text" style=" height: 30px; width: 300px;" /><br>
                        <br><input name="btnlogin" class="login" type="submit" value="Login" style=" height: 25px; width: 200px;" />
                    </form>
                </div>
            </td>
        </tr>
        </table>
        
    </div>
</div>