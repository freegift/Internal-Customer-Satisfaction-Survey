<!DOCTYPE html>
<?php
$r_departments = $cControllers->ListOne("departments", "d_id", $id);
$r_questions = $cControllers->ListNoneMappedDepartmentQuestions($id);              
?>
<form name="Save" action="" method="POST">
    <input type="hidden" value="save_map_department_questions" name="form" />
    <input type="hidden" value="<?php echo $id;?>" name="id" />
<table id="add" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label class="bold">Here is your selected Department</label><span class="star"></span><br>
            <!--<select name="mqo_question_id" class="ui-widget-content ui-corner-all" style=" width: 350px;" >-->
                <?php  
                //$grp = array();
                if(!empty($r_departments)){
                foreach ($r_departments as $k => $v) { 
                    ?><textarea name="d_name" readonly="" class="ui-widget-content ui-corner-all" cols="50" rows="1"><?php echo $v["d_name"];?></textarea>
                    <input type="hidden" value="<?php echo $v["d_id"];?>" name="mqd_dept_id_target" />
            
                        <!--<option value="<?php // echo $v["q_id"] ;?>" <?php // echo $cApp->IsSelected($v["q_id"], $id);?>><?php // echo $v["q_name"] ;?></option>-->
                   <?php //} 
                }}
                ?>
            <!--</select>-->
            
            <?php if (!empty($r_questions)){?>
            <br><br><br><br><br><br>
            <input name="btnadd" class="" type="submit" value="Save Department & Question Mapping" />
            <!--<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php // echo BASE_DIR."controllers/controllers.php?p=mapping";?>');" />--> 
            <?php } ?>
        </td>
        <?php if (!empty($r_questions)){?>
        <td class="td">
            <label class="bold">Select this Question for this department and save</label><span class="star"></span><br>
            <br>
            <div style=" width: 450px; height: 200px; overflow-y: scroll;">
                <?php  
                //$grp = array();
                if(!empty($r_questions)){
                foreach ($r_questions as $k => $v) { ?>
                    <input type="checkbox" class="item" name="mqd_question_id[<?php echo $v["q_id"];?>]" id="id" value="<?php echo $v["q_id"];?>" />&nbsp;&nbsp;
                    <?php echo $v["q_name"] ;?><hr class="hr">
                <?php } }?>
            </div>
        </td>
        <?php } ?>
    </tr>
</table>
<hr class="hr">

<br>
<table id="list" class="list-table ui-widget-content ui-corner-all" >
    <thead>
        <tr class="tr ui-widget-header">
            <th class="th">S/NO</th>
            <th class="th" style=" width: 450px;">MAPPED QUESTIONS</th>
            <th class="th">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        <?php $g = $cControllers->ListMappedDepartmentQuestions($id); 
        $i=0;
        if(!empty($g)){
        foreach ($g as $k => $v) { $i++;
            $bg_row = ($i % 2 == 0)? "row" : "alternate";
        ?>
        <tr class="tr">
            <td class="td <?php echo $bg_row;?>"><?php echo $i;?></td>
            <td class="td <?php echo $bg_row;?>"><?php echo $v["q_name"];?></td>
<!--            <td class="td <?php // echo $bg_row;?> td-center"><?php // echo $v["o_score"];?></td>
            <td class="td <?php // echo $bg_row;?> td-center"><?php // echo $v["o_percent"];?>%</td>-->
            <td class="td <?php echo $bg_row;?> td-center">
                <?php //if ($cApp->HasPrivilege("P_USER_VIEW")) { ?>
                <input name="btnremove[<?php echo $v["mqd_id"];?>]" class="" type="submit" value="Remove" />
            <!--<input name="btnedit" class="view" type="button" value="Remove" onclick="link_direct('<?php // echo BASE_DIR."controllers/controllers.php?p=mapquestionoptions&cmd=delete&id=".$v["mqo_id"];?>');" />-->
               <?php // } ?>
            </td>
        </tr>
        <?php } }?>
    </tbody>
</table>
</form>