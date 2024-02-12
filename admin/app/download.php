<?php session_start();

if(isset($_SESSION['report_record']) && isset($_REQUEST['p']) && isset($_REQUEST['type']) && $_SESSION['report_record'] !== ''):
    include_once '../home/classes/cexports.php';
    
    if($_REQUEST["p"] == '' || $_REQUEST['type'] == ''){
        exit('Invalid parameter(s)');
    }
    $records = $_SESSION["report_record"];
    $type = $_REQUEST['type'];
    if($rec = $cExports->Render($records, $type))
    {
        define("FILE", "../temp/".$type.'-' . session_id(). ".csv");
        $fp = fopen(FILE, 'w');
        foreach ($rec as $key => $value) {
            fputcsv($fp, $value);
        }
        fclose($fp);
    
        if (file_exists(FILE)) {
            $f_name = FILE;
            $f_type = filetype($f_name);
    //        $f_size = filesize($f_name);//
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename='.basename($f_name));
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($f_name));
            ob_clean();
            flush();
            readfile($f_name);
            exit();
        }else{ echo 'File not exit or has been moved.'; exit();} 
    }
endif;
echo 'No report data generated.';
exit();
?>