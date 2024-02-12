<!DOCTYPE html>
<form name="Add" action="" method="POST">
    <input type="hidden" value="add_category" name="form" />
<table id="add" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Category Name</label><span class="star">*</span><br>
            <input name="c_name" class="ui-widget-content ui-corner-all" type="text" style="width: 400px;" />
        </td>
        <td class="td">
            <label>Default Category</label><span class="star">*</span><br>
            <select name="c_default" class="ui-widget-content ui-corner-all" >
                <option value="<?php echo ENABLE ;?>"><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                <option value="<?php echo DISABLE ;?>" selected=""><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
    </tr>    
</table>
<hr class="hr">
<input name="btnadd" class="" type="submit" value="Add Default Survey Category" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=categories";?>');" /> 

</form>
<br>
<!--<p><h3>Upload Users from file (.csv) only</h3><hr class="hr"><p>
<form name="Users" action="" method="POST" enctype="multipart/form-data">
    <input type="hidden" value="upload" name="form" />
    Select file : <input type="file" class="ui-widget-content ui-corner-all" name="filename" > &nbsp;&nbsp;&nbsp;
    <?php echo $cApp->HasPrivilege("P_USER_ADD")? '<input name="btnupload" class="" type="submit" value="Upload Users" />':'';?><br>
    <br>Please <strong>do not alter</strong> the headers from the upload file. <br>
    Upload format <strong>[ FullName, Email, LineManager, Department Id ]</strong>. For line manager column either Y or N. <a class="button" href="<?php echo BASE_DIR ."web/users.csv" ;?>"> Download format here</a>
</form>-->