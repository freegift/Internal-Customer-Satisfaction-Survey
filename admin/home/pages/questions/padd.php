<!DOCTYPE html>
<?php
$def_cat = $cControllers->DefaultSurveyCategory();
//$max_score = $cControllers->ListAll("options");
?>
<form name="Add" action="" method="POST">
    <input type="hidden" value="add_question" name="form" />
<table id="add" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td" >
            <label>Enter Question</label><span class="star">*</span><br>
            <textarea name="q_name" class="ui-widget-content ui-corner-all" cols="50" rows="5"></textarea><br>
        </td>
        <td class="td">
            <label>Default Survey Category</label><span class="star">*</span><br>
            <select name="q_cat_id" class="ui-widget-content ui-corner-all" >
            <?php foreach ($def_cat as $k => $v) { ?>
                    <option value="<?php echo $v["c_id"] ;?>" <?php //echo $cApp->IsSelected($v["c_id"], $id);?>><?php echo $v["c_name"] ;?></option>
            <?php } ?>
            </select>
            <br><br><a class="button" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=categories";?>');">Change Default Survey?</a>
        </td>
        <td class="td">
            <label>Enable</label><span class="star">*</span><br>
            <select name="q_enable" class="ui-widget-content ui-corner-all" >
                <option value="<?php echo ENABLE ;?>" selected=""><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                <option value="<?php echo DISABLE ;?>"><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
            <br><br>
            <label>Maximum Expected Score</label><span class="star">*</span><br>
            <input type="text"  value="5" class="ui-widget-content ui-corner-all" name="q_max_score">
<!--            <select name="q_max_score" class="ui-widget-content ui-corner-all" >
            <?php foreach ($max_score as $k => $v) { ?>
                <option value="<?php echo $v["o_score"] ;?>" selected <?php //echo $cApp->IsSelected($v["c_id"], $id);?>><?php echo $v["o_score"] ;?></option>
            <?php } ?>
            </select>-->
        </td>
    </tr>    
</table>
<hr class="hr">
<input name="btnadd" class="" type="submit" value="Add New Question" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=questions";?>');" /> 

</form>
<br>