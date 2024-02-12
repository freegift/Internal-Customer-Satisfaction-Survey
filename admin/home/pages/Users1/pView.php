<?php $cApp->ShowInfo(); ?><!DOCTYPE html>
<?php
$record = $cUsers->ViewUser($cUsers->id);

if (!empty($record)){
    foreach ($record as $key => $value) {
     ?>     
<form name="Users" action="" method="POST">
    <input type="hidden" value="view" name="form" />
<table id="Users" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>User Name</label><span class="star"></span><br>
            <input name="username" class="ui-widget-content ui-corner-all" disabled type="text" value="<?php echo $value["l_user_name"];?>" />            
        </td>
        <td class="td">
            <label>User Full Name</label><span class="star"></span><br>
            <input name="fullname" class="ui-widget-content ui-corner-all" disabled type="text" value="<?php echo $value["l_full_name"];?>" />            
        </td>
        <td class="td">
            <label>User Email</label><span class="star"></span><br>
            <input name="email" class="ui-widget-content ui-corner-all" disabled type="text" value="<?php echo $value["l_email"];?>" />            
        </td>
    </tr>
    <tr class="tr">
        <td class="td">
            <label>Line Manager / Unit Head</label><span class="star"></span><br>
            <select name="line_manager" disabled class="ui-widget-content ui-corner-all" >
                  <option value="<?php echo ENABLE ;?>" <?php echo $cApp->IsSelected(ENABLE, $value["l_is_enable"]);?>><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                    <option value="<?php echo DISABLE ;?>" <?php echo $cApp->IsSelected(DISABLE, $value["l_is_enable"]);?>><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
           <input name="id" class="name" type="hidden" value="<?php echo $cUsers->id;?>" />
        </td>
    </tr>
    
</table>
<hr class="hr">
<?php // echo $cApp->HasPrivilege("P_USER_EDIT")? '<input name="btnedit" class="" type="button" value="Edit User" onclick="link_direct(\'' .BASE_DIR."users/Users.php?p=edit&amp;id=".$value["US_ID"]."&amp;#edit" . '\');" /> ':'';?>
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."WBlower/Users.php?p=listusers&amp;#list";?>');" /> 
</form>
<?php
    }
}

?>