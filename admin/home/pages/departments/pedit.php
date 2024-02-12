<?php
//$record = array();
$record = $cControllers->ListOne("departments", "d_id", $id);
if (!empty($record)){
    foreach ($record as $key => $value) {
     ?>     
<form name="edit" action="" method="POST">
    <input type="hidden" value="save_department" name="form" />
<table id="edit" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Department Name</label><span class="star">*</span><br>
            <input name="d_name" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["d_name"];?>" style="width: 300px;" />            
        </td>
        <td class="td">
            <label>Enable</label><span class="star">*</span><br>
            <select name="d_enable" class="ui-widget-content ui-corner-all" >
                <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["d_enable"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["d_enable"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
       
    </tr>
</table>
<hr class="hr"><input name="id" class="name" type="hidden" value="<?php echo $id;?>" />
<input name="btnsave" class="" type="submit" value="Save Department" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=departments";?>');" /> 

</form><br>
<?php
    }
}
?>