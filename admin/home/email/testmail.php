<?php
//if ( !isset($_REQUEST['term']) )
    //exit;
//include_once '../../app/connect.php';
//$C = new $cConnect;
//$field="VEN_NAME";//$_GET['field'];
//$table="vendors";//$_GET['table'];
//$sql='select distinct VEN_ID, '.$field.' from '.$table;//.' where '.$field.' like "%'. mysql_real_escape_string($_REQUEST['term']) 
        //.'%" order by '.$field.' asc';
//$result = $C->Select($sql);
//if ($C->num_rows > 0) {
//    $data = array();
//    foreach ($result as $row ) {
//        $data[] = array('value' => $row["VEN_ID"] ." | ". trim(strtoupper($row[$field])));//.', '.strtoupper($row['other_names']));
//    }
//    echo json_encode($data);
//flush ();
//}
//echo 'I am here for you';

if (!isset($_REQUEST["cmd"]))
    exit ();
$mod = $_REQUEST["module"];
$str = $_REQUEST["cmd"];
$opt = $_REQUEST["option"];
$headers = 'From: Udourom E. E. <info@advert-space.com>' ." \r\n";
$headers  .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n"
        . "X-Mailer: PHP/" . phpversion();

if(@mail('freeg.research@gmail.com, uenomfon@cornerstone.com.ng, freegiftudourom@yahoo.com',
        "Inventory Software | $str",
        "promotional materials added to list",
        $headers)){ 
    echo "mail send ok html: $str";
} else {  echo 'mail not sent'; }