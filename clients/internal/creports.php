<?php

class iReports extends Connect
{
    private function SetReportData($param) {
        if (!empty($param))
            $_SESSION["report_record"] = $param; //initialize for export
        return $param;
    }
    //++++++DEPARTMENTS++++++++++++++++
    
    public function ReportsDepartments($param) {
        $query = "SELECT d.* FROM departments d "
                . "WHERE d.d_id IN (SELECT m_dept_id_source FROM mapping WHERE m_dept_id_destination =$param AND m_cat_id=".$_SESSION["c_id"].") ORDER BY d_name ASC";
        if ($records = $this->Select($query))
        {
            return $this->Totals_D($records, $param);
        }else{
            return array();
        }
        
    }
    
    private function Totals_D($param, $dept) {
        error_reporting(0);
        foreach ($param as $key => $value) {
            $rec = $this->Select("SELECT SUM(e_opt_score) s, SUM(e_opt_max_score) s_m FROM entries WHERE e_cat_id=".$_SESSION["c_id"].""
                    . " AND e_dept_id_source =".$value["d_id"]
                    . " AND e_dept_id_target =$dept" );
            $totals = $rec;//($rec)? $rec:0;
//            var_dump($rec);
//            $param[$key]["q_tot_users"] = ($totals != 0)? $totals[0]["c"]:0;
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
}

$iReports = new iReports();