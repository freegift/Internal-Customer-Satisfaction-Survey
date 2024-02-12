<?php
class cInClients extends Connect
{
    function __construct() {
        parent::__construct();
    }
    
    public function user_default_survey() {
        if( $result = $this->Select("SELECT * FROM categories WHERE c_default = '". ENABLE . "' LIMIT 1")){
            $_SESSION['DEFAULT']['c_id'] = $result[0]['c_id'];
            $_SESSION['DEFAULT']['c_name'] = $result[0]['c_name'];
        }
    }
    
    public function TriggerAccessCode($u_id, $sid, $u_email) {
        $code = mt_rand(10000, 99999);
        if($this->Update("UPDATE users SET u_verify_code = '$code', u_sid='$sid' WHERE u_id = $u_id")){
            $_SESSION["u_verify_code"] = $code;
            $_SESSION["u_email"] = $u_email;//$rec[0]["u_email"];
            $_SESSION["u_id"] = $u_id;
            $_SESSION["flag"] = TRUE;
            //trgger mail
//            if (implode('', file( BASE_DIR."home/email/email.php?module=verifycode&email=". $u_email ."&code=". $code .""))){
//                echo 'sent';
//            }else{
//                echo 'not send';
//            }
            
            return $code;
        }
        return NULL;
    }
    
    public function GetDepartmentInfo($id) {
        return $this->Select("SELECT * FROM departments WHERE d_id=$id");
    }
    
    public function TargerDepartmentsSelf($d_id ='', $c_id ='', $u_id = '') { //echo $d_id;
        if ($d_id == '' || $c_id == NULL || $u_id == '')
            return NULL;
        $query = "SELECT m.m_dept_id_destination, d.d_id, d.d_name FROM mapping m LEFT JOIN departments d "
                . " ON (m.m_dept_id_destination=d.d_id) WHERE m.m_dept_id_source = $d_id "
                . " AND m.m_cat_id = $c_id";
   
        return $this->CheckQuestionStatus($this->Select($query),$d_id, $c_id, $u_id);
    }
    
    public function TargerDepartments($d_id ='', $c_id ='', $u_id = '') { //echo $d_id;
        if ($d_id == '' || $c_id == NULL || $u_id == '')
            return NULL;
        $query = "SELECT m.m_dept_id_destination, d.d_id, d.d_name FROM mapping m LEFT JOIN departments d "
                . " ON (m.m_dept_id_destination=d.d_id) WHERE m.m_dept_id_source = $d_id "
                . " AND m.m_cat_id = $c_id";
   
        return $this->CheckQuestionStatus($this->Select($query),$d_id, $c_id, $u_id);
    }
    
    public function TargerDepartmentsForHeads($d_id ='', $c_id ='', $u_id = '') { //echo $d_id;
        if ($d_id == '' || $c_id == NULL || $u_id == '')
            return NULL;
//        echo 'id:'.$d_id;
        $query = "SELECT uh.uh_target_dept_id, d.d_id, d.d_name FROM unit_heads uh LEFT JOIN departments d "
                . " ON (uh.uh_target_dept_id=d.d_id) WHERE uh.uh_user_id = $u_id "
                . " AND uh.uh_cat_id = $c_id ";
//                . "AND uh.uh_target_dept_id"
//                . " NOT IN (SELECT m_dept_id_destination FROM mapping WHERE m_dept_id_source = $d_id AND m_cat_id = $c_id)";
        
      
        return $this->CheckQuestionStatus($this->Select($query),$d_id, $c_id, $u_id);
    }
    
    private function CheckQuestionStatus($records,$d_id, $c_id, $u_id) {
        if($records !== NULL){
            foreach ($records as $key => $value) {
                $records[$key]["remark"] = ($this->TargetQuestions($value["d_id"], $c_id, $u_id))?'PENDING':'COMPLETED';
            }
            return $records;
        }
    }
    
