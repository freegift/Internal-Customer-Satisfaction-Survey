<?php
$def_cat = $cControllers->DefaultSurveyCategory();
//$max_score = $cControllers->ListAll("options");
$record = $cControllers->ListOne("questions", "q_id", $id);
if (!empty($record)){
    foreach ($record as $key => $value) {
     ?>     
<form name="edit" action="" method="POST">
    <input type="hidden" value="save_question" name="form" />
<table id="edit" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Question Title</label><span class="star">*</span><br>
            <textarea name="q_name" class="ui-widget-content ui-corner-all" cols="50" rows="5"><?php echo $value["q_name"];?></textarea><br>
        </td>
        <td class="td">
            <label>Default Survey Category</label><span class="star">*</span><br>
            <select name="q_cat_id" class="ui-widget-content ui-corner-all" >
               <?php foreach ($def_cat as $k => $v) { ?>
                    <option value="<?php echo $v["c_id"] ;?>" <?php echo $cApp->IsSelected($v["c_id"], $id);?>><?php echo $v["c_name"] ;?></option>
                <?php } ?>
            </select>
            <br><br><a class="button" href="javascript:;" onclick="return link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=categories";?>');">Change Default Survey?</a>
        </td>
        <td class="td">
            <label>Enable</label><span class="star">*</span><br>
            <select name="q_enable" class="ui-widget-content ui-corner-all" >
                <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["q_enable"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["q_enable"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
            <label>Maximum Expected Score</label><span class="star">*</span><br>
            <br><br>
            <input type="text" value="<?php echo $value["q_max_score"] ;?>" class="ui-widget-content ui-corner-all" name="q_max_score">
<!--            <select name="q_max_score" class="ui-widget-content ui-corner-all" >
            <?php foreach ($max_score as $k => $v) { ?>
                    <option value="<?php echo $v["o_score"] ;?>" <?php echo $cApp->IsSelected($v["o_score"], $value["q_max_score"]);?>><?php echo $v["o_score"] ;?></option>
            <?php } ?>
            </select>-->
        </td>
    </tr>
</table>
<hr class="hr"><input name="id" class="name" type="hidden" value="<?php echo $id;?>" />
<input name="btnsave" class="" type="submit" value="Save Question" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=questions";?>');" /> 

</form><br>
<?php
    }
}
?>