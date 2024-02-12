<?php $cApp->ShowInfo(); ?><!DOCTYPE html>
<?php
$record = array();
$record = $cUsers->ViewUser($cUsers->id);

if (!empty($record)){
    foreach ($record as $key => $value) {
     ?>     
<form name="Users" action="" method="POST" enctype="multipart/form-data" >
    <input type="hidden" value="changepassword" name="form" />
<table id="Users" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Enter Old Password</label><span class="star">*</span><br>
            <input name="old_pass" class="ui-widget-content ui-corner-all" type="password" value="" />            
        </td>
        <td class="td">&nbsp;</td>
        <td class="td">&nbsp;</td>
    </tr>
    <tr class="tr">
        <td class="td">
            <label>New Password</label><span class="star">*</span><br>
            <input name="new_pass" class="ui-widget-content ui-corner-all" type="password" value="" />            
        </td>
        <td class="td">
            <label>Confirm New Password</label><span class="star">*</span><br>
            <input name="confirm_new_pass" class="ui-widget-content ui-corner-all" type="password" value="" />            
        </td>
        <td class="td">
            <input name="id" class="name" type="hidden" value="<?php echo $cUsers->id;?>" />
        </td>
    </tr>
    
</table>
<hr class="hr">
<input name="btnchangepassword" class="" type="submit" value="Change Password" /> 
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."WBlower/Users.php?p=viewentries&amp;id=".$cUsers->id."&amp;#profile";?>');" /> 

</form>
<?php
    }
}

?>