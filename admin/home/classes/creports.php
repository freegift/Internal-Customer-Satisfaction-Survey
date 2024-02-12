<?php

class cReports extends Connect {
    //put your code here
    public $id = null;
    public $category = '';
    
    function __construct() {
        parent::__construct();
        $this->category = $_SESSION['DEFAULT']['c_id'];
    }
    
    public function HasData() {
        if (isset($_SESSION["report_record"])){
            return TRUE;
        }else{
//            return NULL;
        }
    }
    
    private function SetReportData($param) {
        if (!empty($param))
            $_SESSION["report_record"] = $param; //initialize for export
        return $param;
    }
    
    //recent entries++++++++++++++
    public function ReportsRecentEntries($param = '') {
        $param_query = $this->BuildQuery($param);
        
        if($param_query == '')
            return array();
        
        $query = "SELECT e.*, u.u_fullname, q.q_name, d1.d_name d_name_source, d2.d_name d_name_target "
                . "FROM entries e LEFT JOIN users u ON (e.e_user_id=u.u_id) "
                . "LEFT JOIN questions q ON (e.e_ques_id=q.q_id) "
                . "LEFT JOIN departments d1 ON (e.e_dept_id_source=d1.d_id) "
                . "LEFT JOIN departments d2 ON (e.e_dept_id_target=d2.d_id) "
                . "WHERE q.q_id IN (" . $this->DefaultQuestionsQuery() .") "
                . $param_query;
        $param = $this->Select($query);
        return $this->SetReportData($param);
    }
    
    private function DefaultQuestionsQuery() {
        return "SELECT q.q_id FROM questions q WHERE"
                . " q.q_cat_id = (SELECT c_id FROM categories WHERE c_default = '".ENABLE."' LIMIT 1)";
    }
    
    public function BuildQuery($param) {
        $query = '';
        if (isset($param["btnsearch"])){
            $query .= ($param["users"] != '')? " AND u_id=". $param["users"] ."": "";
            $query .= ($param["questions"] != '')? " AND q_id=". $param["questions"] ."": "";
            $query .= ($param["departments_s"] != '')? " AND d1.d_id=".$param["departments_s"] ."": "";
            $query .= ($param["departments_t"] != '')? " AND d2.d_id=".$param["departments_t"] ."": "";
        }
        return $query;
    }
    //++++++++++++++++++++
    
    //++++++SURVEY QUESTIONS++++++++++++++++
    public function ReportsSurveyQuestions($param = '') {
        $query = "SELECT q.* FROM questions q "
                . "WHERE q.q_cat_id = ".$_SESSION["DEFAULT"]["c_id"]."";
        if ($records = $this->Select($query))
        {
            return $this->Totals_Q($records);
        }else{
            return array();
        }
        
    }
    
    private function Totals_Q($param) {
        foreach ($param as $key => $value) {
            $rec = $rec = $this->Select("SELECT count(e_user_id) c, SUM(e_opt_score) s FROM entries WHERE e_ques_id =".$value["q_id"]);
            $totals = $rec;//()? $rec:0;
            $param[$key]["q_tot_users"] = ($totals[0]["c"] !== NULL)? $totals[0]["c"]:0;
            $param[$key]["q_tot_scores"] = ($totals[0]["s"] !== NULL)? $totals[0]["s"]:0;
            $param[$key]["q_max_scores"] = $param[$key]["q_tot_users"] * 5;//($tot_users != 0)? $totals[0]["s"]:0;
        }
//        $_SESSION["report_record"] = $param; //initialize for export
        return $this->SetReportData($param);
    }
    //++++++++++++++++++++++++++++++
    
