<?php $cApp->ShowInfo(); ?><!DOCTYPE html>
<?php
//$record = array();
$record = $cUsers->ViewUser($cUsers->id);

if (!empty($record)){
    foreach ($record as $key => $value) {
     ?>     
<form name="Users" action="" method="POST">
    <input type="hidden" value="save" name="form" />
<table id="Users" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>User Name</label><span class="star">*</span><br>
            <input name="username" class="ui-widget-content ui-corner-all ui-widget-shadow" readonly="" type="text" value="<?php echo $value["l_user_name"];?>" />            
        </td>
        <td class="td">
            <label>User Full Name</label><span class="star">*</span><br>
            <input name="fullname" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["l_full_name"];?>" />            
        </td>
        <td class="td">
            <label>User Email</label><span class="star">*</span><br>
            <input name="email" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["l_email"];?>" />            
        </td>
        
    </tr>
    <tr class="tr">
        <td class="td">
            <label>Enable</label><span class="star">*</span><br>
            <select name="enable" class="ui-widget-content ui-corner-all" >
                  <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["l_is_enable"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                  <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["l_is_enable"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
            <label>Alert New Entry</label><span class="star">*</span><br>
            <select name="alert_new_entry" class="ui-widget-content ui-corner-all" >
                  <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["l_is_alert_new_entry"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                  <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["l_is_alert_new_entry"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
            <label>Special (Send to GMD alert)</label><span class="star">*</span><br>
            <select name="special" class="ui-widget-content ui-corner-all" >
                  <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["l_is_special"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                  <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["l_is_special"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
            <input name="id" class="name" type="hidden" value="<?php echo $cUsers->id;?>" />
        </td>
    </tr>
    
</table>
<hr class="hr">
<input name="btnsave" class="" type="submit" value="Save User" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."WBlower/Users.php?p=listusers&amp;id=&amp;#list";?>');" /> 

</form>
<?php
    }
}

?>