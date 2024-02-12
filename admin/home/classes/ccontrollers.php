<?php

class cControllers extends Connect {
    
    public $category = '';
    
    function __construct() {
        parent::__construct();
        $this->category = $_SESSION['DEFAULT']['c_id'];
    }
//    public function GetCurrentSurvey() {
//        $result = $this->Select("SELECT * FROM categories WHERE c_default = '". ENABLE . "'");
//        return $result;
//    }
    
    public function ResetPasswordCode() {
        return 'pass=123';
    }
    
    public function ListUsersDept() {
        return $this->Select("SELECT u.*, d.d_name FROM users u LEFT JOIN departments d ON (d.d_id=u_dept_id)"
                . " WHERE u_c_id = ". $_SESSION['DEFAULT']['c_id'] 
                . " ORDER BY u.u_fullname DESC");
    }
    
    //+++++++++++MAPPING QUESTIONS / OPTIONS
    public function ListAllQuestionsMappingRecords($id = '') {
        $records = $this->ListDefaultQuestions($id);// $this->Select($query);
        return $this->QuestionsMappingExtensions($records);
    }
    
    private function QuestionsMappingExtensions($param) {
        foreach ($param as $key => $value) {
            $param[$key]["ext"] = $this->Select("SELECT m.*, q.q_name, o.* FROM map_question_options m "
                    . "LEFT JOIN questions q ON (m.mqo_question_id = q.q_id) "
                    . "LEFT JOIN options o ON (m.mqo_option_id = o.o_id) "
                    . " WHERE m.mqo_question_id = ".$value["q_id"] ." ORDER BY o.o_score ASC");
        }
        return $param;
    }
    
    public function ListMappedOptions($id = '') {
        ($id != '' && $id > 0)? $pad = " WHERE m.mqo_question_id = '$id' " : $pad = '';
        $query = "SELECT m.*, o.* FROM map_question_options m LEFT JOIN options o ON (m.mqo_option_id=o.o_id)"
                . " $pad ORDER BY o.o_score ASC";
        return $this->Select($query);
    }
    
    public function ListNoneMappedOptions($id = '') {
        ($id != '' && $id > 0)? $pad = " WHERE m.mqo_question_id = '$id' " : $pad = '';
        $query = "SELECT o.* FROM options o WHERE o.o_enable = '".ENABLE."' "
                . " AND o_c_id = ". $_SESSION['DEFAULT']['c_id']
                . " AND o_id NOT IN "
                . " (SELECT mqo_option_id FROM map_question_options m " //$pad (m.m_dept_id_destination=d.d_id)"
                . " $pad) ORDER BY o.o_score ASC";
        return $this->Select($query);
    }
    //+++++++++++MAPPING QUESTIONS / OPTIONS
    
    //+++++++++++MAPPING DEPARTMENTS / QUESTIONS 
    public function ListAllDepartmentsQuestionsMappingRecords($id = '') {
//        $records = $this->ListDefaultQuestions($id);// $this->Select($query);
        $query = "SELECT * FROM departments WHERE d_c_id=". $_SESSION['DEFAULT']['c_id'];
        $records = $this->Select($query);
        return $this->DepartmentsQuestionsMappingExtensions($records);
    }
    
    private function DepartmentsQuestionsMappingExtensions($param) {
        foreach ($param as $key => $value) {
            $param[$key]["ext"] = $this->Select("SELECT * FROM map_questions_department m "
                    . "LEFT JOIN questions q ON (m.mqd_question_id = q.q_id) "
//                    . "LEFT JOIN options o ON (m.mqo_option_id = o.o_id) "
                    . " WHERE m.mqd_dept_id_target = ".$value["d_id"] ." ORDER BY q.q_id ASC");
        }
        /*foreach ($param as $key => $value) {
            $param[$key]["ext"] = $this->Select("SELECT m.*, q.q_name, o.* FROM map_question_options m "
                    . "LEFT JOIN questions q ON (m.mqo_question_id = q.q_id) "
                    . "LEFT JOIN options o ON (m.mqo_option_id = o.o_id) "
                    . " WHERE m.mqo_question_id = ".$value["q_id"] ." ORDER BY o.o_score ASC");
        }*/
        return $param;
    }
    
    public function ListMappedDepartmentQuestions($id = '') {
        ($id != '' && $id > 0)? $pad = " WHERE m.mqd_dept_id_target = '$id' " : $pad = '';
        $query = "SELECT * FROM map_questions_department m LEFT JOIN questions q ON (m.mqd_question_id=q.q_id)"
                . " $pad ORDER BY q.q_id ASC";
        return $this->Select($query);
    }
    
    public function ListNoneMappedDepartmentQuestions($id = '') {
        
        /*($id != '' && $id > 0)? $pad = " WHERE m.mqo_question_id = '$id' " : $pad = '';
        $query = "SELECT o.* FROM options o WHERE o.o_enable = '".ENABLE."' "
                . " AND o_c_id = ". $_SESSION['DEFAULT']['c_id']
                . " AND o_id NOT IN "
                . " (SELECT mqo_option_id FROM map_question_options m " 
                . " $pad) ORDER BY o.o_score ASC";
        */
        ($id != '' && $id > 0)? $pad = " WHERE m.mqd_dept_id_target = '$id' " : $pad = '';
        $query = "SELECT * FROM questions q WHERE q.q_enable = '".ENABLE."' "
                . " AND q_cat_id = ". $_SESSION['DEFAULT']['c_id']
                . " AND q_id NOT IN "
                . " (SELECT mqd_question_id FROM map_questions_department m " 
                . " $pad) ORDER BY q.q_id ASC";
        
        return $this->Select($query);
    }
    //+++++++++++MAPPING DEPARTMENTS / QUESTIONS 
    //
    //+++++++++++MAPPING UNITS / DEPARTMENTS
    public function ListAllMappingRecords($id = '') {
        ($id != '' && $id > 0)? $pad = " AND d_id = $id" : $pad = '';
        $query = "SELECT * FROM departments WHERE d_enable = '".ENABLE."' "
                . " AND d_c_id = ". $_SESSION['DEFAULT']['c_id']
                . " $pad ORDER BY d_name ASC";
        $records = $this->Select($query);
        return $this->MappingExtensions($records);
    }
    