    //++++++USERS++++++++++++++++
    public function ReportsUsers($param = '') {
        $query = "SELECT u.u_id, u.u_fullname, u.u_email, u.u_dept_id, u.u_last_login_date, u.u_last_login_time, d.d_name FROM users u "
                . "LEFT JOIN departments d ON (u.u_dept_id=d.d_id) "
                . "WHERE u.u_enable = '".ENABLE."' "
                . " AND u.u_c_id = ". $_SESSION['DEFAULT']['c_id']
//                . "AND u_dept_id IN (SELECT m_dept_id_destination FROM mapping WHERE m_cat_id=".$_SESSION["DEFAULT"]["c_id"].") "
                . " ORDER BY d.d_name, u.u_fullname";
        if ($records = $this->Select($query))
        {
            return $this->Totals_U($records);
        }else{
            return array();
        }
        
    }
    
    private function Totals_U($param) {
        foreach ($param as $key => $value) {
            $submitted_depts = $this->Select("SELECT DISTINCT e_dept_id_target cd FROM entries WHERE e_cat_id=".$_SESSION["DEFAULT"]["c_id"]." AND e_user_id =".$value["u_id"]);
            $param[$key]["u_tot_submitted_depts"] = $this->num_rows;// ($submitted_depts[0]["cd"] !== NULL)? $submitted_depts[0]["cd"]:0;
            
            
            $rec = $this->Select("SELECT count(e_dept_id_source) c FROM entries WHERE e_cat_id=".$_SESSION["DEFAULT"]["c_id"]." AND e_user_id =".$value["u_id"]);
            $totals = $rec;// ()? $rec:0;
            $param[$key]["u_tot_ques"] = ($totals[0]["c"] !== NULL)? $totals[0]["c"]:0;
            $totals_target = $this->QuestionsForThisDepartment($value["u_dept_id"], $value["u_id"]);
            list($param[$key]["u_max_ques"], $param[$key]["u_tot_depts"]) = explode("~", $totals_target);
            $diff = (int)$param[$key]["u_max_ques"] - (int)$param[$key]["u_tot_ques"];
            if($param[$key]["u_tot_depts"] == 0){
                $param[$key]["u_status"] = '-';
            }else{
                if($diff != 0){
                    $param[$key]["u_status"] = $diff . " - Remaining";
                }else{
                    $param[$key]["u_status"] = "COMPLETED";
                }
            }
            $param[$key]["u_tot_unsubmitted_depts"] = $param[$key]["u_tot_depts"] - $param[$key]["u_tot_submitted_depts"];
//            $param[$key]["u_status"] = (($diff != 0) && ((int)$param[$key]["u_tot_ques"]>0))? $diff . " - Remaining":"COMPLETED";
        }
//        $_SESSION["report_record"] = $param; //initialize for export
        return $this->SetReportData($param);
    }
    
    private function QuestionsForThisDepartment($dept_id, $user_id = '') {
        $tot = 0;
        $depts = $this->TargetDepartments($dept_id, $user_id);      //  echo 'count: '.  count($depts);
        if (!empty($depts)){ $tot = 0; $dept_tot = array();
            foreach ($depts as $key => $value) {
                //NOTE: all questions for each dept
//                if ($rec = $this->Select("SELECT COUNT(q_id) c FROM questions WHERE q_cat_id = ".$_SESSION["DEFAULT"]["c_id"]))
//                {
//                    $tot += $rec[0]["c"];
//                }
                if ($rec = $this->Select("SELECT COUNT(q_id) c FROM questions WHERE q_id IN (SELECT mqd_question_id FROM map_questions_department WHERE mqd_cat_id = ".$_SESSION["DEFAULT"]["c_id"]." AND mqd_dept_id_target = ".$value.")"))
                {
//                    var_dump($rec);
                    $tot += $rec[0]["c"];
                }
            }
        }
        return $tot ."~". count($depts);
    }
    
