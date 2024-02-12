<?php
$def_cat = $cControllers->DefaultSurveyCategory();
$record = $cControllers->ListOne("options", "o_id", $id);
if (!empty($record)){
    foreach ($record as $key => $value) {
     ?>     
<form name="edit" action="" method="POST">
    <input type="hidden" value="save_option" name="form" />
<table id="edit" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Option Name</label><span class="star">*</span><br>
            <textarea name="o_name" class="ui-widget-content ui-corner-all" cols="40" rows="3"><?php echo $value["o_name"];?></textarea><br>
        </td>
        <td class="td">
            <label>Score / Weight / Point</label><span class="star">*</span><br>
            <input name="o_score" class="ui-widget-content ui-corner-all td-center" value="<?php echo $value["o_score"];?>" type="text" />
        </td>
        <td class="td">
            <label>Percent</label><span class="star">*</span><br>
            <input name="o_percent" class="ui-widget-content ui-corner-all td-center" value="<?php echo $value["o_percent"];?>" type="text" />
            <br>
            <label>Enable</label><span class="star">*</span><br>
            <select name="o_enable" class="ui-widget-content ui-corner-all" >
                <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["o_enable"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["o_enable"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
            
        </td>
    </tr>
</table>
<hr class="hr"><input name="id" class="name" type="hidden" value="<?php echo $id;?>" />
<input name="btnsave" class="" type="submit" value="Save Option" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=options";?>');" /> 

</form><br>
<?php
    }
}
?>