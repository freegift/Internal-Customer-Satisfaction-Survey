<?php
//$record = $cReports->GetAuditLog();
$record = $cConnect->Select("SELECT * FROM audit_log ORDER BY 1 DESC");
//var_dump($record);
if (!empty($record)){
?>    <table id="Items" class='list-table ui-widget-content ui-corner-all'>
    <tr class="tr ui-widget-header"><td class="th">ID</td><td class="th">DATE</td><td class="th">TIME</td><td class="th">DESCRIPTION</td><td class="th">TABLE</td><td class="th">ACTION</td></tr>
    <?php
    
    $i = 0;
    foreach ($record as $key => $value) {
        echo "<tr class='tr'>"; 
        $i++;
        $bg_row = ($i % 2 == 0)? "row" : "alternate";
        $keys = array_keys($value);
        for ($i = 0; $i < count($keys); $i++){
            echo "<td class='td $bg_row'>{$value[$keys[$i]]}</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
}else{
    echo 'No audit generated';
}