    private function TargetDepartments($dept_id, $user_id = '') {
        //get user assigned units/depts
        $d = $this->Select("SELECT DISTINCT m_dept_id_destination FROM mapping WHERE m_dept_id_source = $dept_id "
                . "AND m_cat_id = ".$_SESSION["DEFAULT"]["c_id"] ."") ;
        //get extra units/dept for units heads, managers mapping
        $d1 = ($user_id != '') ? $this->Select("SELECT DISTINCT uh_target_dept_id m_dept_id_destination FROM unit_heads WHERE uh_cat_id =".$_SESSION["DEFAULT"]["c_id"] ." AND uh_user_id =".$user_id) :'';
        
        $vals = array();
        $d_all = array_merge($d, $d1);
        
        foreach ($d_all as $key => $value) { //remove duplicated units mapping
            if(!in_array($value["m_dept_id_destination"], $vals)){
                $vals[] = $value["m_dept_id_destination"];
            }
        }
//        $vals = $d;
        if($vals)
        {
            return $vals;
        }else{
            return NULL;
        }
    }
    //++++++++++++++++++++++++++++++
    
    //++++++DEPARTMENTS++++++++++++++++
    public function ReportsDepartments($param = '') {
        $query = "SELECT d.* FROM departments d "
                . "WHERE d.d_id IN (SELECT m_dept_id_destination FROM mapping WHERE m_cat_id=".$_SESSION["DEFAULT"]["c_id"].") "
                . " AND d_c_id = ". $_SESSION['DEFAULT']['c_id']
                . " ORDER BY d_name ASC";
        if ($records = $this->Select($query))
        {
            return $this->Totals_D($records);
        }else{
            return array();
        }
        
    }
    
    private function Totals_D($param) {
        error_reporting(0);
        foreach ($param as $key => $value) {
            $rec = $this->Select("SELECT SUM(e_opt_score) s, SUM(e_opt_max_score) s_m FROM entries WHERE e_cat_id=".$_SESSION["DEFAULT"]["c_id"]." AND e_dept_id_target =".$value["d_id"]);
            $totals = $rec;//($rec)? $rec:0;
//            var_dump($rec);
            $mem = $this->Select("SELECT DISTINCT e_user_id FROM entries WHERE e_dept_id_target=".$value["d_id"] ." AND e_cat_id=".$_SESSION["DEFAULT"]["c_id"]);
            $param[$key]["q_tot_users"] = $this->num_rows;
//            $totals = (!empty($totals))? $totals : 0;
            $param[$key]["d_tot_scores"] = ($totals[0]["s"] !== NULL)? $totals[0]["s"]:0;
//            $totals_max = ($rec = $this->Select("SELECT SUM(q_max_score) s FROM questions WHERE e_dept_id_target =".$value["d_id"]))? $rec:0;
            $param[$key]["d_max_scores"] = ($totals[0]["s_m"] !== NULL)? $totals[0]["s_m"]:0;
            $param[$key]["d_avg_scores"] = round(($totals[0]["s_m"] / $totals[0]["s"]), 2);
            $param[$key]["d_percent"] = round(($totals[0]["s"] / $totals[0]["s_m"] * 100), 2);
            $param[$key]["d_remark"] = $this->GetRemark($param[$key]["d_percent"]);
        }
//        $_SESSION["report_record"] = $param; //initialize for export
        return $this->SetReportData($param);
    }
    
    private function GetRemark($param) {
        if ($param > 80 && $param <= 100){
            $remark = "EXCELLENT";
        }elseif ($param > 60 && $param <= 80){
            $remark = "VERY GOOD";
        }elseif ($param > 40 && $param <= 60){
            $remark = "GOOD";
        }elseif ($param > 20 && $param <= 40){
            $remark = "AVERAGE";
        }elseif ($param > 0 && $param <= 20){
            $remark = "POOR";
        }else{
            $remark = "-";
        }
        return $remark;
        /*if($result = $this->Select("SELECT o_name FROM options WHERE o_percent >= $param AND o_percent <= $param LIMIT 1"))
        {
            return $result[0]["o_name"];
        }else{
            return NULL;
        }*/
    }
    //++++++++++++++++++++++++++++++
    
    public function TotalDefaultEntries($c_id) {
        if($c = $this->Select("SELECT COUNT(e_id) c FROM entries WHERE e_cat_id = $c_id")){
            return $c[0]["c"];
        }else{
            return 0;
        }
    }
    
