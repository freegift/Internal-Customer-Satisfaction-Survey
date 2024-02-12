<?php
if (!isset($_SESSION)){
    session_start();
}

class Login extends Connect {
    
    public $username;
    public $password;
    
    public function LoginPass($username, $password) {
        //filter the input parameters before query
//        $this->FilterLogin($username, $password);
       
        $record = $this->Select("SELECT * FROM login WHERE l_username = '".$username."' && l_password = '".$password."'"
                . " LIMIT 1");
//        echo 'password: '.$this->password;
//        var_dump($record);
        if ($record){
            if ($this->num_rows > 0) {
               return $this->RegisterUser($record[0]);
            }
        } else { //die("ok");
            return "User not exist or password not valid. Contact Support: support@cornerstone.com.ng";
        }
    }

//    private function FilterLogin($username, $password) {
//        $this->username = filter_var($username, FILTER_SANITIZE_STRING);
//        $this->password = filter_var($password, FILTER_SANITIZE_STRING);
//    }
    
    private function RegisterUser($user) {
        
        if ($user["l_enable"] == DISABLE){                  
            return "User account disabled. Contact System Admin: support@cornerstone.com.ng";
        }
        
//        $_SESSION["LOGIN"]["US_DEPT_NAME"] = $this->GetDepartmentName($user["US_DEPT_ID"]);
        //$_SESSION["LOGIN"]["US_ROLE_NAME"] = $this->GetRoleName($user["US_ROLE_ID"]);
        
        
        
        foreach ($user as $u => $v){
            $_SESSION["LOGIN"][$u] = $v;
        }  
        
//        if ($user["US_ROLE_ID"] == 0){
//            return "User have no ROLE assigned. Contact Admin: support@cornerstone.com.ng";
//        }
//        //set/get session for user role/privileges
//        return $this->GetUserRolePrivileges($user["US_ROLE_ID"]);
        
        if($result = $this->Select("SELECT * FROM categories WHERE c_default = '". ENABLE . "' LIMIT 1"))
        {
            $_SESSION['DEFAULT']['c_id'] = $result[0]['c_id'];
            $_SESSION['DEFAULT']['c_name'] = $result[0]['c_name'];
        }else{
            
        }
        
    }
    
//    private function GetDepartmentName($id) {
//        $record = $this->Select("SELECT DEPT_NAME FROM departments WHERE DEPT_ID = $id");
//        if ($record){
//            return $record[0]["DEPT_NAME"];
//        }
//    }
    
//    private function GetUserRolePrivileges($roleid) {
//        $role = $this->Select(
//                "SELECT ROLE_NAME, ROLE_PRIVILEGES_ID FROM roles WHERE ROLE_ID = $roleid AND ROLE_ENABLE = '" 
//                . ENABLE ."' LIMIT 1");
//        if ($role){
//            $_SESSION["ROLE"]["NAME"] = $role[0]["ROLE_NAME"];
//            //get privileges from this role
//            //$priv_ids = explode(",",$role[0]["ROLE_PRIVILEGES_ID"]);
//            if ($role[0]["ROLE_PRIVILEGES_ID"] === NULL){
//               return "No privilege(s) hanve been assigned to the current user. Contact ADMIN: support@cornerstone.com.ng";
//            }
//            
//            $priv = $this->Select("SELECT PR_NAME FROM privileges WHERE PR_ID IN ("
//                    . $role[0]["ROLE_PRIVILEGES_ID"] . ") AND PR_ENABLE='" . ENABLE ."'");
//            if ($priv){
//                //$_SESSION["ROLE_PRIV"] = $priv;
//                return $this->GetRoles($priv);
//            } else {
//                return "User privilege(s) not Enabled. Contact ADMIN: support@cornerstone.com.ng";
//            }
//            
//        } else {
//            return "User ROLE not enabled. Contact Administrator: support@cornerstone.com.ng";
//        }
//    }
//    
//    private function GetRoles($param) {
//        $i = 0;//initialize array index
//        foreach ($param as $priv => $value){
//            $i++;
//            $_SESSION["ROLE_PRIV"][$i] = $value["PR_NAME"];
//        }
//        $this->SetCurrentInfo();
//    }
    
    public function SetCurrentInfo() { //echo 'good';
        $ldate = A_DATE; $ltime = A_TIME;
        $query = "UPDATE login SET l_last_login_date = '$ldate', l_last_login_time = '$ltime' "
                . "WHERE l_username = '".$_SESSION["LOGIN"]["l_username"]."'";
//        echo 'seen';
        $this->Update($query);
        
        
    }
    
}
$cLogin = new Login();
        

if (isset($_POST["btnlogin"])){
    global $ERROR;
    
    $cLogin->username = filter_input(INPUT_POST, 'us_username', FILTER_SANITIZE_STRING);
    $cLogin->password = filter_input(INPUT_POST, 'us_password', FILTER_SANITIZE_STRING);
//    echo 'login: ' .$cLogin->username;
//    $reply = $cLogin->LoginPass($_POST["us_username"], $_POST["us_password"]);
//    echo 'pass: '.$cLogin->password;
    $reply = $cLogin->LoginPass($cLogin->username, $cLogin->password);
    
    if ($reply){
        
        $desc = ' IP: ' .$_SERVER['REMOTE_ADDR']. ' by '. $cLogin->username;
        $values = "Atempted login. Access denied [ $reply ]" . ' - ' .$desc;
        $date = A_DATE;
        $time = A_TIME;
        $query = "INSERT INTO audit_log (a_id, a_table, a_action, a_description, a_date, a_time) VALUES "
                . "(NULL,'login','LOGIN','$desc', '$date', '$time')";
        $cLogin->Insert($query);
        $ERROR[] = $reply;
    }else{
        $cLogin->SetCurrentInfo();
        $cLogin->AuditLog("login","LOGIN","Successful login");
        header("Location: " . BASE_DIR . "");
        exit('redirect');
    }
}
?>                            