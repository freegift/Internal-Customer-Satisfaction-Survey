<?php
class cExports {
    public function Render($records, $report_type) {
        switch ($report_type) {
            case "comprehensive":
                return $this->Comprehensive($records);
                break;
            case "recententries":
                return $this->RecentEntries($records);
                break;
//            case "comprehensive":
//                return $this->Comprehensive($records);
//                break;
            case "bydepartments":
                return $this->Departments($records);
                break;
            case "byquestions":
                return $this->Questions($records);
                break;
            case "byusers":
                return $this->Users($records);
                break;
            case "suggestions":
                return $this->Suggestions($records);
                break;
            default:
                break;
        }
    }
    
    private function Comprehensive($records) {
        $header = array("S/N", "USERS", "USER UNIT", "APPRAISAL UNITS", "TOTAL SCORES", "MAX. EXP. SCORES",
            "ACCUMULATIVE PERCENT", "FINAL PERCENT", "REMARK");
        $data[0] = $header;
        foreach ($records as $key => $value) {
            $v = array(($key + 1), $value["u_fullname"], $value["d_name"], $value["target_dept_name"], $value["target_total_scores"], 
                $value["target_total_max_scores"], $value["target_total_percent"], $value["target_total_final_percent"], 
                $value["target_remark"]);
             $data[($key + 1)] = $v;
         }
        return $data;
    }
    
    private function RecentEntries($records) {
        $header = array("S/N", "USERS", "QUESTIONS", "SCORE", "USER UNIT/DEPT", "TARGET UNIT/DEPT", "DATE");
        $data[0] = $header;
        foreach ($records as $key => $value) {
            $v = array(($key + 1), $value["u_fullname"], $value["q_name"], $value["e_opt_score"], $value["d_name_source"], 
                $value["d_name_target"], $value["e_date"]);
             $data[($key + 1)] = $v;
         }
        return $data;
    }
    
    private function Departments($records) {
        $header = array("S/N", "DEPARTMENTS", "GRAND TOTAL SUBMITTED SCORES", "MAX EXPECTED SCORES", "AVERAGE SCORE",
            "PERCENT", "REMARK");
        $data[0] = $header;
        foreach ($records as $key => $value) {
            $v = array(($key + 1), $value["d_name"], $value["d_tot_scores"], $value["d_max_scores"], $value["d_avg_scores"], 
                $value["d_percent"], $value["d_remark"]);
             $data[($key + 1)] = $v;
         }
        return $data;
    }
    
    private function Questions($records) {
        $header = array("S/N", "QUESTIONS", "TOTAL USERS IN SURVEY", "TOTAL SUBMITTED SCORES", "MAX EXPECTED SCORES");
        $data[0] = $header;
        foreach ($records as $key => $value) {
            $v = array(($key + 1), $value["q_name"], $value["q_tot_users"], $value["q_tot_scores"], $value["q_max_scores"]);
             $data[($key + 1)] = $v;
         }
        return $data;
    }
    
    private function Users($records) {
        $header = array("S/N", "USERS", "EMAIL", "DEPARTMENTS", "ASSIGNED DEPT. ", "SUBMITTED QUESTIONS",
            "EXPECTED QUESTIONS", "TIME", "STATUS");
        $data[0] = $header;
        foreach ($records as $key => $value) {
            $v = array(($key + 1), $value["u_fullname"], $value["u_email"], $value["d_name"], $value["u_tot_depts"], $value["u_tot_ques"],
                $value["u_max_ques"], $value["u_last_login_date"].' '.$value["u_last_login_time"], $value["u_status"]);
             $data[($key + 1)] = $v;
         }
        return $data;
    }
    
    private function Suggestions($records) {
        $header = array("S/N", "SENT BY", "TARGET UNITS / DEPARTMENTS", "What do you like most about us", "What would you like us to do better?", "TIME");
        $data[0] = $header;
        foreach ($records as $key => $value) {
            $v = array(($key + 1), $value["u_fullname"], $value["d_name"], $value["s_suggestion"], $value["s_suggestion2"], $value["s_date"].' '.$value["s_time"]);
             $data[($key + 1)] = $v;
         }
        return $data;
    }
}

$cExports = new cExports();