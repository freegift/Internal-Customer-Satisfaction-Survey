<?php 
include_once 'header.php';
if (!isset($_SESSION["c_id"])){
    echo '<script>window.location.href = "index.php";</script>';
//    ob_flush();
//    header("Location: index.php");
}


//var_dump($_SESSION["u_dept_id"]);
//var_dump($_SESSION["c_id"]);
//var_dump($_SESSION["u_id"]);
$target_dept_heads = NULL; $target_dept = NULL;
if($_SESSION['u_unit_head']=='Y')
{
    $target_dept = $cInClients->TargerDepartmentsForHeads($_SESSION["u_dept_id"], $_SESSION["c_id"], $_SESSION["u_id"]);
}else{
    $target_dept = $cInClients->TargerDepartments($_SESSION["u_dept_id"], $_SESSION["c_id"], $_SESSION["u_id"]);
}
//$target_dept_self = $cInClients->TargerDepartmentsSelf($_SESSION["u_dept_id"], $_SESSION["c_id"], $_SESSION["u_id"]);
//$report_data = $cInClients->TargerDepartments($_SESSION["u_dept_id"], $_SESSION["c_id"], $_SESSION["u_id"]);
?>
<div align="center">
    <div style="font-size: 30px; margin-top: 10px">Welcome <strong><?php echo $_SESSION["u_fullname"];?></strong></div>
    <?php 
    //echo 'note this';
//    if (isset($_SESSION["u_verify_code"]) && $_SESSION["u_verify_code"] !== '' && $_SESSION["flag"] == TRUE){
//        $MESSAGE[] = "Access code successfully generated and sent to ". $_SESSION["u_email"] .". Please check your email.";//.$code;
//        $_SESSION["flag"] = FALSE;
//    }elseif(!isset($_SESSION["u_verify_code"])){
//        header("Location: /");
//        exit();
//    }
//    echo 'u_id:'.$_SESSION["u_id"];
//    $_SESSION["DEFAULT"]["c_id"] = $_SESSION["c_id"];
    ?>
    <?php $cApp->ShowInfo();?>
    
    <?php if(!empty($my_target_questions) && isset($my_target_dept)) : ?>
    <div id="questions" style="text-align: center; border: 1px #1a206d solid; /*background-color: #1a206d; color: #ffffff;*/ border-radius: 5px; margin: 20px; padding: 10px 15px; width: 800px;text-align: center;">
    <table class="form-table" style="/*color: #ffffff;*/ width: 100%;">
    <tr style="vertical-align: top;">
        <td >
            <div class="formtitle1" >
                <span style="font-size: 22px;">Department : <strong><?php echo $my_target_dept[0]["d_name"];?></strong></span> 
                <!--<span style="font-size: 20px; line-height: 1.4em;">Please rate this unit/department.</span>-->
            </div><br>
            <div style="font-weight: bold; color: red;">* All questions are compulsory</div>
            <hr class="hr"/>
            
            <?php // var_dump($my_target_questions);?>
                <form action="" method="POST" name="survey_q">
                    <input name="form" value="survey_q"  type="hidden" />
                    <div style="border-radius: 5px; padding: 15px 8px; ">
                    <?php if(!empty($my_target_questions)) { ?>
                        <table style="/*color: #ffffff;*/ width: 100%;">
                    <?php foreach ($my_target_questions as $key => $value) {
                        ?>
                            <tr>
                            <td style="width: 20px;"><span class="label td-center"><?php echo ($key+1) ;?></span></td>
                            <td style="width: 600px; font-size: 16px;">
                                <span><?php echo $value["q_name"] ;?></span>
                                <div style="margin-left: 10px; margin-bottom: 15px;">
                                <?php foreach ($value["options"] as $key_o => $value_o) {?>
                                    <input id="<?php echo $value["q_id"].'['.$value_o["o_id"].']';?>" type="radio"
                                           name="options[<?php echo $value["q_id"];?>]"
                                           class="" value="<?php echo $value_o["o_id"].','.$value_o["o_score"].','.$value["q_max_score"] ;?>"
                                           required>
                                    <label for="<?php echo $value["q_id"].'['.$value_o["o_id"].']';?>"><?php echo $value_o["o_name"] ;?></label>
                                    
                                    &nbsp;&nbsp;&nbsp;&nbsp;
<!--                                    <label for="no">NO</label>
                                    <input id="no" type="radio" name="option" class="anon" value="N"> -->
                                <?php  };?>
                                </div>
                                <hr>
                            </td>
                        </tr>
                    <?php  } ?>
                       </table>
                        <br>
                    <div>
                        <p>
                        <span>What do you like most about us?</span><br>
                        <textarea name="s_suggestion" cols="60" rows="6" style=" text-align: left;"><?php echo trim($my_target_suggestion[0]["s_suggestion"]); ?></textarea>
                        </p>
                        <p>
                        <span>What would you like us to do better?</span><br>
                        <textarea name="s_suggestion2" cols="60" rows="6" style=" text-align: left;"><?php echo trim($my_target_suggestion[0]["s_suggestion2"]); ?></textarea>
                        </p>
                        <input name="s_id" value="<?php echo $my_target_suggestion[0]["s_id"];?>" type="hidden" />
                    </div>
                        <input name="target_dept" value="<?php echo $my_target_dept[0]["d_id"];?>" type="hidden" />
                            <input name="mydata" type="hidden" value="
                                <?php echo $_SESSION["u_id"].','.$_SESSION["u_dept_id"].','.$my_target_dept[0]["d_id"]
                                        .','.$_SESSION["c_id"];?>
                            " />
                        <br><input name="btnsurvey_q" class="login" type="submit" value="Submit" style=" height: 25px; width: 200px; font-size: 14px;" />
                    <?php };?>
                    </div>
                </form>
        </td>
    </tr>
    </table>
    </div>
