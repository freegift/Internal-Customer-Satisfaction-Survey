
<form name="list" action="" method="POST">
    <input type="hidden" value="list_map_questions" name="form" />
    
<table id="list" class="list-table ui-widget-content ui-corner-all" >
    <thead>
        <tr class="tr ui-widget-header">
            <th class="th"><input type="checkbox" class="selectall" name="selectall" id="id" /></th>
            <th class="th">S/N</th>        
            <th class="th" style=" width: 400px;">QUESTIONS</th>
            <th class="th" style=" width: 200px;">OPTIONS</th>
            <th class="th"></th>
        </tr>
    </thead>
    <tbody>
<?php
$record = $cControllers->ListAllQuestionsMappingRecords();
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
            <td class="td <?php echo $bg_row;?>">
            <?php
                foreach ($value["ext"] as $key_ext => $value_ext) {
                    echo "<strong>* ". $value_ext["o_name"].' - '.$value_ext["o_score"].' - '.$value_ext["o_percent"]."%</strong><hr class'hr'/>";
                }
            ?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                 <?php //if ($cApp->HasPrivilege("P_USER_VIEW")) { ?>    
                    <input name="btnedit" class="view" type="button" value="Edit" onclick="link_direct('<?php echo BASE_DIR."controllers/controllers.php?p=mapquestions&id=".$value["q_id"];?>#savemapquestions');" />
                <?php // } ?>
            </td>
            
        </tr>
    
<?php
    }
} else {
//    echo "Users List: No record found";
}
?>
    </tbody>
</table>
<hr class="hr">
</form>