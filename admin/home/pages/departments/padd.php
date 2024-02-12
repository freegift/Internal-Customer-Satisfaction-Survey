<!DOCTYPE html>
<form name="Add" action="" method="POST">
    <input type="hidden" value="add_department" name="form" />
<table id="add" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Department Name</label><span class="star">*</span><br>
            <input name="d_name" class="ui-widget-content ui-corner-all" type="text" style="width: 300px;" />
        </td>
        <td class="td">
            <label>Enable</label><span class="star">*</span><br>
            <select name="d_enable" class="ui-widget-content ui-corner-all" >
                <option value="<?php echo ENABLE ;?>" selected=""><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                <option value="<?php echo DISABLE ;?>"><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
    </tr>    
</table>
<hr class="hr">
<input name="btnadd" class="" type="submit" value="Add Department" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=departments";?>');" /> 

</form>
<br>