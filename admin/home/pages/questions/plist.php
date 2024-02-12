
<form name="list" action="" method="POST">
    <input type="hidden" value="list_question" name="form" />
    <div id="controls">
        <?php
//        echo $cApp->HasPrivilege("P_USER_ADD")? '<input name="btnadd" class="add" type="button" value="Add New" onclick="link_direct(\'' .BASE_DIR. "users/Users.php?p=add&amp;#add" . '\');" /> ':'';
//        echo $cApp->HasPrivilege("P_USER_ENABLE")? '<input name="btnenable" class="enable" type="submit" value="Enable" /> ':'';
//        echo $cApp->HasPrivilege("P_USER_DISABLE")? '<input name="btndisable" class="disable" type="submit" value="Disable" /> ':'';
//        echo $cApp->HasPrivilege("P_USER_DELETE")? '<input name="btndelete" class="delete" type="submit" value="Delete" /> ':'';
       ?> 
        <!--<input name="btnreset" class="edit" type="submit" value="Reset" />-->
    </div>
<table id="list" class="list-table ui-widget-content ui-corner-all" >
    <thead>
        <tr class="tr ui-widget-header">
            <th class="th"><input type="checkbox" class="selectall" name="selectall" id="id" /></th>
            <th class="th">S/N</th>        
                <th class="th" style="min-width:300px;">QUESTIONS</th>
            <th class="th">DEFAULT SURVEY CATEGORY</th>
            <th class="th">MAXIMUM SCORE</th>
            <th class="th">ENABLE</th>
            <th class="th">OPTIONS</th>
        </tr>
    </thead>
    <tbody>
<?php
$record = $cControllers->ListDefaultQuestions();
//var_dump($record);
//die('ok');
if (!empty($record)){
    $i = 0;
    foreach ($record as $key => $value) {
    $i++;
    $bg_row = ($i % 2 == 0)? "row" : "alternate";
    $b = '';//($value["e_view"] < 1) ? 'bold' : '';
        ?>     
    
        <tr class="tr <?php echo $b;?>">
            <td class="td <?php echo $bg_row;?>"><input type="checkbox" class="item" name="id[<?php echo $value["q_id"];?>]" id="id" value="<?php echo $value["q_id"];?>" /></td>
            <td class="td <?php echo $bg_row;?>"><?php echo (int)$i;?></td>
            <td class="td <?php echo $bg_row;?>"><?php echo $value["q_name"];?></td>
            <td class="td <?php echo $bg_row;?>"><?php echo $value["c_name"];?></td>
            <td class="td <?php echo $bg_row;?> td-center"><?php echo $value["q_max_score"];?></td>
            <td class="td <?php echo $bg_row;?> td-center"><?php echo $cApp->EnableStatus($value["q_enable"]);?></td>
            <td class="td <?php echo $bg_row;?> td-action">
                <?php //if ($cApp->HasPrivilege("P_USER_VIEW")) { ?>    
                    <input name="btnedit" class="view" type="button" value="Edit" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=questions&id=".$value["q_id"];?>');" />
                <?php // } ?>
            </td>
            
        </tr>
    
<?php
    }
}
//else {
//    echo "Users List: No record found";
//}
?>
    </tbody>
</table>
<hr class="hr">
</form>