    private function MappingExtensions($param) {
        foreach ($param as $key => $value) {
            $param[$key]["ext"] = $this->Select("SELECT m.*, d1.d_name d_source, d2.d_name d_destination FROM mapping m "
                    . "LEFT JOIN departments d1 ON (m.m_dept_id_source = d1.d_id) "
                    . "LEFT JOIN departments d2 ON (m.m_dept_id_destination = d2.d_id) "
                    . " WHERE d1.d_id = ".$value["d_id"] ." "
                    . " AND m_cat_id = ".$_SESSION["DEFAULT"]["c_id"] ." ORDER BY d_destination ASC");
        }
        return $param;
    }
    
    public function ListMappedDepartments($id = '') {
        ($id != '' && $id > 0)? $pad = " WHERE m.m_dept_id_source = '$id' AND m_cat_id = ".$_SESSION["DEFAULT"]["c_id"] : $pad = '';
        $query = "SELECT m.*, d.d_name FROM mapping m LEFT JOIN departments d ON (m.m_dept_id_destination=d.d_id)"
                . " $pad ORDER BY d.d_name ASC";
        return $this->Select($query);
    }
    
    public function ListNoneMappedDepartments($id = '') {
        ($id != '' && $id > 0)? $pad = " WHERE m_dept_id_source = '$id' AND m_cat_id = ".$_SESSION["DEFAULT"]["c_id"] : $pad = '';
        $query = "SELECT d.d_id, d.d_name FROM departments d WHERE d.d_enable = '".ENABLE."' "
                . " AND d_c_id = ". $_SESSION['DEFAULT']['c_id']
                . " AND d_id NOT IN "
                . "(SELECT m_dept_id_destination FROM mapping " //$pad (m.m_dept_id_destination=d.d_id)"
                . " $pad) ORDER BY d.d_name ASC";
        return $this->Select($query);
    }
    //+++++++++++MAPPING UNITS / DEPARTMENTS
    
    //+++++++++++MAPPING UNITS HEADS / MANAGERS +++++++++++++++++++++++
    public function ListAllUnitHeadMappingRecords($id = '') {
        ($id != '' && $id > 0)? $pad = " AND u_id = $id" : $pad = '';
        $query = "SELECT u.*, d.d_id, d.d_name FROM users u LEFT JOIN departments d ON (u.u_dept_id=d.d_id) "
                . "WHERE u_unit_head = 'Y' AND u_c_id = '".$_SESSION['DEFAULT']['c_id']."' AND u_enable = '".ENABLE."' $pad ORDER BY u_fullname ASC";
        $records = $this->Select($query);
        return $this->UnitHeadMappingExtensions($records);
    }
    
    private function UnitHeadMappingExtensions($param) {
        foreach ($param as $key => $value) {
            $param[$key]["ext"] = $this->Select("SELECT uh.*, d1.d_name d_target FROM unit_heads uh "
                    . "LEFT JOIN departments d1 ON (uh.uh_target_dept_id = d1.d_id) "
                    . " WHERE uh.uh_user_id = ".$value["u_id"] ." "
                    . " AND uh_cat_id = ".$_SESSION["DEFAULT"]["c_id"] ." ORDER BY d_target ASC");
        }
        return $param;
    }
    
    public function ListUnitHeadMappedDepartments($id = '') {
        ($id != '' && $id > 0)? $pad = " WHERE uh.uh_user_id = '$id' AND uh_cat_id = ".$_SESSION["DEFAULT"]["c_id"] : $pad = '';
        $query = "SELECT uh.*, d.d_name FROM unit_heads uh LEFT JOIN departments d ON (uh.uh_target_dept_id=d.d_id)"
                . " $pad ORDER BY d.d_name ASC";
//        echo $query;
        return $this->Select($query);
    }
    
    public function ListUnitHeadNoneMappedDepartments($id = '') {
        ($id != '' && $id > 0)? $pad = " WHERE uh_user_id = '$id' AND uh_cat_id = ".$_SESSION["DEFAULT"]["c_id"] : $pad = '';
        $query = "SELECT d.d_id, d.d_name FROM departments d WHERE d.d_enable = '".ENABLE."' "
                . " AND d_c_id = ". $_SESSION['DEFAULT']['c_id']
                . " AND d_id NOT IN "
                . "( SELECT uh_target_dept_id FROM unit_heads " //$pad (m.m_dept_id_destination=d.d_id)"
                . " $pad ) ORDER BY d.d_name ASC";
        return $this->Select($query);
    }
    //+++++++++++++ END UNIT HEADS HERE +++++++++++++++++++++++++++++++
    
    //+++++++++++MAPPING USERS / UNITS & DEPARTMENTS
    public function ListAllUsersMappingRecords($id = '') {
        ($id != '' && $id > 0)? $pad = " AND u_id = $id" : $pad = '';
        $query = "SELECT u.*, d.d_id, d.d_name FROM users u LEFT JOIN departments d ON (u.u_dept_id=d.d_id) WHERE u_c_id = '".$_SESSION['DEFAULT']['c_id']."' AND u_enable = '".ENABLE."' $pad ORDER BY u_fullname ASC";
        $records = $this->Select($query);
        return $this->UsersMappingExtensions($records);
    }
    
    private function UsersMappingExtensions($param) {
        foreach ($param as $key => $value) {
            $param[$key]["ext"] = $this->Select("SELECT m.*, d1.d_name d_target FROM map_user_departments m "
                    . "LEFT JOIN departments d1 ON (m.mud_target_dept_id = d1.d_id) "
                    . " WHERE m.mud_user_id = ".$value["u_id"] ." "
                    . " AND mud_cat_id = ".$_SESSION["DEFAULT"]["c_id"] ." ORDER BY d_target ASC");
        }
        return $param;
    }
    