<?php endif; ?>
    
    
    <div style="text-align: center; background-color: #1a206d; color: #ffffff; border-radius: 5px; margin-top: 20px; margin-bottom: 40px; padding: 10px 15px; width: 800px;">
        <style>
/*@font-face {
    font-family: FBNIFont;
    src: url(<?php // echo BASE_DIR ?>web/fonts/FrutigerLTStd-Light.otf)?>);
}
*{font-family: FBNIFont}*/
</style>
        <table class="form-table" style="color: #ffffff; width: 98%;">
        <tr style="vertical-align: top;">
            <td>
<!--                <form action="#questions" method="POST" name="survey_logout">
                    <div class="formtitle" style="font-size: 22px;">
                        <?php // echo (isset($_SESSION["u_fullname"]))? "Welcome <strong>".$_SESSION["u_fullname"]."</strong> !":'';?>
                        <input name="btnlogout" value="Logout" type="submit" style="float: right;" />
                        <input name="form" value="survey_logout"  type="hidden" />
                    </div>
                </form> 
                <hr class="hr"/>-->
                <!--<div style="">
                    <span style="font-size: 16px;">Survey Summary Report <strong><?php //echo 'i am here';?></strong></span> 
                    <span style="font-size: 15px; line-height: 1.4em;">
                        - Here are your scores from different units<br>
                    </span><br>
                    <div style="border-radius: 5px; padding: 15px 8px; width: 100%;background-color: #ffffff;">
                        <?php
                            $report_data = $iReports->ReportsDepartments($_SESSION["u_dept_id"]);
                        ?>
                        <table style=" font-size: 0.9em;">
                            <tr>
                                <th>S/N</th><th>UNIT</th>
                                <th>TOT. SCORES</th><th>EXP. SCORES</th><th>AVERAGE</th><th>PERCENT</th><th>REMARK</th>
                            </tr>
                            <?php foreach ($report_data as $key => $value) { ?>
                            <tr style="font-size: 18px; margin-bottom: 10px">
                            <td style="width: 10px; padding: 5px"><span class="label td-center">
                                <span><?php echo ($key+1) ;?></span>
                            </td>
                            <td style="min-width: 300px; font-weight: bold;padding: 5px ">
                                <span><?php echo $value["d_name"] ;?></span>
                            </td>
                            <!--
                            <td style="text-align: center;">
                                <?php // echo $value["d_tot_scores"] ;?>
                            </td>
                            <td style="text-align: center;">
                                <?php // echo $value["d_max_scores"] ;?>
                            </td>
                            <td style="text-align: center;">
                                <?php // echo $value["d_avg_scores"] ;?>
                            </td>
                            <td style="text-align: center;">
                                <?php // echo $value["d_percent"] ;?>%
                            </td>
                            <td style="text-align: center; width: 150px;">
                                <?php // echo $value["d_remark"] ;?>
                            </td>
                             <?php } ?>
                        </table>
                    </div><br>
                    <hr class="hr"/><br/>
                </div>-->
            <?php $i = 1 ;?>
                    <?php if(!empty($target_dept)) { ?>
                    <span style="font-size: 16px; line-height: 1.4em;">
                        Please objectively appraise the following departments/units<br>
<!--                        Click the continue button-->
                    </span>
                    <br>    
                    <form action="" method="POST" name="survey_d">
                        <input name="form" value="survey_d"  type="hidden" />
                        <div style="border-radius: 5px; padding: 15px 8px; width: 100%;background-color: #ffffff;">
                            <table style="">
                            <?php foreach ($target_dept as $key => $value) {
                                if($value["remark"] == "COMPLETED"){
                                    $style = 'color: green;';
                                    $hidden = "disabled";
                                }else{
                                    $style = 'color: red;';
                                    $hidden = '';
                                }
                            ?>
                                <tr style="font-size: 16px; margin-bottom: 10px">
                                    <td style="width: 20px; padding: 5px"><span class="label td-center"><span><?php echo ($i++) ;?></span></td>
                                <td style="min-width: 400px; font-weight: bold;padding: 5px "><span><?php echo $value["d_name"] ;?></span></td>
                                <td>
                                    <input name="btnsurvey_d[<?php echo $value["d_id"] ;?>]" <?php echo $hidden;?> class="login" type="submit" value="Continue >>..." style=" height: 25px; width: 200px;" />
                                </td>
                                <td style="text-align: center; <?php echo $style;?>"><?php echo $value["remark"] ;?></td>
                            </tr>
                        <?php  } ?>
                            <!--++++++++++++++++++++ unit head / managers special unit rating begins -->
                            <?php foreach ($target_dept_heads as $key => $value) {
                                if($value["remark"] == "COMPLETED"){
                                    $style = 'color: green;';
                                    $hidden = "disabled";
                                }else{
                                    $style = 'color: red;';
                                    $hidden = '';
                                }
                            ?>
                                <tr style="font-size: 16px;  margin-bottom: 10px; background-color: #fbf9ee;">
                                    <td style="width: 20px; padding: 5px"><span class="label td-center"><span><?php echo ($i++) ;?></span></td>
                                <td style="min-width: 400px; font-weight: bold;padding: 5px "><span><?php echo $value["d_name"] ;?></span></td>
                                <td>
                                    <input name="btnsurvey_d[<?php echo $value["d_id"] ;?>]" <?php echo $hidden;?> class="login" type="submit" value="Continue >>..." style=" height: 25px; width: 200px;" />
                                </td>
                                <td style="text-align: center; <?php echo $style;?>"><?php echo $value["remark"] ;?></td>
                            </tr>
                        <?php  } ?>
                            <!-- unit head / managers special unit rating ENDS -->
                           </table>
                        
                        </div>
                    </form>
                <?php }else{ ?>
                    <div style="font-size: 20px; line-height: 1.4em; width: 100%">
                        No available survey requirement for now.
                    </div>
               <?php };?>
            </td>
        </tr>
        </table>
    </div>


</div>