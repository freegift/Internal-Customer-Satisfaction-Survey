<?php
//$record = array();
$record = $cControllers->ListOne("login", "l_id", $id);
if (!empty($record)){
    foreach ($record as $key => $value) {
     ?>     
<form name="edit" action="" method="POST">
    <input type="hidden" value="save_login" name="form" />
<table id="Users" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Admin User Name</label><span class="star">*</span><br>
            <input name="l_username" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["l_username"];?>" />            
        </td>
        <td class="td">
            <label>User Full Name</label><span class="star">*</span><br>
            <input name="l_fullname" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["l_fullname"];?>" />            
        </td>
        <td class="td">
            <label>User Email</label><span class="star">*</span><br>
            <input name="l_email" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["l_email"];?>" />            
        </td>
    </tr>
    <tr class="tr">
        <td class="td">
            <label>Enable</label><span class="star">*</span><br>
            <select name="l_enable" class="ui-widget-content ui-corner-all" >
                  <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["l_enable"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                  <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["l_enable"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
<!--            <label>Visibility</label><span class="star">*</span><br>
            <select name="l_visibility" class="ui-widget-content ui-corner-all" >
                  <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["l_visibility"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                  <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["l_visibility"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>-->
        </td>
        <td class="td">
<!--            <label>Special (Send to GMD alert)</label><span class="star">*</span><br>
            <select name="special" class="ui-widget-content ui-corner-all" >
                  <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["l_is_special"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                  <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["l_is_special"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>-->
        </td>
    </tr>
</table>
<hr class="hr"><input name="id" class="name" type="hidden" value="<?php echo $id;?>" />
<input name="btnsave" class="" type="submit" value="Save Admin Login" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=login";?>');" /> 
&nbsp;&nbsp;&nbsp;&nbsp;Default Password Reset Code: <strong><?php echo $cControllers->ResetPasswordCode() ;?></strong>
</form><br>
<?php
    }
}
?>