<?php $record = $cReports->ReportsUsers($_REQUEST);?>
<form name="Reports" action="" method="POST">
    <input type="hidden" value="recententries" name="form" />
    <div id="controls">
        <?php if($cReports->HasData()){ ?>
        <input name="btndownload" class="edit" type="button" value="Export to CSV" onclick="link_direct('<?php echo BASE_DIR."app/download.php?p=download&type=byusers";?>');" />
        <?php } ?>
        <hr class="hr"/>
    </div>
<table id="Users" class="list-table ui-widget-content ui-corner-all" >
    <thead>
        <tr class="tr ui-widget-header">
            <th class="th"><input type="checkbox" class="selectall" name="selectall" id="id" /></th>
            <th class="th">S/N</th>        
            <th class="th" style="min-width:150px;">USERS / CUSTOMERS</th>
            <!--<th class="th" style="">EMAIL</th>-->
            <th class="th" style="">DEPARTMENTS</th>
            <th class="th" style="">#ASSIGNED DEPT.</th>
            <th class="th" style="">#SUBMITTED DEPT.</th>
            <th class="th" style="">#PENDING DEPT.</th>
            <th class="th" style="">SUBMITTED QUESTIONS</th>
            <th class="th" style="">EXPECTED QUESTIONS</th>
            <th class="th" style="min-width:60px;">TIME</th>
            <th class="th" style="min-width:80px;">STATUS</th>
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
            <td class="td <?php echo $bg_row;?>"><input type="checkbox" class="item" name="id[<?php echo $value["u_id"];?>]" id="id" value="<?php echo $value["u_id"];?>" /></td>
            <td class="td <?php echo $bg_row;?>"><?php echo (int)$i;?></td>
            <td class="td <?php echo $bg_row;?>">
                <?php echo $value["u_fullname"];?>
            </td>
<!--            <td class="td <?php // echo $bg_row;?>">
                <?php // echo $value["u_email"];?>
            </td>-->
            <td class="td <?php echo $bg_row;?>">
                <?php echo $value["d_name"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["u_tot_depts"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["u_tot_submitted_depts"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["u_tot_unsubmitted_depts"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["u_tot_ques"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["u_max_ques"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["u_last_login_date"];?> <?php echo $value["u_last_login_time"];?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <strong><?php echo $value["u_status"];?></strong>
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