    public function ListUsersMappedDepartments($id = '') {
        ($id != '' && $id > 0)? $pad = " WHERE m.mud_user_id = '$id' AND mud_cat_id = ".$_SESSION["DEFAULT"]["c_id"] : $pad = '';
        $query = "SELECT m.*, d.d_name FROM map_user_departments m LEFT JOIN departments d ON (m.mud_target_dept_id=d.d_id)"
                . " $pad ORDER BY d.d_name ASC";
//        echo $query;
        return $this->Select($query);
    }
    
    public function ListNoneUsersMappedDepartments($id = '') {
        ($id != '' && $id > 0)? $pad = " WHERE mud_user_id = '$id' AND mud_cat_id = ".$_SESSION["DEFAULT"]["c_id"] : $pad = '';
        $query = "SELECT d.d_id, d.d_name FROM departments d WHERE d.d_enable = '".ENABLE."' "
                . " AND d_c_id = ". $_SESSION['DEFAULT']['c_id']
                . " AND d_id NOT IN "
                . "( SELECT mud_target_dept_id FROM map_user_departments " //$pad (m.m_dept_id_destination=d.d_id)"
                . " $pad ) ORDER BY d.d_name ASC";
        return $this->Select($query);
    }
    //+++++++++++MAPPING USERS / UNITS & DEPARTMENTS
    
    public function DefaultSurveyCategory() {
        return $this->Select("SELECT c_id, c_name FROM categories WHERE c_default = '".ENABLE."' LIMIT 1");
    }
    
    public function ListDefaultQuestions($id = '') {
        ($id != '' && $id > 0)? $pad = " AND q.q_id = $id " : $pad = '';
        return $this->Select("SELECT q.*, c.c_name FROM questions q LEFT JOIN categories c ON (q.q_cat_id=c.c_id) WHERE"
                . " q.q_cat_id = (SELECT c_id FROM categories WHERE c_default = '".ENABLE."' LIMIT 1) $pad");
    }
    
    public function GetUnitMappingCategory($c_id) {
        return $this->Select("SELECT DISTINCT m.m_cat_id, c.* FROM mapping m LEFT JOIN categories c ON "
                . "(m.m_cat_id=c.c_id) WHERE m.m_cat_id != $c_id");
    }
    
    public function AutoGlobalConfigMapping($scum = '', $curr_cat_id = '') {
        if($scum == '' || $curr_cat_id == ''){
            
        }else{
            $this->MapUnits($scum, $curr_cat_id);//map units-to-units
            $this->MapUsers($scum, $curr_cat_id);//map users-to-units/departments
        }
    }
    
    private function MapUnits($scum, $curr_cat_id) {
        global $MESSAGE, $ERROR;
        $data = '';
        if($other_map = $this->Select("SELECT * FROM mapping WHERE m_cat_id = $scum")){
            foreach ($other_map as $key => $value) {
                if($this->Select("SELECT 1 FROM mapping WHERE m_dept_id_source = "
                        .$value["m_dept_id_source"]." AND m_dept_id_destination = ".$value["m_dept_id_destination"]
                        ." AND m_cat_id = $curr_cat_id")){
                    unset($other_map[$key]); // remove already mapped units record
                }else{
                    $data .= "(NULL,".$value["m_dept_id_source"].",".$value["m_dept_id_destination"].",$curr_cat_id),";
                }
            }
            if($data !== ''){
                $query = "INSERT INTO mapping (m_id, m_dept_id_source, m_dept_id_destination, m_cat_id) VALUES ".substr($data,0,-1);
                if($this->Insert($query)){
                    $MESSAGE[] = "Copying / Mapping Units successfully created";
                     $this->AuditLog("mapping","INSERT","Copying / Mapping user-unit(s) successful $data");
                }else{
                    $ERROR[] = "Mapping Units could not be completed";
                     $this->AuditLog("mapping","INSERT","Copying / Mapping user-unit(s) successful $data");
                }
            }
        }
    }
    
    private function MapUsers($scum, $curr_cat_id) {
        global $MESSAGE, $ERROR;
        $data = '';
        if($other_map = $this->Select("SELECT * FROM map_user_departments WHERE mud_cat_id = $scum")){
            foreach ($other_map as $key => $value) {
                if($this->Select("SELECT 1 FROM map_user_departments WHERE mud_user_id = ".$value["mud_user_id"]
                        . " AND mud_target_dept_id = ".$value["mud_target_dept_id"]
                        ." AND mud_cat_id = $curr_cat_id")){
                    unset($other_map[$key]); // remove already mapped units record
                }else{
                    $data .= "(NULL,".$value["mud_user_id"].",".$value["mud_target_dept_id"].",$curr_cat_id),";
                }
            }
            if($data !== ''){
                $query = "INSERT INTO map_user_departments (mud_id, mud_user_id, mud_target_dept_id, mud_cat_id) VALUES ".substr($data,0,-1);
                if($this->Insert($query)){
                    $MESSAGE[] = "Copying / Mapping Users successfully created";
                    $this->AuditLog("map_user_departments","INSERT","Copying / Mapping user-unit(s) successful $data");
                }else{
                    $ERROR[] = "Copying / Mapping Users could not be completed";
                    $this->AuditLog("map_user_departments","INSERT","Copying / Mapping user-unit(s) successful $data");
                }
            }
        }
    }
}
$cControllers = new cControllers();


