<?php 
include_once '../../admin/app/config.php';
include_once '../../admin/app/connect.php';
include_once '../../admin/app/capp.php';
include_once '../../admin/home/classes/cinclients.php';
include_once 'creports.php';

$cInClients->user_default_survey();// Get default survey category

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo cApp::AppTitle() ;?></title>
        
<link href="<?php echo BASE_DIR ;?>web/css/custom-theme/jquery-ui-1.9.2.custom.css" rel="stylesheet" type="text/css" />
<link href="<?php echo BASE_DIR ;?>web/css/css.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/jquery-1.8.3.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/jquery-ui-1.9.2.custom.js"></script>
<script type="text/javascript" src="<?php echo BASE_DIR ;?>web/js/js.js"></script>
<style>
@font-face {
    font-family: FBNIFont;
    src: url(<?php echo BASE_DIR ?>web/fonts/FrutigerLTStd-Light.otf)?>);
}
*{font-family: FBNIFont !important}
</style>
</head>
<div id="header" class=" ui-widget">
    <div style="/*width: 500px; float: left;*/">
        <div style="float: left; background-color: white;">
            <img src="<?php echo BASE_DIR ;?>web/images/fbn-logo-blue.png" height="60" width="200" alt=""
             style=" border-radius: 4px; float: left; vertical-align: top; margin-right: 5px; margin-left: 10px; margin-top: 3px; z-index: 3"/>
        </div>
        <div class="" style="padding: 1px 5px; margin-top: 7px; color:white; 
            position:relative; font-weight: normal; /*width: 100%; */ z-index: 1; float: left;">
            <h1 style="margin: 0px; padding: 0px; "><?php echo cApp::AppTitle() ;?></h1>
            <!--<span class=""><br><?php // echo (isset($_SESSION["u_fullname"]))? "Welcome <strong>".$_SESSION["u_fullname"]."</strong> !":'';// 'sis ='. session_id();?></span>-->
            <br><?php // echo isset($_SESSION['DEFAULT'])? $_SESSION['DEFAULT']['c_id'].' - ' .$_SESSION['DEFAULT']['c_name']:'';?>
        </div>
        <div style="float: right;">
            <?php if(isset($_SESSION["u_email"])){?>
            <form action="#questions" method="POST" name="survey_logout">
                <div class="formtitle" style="font-size: 16px;">
                    <input name="btnlogout" value="Logout" type="submit" />
                    <input name="form" value="survey_logout"  type="hidden" />
                </div>
            </form> 
            <?php }?>
        </div> 
    </div>
</div>  

<?php
//
//class iReports extends Connect
//{
//    //++++++DEPARTMENTS++++++++++++++++
//    
//    public function ReportsDepartments1($param = '') {
//        $query = "SELECT d.* FROM departments d "
//                . "WHERE d.d_id IN (SELECT m_dept_id_destination FROM mapping WHERE m_cat_id=".$_SESSION["c_id"].") ORDER BY d_name ASC";
//        if ($records = $this->Select($query))
//        {
//            return $this->Totals_D($records);
//        }else{
//            return array();
//        }
//        
//    }
//    
//    private function Totals_D($param) {
//        error_reporting(0);
//        foreach ($param as $key => $value) {
//            $rec = $this->Select("SELECT SUM(e_opt_score) s, SUM(e_opt_max_score) s_m FROM entries WHERE e_cat_id=".$_SESSION["c_id"]." AND e_dept_id_target =".$value["d_id"]);
//            $totals = $rec;//($rec)? $rec:0;
////            var_dump($rec);
////            $param[$key]["q_tot_users"] = ($totals != 0)? $totals[0]["c"]:0;
////            $totals = (!empty($totals))? $totals : 0;
//            $param[$key]["d_tot_scores"] = ($totals[0]["s"] !== NULL)? $totals[0]["s"]:0;
////            $totals_max = ($rec = $this->Select("SELECT SUM(q_max_score) s FROM questions WHERE e_dept_id_target =".$value["d_id"]))? $rec:0;
//            $param[$key]["d_max_scores"] = ($totals[0]["s_m"] !== NULL)? $totals[0]["s_m"]:0;
//            $param[$key]["d_avg_scores"] = round(($totals[0]["s_m"] / $totals[0]["s"]), 2);
//            $param[$key]["d_percent"] = round(($totals[0]["s"] / $totals[0]["s_m"] * 100), 2);
//            $param[$key]["d_remark"] = $this->GetRemark($param[$key]["d_percent"]);
//        }
////        $_SESSION["report_record"] = $param; //initialize for export
//        return $this->SetReportData($param);
//    }
//    
//    private function GetRemark($param) {
//        if ($param > 80 && $param <= 100){
//            $remark = "EXCELLENT";
//        }elseif ($param > 60 && $param <= 80){
//            $remark = "VERY GOOD";
//        }elseif ($param > 40 && $param <= 60){
//            $remark = "GOOD";
//        }elseif ($param > 20 && $param <= 40){
//            $remark = "AVERAGE";
//        }elseif ($param > 0 && $param <= 20){
//            $remark = "POOR";
//        }else{
//            $remark = "-";
//        }
//        return $remark;
//        /*if($result = $this->Select("SELECT o_name FROM options WHERE o_percent >= $param AND o_percent <= $param LIMIT 1"))
//        {
//            return $result[0]["o_name"];
//        }else{
//            return NULL;
//        }*/
//    }
//    //++++++++++++++++++++++++++++++
//    
//    private function SetReportData($param) {
//        if (!empty($param))
//            $_SESSION["report_record"] = $param; //initialize for export
//        return $param;
//    }
//}
//
//$iReports = new iReports();

?>