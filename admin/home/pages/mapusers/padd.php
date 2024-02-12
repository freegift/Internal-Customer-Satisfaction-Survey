<!DOCTYPE html>
<?php
$d_source_user = $cControllers->ListOne("users", "u_id", $id);
$d_source_user_dept = $cControllers->ListOne("departments", "d_id", $d_source_user[0]["u_dept_id"]);
$d_destination = $cControllers->ListNoneUsersMappedDepartments($id);              
?>
<form name="Add" action="" method="POST">
    <input type="hidden" value="add_users_mapping" name="form" />
    <input type="hidden" value="<?php echo $id;?>" name="id" />
<table id="add" class="form-table ui-widget-content ui-corner-all" >
    <tr class="tr">
        <td class="td">
            <label>Active User</label><span class="star">*</span><br>
            <select name="mud_user_id" class="ui-widget-content ui-corner-all" style="width: 300px;">
                <?php  
                //$grp = array();
                foreach ($d_source_user as $k => $v) { 
                    ?>
                    <option value="<?php echo $v["u_id"] ;?>" <?php echo $cApp->IsSelected($v["u_id"], $id);?>><?php echo $v["u_fullname"].' ('.$d_source_user_dept[0]["d_name"].') ' ;?></option>
                   <?php //} 
                }
                ?>
            </select>
            
            <?php if (!empty($d_destination)){?>
            <br><br><br><br><br><br>
            <input name="btnadd" class="" type="submit" value="Save New User Mapping" />
            <!--<input name="btncancel" class="" type="button" value="Cancel" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=mapping";?>');" />--> 
            <?php } ?>
        </td>
        <?php if (!empty($d_destination)){?>
        <td class="td">
            <label>Select Target Unit(s) / Department(s) you wish to map this user to</label><span class="star">*</span><br>
            <br>
            <div style=" width: 350px; height: 250px; overflow-y: scroll;">
                <?php  
                //$grp = array();
                foreach ($d_destination as $k => $v) { ?>
                    <input type="checkbox" class="item" name="mud_target_dept_id[<?php echo $v["d_id"];?>]" id="id" value="<?php echo $v["d_id"];?>" />&nbsp;&nbsp;
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
        <?php $g = $cControllers->ListUsersMappedDepartments($id); $i=0;
        foreach ($g as $k => $v) { $i++;
            $bg_row = ($i % 2 == 0)? "row" : "alternate";
        ?>
        <tr class="tr">
            <td class="td <?php echo $bg_row;?>"><?php echo $i;?></td>
            <td class="td <?php echo $bg_row;?>"><?php echo $v["d_name"];?></td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php //if ($cApp->HasPrivilege("P_USER_VIEW")) { ?>
                <input name="btnremove[<?php echo $v["mud_id"];?>]" class="" type="submit" value="Remove" />
            <!--<input name="btnedit" class="view" type="button" value="Remove" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=mapping&cmd=delete&id=".$v["m_id"];?>');" />-->
               <?php // } ?>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>
</form>