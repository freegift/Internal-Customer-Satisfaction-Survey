<?php $record = $cReports->ComprehensiveAppraisals($_REQUEST);?>
<form name="Reports" action="" method="POST">
    <input type="hidden" value="reportbydepartments" name="form" />
    <div id="controls">
        <input name="btndownload" class="edit" type="button" value="Export to CSV" onclick="link_direct('<?php echo BASE_DIR."app/download.php?p=download&type=comprehensive";?>');" />
    </div>
    <hr class="hr" />
<table id="Users" class="list-table ui-widget-content ui-corner-all" >
    <thead>
        <tr class="tr ui-widget-header">
            <th class="th"><input type="checkbox" class="selectall" name="selectall" id="id" /></th>
            <th class="th">S/N</th>        
            <th class="th">USERS</th>
            <th class="th">APPRAISAL UNIT(S)</th>
            <th class="th">GRAND TOT. SCORES</th>
            <th class="th">MAX. EXPECTED SCORE</th>
            <th class="th">ACCUMULATIVE PERCENT</th>
            <th class="th">PERCENTAGE</th>
            <th class="th">REMARK</th>
        </tr>
    </thead>
    <tbody>
<?php


if (!empty($record)){
    $i = 0;
    foreach ($record as $key => $value) {
    $i++;
    $bg_row = ($i % 2 == 0)? "row" : "alternate";
//    $b = ($value["e_view"] < 1) ? 'bold' : '';
        ?>     
    
        <tr class="tr <?php // echo $b;?>">
            <td class="td <?php echo $bg_row;?>"><input type="checkbox" class="item" name="id[<?php echo $value["u_id"];?>]" id="id" value="<?php echo $value["u_id"];?>" /></td>
            <td class="td <?php echo $bg_row;?>"><?php echo (int)$i;?></td>
            <td class="td <?php echo $bg_row;?>">
                <?php echo "<strong>". $value["u_fullname"] ." </strong><br>(".$value["d_name"].")";?>
            </td>
            <td class="td <?php echo $bg_row;?>">
                <?php echo isset($value["target_dept_name"])? nl2br( $value["target_dept_name"]):'';?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo isset($value["target_total_scores"])? $value["target_total_scores"]:'0';?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo isset($value["target_total_max_scores"])?$value["target_total_max_scores"]:'0';?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo isset($value["target_total_percent"])?$value["target_total_percent"]:'0';?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <strong><?php echo isset($value["target_total_final_percent"])?$value["target_total_final_percent"]:'0';?>%</strong>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <strong><?php echo isset($value["target_remark"])?$value["target_remark"]:'';?></strong>
            </td>
        </tr>
    
<?php
    }
}
?>
    </tbody>
</table>
    <?php // ob_start();
//    $buffer = ob_get_flush();
//    $_SESSION["records"] = $buffer;
//    file_put_contents('..\buffer.txt', $buffer);
//    ob_end_flush();
//    var_dump($_SESSION["records"]);
    ?>
<hr class="hr">
</form>
