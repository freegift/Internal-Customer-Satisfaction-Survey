<!DOCTYPE html>
<?php
$d_source = $cControllers->ListOne("departments", "d_id", $id);
$d_destination = $cControllers->ListNoneMappedDepartments($id);              
?>
<form name="Add" action="" method="POST">
    <input type="hidden" value="add_mapping" name="form" />
    <input type="hidden" value="<?php echo $id;?>" name="id" />
<table id="add" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Source Department</label><span class="star">*</span><br>
            <select name="m_dept_id_source" class="ui-widget-content ui-corner-all" style="width: 300px;">
                <?php  
                //$grp = array();
                foreach ($d_source as $k => $v) { 
                    ?>
                    <option value="<?php echo $v["d_id"] ;?>" <?php echo $cApp->IsSelected($v["d_id"], $id);?>><?php echo $v["d_name"] ;?></option>
                   <?php //} 
                }
                ?>
            </select>
            
            <?php if (!empty($d_destination)){?>
            <br><br><br><br><br><br>
            <input name="btnadd" class="" type="submit" value="Save New Unit Mapping" />
            <!--<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=mapping";?>');" />--> 
            <?php } ?>
        </td>
        <?php if (!empty($d_destination)){?>
        <td class="td">
            <label>Select Target Department for mapping users</label><span class="star">*</span><br>
            <br>
            <div style=" width: 350px; height: 250px; overflow-y: scroll;">
                <?php  
                //$grp = array();
                foreach ($d_destination as $k => $v) { ?>
                    <input type="checkbox" class="item" name="m_dept_id_destination[<?php echo $v["d_id"];?>]" id="id" value="<?php echo $v["d_id"];?>" />&nbsp;&nbsp;
                    <?php echo $v["d_name"] ;?><hr class="hr">
                <?php } ?>
            </div>
        </td>
        <?php } ?>
    </tr>
</table>
<hr class="hr">

<br>
<table id="list" class="list-table ui-widget-content ui-corner-all" >
    <thead>
        <tr class="tr ui-widget-header">
            <th class="th">S/NO</th>
            <th class="th" style=" width: 380px;">MAPPED UNITS / DEPARTMENTS</th>
            <th class="th">OPTIONS</th>
        </tr>
    </thead>
    <tbody>
        <?php $g = $cControllers->ListMappedDepartments($id); $i=0;
        foreach ($g as $k => $v) { $i++;
            $bg_row = ($i % 2 == 0)? "row" : "alternate";
        ?>
        <tr class="tr">
            <td class="td <?php echo $bg_row;?>"><?php echo $i;?></td>
            <td class="td <?php echo $bg_row;?>"><?php echo $v["d_name"];?></td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php //if ($cApp->HasPrivilege("P_USER_VIEW")) { ?>
                <input name="btnremove[<?php echo $v["m_id"];?>]" class="" type="submit" value="Remove" />
            <!--<input name="btnedit" class="view" type="button" value="Remove" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=mapping&cmd=delete&id=".$v["m_id"];?>');" />-->
               <?php // } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</form>