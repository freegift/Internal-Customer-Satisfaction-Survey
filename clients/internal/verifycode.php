<?php 
include_once 'header.php';
if (isset($_SESSION["verifycode"]["no_back"])){
    echo "<script> history.go(1); </script>";
}
?>
<div align="center">
    <div style="margin: 0px 30px; padding: 30px; width: 600px">
    <?php 
    if (isset($_SESSION["u_verify_code"]) && $_SESSION["u_verify_code"] !== '' && $_SESSION["flag"] == TRUE){
        $MESSAGE[] = "Access code generated successfully";// and sent to ". $_SESSION["u_email"] .". Please check your email.";//.$code;
        $_SESSION["flag"] = FALSE;
        echo "<script>
                $(function(){
                    $.post('".BASE_DIR ."home/email/email.php?module=verifycode&email=".$_SESSION['u_email']."&code=".$_SESSION['u_verify_code']."',
                    function(data) {
                    $('.message_').html(data);
                    });
                });
           </script>";
    }elseif(!isset($_SESSION["u_verify_code"])){
        header("Location: index.php");
        exit();
    }
    $cApp->ShowInfo();
    ?>
        <table class="form-table" style="/*margin: 30px; padding: 30px;*/ border-radius: 10px; background: url(<?php echo BASE_DIR ;?>web/images/bg102.png) repeat;">
        <tr style="vertical-align: top;">
            <td>
                <div style="background-color: #1a206d; color: #ffffff; border-radius: 5px; padding: 15px; width: 500px;  /*height: 350px;*/ text-align: center;">
                    <div class="formtitle" style="font-size: 22px;font-weight: bold;">USER LOGIN</div>
                    <hr class="hr" /><br>
                    <span style="font-size: 20px; font-style: italic;">Please verify the access code sent to your email or copy as generated below</span>
                    <br><br><br>    
                    <form action="" method="POST" name="acces">
                        <input name="form" value="verifycode"  type="hidden" />
                        <span class="label" style="font-size: 22px;font-weight: bold;">ACCESS CODE [ <?php echo $_SESSION['u_verify_code'];?> ]</span><br>
                        <input name="u_verify_code" id="us_username" class="input ui-widget-content ui-corner-all td-center" type="text" style=" height: 30px; width: 300px;" /><br>
                        <br><input name="btnverifycode" class="login" type="submit" value="Verify Access Code" style=" height: 25px; width: 200px;" />
                    </form>
                </div>
            </td>
        </tr>
        </table>
    </div>
</div>