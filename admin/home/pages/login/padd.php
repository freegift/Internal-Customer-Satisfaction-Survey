<!DOCTYPE html>
<form name="Add" action="" method="POST">
    <input type="hidden" value="add_login" name="form" />
<table id="add" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Admin User Name</label><span class="star">*</span><br>
            <input name="l_username" class="ui-widget-content ui-corner-all" type="text" />
        </td>
        <td class="td">
            <label>User Full Name</label><span class="star">*</span><br>
            <input name="l_fullname" class="ui-widget-content ui-corner-all" type="text" />
        </td>
        <td class="td">
            <label>Email</label><span class="star">*</span><br>
            <input name="l_email" class="ui-widget-content ui-corner-all" type="text" />
        </td>
        
    </tr>
    <tr class="tr">
        <td class="td">
            <label>Enabled</label><span class="star">*</span><br>
            <select name="l_enable" class="ui-widget-content ui-corner-all" >
                <option value="<?php echo ENABLE ;?>" selected=""><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                <option value="<?php echo DISABLE ;?>"><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
<!--            <label>Visibility</label><span class="star">*</span><br>
            <select name="l_visibility" class="ui-widget-content ui-corner-all" >
                   <option value="<?php echo ENABLE ;?>"><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                    <option value="<?php echo DISABLE ;?>"><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>-->
        </td>
        <td class="td">
<!--            <label>Special (send to GMD alert)</label><span class="star">*</span><br>
            <select name="special" class="ui-widget-content ui-corner-all" >
                   <option value="<?php echo ENABLE ;?>"><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                    <option value="<?php echo DISABLE ;?>"><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>-->
        </td>
    </tr>
</table>
<hr class="hr">
<input name="btnadd" class="" type="submit" value="Add Admin Login" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=login";?>');" /> 
&nbsp;&nbsp;&nbsp;&nbsp;Default Password Reset Code: <strong><?php echo $cControllers->ResetPasswordCode() ;?></strong>
</form>
<br>