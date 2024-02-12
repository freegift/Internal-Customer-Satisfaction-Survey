<?php
//$record = array();
$record = $cControllers->ListOne("categories", "c_id", $id);
if (!empty($record)){
    foreach ($record as $key => $value) {
     ?>     
<form name="edit" action="" method="POST">
    <input type="hidden" value="save_category" name="form" />
<table id="edit" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Category Name</label><span class="star">*</span><br>
            <input name="c_name" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["c_name"];?>" style="width: 400px;" />            
        </td>
        <td class="td">
            <label>Default Category</label><span class="star">*</span><br>
            <select name="c_default" class="ui-widget-content ui-corner-all" >
                <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["c_default"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["c_default"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
       
    </tr>
</table>
<hr class="hr"><input name="id" class="name" type="hidden" value="<?php echo $id;?>" />
<input name="btnsave" class="" type="submit" value="Save Default Survey Category" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=categories";?>');" /> 

</form><br>
<?php
    }
}
?>