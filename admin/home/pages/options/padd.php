<!DOCTYPE html>
<form name="Add" action="" method="POST">
    <input type="hidden" value="add_option" name="form" />
<table id="add" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td" >
            <label>Enter Option Name</label><span class="star">*</span> <br>
            [ E.g. Poor, Average, Good, Very Good, Excellent ]<br>
            <textarea name="o_name" class="ui-widget-content ui-corner-all" cols="40" rows="3"></textarea><br>
        </td>
        <td class="td">
            <label>Score / Weight / Point</label><span class="star">*</span> <br>
            [ E.g. 1, 2, 3, 4, 5 ]<br>
            <input name="o_score" class="ui-widget-content ui-corner-all td-center" type="text" />
        </td>
        <td class="td">
            <label>Value in percentage (%)</label><span class="star">*</span> <br>
            [ E.g. 20, 40, 60, 80, 100 ]<br>
            <input name="o_percent" class="ui-widget-content ui-corner-all td-center" type="text" />
            <br>
            <label>Enable</label><span class="star">*</span><br>
            <select name="o_enable" class="ui-widget-content ui-corner-all" >
                <option value="<?php echo ENABLE ;?>" selected=""><?php echo $cApp->EnableStatus(ENABLE) ;?></option>
                <option value="<?php echo DISABLE ;?>"><?php echo $cApp->EnableStatus(DISABLE) ;?></option>
            </select>
        </td>
        <td class="td">
            
        </td>
    </tr>    
</table>
<hr class="hr">
<input name="btnadd" class="" type="submit" value="Add New Option" />
<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=options";?>');" /> 

</form>
<br>