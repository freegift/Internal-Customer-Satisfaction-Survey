<?php include_once 'header.php';
if (isset($_SESSION["logout"]["no_back"])){
    echo "<script> history.go(1); </script>";
}
?>
<div align="center">
    <div style="margin: 0px 30px; padding: 30px; width: 600px"><?php $cApp->ShowInfo();?>
        
        <table class="form-table" style="border-radius: 10px; background: url(<?php echo BASE_DIR ;?>web/images/bg102.png) repeat;">
        <tr style="vertical-align: top;">
            <td>
                <div style="background-color: #1a206d; color: #ffffff; border-radius: 5px; padding: 15px; width: 500px;  /*height: 350px;*/ text-align: center;">
                    <div class="formtitle" style="font-size: 22px;">LOGOUT</div>
                    <br>
                    <span style="font-size: 20px;">Your logout is successful</span>
                    <br>
                    
                </div>
            </td>
        </tr>
        </table><br>
        <p>
            <h3><a class="button" href="../../" title="Home">Home Page >>></a></h3>
        
    </div>
</div>