<?php 
$departments_t = (isset($_POST["departments_t"]))? $_POST["departments_t"]:'';
$record = $cReports->ReportsSuggestions($departments_t);
?>
<form name="Reports" action="" method="POST">
    <input type="hidden" value="suggestions" name="form" />
    <div id="controls">
        <label>Select Target Unit/Dept</label>&nbsp;&nbsp;
        <select name="departments_t" class="ui-widget-content ui-corner-all">
            <option value="">---Select All---</option>
        <?php
            $p_d_t = $cReports->ListAll("departments","d_c_id",$_SESSION['DEFAULT']['c_id'],"d_name");//("departments");
            foreach ($p_d_t as $key => $value) {
                echo "<option value='".$value["d_id"]."' ". $cApp->IsSelected($departments_t, $value["d_id"])." >".$value["d_name"]."</option>";
            }
        ?>
        </select>&nbsp;&nbsp;
        <input name="btnsearch" class="" type="submit" value="Run Search" />
        &nbsp;&nbsp;&nbsp;&nbsp;Total Submitted Suggestions : ( <strong><?php echo $cReports->TotalDefaultSuggestions($_SESSION["DEFAULT"]["c_id"]) ;?></strong> )
        &nbsp;&nbsp;&nbsp;&nbsp;Total Search Result Suggestions : ( <strong><?php echo count($record) ;?></strong> )
        
        <?php if($cReports->HasData()){ ?>
        &nbsp;&nbsp;&nbsp;&nbsp;<input name="btndownload" class="edit" type="button" value="Export to CSV" onclick="link_direct('<?php echo BASE_DIR."app/download.php?p=download&type=suggestions";?>');" />
        <?php } ?>
        <hr class="hr"/>
    </div>
<table id="Users" class="list-table ui-widget-content ui-corner-all" >
    <thead>
        <tr class="tr ui-widget-header">
            <th class="th"><input type="checkbox" class="selectall" name="selectall" id="id" /></th>
            <th class="th">S/N</th>        
            <th class="th" style="min-width:150px;">SENT BY</th>
            <th class="th" style="min-width:150px;">TARGET UNITS / DEPARTMENTS</th>
            <th class="th" style="min-width:300px;">What do you like most about us?</th>
            <th class="th" style="min-width:300px;">What would you like us to do better?</th>
            <th class="th" style="min-width:60px;">TIME</th>
            <th class="th">&nbsp;</th>
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
            <td class="td <?php echo $bg_row;?>"><input type="checkbox" class="item" name="id[<?php echo $value["s_id"];?>]" id="id" value="<?php echo $value["s_id"];?>" /></td>
            <td class="td <?php echo $bg_row;?>"><?php echo (int)$i;?></td>
            <td class="td <?php echo $bg_row;?>">
                <?php echo $value["u_fullname"];?>
            </td>
            <td class="td <?php echo $bg_row;?>">
                <?php echo $value["d_name"];?>
            </td>
            <td class="td <?php echo $bg_row;?>">
                <?php echo nl2br( $value["s_suggestion"] );?>
            </td>
            <td class="td <?php echo $bg_row;?>">
                <?php echo nl2br( $value["s_suggestion2"] );?>
            </td>
            <td class="td <?php echo $bg_row;?> td-center">
                <?php echo $value["s_date"];?> <?php echo $value["s_time"];?>
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