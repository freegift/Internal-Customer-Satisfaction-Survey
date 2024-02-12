<?php
//$cReports->DailyRequisition(A_DATE_FROM, A_DATE);
$lines = file( BASE_DIR . 'web/error_log.txt');
$lines = array_reverse($lines);
$c = count($lines);
//if (!empty($cReports->report)){
$i = 0;
//    echo "<div>";
    echo '<table id="Items" class="list-table ui-widget-content ui-corner-all">';
    // Loop through our array, show HTML source as HTML source; and line numbers too.
    foreach ($lines as $line_num => $line) {
        $i++;
        $bg_row = ($i % 2 == 0)? "row" : "alternate";
        echo "<tr class='tr'>";
        echo "<td class='td $bg_row'>#<b>".($c-$line_num)."</b> </td>";
        echo "<td class='td $bg_row'>". htmlspecialchars($line) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
//    echo "</div>";
//}else{
//    echo 'No error reported';
//}