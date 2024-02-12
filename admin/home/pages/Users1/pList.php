<?php $cApp->ShowInfo(); ?><!DOCTYPE html>
<form name="Users" action="" method="POST">
    
    <input type="hidden" value="list" name="form" />
    <div id="controls">
        <?php
        echo '<input name="btnadd" class="add" type="button" value="Add New User" onclick="link_direct(\'' .BASE_DIR. "WBlower/Users.php?p=add&amp;#add" . '\');" /> ';
//        echo $cApp->HasPrivilege("P_USER_ENABLE")? '<input name="btnenable" class="enable" type="submit" value="Enable" /> ':'';
//        echo $cApp->HasPrivilege("P_USER_DISABLE")? '<input name="btndisable" class="disable" type="submit" value="Disable" /> ':'';
//        echo $cApp->HasPrivilege("P_USER_DELETE")? '<input name="btndelete" class="delete" type="submit" value="Delete" /> ':'';
       ?> 
        <input name="btnreset" class="edit" type="submit" value="Reset Password" />
        &nbsp;&nbsp;Default Password: <strong><?php echo $cUsers->ResetPasswordCode(); ?></strong>
    </div><br>
<table id="Users" class="list-table ui-widget-content ui-corner-all" >
    <thead>
        <tr class="tr ui-widget-header">
            <th class="th"><input type="checkbox" class="selectall" name="selectall" id="id" /></th>
            <th class="th">S/N</th>        
            <th class="th">USERNAME</th>
            <th class="th">FULL NAME</th>
            <th class="th">EMAIL</th>
            <th class="th">LOGIN DATE</th>
            <th class="th">LOGIN TIME</th>
            <th class="th">ALERT LOGIN</th>
            <th class="th">ALERT NEW ENTRY</th>
            <th class="th">SPECIAL(Send to GMD)</th>
            <th class="th">ENABLE</th>
            <th class="th">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php
$record = $cUsers->ListUsers();

if (!empty($record)){
    $i = 0;
    foreach ($record as $key => $value) {
    $i++;
    $bg_row = ($i % 2 == 0)? "row" : "alternate"
        ?>     
    
        <tr class="tr">
            <td class="td <?php echo $bg_row;?>"><input type="checkbox" class="item" name="id[<?php echo $value["l_id"];?>]" id="id" value="<?php echo $value["l_id"];?>" /></td>
            <td class="td <?php echo $bg_row;?>"><?php echo (int)$i;?></td>
            <td class="td <?php echo $bg_row;?>"><?php echo $value["l_user_name"];?></td>
            <td class="td <?php echo $bg_row;?>"><?php echo $value["l_full_name"];?></td>
            <td class="td <?php echo $bg_row;?>"><?php echo $value["l_email"];?></td>
            <td class="td <?php echo $bg_row;?>"><?php echo $value["l_last_login_date"];?></td>
            <td class="td <?php echo $bg_row;?>"><?php echo $value["l_last_login_time"];?></td>
            <td class="td <?php echo $bg_row;?> td-center"><?php echo $cApp->EnableStatus($value["l_is_alert_login"]);?></td>
            <td class="td <?php echo $bg_row;?> td-center"><?php echo $cApp->EnableStatus($value["l_is_alert_new_entry"]);?></td>
            <td class="td <?php echo $bg_row;?> td-center"><?php echo $cApp->EnableStatus($value["l_is_special"]);?></td>
            <td class="td <?php echo $bg_row;?> td-center"><?php echo $cApp->EnableStatus($value["l_is_enable"]);?></td>
            <td class="td <?php echo $bg_row;?> td-action">
                <?php //if ($cApp->HasPrivilege("P_USER_VIEW")) { ?>    
                    <input name="btnview" class="view" type="button" value="View" onclick="link_direct('<?php echo BASE_DIR."WBlower/Users.php?p=view&amp;id=".$value["l_id"];?>&amp;#view');" />
                <?php // } ?>
                    <?php // if ($cApp->HasPrivilege("P_USER_EDIT")) { ?>
                <input name="btnedit" class="edit" type="button" value="Edit" onclick="link_direct('<?php echo BASE_DIR."WBlower/Users.php?p=edit&amp;id=".$value["l_id"];?>&amp;#edit');" />
                <!--<input name="btndownload" class="edit" type="button" value="Download" onclick="link_direct('<?php echo BASE_DIR."app/download.php?p=assignrole&amp;id=".$value["l_id"];?>&amp;#assign');" />-->
                <?php // } ?>
                
            </td>
            
        </tr>
    
<?php
    }
} else {
    echo "Users List: No record found";
}
?>
    </tbody>
</table>
<hr class="hr">
</form>
<?php
/*if ($_POST["btndownload"]):
    $file = 'monkey.gif';

//    if (file_exists($file)) {
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        ob_clean();
        flush();
        readfile($file);
        exit;
//    }
endif;*/
?>