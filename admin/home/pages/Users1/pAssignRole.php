<?php $cApp->ShowInfo(); ?><!DOCTYPE html>
<?php
//$record = array();
$record = $cUsers->ViewUser($cUsers->id);

if (!empty($record)){
    foreach ($record as $key => $value) {
     ?>     
<form name="Users" action="" method="POST">
    <input type="hidden" value="assignrole" name="form" />
<table id="Users" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Assign New Role to <strong>[ <?php echo $value["US_FULLNAME"];?> ]</strong></label><span class="star"></span> : 
            <select name="role" class="ui-widget-content ui-corner-all" >
                <?php  
                $r = array();
                $r = $cUsers->UserListRoles();
                foreach ($r as $k => $v) { ?>
                    <option value="<?php echo $v["ROLE_ID"] ;?>" <?php echo $cApp->IsSelected($v["ROLE_ID"], $value["US_ROLE_ID"]);?>><?php echo $v["ROLE_ID"] .' - '.$v["ROLE_NAME"] ;?></option>
               <?php } ?>
            </select>
        </td>
        <td class="td">
            <input name="id" class="name" type="hidden" value="<?php echo $cUsers->id;?>" />
        </td>
    </tr>
    
</table>
<hr class="hr">
<?php echo $cApp->HasPrivilege("P_USER_ASSIGN")? '<input name="btnassignrole" class="" type="submit" value="Assign Role" />':'';?> 
</form>
<?php
    }
}

?>