<?php $cApp->ShowInfo(); ?><!DOCTYPE html>
<form name="Users" action="" method="POST">
    <input type="hidden" value="add" name="form" />
<table id="Users" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>User Name</label><span class="star">*</span><br>
            <input name="username" class="ui-widget-content ui-corner-all" type="text" />
        </td>
        <td class="td">
            <label>User Full Name</label><span class="star">*</span><br>
            <input name="fullname" class="ui-widget-content ui-corner-all" type="text" />
        </td>
        <td class="td">
            <label>Email</label><span class="star">*</span><br>
            <input name="email" class="ui-widget-content ui-corner-all" type="text" />
        </td>
        
    </tr>
    <tr class="tr">
        <td class="td">
            <label>Enabled</label><span class="star">*</span><br>
            <select name="enable" class="ui-widget-content ui-corner-all" >
                   <option value="<?php echo ENABLE ;?>"><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                    <option value="<?php echo DISABLE ;?>"><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
            <label>Alert New Entry</label><span class="star">*</span><br>
            <select name="alert_new_entry" class="ui-widget-content ui-corner-all" >
                   <option value="<?php echo ENABLE ;?>"><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                    <option value="<?php echo DISABLE ;?>"><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
            <label>Special (send to GMD alert)</label><span class="star">*</span><br>
            <select name="special" class="ui-widget-content ui-corner-all" >
                   <option value="<?php echo ENABLE ;?>"><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                    <option value="<?php echo DISABLE ;?>"><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
    </tr>
    
</table>
<hr class="hr">
<input name="btnadd" class="" type="submit" value="Save New User" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."WBlower/Users.php?p=listusers&amp;#list";?>');" /> 

</form>
<br><br>
<!--<p><h3>Upload Users from file (.csv) only</h3><hr class="hr"><p>
<form name="Users" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" value="upload" name="form" />
    Select file : <input type="file" class="ui-widget-content ui-corner-all" name="filename" > &nbsp;&nbsp;&nbsp;
    <?php echo $cApp->HasPrivilege("P_USER_ADD")? '<input name="btnupload" class="" type="submit" value="Upload Users" />':'';?><br>
    <br>Please <strong>do not alter</strong> the headers from the upload file. <br>
    Upload format <strong>[ FullName, Email, LineManager, Department Id ]</strong>. For line manager column either Y or N. <a class="button" href="<?php echo BASE_DIR ."web/users.csv" ;?>"> Download format here</a>
</form>-->