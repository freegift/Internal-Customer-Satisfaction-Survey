<?php $cApp->ShowInfo(); ?><!DOCTYPE html>
<?php
$record = $cUsers->ViewUser($cUsers->id);

if (!empty($record)){
    foreach ($record as $key => $value) {
//        $dept = $cUsers->UserListDepartments("",$value["US_DEPT_ID"]);
//        
//        $role = $cUsers->UserListRoles("",$value["US_ROLE_ID"]);
//        $role[0]["ROLE_NAME"] = isset($role[0]["ROLE_NAME"])? $role[0]["ROLE_NAME"]:'';
     ?>     
<form name="Users" action="" method="POST">
    <input type="hidden" value="view" name="form" />
<table id="Users" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>User Name</label><span class="star"></span><br>
            <input name="username" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["l_user_name"];?>" />            
        </td>
        <td class="td">
            <label>User Full Name</label><span class="star"></span><br>
            <input name="fullname" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["l_full_name"];?>" />            
        </td>
        <td class="td">
            <label>User Email</label><span class="star"></span><br>
            <input name="email" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["l_email"];?>" />            
        </td>
    </tr>
    <tr class="tr">
        <td class="td">
            <label>Department</label><span class="star"></span><br>
            <input name="department" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $dept[0]["DEPT_NAME"];?>" />
        </td>
        <td class="td">
            <label>Role</label><span class="star"></span><br>
            <input name="role" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $role[0]["ROLE_NAME"];?>" />            
        </td>
        <td class="td">
           <input name="id" class="name" type="hidden" value="<?php echo $cUsers->id;?>" />
        </td>
    </tr>
    <tr class="tr">
        <td class="td">
            <label>Date Created</label><span class="star"></span><br>
            <input name="date_created" class="ui-widget-content ui-corner-all"  type="text" value="<?php echo $value["US_DATE_CREATED"] .' '. $value["US_TIME_CREATED"];?>" />            
        </td>
        <td class="td">
            <label>Last Login Date</label><span class="star"></span><br>
            <input name="login_date" class="ui-widget-content ui-corner-all"  type="text" value="<?php echo $value["US_LAST_LOGIN_DATE"] .' '.$value["US_LAST_LOGIN_TIME"];?>" />            
        </td>
        <td class="td">
            <label>Last Password Change Date</label><span class="star"></span><br>
            <input name="pass_change_date" class="ui-widget-content ui-corner-all" type="text" value="<?php echo $value["US_PASSWORD_LAST_CHANGE"];?>" />            
        </td>
    </tr>
</table>
<hr class="hr">
</form>
<?php
    }
}
?>