    public function TargetQuestions($d_id, $c_id, $u_id) {
         if ($d_id == '' || $c_id == NULL || $u_id == '')
            return NULL;
        /*$query = "SELECT q.* FROM questions q WHERE q.q_cat_id = $c_id "
                . " AND q.q_id NOT IN (SELECT e_ques_id FROM entries WHERE e_user_id=$u_id "
                . "AND e_cat_id=$c_id AND e_dept_id_target=$d_id)";
        */
        $query = "SELECT q.* FROM questions q WHERE q.q_cat_id = $c_id "
                . " AND q.q_id IN (SELECT mqd_question_id FROM map_questions_department WHERE mqd_cat_id=$c_id AND mqd_dept_id_target=$d_id) "
                . " AND q.q_id NOT IN (SELECT e_ques_id FROM entries WHERE e_user_id=$u_id AND e_cat_id=$c_id AND e_dept_id_target=$d_id)";
        $result=$this->AttachOptionsList($this->Select($query));
       //echo $query;
        return $result;
    }
    
    private function AttachOptionsList($records = NULL) {
        if($records !== NULL){
            foreach ($records as $key => $value) {
                $records[$key]["options"] = $this->Select("SELECT * FROM map_question_options m "
                        . "LEFT JOIN options o ON (o.o_id=m.mqo_option_id) "
                        . "WHERE m.mqo_question_id =".$value["q_id"]);
            }
            return $records;
        }
    }
    
    public function GetSuggestion($d_id, $c_id, $u_id) {
        if($sugg = $this->Select("SELECT * FROM suggestions WHERE s_dept_id=$d_id AND s_cat_id=$c_id AND s_user_id=$u_id"))
        {
            return $sugg;
        }else{
            $s[0]["s_id"] = '0';
            $s[0]["s_suggestion"] = '';
            $s[0]["s_suggestion2"] = '';
            return $s;
        }
    }
    
}
$cInClients = new cInClients();