if (!empty($_REQUEST) && !empty($_REQUEST["form"])){
    
    switch ($_REQUEST["form"]) {
        //++++++++++++++++++QUESTIONS
        case "add_question":
            if (isset($_POST["btnadd"])){
                $q_name = trim(filter_input(INPUT_POST, 'q_name',  FILTER_SANITIZE_STRING));
                $q_enable = filter_input(INPUT_POST, 'q_enable',  FILTER_SANITIZE_STRING);
                $q_cat_id = filter_input(INPUT_POST, 'q_cat_id',  FILTER_SANITIZE_STRING);
                $q_max_score = filter_input(INPUT_POST, 'q_max_score',  FILTER_SANITIZE_STRING);
                if ($q_name != ''){
                    $query = "INSERT INTO questions (q_id, q_cat_id, q_name, q_enable, q_date, q_max_score) VALUES (NULL, $q_cat_id, '$q_name', '$q_enable', '".A_DATE."', $q_max_score)";
                    if ($cControllers->Insert($query)){
                        $MESSAGE[] = 'Question added successfully ID: '. $cControllers->insert_id;
                        $cConnect->AuditLog("questions","INSERT","Question added successfully");
                    }else{
                        $ERROR[] = 'Question could not be added';
                        $cConnect->AuditLog("questions","INSERT","Question could not be added");
                    }
                }
            }
            break;
        case "save_question":
            if (isset($_POST["btnsave"])){
                $q_name = filter_input(INPUT_POST, 'q_name',  FILTER_SANITIZE_STRING);
                $q_enable = filter_input(INPUT_POST, 'q_enable',  FILTER_SANITIZE_STRING);
                $q_cat_id = filter_input(INPUT_POST, 'q_cat_id',  FILTER_SANITIZE_STRING);
                $q_max_score = filter_input(INPUT_POST, 'q_max_score',  FILTER_SANITIZE_STRING);
                $q_id = filter_input(INPUT_POST, 'id',  FILTER_SANITIZE_STRING);
                if ($q_name != ''){
                    $query = "UPDATE questions SET q_cat_id = $q_cat_id, q_name = '$q_name', q_enable = '$q_enable', q_max_score = $q_max_score WHERE q_id=$q_id";
                    if ($cControllers->Update($query)){
                        $MESSAGE[] = 'Question updated successfully';
                        $cConnect->AuditLog("questions","INSERT","Question updated successfully");
                    }else{
                        $ERROR[] = 'Question could not be updated';
                        $cConnect->AuditLog("questions","INSERT","Question could not be updated");
                    }
                }
            }
            break;
        //++++++++++++++++++OPTIONS
        case "add_option":
            if (isset($_POST["btnadd"])){
                $o_name = trim(filter_input(INPUT_POST, 'o_name',  FILTER_SANITIZE_STRING));
                $o_enable = filter_input(INPUT_POST, 'o_enable',  FILTER_SANITIZE_STRING);
                $o_score = filter_input(INPUT_POST, 'o_score',  FILTER_SANITIZE_STRING);
                $o_percent = filter_input(INPUT_POST, 'o_percent',  FILTER_SANITIZE_STRING);
                if ($o_name != ''){
                    $query = "INSERT INTO options (o_id, o_name, o_score, o_percent, o_enable, o_date, o_c_id) VALUES "
                            . "(NULL, '$o_name', '$o_score', $o_percent, '$o_enable', '".A_DATE."', ".$_SESSION['DEFAULT']['c_id'].")";
                    if ($cControllers->Insert($query)){
                        $MESSAGE[] = 'Option added successfully ID: '. $cControllers->insert_id;
                        $cConnect->AuditLog("options","INSERT","Option added successfully");
                    }else{
                        $ERROR[] = 'Option could not be added';
                        $cConnect->AuditLog("options","INSERT","Option could not be added");
                    }
                }
            }
            break;
        case "save_option":
            if (isset($_POST["btnsave"])){
                $o_name = filter_input(INPUT_POST, 'o_name',  FILTER_SANITIZE_STRING);
                $o_enable = filter_input(INPUT_POST, 'o_enable',  FILTER_SANITIZE_STRING);
                $o_score = filter_input(INPUT_POST, 'o_score',  FILTER_SANITIZE_STRING);
                $o_percent = filter_input(INPUT_POST, 'o_percent',  FILTER_SANITIZE_STRING);
                $o_id = filter_input(INPUT_POST, 'id',  FILTER_SANITIZE_STRING);
                if ($o_name != ''){
                    $query = "UPDATE options SET o_score = $o_score, o_name = '$o_name', o_percent = $o_percent, o_enable = '$o_enable' WHERE o_id=$o_id";
                    if ($cControllers->Update($query)){
                        $MESSAGE[] = 'Option updated successfully';
                        $cConnect->AuditLog("options","UPDATE","Option updated successfully");
                    }else{
                        $ERROR[] = 'Option could not be updated';
                        $cConnect->AuditLog("options","UPDATE","Option could not be updated");
                    }
                }
            }
            break;
        //++++++++++++++CATEGOPRY    
        case "add_category":
            if (isset($_POST["btnadd"])){
                $c_name = filter_input(INPUT_POST, 'c_name',  FILTER_SANITIZE_STRING);
                $c_default = filter_input(INPUT_POST, 'c_default',  FILTER_SANITIZE_STRING);
                if ($c_name != ''){
                    $query = "INSERT INTO categories (c_id, c_name, c_default, c_date) VALUES (NULL, '$c_name', '$c_default', '".A_DATE."')";
                    if ($cControllers->Insert($query)){
                        $MESSAGE[] = 'Category added successfully ID: '. $cControllers->insert_id;
                        $cControllers->SetDefaultSurvey();
                        $cConnect->AuditLog("categories","INSERT","Category added successfully");
                    }else{
                        $ERROR[] = 'Category could not be added';
                        $cConnect->AuditLog("categories","INSERT","Category could not be added");
                    }
                }
            }
            break;
        case "save_category":
            if (isset($_POST["btnsave"])){
                $c_name = filter_input(INPUT_POST, 'c_name',  FILTER_SANITIZE_STRING);
                $c_default = filter_input(INPUT_POST, 'c_default',  FILTER_SANITIZE_STRING);
                $c_id = filter_input(INPUT_POST, 'id',  FILTER_SANITIZE_STRING);
                if ($c_name != ''){
                    $query = "UPDATE categories SET c_name = '$c_name', c_default = '$c_default' WHERE c_id=$c_id";
                    if ($cControllers->Update($query)){
                        $MESSAGE[] = 'Category updated successfully';
                        $cControllers->SetDefaultSurvey();
                        if($c_default == ENABLE){
                            $cControllers->Update("UPDATE categories SET c_default = '".DISABLE."' WHERE c_id <> $c_id");
                        }
                        $cConnect->AuditLog("categories","UPDATE","Category updated successfully");
                    }else{
                        $ERROR[] = 'Category could not be updated';
                        $cConnect->AuditLog("categories","UPDATE","Category could not be updated");
                    }
                }
            }
            break;
        
        //+++++++++++DEPARTMENTS    
        case "add_department":
            if (isset($_POST["btnadd"])){
                $d_name = filter_input(INPUT_POST, 'd_name',  FILTER_SANITIZE_STRING);
                $d_enable = filter_input(INPUT_POST, 'd_enable',  FILTER_SANITIZE_STRING);
                if ($d_name != ''){
                    $query = "INSERT INTO departments (d_id, d_name, d_enable, d_date, d_c_id) VALUES (NULL, '$d_name', '$d_enable', '".A_DATE."', ".$_SESSION['DEFAULT']['c_id'].")";
                    if ($cControllers->Insert($query)){
                        $MESSAGE[] = 'Department added successfully ID: '. $cControllers->insert_id;
                        $cConnect->AuditLog("departments","INSERT","Department added successfully");
                    }else{
                        $ERROR[] = 'Department could not be added';
                        $cConnect->AuditLog("departments","INSERT","Department could not be added");
                    }
                }
            }
            break;
        case "save_department":
            if (isset($_POST["btnsave"])){
                $d_name = filter_input(INPUT_POST, 'd_name',  FILTER_SANITIZE_STRING);
                $d_enable = filter_input(INPUT_POST, 'd_enable',  FILTER_SANITIZE_STRING);
                $d_id = filter_input(INPUT_POST, 'id',  FILTER_SANITIZE_STRING);
                if ($d_name != ''){
                    $query = "UPDATE departments SET d_name = '$d_name', d_enable = '$d_enable' WHERE d_id=$d_id";
                    if ($cControllers->Update($query)){
                        $MESSAGE[] = 'Department updated successfully';
                        $cConnect->AuditLog("departments","UPDATE","Department updated successfully $d_enable");
                    }else{
                        $ERROR[] = 'Department could not be updated';
                        $cConnect->AuditLog("departments","UPDATE","Department could not be updated $d_enable");
                    }
                }
            }
            break;
        
            
         //+++++++++++LOGIN   
        case "add_login":
            if (isset($_POST["btnadd"])){
                $l_username = filter_input(INPUT_POST, 'l_username',  FILTER_SANITIZE_STRING);
                $l_enable = filter_input(INPUT_POST, 'l_enable',  FILTER_SANITIZE_STRING);
                $l_fullname = filter_input(INPUT_POST, 'l_fullname',  FILTER_SANITIZE_STRING);
                $l_email = filter_input(INPUT_POST, 'l_email',  FILTER_SANITIZE_STRING);
                $l_password = $cControllers->ResetPasswordCode(); 
                if ($l_username !== '' && $l_fullname !== '' && $l_email !== ''){
                    $query = "INSERT INTO login (l_id, l_username, l_fullname, l_password, l_email, l_enable) VALUES "
                        . "(NULL, '$l_username', '$l_fullname', '$l_password', '$l_email', '$l_enable')";
                    if ($cControllers->Insert($query)){
                        $MESSAGE[] = 'LOGIN user added successfully ID: '. $cControllers->insert_id;
                        $cConnect->AuditLog("logins","INSERT","LOGIN user added successfully");
                    }else{
                        $ERROR[] = 'LOGIN user could not be added';
                        $cConnect->AuditLog("login","INSERT","LOGIN user could not be added $l_fullname");
                    }
                }
            }
            break;
            
        case "save_login":
            if (isset($_POST["btnsave"])){
                $l_enable = filter_input(INPUT_POST, 'l_enable',  FILTER_SANITIZE_STRING);
                $l_fullname = filter_input(INPUT_POST, 'l_fullname',  FILTER_SANITIZE_STRING);
                $l_email = filter_input(INPUT_POST, 'l_email',  FILTER_SANITIZE_STRING);
                $l_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                if ($l_fullname !=='' && $l_email !==''){
                    $query = "UPDATE login SET l_fullname ='$l_fullname', l_email ='$l_email', l_enable = '$l_enable'"
                            . " WHERE l_id=$l_id";
                    if ($cControllers->Update($query)){
                        $MESSAGE[] = 'LOGIN user updated successfully';
                        $cConnect->AuditLog("login","UPDATE","LOGIN user updated successfully");
                    }else{
                        $ERROR[] = 'LOGIN user could not be updated';
                        $cConnect->AuditLog("login","UPDATE","LOGIN user could not be updated");
                    }
                }
            }
            break;
            
        case "changepassword":
            $old_pass = filter_input(INPUT_POST, 'old_pass',  FILTER_SANITIZE_STRING);
            $new_pass = filter_input(INPUT_POST, 'new_pass',  FILTER_SANITIZE_STRING);
            $confirm_new_pass = filter_input(INPUT_POST, 'confirm_new_pass', FILTER_SANITIZE_STRING);
            $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
            if ($_POST["btnchangepassword"]){
                if ($old_pass === '' || $new_pass === '' || $confirm_new_pass === ''){
                    $ERROR[] = "Either of the field(s) empty";
                }elseif ($new_pass !== $confirm_new_pass){
                    $ERROR[] = "New Password not match";
                }else{
                    $rec = $cControllers->Select("SELECT 1 FROM login WHERE l_id = $id AND l_password = '$old_pass'");
                    if ($rec){
                        if ($cControllers->Update("UPDATE login SET l_password = '$new_pass'"
                                . ", l_last_login_date = '".A_DATE."', l_last_login_time = '".A_TIME."' WHERE l_id = $id")){
                            $MESSAGE[] = "Password successfully changed: $new_pass for ID: $id";
                            $cConnect->AuditLog("login","CHANGE PASSWORD","Password successfully changed");
                        }
                    }else{
                         $ERROR[] = "Invalid old password: $old_pass for ID: $id";
                         $cConnect->AuditLog("login","CHANGE PASSWORD","Invalid old password");
                    }
                }
            }
            break;    
         //+++++++++++USERS  
        case "add_user":
            if (isset($_POST["btnadd"])){
                
                if(!filter_input(INPUT_POST, 'u_email', FILTER_VALIDATE_EMAIL)){
                    $ERROR[] = "Invalid input for username or email. Both must be valid email address";
                    break;
                }
                $u_username = filter_input(INPUT_POST, 'u_username',  FILTER_SANITIZE_STRING);
                $u_enable = filter_input(INPUT_POST, 'u_enable',  FILTER_SANITIZE_STRING);
                $u_fullname = filter_input(INPUT_POST, 'u_fullname',  FILTER_SANITIZE_STRING);
                $u_email = filter_input(INPUT_POST, 'u_email',  FILTER_SANITIZE_STRING);
                $u_dept_id = filter_input(INPUT_POST, 'u_dept_id',  FILTER_SANITIZE_NUMBER_INT);
                $u_password = $cControllers->ResetPasswordCode(); 
                $category_id = $_SESSION['DEFAULT']['c_id'];
                if ($u_username !== '' && $u_fullname !== '' && $u_email !== ''){
                    if($cControllers->Select("SELECT 1 FROM users WHERE u_username = '$u_username' AND u_c_id = $category_id")){
                        $ERROR[] = "User already exist with $u_username";
                        break;
                    }
                    
                    $query = "INSERT INTO users (u_id, u_username, u_fullname, u_password, u_email, u_enable, u_dept_id, u_c_id) VALUES "
                        . "(NULL, '$u_username', '$u_fullname', '$u_password', '$u_email', '$u_enable', $u_dept_id, $category_id)";
                    if ($cControllers->Insert($query)){
                        $MESSAGE[] = 'User added successfully ID: '. $cControllers->insert_id;
                        $cConnect->AuditLog("users","SURVEY","User added successfully");
                    }else{
                        $ERROR[] = 'User could not be added';
                        $cConnect->AuditLog("users","SURVEY","User could not be added");
                    }
                }
            }
            break;
            
        case "save_user":
            if (isset($_POST["btnsave"])){
                $u_enable = filter_input(INPUT_POST, 'u_enable',  FILTER_SANITIZE_STRING);
                $u_fullname = filter_input(INPUT_POST, 'u_fullname',  FILTER_SANITIZE_STRING);
                $u_email = filter_input(INPUT_POST, 'u_email',  FILTER_SANITIZE_STRING);
                $u_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);
                $u_dept_id = filter_input(INPUT_POST, 'u_dept_id',  FILTER_SANITIZE_NUMBER_INT);
                if ($u_fullname !=='' && $u_email !==''){
                    $query = "UPDATE users SET u_fullname ='$u_fullname', u_email ='$u_email', u_enable = '$u_enable'"
                            . ", u_dept_id = $u_dept_id WHERE u_id=$u_id";
                    if ($cControllers->Update($query)){
                        $MESSAGE[] = 'User updated successfully';
                        $cConnect->AuditLog("users","UPDATE","User updated successfully");
                    }else{
                        $ERROR[] = 'User could not be updated';
                        $cConnect->AuditLog("users","UPDATE","User could not be updated");
                    }
                }
            }
            break;
        case "list_user":
            if (isset($_POST["btnsubmitaction"])){
                $u_unit_head = filter_input(INPUT_POST, 'u_unit_head',  FILTER_SANITIZE_STRING);
                $data ='';
                foreach ($_POST["id"] as $key => $value) {
                    $data .= "$value,";
                }
                
                if ($u_unit_head !=='' && $data != ''){
                    $data = substr($data, 0, -1);
                    $query = "UPDATE users SET u_unit_head ='$u_unit_head' WHERE u_id IN ($data)";
//                    echo $query;
                    if ($cControllers->Update($query)){
                        $MESSAGE[] = 'Action updated successfully';
                        $cConnect->AuditLog("users","UPDATE","User action updated successfully for users ($data) with [ $u_unit_head ]");
                    }else{
                        $ERROR[] = 'Action could not be updated';
                        $cConnect->AuditLog("users","UPDATE","User action could not be updated for users ($data) with [ $u_unit_head ]");
                    }
                }
            }
            break;
        case "users_upload":
            if (isset($_POST['btnupload'])) {
                if (($_FILES['filename']['type'] !== 'application/csv') && ($_FILES['filename']['type'] !== 'application/vnd.ms-excel')
                        && ($_FILES['filename']['type'] !== 'application/ms-excel')) {// verify upload file
                    $ERROR[] = "Invalid file type : ".$_FILES['filename']['type'];
                    break;
                } 
                
                $pass = $cControllers->ResetPasswordCode();
                $category_id = $_SESSION['DEFAULT']['c_id'];
                
                if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
                    //readfile($_FILES['filename']['tmp_name']);
                    $handle = fopen($_FILES['filename']['tmp_name'], "r");
                    $i = 0; $succ = 0; $fail = 0; $dup = 0; $values = '';// ALL initalization doen here
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $i++;
                        if ($i == 1)                                
                                continue; //ignore headers from list
                        
                        $data[0] = trim($data[0]);
                        $data[1] = trim($data[1]);
                        $data[2] = trim($data[2]);
                        
                        if ($data[0] !== '' && $data[1] !== '' && $data[2] !== '')
                        {
                            if ($cControllers->Select("SELECT 1 FROM users WHERE u_email = '$data[1]' AND u_c_id = $category_id LIMIT 1"))
                            {
                                $dup++;
                                continue;
                            }
                            $succ++;
//                            list($data[4]) = explode("@", $data[1]); //get username
//                            $data[2] = ($data[2] === "Y") ? "Y" : "N"; //get line manager
//                            $data[5] = ENABLE;
//                            $data[6] = 5;
//                            $data[7] = A_DATE;
//                            $data[8] = A_TIME;
//                            $data[9] = $cUsers->ResetPasswordCode();
                            $values .= "('NULL','$data[0]','$data[1]','$data[2]','".ENABLE."','".ENABLE."','$data[1]','$pass',$category_id),";
                            $succ_data[] = $data;
                        }else{
                            $fail++;
                        }
                    }
                    fclose($handle);
                   
                    if ($values !== ''){
                       $import = "INSERT INTO users (u_id, u_fullname,u_email,u_dept_id,u_enable,u_visibility,u_username,u_password, u_c_id) VALUES ";
                       $values = substr($values, 0, -1);
                       $query = $import . $values;
                       $cControllers->Insert($query);
                       $cControllers->AuditLog("users","INSERT-UPLOAD","Uploaded $succ users successfully");
                   }
                }
                $MESSAGE[] = "File ". $_FILES['filename']['name'] ." uploaded successfully. Import done { total(" .($i-1). "),  success($succ),  failed($fail),  duplication($dup) }";
            }
	    break;
            
        //+++++++++++MAPPING UNITS/DEPARTMENT
        case "add_mapping":
            if (isset($_POST["btnadd"])){      //          var_dump($_REQUEST);
                $m_dept_id_source = filter_input(INPUT_POST, 'm_dept_id_source',  FILTER_SANITIZE_NUMBER_INT);
                $data = '';
                foreach ($_POST["m_dept_id_destination"] as $key => $value) {
                    if (!$cControllers->Select("SELECT 1 FROM mapping WHERE m_dept_id_source = $m_dept_id_source "
                            . "AND m_dept_id_destination = $value AND m_cat_id=".$_SESSION["DEFAULT"]["c_id"]))
                    {
                        $data .= "(NULL, $m_dept_id_source, $value, ".$_SESSION["DEFAULT"]["c_id"]."),";
                    }
                }
                if ($data !== ''){
                    if($cControllers->Insert("INSERT INTO mapping (m_id, m_dept_id_source, m_dept_id_destination, m_cat_id) "
                            . "VALUES ". substr($data, 0, -1))){
                        $MESSAGE[] = "Mapping successful";
                        $cConnect->AuditLog("mapping","INSERT","Mapping successful $data");
                    }else{
                        $ERROR[] = "Mapping could not be completed";
                        $cConnect->AuditLog("mapping","INSERT","Mapping could not be completed $data");
                    }
                }
            } elseif (isset($_REQUEST["btnremove"])) {// && isset($_REQUEST["id"]) && ($_REQUEST["cmd"] = "delete")){ 
                foreach ($_REQUEST["btnremove"] as $key => $value) {
                    if ($cControllers->Delete("DELETE FROM mapping WHERE m_id = $key")){
                        $MESSAGE[] = 'Mapping removed successfully';
                        $cConnect->AuditLog("mapping","DELETE","Mapping removed successfully m_id = $key");
                    }else{
                        $ERROR[] = 'Mapping could not be removed';
                        $cConnect->AuditLog("mapping","DELETE","Mapping could not be removed m_id = $key");
                    }
                }
            }
            break;
        //+++++++++++MAPPING QUESTIONS / OPTIONS
        case "save_map_questions":
            if (isset($_POST["btnadd"])){      //          var_dump($_REQUEST);
                $mqo_question_id = filter_input(INPUT_POST, 'mqo_question_id',  FILTER_SANITIZE_NUMBER_INT);
                $data = '';
                foreach ($_POST["mqo_option_id"] as $key => $value) {
                    if (!$cControllers->Select("SELECT 1 FROM map_question_options WHERE mqo_question_id = $mqo_question_id "
                            . "AND mqo_option_id = $value"))
                    {
                        $data .= "(NULL, $mqo_question_id, $value),";
                    }
                }
                if ($data !== ''){
                    if($cControllers->Insert("INSERT INTO map_question_options (mqo_id, mqo_question_id, mqo_option_id) "
                            . "VALUES ". substr($data, 0, -1))){
                        $MESSAGE[] = "Question/Options is successful";
                        $cConnect->AuditLog("map_question_options","QUESTIONS/OPTIONS MAPPING","Question/Options is successful $data");
                    }else{
                        $ERROR[] = "Question/Options could not be completed";
                        $cConnect->AuditLog("map_question_options","QUESTIONS/OPTIONS MAPPING","Question/Options could not be completed $data");
                    }
                }
            } elseif (isset($_REQUEST["btnremove"])) {// && isset($_REQUEST["id"]) && ($_REQUEST["cmd"] = "delete")){ 
                foreach ($_REQUEST["btnremove"] as $key => $value) {
                    if ($cControllers->Delete("DELETE FROM map_question_options WHERE mqo_id = $key")){
                        $MESSAGE[] = 'Option removed successfully';
                        $cConnect->AuditLog("map_question_options","QUESTIONS/OPTIONS MAPPING","Option removed successfully mqo_id = $key");
                    }else{
                        $ERROR[] = 'Option could not be removed';
                        $cConnect->AuditLog("map_question_options","QUESTIONS/OPTIONS MAPPING","Option could not be removed mqo_id = $key");
                    }
                }
            }
            break;
        //+++++++++++MAPPING DEPARTMENT / QUESTIONS
        case "save_map_department_questions":
            if (isset($_POST["btnadd"])){      //          var_dump($_REQUEST);
                $mqd_dept_id_target = filter_input(INPUT_POST, 'mqd_dept_id_target',  FILTER_SANITIZE_NUMBER_INT);
                $data = '';
                foreach ($_POST["mqd_question_id"] as $key => $value) {
                    if (!$cControllers->Select("SELECT 1 FROM map_questions_department WHERE mqd_dept_id_target = $mqd_dept_id_target "
                            . "AND mqd_question_id = $value"))
                    {
                        $data .= "(NULL,  $value, $mqd_dept_id_target,".$_SESSION['DEFAULT']['c_id']." ),";
                    }
                }
                if ($data !== ''){
                    if($cControllers->Insert("INSERT INTO map_questions_department (mqd_id, mqd_question_id, mqd_dept_id_target, mqd_cat_id) "
                            . "VALUES ". substr($data, 0, -1))){
                        $MESSAGE[] = "Question/Options is successful";
                        $cConnect->AuditLog("map_question_options","QUESTIONS/OPTIONS MAPPING","Question/Options is successful $data");
                    }else{
                        $ERROR[] = "Question/Options could not be completed";
                        $cConnect->AuditLog("map_question_options","QUESTIONS/OPTIONS MAPPING","Question/Options could not be completed $data");
                    }
                }
            } elseif (isset($_REQUEST["btnremove"])) {// && isset($_REQUEST["id"]) && ($_REQUEST["cmd"] = "delete")){ 
                foreach ($_REQUEST["btnremove"] as $key => $value) {
                    if ($cControllers->Delete("DELETE FROM map_questions_department WHERE mqd_id = $key")){
                        $MESSAGE[] = 'Questions removed successfully';
                        $cConnect->AuditLog("map_question_options","DEPARTMENTS/QUESTIONS MAPPING","Questions removed successfully mqd_id = $key");
                    }else{
                        $ERROR[] = 'Questions could not be removed';
                        $cConnect->AuditLog("map_questions_department","DEPARTMENTS/QUESTIONS MAPPING","Questions could not be removed mqd_id = $key");
                    }
                }
            }
            break;
        //copy existing mapping values to current survey category    
        case "copy_units_mapping":
            if(isset($_REQUEST["btncopymap"]) && ($_REQUEST["select_copy_units_mapping"] !== '')){
                $scum = (int)$_REQUEST["select_copy_units_mapping"];
                $curr_cat_id = $_SESSION["DEFAULT"]["c_id"];
                $cControllers->AutoGlobalConfigMapping($scum, $curr_cat_id);
            }
            break;
        //copy existing mapping values to current survey category    
        case "copy_users_mapping":
            if(isset($_REQUEST["btncopymap"]) && ($_REQUEST["select_copy_units_mapping"] !== '')){
                $scum = (int)$_REQUEST["select_copy_units_mapping"];
                $curr_cat_id = $_SESSION["DEFAULT"]["c_id"];
                $cControllers->AutoGlobalConfigMapping($scum, $curr_cat_id);
            }
            break;
        
        //+++++++++++MAPPING UNITS/DEPARTMENT
        case "add_users_mapping":
            if (isset($_POST["btnadd"])){      //          var_dump($_REQUEST);
                $mud_user_id = filter_input(INPUT_POST, 'mud_user_id',  FILTER_SANITIZE_NUMBER_INT);
                $data = '';
                foreach ($_POST["mud_target_dept_id"] as $key => $value) {
                    if (!$cControllers->Select("SELECT 1 FROM map_user_departments WHERE mud_user_id = $mud_user_id "
                            . "AND mud_target_dept_id = $value AND mud_cat_id=".$_SESSION["DEFAULT"]["c_id"]))
                    {
                        $data .= "(NULL, $mud_user_id, $value, ".$_SESSION["DEFAULT"]["c_id"]."),";
                    }
                }
                
                if ($data !== ''){
                    if($cControllers->Insert("INSERT INTO map_user_departments (mud_id, mud_user_id, mud_target_dept_id, mud_cat_id) "
                            . "VALUES ". substr($data, 0, -1))){
                        $MESSAGE[] = "Mapping user-unit(s) successful";
                        $cConnect->AuditLog("map_user_departments","INSERT","Mapping user-unit(s) successful $data");
                    }else{
                        $ERROR[] = "Mapping user-unit(s) could not be completed";
                        $cConnect->AuditLog("map_user_departments","INSERT","Mapping user-unit(s) could not be completed $data");
                    }
                }
            } elseif (isset($_REQUEST["btnremove"])) {// && isset($_REQUEST["id"]) && ($_REQUEST["cmd"] = "delete")){ 
                foreach ($_REQUEST["btnremove"] as $key => $value) {
                    if ($cControllers->Delete("DELETE FROM map_user_departments WHERE mud_id = $key")){
                        $MESSAGE[] = 'Mapping user-unit(s) removed successfully';
                        $cConnect->AuditLog("map_user_departments","DELETE","Mapping removed successfully mud_id = $key");
                    }else{
                        $ERROR[] = 'Mapping user-unit(s) could not be removed';
                        $cConnect->AuditLog("map_user_departments","DELETE","Mapping could not be removed mud_id = $key");
                    }
                }
            }
            break;
        case "add_unit_heads_mapping":
            if (isset($_POST["btnadd"])){      //          var_dump($_REQUEST);
                $uh_user_id = filter_input(INPUT_POST, 'uh_user_id',  FILTER_SANITIZE_NUMBER_INT);
                $data = '';
                foreach ($_POST["uh_target_dept_id"] as $key => $value) {
                    if (!$cControllers->Select("SELECT 1 FROM unit_heads WHERE uh_user_id = $uh_user_id "
                            . "AND uh_target_dept_id = $value AND uh_cat_id=".$_SESSION["DEFAULT"]["c_id"]))
                    {
                        $data .= "(NULL, $uh_user_id, $value, ".$_SESSION["DEFAULT"]["c_id"]."),";
                    }
                }
//                echo $data;
                if ($data !== ''){
                    if($cControllers->Insert("INSERT INTO unit_heads (uh_id, uh_user_id, uh_target_dept_id, uh_cat_id) "
                            . "VALUES ". substr($data, 0, -1))){
                        $MESSAGE[] = "Mapping unit-heads to unit(s) successful";
                        $cConnect->AuditLog("unit_heads","INSERT","Mapping unit-heads to unit(s) successful $data");
                    }else{
                        $ERROR[] = "Mapping unit-heads to unit(s) could not be completed";
                        $cConnect->AuditLog("unit_heads","INSERT","Mapping unit-heads to unit(s) could not be completed $data");
                    }
                }
            } elseif (isset($_REQUEST["btnremove"])) {// && isset($_REQUEST["id"]) && ($_REQUEST["cmd"] = "delete")){ 
                foreach ($_REQUEST["btnremove"] as $key => $value) {
                    if ($cControllers->Delete("DELETE FROM unit_heads WHERE uh_id = $key")){
                        $MESSAGE[] = 'Mapping unit-heads to unit(s) removed successfully';
                        $cConnect->AuditLog("unit_heads","DELETE","Mapping unit-heads to unit removed successfully uh_id = $key");
                    }else{
                        $ERROR[] = 'Mapping user-unit(s) could not be removed';
                        $cConnect->AuditLog("unit_heads","DELETE","Mapping unit-heads to unit could not be removed uh_id = $key");
                    }
                }
            }
            break;
        default:
            break;
    }
}