    public function ReportsSuggestions($d_id = '') {
        if ($d_id == '') return array();
        $param = $this->Select("SELECT s.*, u.u_fullname, d.d_name FROM suggestions s LEFT JOIN users u ON (u.u_id=s.s_user_id) "
                . " LEFT JOIN departments d ON (d.d_id=s.s_dept_id) WHERE s_dept_id=$d_id  AND s_cat_id = ". $this->category);
        return $this->SetReportData($param);
    }
    
    public function TotalDefaultSuggestions($c_id) {
        if($c = $this->Select("SELECT COUNT(s_id) c FROM suggestions WHERE s_cat_id = $c_id")){
            return $c[0]["c"];
        }else{
            return 0;
        }
    }
    
    //Comprehensive / INDIVIDUAL APPRAISALS REPORTS ++++++++++++++++++++++++++++++++++
    public function ComprehensiveAppraisals($param) {
        $users_rec = array();
        
        if($users_rec = $this->Select( "SELECT u.*, d.d_name FROM users u LEFT JOIN departments d ON (d_id=u_dept_id) "
                . " WHERE u_c_id = ". $_SESSION['DEFAULT']['c_id']
                . " ORDER BY d_name, u_fullname" )):
            $target_dept_reports = $this->ReportsDepartments(); //get all departments final scores and grading
        
            foreach ($users_rec as $key_u => $value_u) {
                if ($appraise_dept = $this->Select("SELECT mud_target_dept_id, d_name FROM map_user_departments"
                        . " LEFT JOIN departments ON (mud_target_dept_id=d_id) WHERE mud_user_id =".$value_u["u_id"]
                        ." AND mud_cat_id =".$_SESSION["DEFAULT"]["c_id"] )){
                    $users_rec[$key_u]["target_dept_count"] = count($appraise_dept);//get count of target depts
//                    $users_rec[$key_u]["target_depts"] = $appraise_dept;
                    $users_rec[$key_u]["target_dept_id"] = '';
                    $users_rec[$key_u]["target_dept_name"] = '';
                    foreach ($appraise_dept as $key_d => $value_d) {
                        $users_rec[$key_u]["target_dept_id"] .= $value_d["mud_target_dept_id"]."<br>";
                        $users_rec[$key_u]["target_dept_name"] .= $value_d["d_name"]." | ";
//                        $users_rec[$key_u]["target_dept_all"] .= $value_d["d_name"]."<br>";
//                        $users_rec[$key_u]["target_total_scores"] = 0;
                        foreach ($target_dept_reports as $key_tdr => $value_tdr) {
                            if ($value_d["mud_target_dept_id"] == $value_tdr["d_id"]){
//                                $users_rec[$key_u]["target_dept_all_data"] .= $value_d["d_name"]."<br>";
                                $users_rec[$key_u]["target_total_scores"] += $value_tdr["d_tot_scores"];
                                $users_rec[$key_u]["target_total_max_scores"] += $value_tdr["d_max_scores"];
                                $users_rec[$key_u]["target_total_percent"] += $value_tdr["d_percent"];
                                $users_rec[$key_u]["target_total_final_percent"] = round(($users_rec[$key_u]["target_total_scores"] / $users_rec[$key_u]["target_total_max_scores"] * 100), 2);
                            }
                        }
                        $users_rec[$key_u]["target_remark"] = isset($users_rec[$key_u]["target_total_final_percent"])?
                                $this->GetRemark($users_rec[$key_u]["target_total_final_percent"]) : '';
                    }
                }
            }
//            $_SESSION["report_record"] = $users_rec; //initialize for export
            return $this->SetReportData($users_rec);
        endif;
    }
}
$cReports = new cReports();


if (!empty($_POST) && !empty($_POST["form"])){
    
//    echo 'data sent';
    switch ($_POST["form"]) {
        case "add":
            break;
        case "save":
            break;
        case "view":
            
            break;
        case "list":
            
            break;
        
        default:
            break;
    }
    
}