if (!empty($_REQUEST) && !empty($_REQUEST["form"])){
    switch ($_REQUEST["form"]) {
        case "email":
            if (isset($_POST["btnlogin"])){
//                if($t = filter_input(INPUT_POST, 'u_email', FILTER_VALIDATE_)){
                    $u_username = filter_input(INPUT_POST, 'u_username', FILTER_SANITIZE_STRING);
                    //$cInClients->ListOne("users", "u_email","'". $u_email."'")
                    if($rec = $cInClients->Select("SELECT * FROM users WHERE u_username='$u_username' AND u_c_id = ".$_SESSION['DEFAULT']['c_id']))
                    {
                        if ($rec[0]["u_enable"] !== ENABLE){
                            $ERROR[] = "User account disabled. Please contact system administrator";
                            break;
                        }
                        //+++++++++ login direct to survey page
                        $_SESSION["u_id"] = $rec[0]["u_id"];
                        $_SESSION["u_dept_id"] = $rec[0]["u_dept_id"];
                        $_SESSION["u_fullname"] = $rec[0]["u_fullname"];
                        $_SESSION["u_email"] = $rec[0]["u_email"];
                        $_SESSION["u_unit_head"] = $rec[0]["u_unit_head"];
//                        $cConnect->AuditLog("users","LOGIN - 2","Access Code verified successfully for ".$_SESSION["u_fullname"]);
                        if ($cat = $cInClients->Select("SELECT * FROM categories WHERE c_default = '". ENABLE ."'")){
                            $MESSAGE[] = "Active survey found";
                            $_SESSION["c_id"] = $cat[0]["c_id"];
                            $_SESSION["verifycode"]["no_back"] = TRUE;
                            header("Location: survey.php");
                            exit();
                        }else{
                            session_unset();
                            session_destroy();
                            session_regenerate_id();
                            $_SESSION["verifycode"]["no_back"] = TRUE;
                            header("Location: done.php");
                            exit();
                        }
                        //+++++++++++ end direct login
                        /*
                        if ($code = $cInClients->TriggerAccessCode($rec[0]["u_id"], session_id(), $u_email)){
                            $cConnect->Update("UPDATE users SET u_last_login_date ='".A_DATE."', u_last_login_time ='".A_TIME."' WHERE u_id = {$rec[0]["u_id"]}");
                            $cConnect->AuditLog("users","LOGIN - 1","User login successfully - $u_email");// and Verification code generated and sent to 
                            $_SESSION["index"]["no_back"] = TRUE;
                            header("Location: verifycode.php");
                            header("Location: survey.php");
                            exit();
                        }else{
                            $ERROR[] = "Error occured while genrating/sending your access code. Please retry.";
                            $cConnect->AuditLog("users","LOGIN - 1","Error occured while genrating/sending your access code for $u_email");
                        }
                        */
                    }else{
                        $ERROR[] = "User email [ $u_username ] not exist or invalid email. Please contact system administrator.";
                        $cConnect->AuditLog("users","LOGIN - 1","User email [ $u_username ] not exist or invalid email");
                    }
//                }else{
//                    $ERROR[] = "Invalid email address format. Please retry.";
//                    $cConnect->AuditLog("users","LOGIN - 1","Invalid email address format for ".$_POST["u_email"]);
//                }
            }
            break;
        case "verifycode":
            if (isset($_POST["btnverifycode"])){
                if($t = filter_input(INPUT_POST, 'u_verify_code', FILTER_VALIDATE_INT)){
                    $u_verify_code = filter_input(INPUT_POST, 'u_verify_code', FILTER_SANITIZE_NUMBER_INT);
                    if($rec = $cInClients->Select("SELECT * FROM users WHERE u_verify_code = '". $u_verify_code."'"
                            . " AND u_id = ".$_SESSION["u_id"] ." AND u_c_id = ".$_SESSION['DEFAULT']['c_id']))
                    {
//                        if ($rec[0]["u_enable"] !== ENABLE){
//                            $ERROR[] = "User account disabled. Please contact system administrator";
//                            break;
//                        }
                        $_SESSION["u_dept_id"] = $rec[0]["u_dept_id"];
                        $_SESSION["u_fullname"] = $rec[0]["u_fullname"];
                        $_SESSION["u_email"] = $rec[0]["u_email"];
                        $cConnect->AuditLog("users","LOGIN - 2","Access Code verified successfully for ".$_SESSION["u_fullname"]);
                        if ($cat = $cInClients->Select("SELECT * FROM categories WHERE c_default = '". ENABLE ."'")){
                            $MESSAGE[] = "Active survey found";
                            $_SESSION["c_id"] = $cat[0]["c_id"];
                            $_SESSION["verifycode"]["no_back"] = TRUE;
                            header("Location: survey.php");
                            exit();
                        }else{
                            session_unset();
                            session_destroy();
                            session_regenerate_id();
                            $_SESSION["verifycode"]["no_back"] = TRUE;
                            header("Location: done.php");
                            exit();
                        }
                    }else{
                        $ERROR[] = "Your verification code [ $u_verify_code ] does not exist. Please retry or contact system administrator.";
                        $cConnect->AuditLog("users","LOGIN - 2","Verification code [ $u_verify_code ] does not exist for ".$_SESSION["u_email"]);
                    }
                }else{
                    $ERROR[] = "Invalid verification code format. Please retry.";
                    $cConnect->AuditLog("entries","SURVEY","Invalid verification code [ ".$_POST["u_verify_code"]." ] format for ".$_SESSION["u_email"]);
                }
            }
            break;
        case "survey_d":
            $my_target_dept_id = NULL;
            if (isset($_REQUEST["btnsurvey_d"])){
                $my_target_dept_id = array_keys($_REQUEST["btnsurvey_d"]);
                $my_target_dept = $cInClients->GetDepartmentInfo($my_target_dept_id[0]);
                
                $my_target_questions = $cInClients->TargetQuestions($my_target_dept_id[0], $_SESSION["c_id"], $_SESSION["u_id"]);
                $my_target_suggestion = $cInClients->GetSuggestion($my_target_dept_id[0], $_SESSION["c_id"], $_SESSION["u_id"]);
            }
            break;
        case "survey_q":
            $my_target_dept_id = NULL;
            $query_data = '';
            if (isset($_REQUEST["btnsurvey_q"]) && (!empty($_REQUEST["options"]))){
                foreach ($_REQUEST["options"] as $key => $value) {
                    $q_id = $key;
                    $opt_data = $value;
                    $my_data = $_POST["mydata"];
//                    echo $q_id . $opt_data .$my_data;
                    $query_data .= "(NULL,$q_id," . $opt_data . ",". $my_data . ",'".A_DATE."','".A_TIME."'),";
                }
                if ($query_data !== ''){
                    $query = "INSERT INTO entries (e_id, e_ques_id, e_opt_id, e_opt_score, e_opt_max_score,"
                            . "e_user_id, e_dept_id_source, e_dept_id_target, e_cat_id, e_date, e_time) VALUES ".substr($query_data,0,-1);
//                    echo $query;
                    if($cInClients->Insert($query)){
                        $MESSAGE[] = "Survey entries submitted successfully";
                        $cConnect->AuditLog("entries","SURVEY","Survey questions submitted successfully by ".$_SESSION["u_fullname"]);
                    }else{
                        $ERROR[] = "Action could not be completed. Please retry";
                        $my_target_dept = $cInClients->GetDepartmentInfo($_POST["target_dept"]);
                        $my_target_questions = $cInClients->TargetQuestions($_POST["target_dept"], $_SESSION["c_id"], $_SESSION["u_id"]);
                        $cConnect->AuditLog("entries","SURVEY","Survey questions could not be submitted by ".$_SESSION["u_fullname"]);
                    }
                }
                //suggestion input
                $s_sugg = trim(filter_input(INPUT_POST, 's_suggestion', FILTER_SANITIZE_STRING));
                $s_sugg2 = trim(filter_input(INPUT_POST, 's_suggestion2', FILTER_SANITIZE_STRING));
                if($s_sugg !== ''){
                    $s_id = filter_input(INPUT_POST, 's_id', FILTER_SANITIZE_NUMBER_INT);
                    if($s_id == 0){
                        $query = "INSERT INTO suggestions (s_id, s_user_id, s_dept_id, s_cat_id, s_suggestion, s_date, s_time, s_suggestion2) VALUES "
                                . "(NULL,".$_SESSION["u_id"].",".$_POST["target_dept"].",".$_SESSION["c_id"].",'$s_sugg','".A_DATE."','".A_TIME."','$s_sugg2')";
                        if($cInClients->Insert($query)){
                            $MESSAGE[] = "Suggestion saved succesfully";
                        }else{
                            $ERROR[] = "Suggestion could not be saved";
                        }
                    }else{
                        $query = "UPDATE suggestions SET s_suggestion = '$s_sugg',s_suggestion2 = '$s_sugg2',s_date='".A_DATE."',s_time='".A_TIME."' WHERE s_id = $s_id";
                        if($cInClients->Insert($query)){
                            $MESSAGE[] = "Suggestion updated succesfully";
                        }else{
                            $ERROR[] = "Suggestion could not be updated";
                        }
                    }
                }
            }
            break;
        case "survey_logout":
            if(isset($_POST["btnlogout"])):
                $cConnect->AuditLog("login","LOGOUT","Successful logout by ".$_SESSION["u_fullname"]);
                session_unset();
                session_destroy();
                session_regenerate_id();
//                $_SESSION["verifycode"]["no_back"] = TRUE;
                $_SESSION["logout"]["no_back"] = TRUE;
                header("Location: logout.php");
                exit();
            endif;
        default:
            break;
    }
}
