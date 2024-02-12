<?php $record = $cReports->ReportsDepartments($_REQUEST);?>
<form name="Reports" action="" method="POST">
    <input type="hidden" value="reportbydepartments" name="form" />
    <div id="controls">
        <?php if($cReports->HasData()){ ?>
        <input name="btndownload" class="edit" type="button" value="Export to CSV" onclick="link_direct('<?php echo BASE_DIR."app/download.php?p=download&type=bydepartments";?>');" />
        <?php } ?>
        <hr class="hr"/>
    </div>
<table id="Users" class="list-table ui-widget-content ui-corner-all" >
    <thead>
        <tr class="tr ui-widget-header">
            <th class="th"><input type="checkbox" class="selectall" name="selectall" id="id" /></th>
            <th class="th">S/N</th>        
            <th class="th" style="min-width:100px;">DEPARTMENTS</th>
            <th class="th" style="min-width:100px;">APPRAISEE</th>
            <th class="th" style="min-width:100px;">GRAND TOTAL SUBMITTED SCORES</th>
            <th class="th" style="min-width:100px;">MAX EXPECTED SCORES</th>
            <th class="th">AVERAGE SCORE</th>
            <th class="th">PERCENT</th>
            <th class="th">REMARK</th>
            <th class="th">&nbsp;</th>
        </tr>
    </thead>
    <tbody>
<?php

//var_dump($record);
//die('ok');

if (!empty($record)){
    $i = 0;
    foreach ($record as $key => $value) {
    $i++;
    $bg_row = ($i % 2 == 0)? "row" : "alternate";
//    $b = ($value["e_view"] < 1) ? 'bold' : '';
        ?>     
    
        <tr class="tr <?php // echo $b;?>">
            <td class="td <?php echo $bg_row;?>"><input type="checkbox" class="item" name="id[<?php echo $value["d_id"];?>]" id="id" value="<?php echo $value["d_id"];?>" /></td>
            <td class="td <?php echo $bg_row;?>"><?php echo (int)$i;?></td>
            <td class="td <?php echo $bg_row;?>">
                <?php echo $value["d_name"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["q_tot_users"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["d_tot_scores"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["d_max_scores"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["d_avg_scores"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["d_percent"];?>%
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <strong><?php echo $value["d_remark"];?></strong>
            </td>
            <td class="td <?php echo $bg_row;?> td-action">
                <?php //if ($cApp->HasPrivilege("P_USER_VIEW")) { ?>    
                    <!--<input name="btnview" class="view" type="button" value="View" onclick="link_direct('<?php echo BASE_DIR."controllers/reports.php?p=viewentry&amp;id=".$value["e_id"];?>&amp;#view');" />-->
                <?php // } ?>
            </td>
            
        </tr>
    
<?php
    }
}
?>
    </tbody>
</table>
<hr class="hr">
</form>