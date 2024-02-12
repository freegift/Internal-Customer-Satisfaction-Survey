<?php
//$cApp = new cApp;

class cApp {
    //put your code here
    
    public static function AppTitle() {
        return 'Internal Customer Satisfaction Survey';
    }
    
    public function IsChecked($key, $value) {
        return ($value==$key)? 'checked':'';
    }
    
    public function IsSelected($key, $value) {
        return ($value==$key)? 'selected="selected"':'';
    }
    
    public function IsLoginSession($redirect = FALSE) {
        if (!isset($_SESSION["LOGIN"])){
            if ($redirect === TRUE){
                header("Location: " . BASE_DIR . "login/");
            } else {
                echo "<div class='message'><h3>Your login session has expired. Please logout and re-login</h3></div>";
            }
            exit();
         }
    }
    
    public function HasMessage() {
        $msg = NULL;
        if (!empty($GLOBALS["MESSAGE"])){
            $msg = "<div class='message'>";
            foreach ($GLOBALS["MESSAGE"] as $key => $value) {
                $msg .= $value."<br>";
            }
            $msg .= "</div>";
        }
        return $msg;
    }
    
    public function HasError() {
        $msg = NULL;
        if (!empty($GLOBALS["ERROR"])){
            $msg = "<div class='error'>";
            foreach ($GLOBALS["ERROR"] as $key => $value) {
                $msg .= $value."<br>";
            }
            $msg .= "</div>";
        }
        return $msg;
    }
    
    public function ShowInfo() {
        echo $this->HasMessage();
        echo $this->HasError();
    }
    
    public function HasPrivilege($priv) {
        if (array_search($priv, $_SESSION["ROLE_PRIV"]) <> NULL){
            return $priv;
        } else {
            
        }
    }
    
    public function IsApprove($param) {
        if ($param == APPROVE){
            //$MESSAGE[] = "No edit allowed. Already approved!";
            return 'approve';//$this->HasMessage();
        }
    }
    
    public function ItemsInOrderCart() {
        if (isset($_SESSION["MYORDER"])){
             $c = count($_SESSION["MYORDER"]);
            return $c;// > 0? $c : NULL;
        } else {
            $_SESSION["MYORDER"] = NULL;
        }
    }
    
    public function ItemsInReceivableCart() {
        if (isset($_SESSION["MYRECEIVABLE"])){
             $c = count($_SESSION["MYRECEIVABLE"]);
            return $c;// > 0? $c : NULL;
        } else {
            $_SESSION["MYRECEIVABLE"] = NULL;
        }
    }
    
    public function ItemsInRequestCart() {
        if (isset($_SESSION["MYREQUEST"])){
             $c = count($_SESSION["MYREQUEST"]);
            return $c;// > 0? $c : NULL;
        } else {
            $_SESSION["MYREQUEST"] = NULL;
        }
    }
    
    public function ApprovalStatus($value) {
        if ($value === APPROVE){
            return "APPROVED";
        } elseif ($value === PENDING){
            return "PENDING";
        } elseif($value === CANCEL){
            return "CANCELLED";
        } elseif($value === DECLINE){
            return "DECLINED";
        } 
        
    }
    
    public function ItemStatus($value) {
        if ($value === OPEN){
            return "OPEN";
        } elseif ($value === CLOSE){
            return "CLOSE";
        }
    }
    
    public function EnableStatus($value) {
        if ($value === ENABLE){
            return "YES";
        } elseif ($value === DISABLE){
            return "NO";
        } elseif ($value === ''){
            return "-";
        }
    }
    
    public function EntryStatus($value) {
        if ($value === PENDING){
            return "PENDING";
        } elseif ($value === TREATED){
            return "TREATED";
        } elseif ($value === ''){
            return "-";
        }
    }
    
    public function IsFileUploadType($type) {
        $f_types[] = array();
        $f_types[] = "application/octetstream";
        $f_types[] = "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
        $f_types[] = "application/vnd.ms-word";
        $f_types[] = "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet";
        $f_types[] = "application/vnd.ms-excel";
        $f_types[] = "image/jpeg";
        $f_types[] = "image/pjpeg";
        $f_types[] = "image/png";
        $f_types[] = "image/gif";
        $f_types[] = "text/plain";
        $f_types[] = "text/csv";
        $f_types[] = "application/pdf";
        //$f_types[] = "application/octetstream";
        
        if (array_search($type, $f_types) <> NULL){
            return $type;
        }
    }
    
    public function ReorderClass($reorder_level, $qty_balance) {
        if ($qty_balance <= $reorder_level){
            return "reorder";
        } elseif (($qty_balance <= ($reorder_level + ($reorder_level * 15/100))) && ($qty_balance > $reorder_level)){ //if bal less than (reorder + 10%)
            return "reorder-range";
        } else {
            return '';
        }
    }
    
    public function MoneyFunction($param) {
        if($param <0){
            return '('.  number_format(substr($param,1), 2) . ')';
        }else{
            return number_format($param, 2);
        }
    }
    
    public function FilterPrice($param) {
        $val = str_replace(",", "", $param);
        $val = str_replace("%", "", $val);
        
        return $val;
    }
}
$cApp = new cApp;


/*
class cApprovals extends Connect{
    
    public function ApproveButtons($approval_name, $approval_name_id, $current_user) {
        //include_once 'connect.php'; 
        $db = new Connect();
        //get all users email available for approvals of this approval name eg. oders, items, receivables, quotes
        $r_1 = $db->Select("SELECT APP_USERS, APP_USERS_COPY FROM approvals WHERE APP_NAME = '$approval_name'");
        if (!$r_1)            
            return;
        
        
        $app_users = explode(";", $r_1[0]["APP_USERS"]); // get approve users
        $app_users_copy = explode(";", $r_1[0]["APP_USERS_COPY"]); // get copy users
        //return $app_users_copy;//$result[0]["APP_USERS"];
        
        $r_2 = $db->Select("SELECT * FROM approval_history WHERE APPH_APP_NAME = '$approval_name' AND APPH_APP_NAME_ID = $approval_name_id "
                . "");
        if (!$r_2)
            return;
        
        $apph_keys = array_keys($r_2[0]); //get all fields for the approval history table
        $no_users = count($r_2);//get total number of users to approve this 
        $i=0;
        foreach($r_2 as $k => $v){ //cycle to get all registered approve users info 
            $i++;
            $app_history_id[$i] = $v["APPH_ID"];
            $users[$i] = $v["APPH_APP_USER"];
            $status[$i] = $v["APPH_APP_STATUS"];
        }
        
        $found_user_index = array_search($current_user, $users); //confirm if user in approval list
        if ($found_user_index === FALSE)
            return;
        
        $level = NULL; 
        $flag = FALSE;
        for ($i = 1; $i <= $no_users; $i++){
            if ($status[$i] === DECLINE ){
                return;
            } 
            if ($flag === TRUE) //do not cycle again once seen pending approval code
                continue;
            if ($status[$i] === PENDING ){ // check for pending approval code, the flag true
                $level = $i;
                $flag = TRUE;
                continue;
            }
        }
        
        if ($level === NULL)            
            return;
        //confirm if current login user is the pending approval user, then enable for approval, else ignore approval buttons
        if (($users[$level] !== $current_user))
            return;
        //$level = ($found_user_index < $no_users) ? "Move to next user : $found_user_index" : "Final : $found_user_index";
        //$t = array_search('freegiftudourom@yahoo.com1', $users);
        //$t = in_array('freeg.research@gmail.com', $users);
        //return "This user $users[$level] must approve first ($level of $no_users), History ID: $app_history_id[$level]";
        return $app_history_id[$level]."~".$level."~".$no_users;
    }
    
    public function ApprovalHistory($app_name, $id) {
        $query = "SELECT AH.*, U.US_FULLNAME, U.US_NAME, D.DEPT_NAME FROM approval_history AH LEFT JOIN users U ON (U.US_EMAIL=AH.APPH_APP_USER)"
                . " LEFT JOIN departments D ON (D.DEPT_ID=U.US_DEPT_ID) WHERE APPH_APP_NAME = '$app_name' AND APPH_APP_NAME_ID = $id ORDER BY APPH_ID";
        return $this->Select($query);
    }
    
    public function RegisterApproveUsers($app_name, $id) {
        $query = "SELECT APP_USERS FROM approvals WHERE APP_NAME = '$app_name'";
        $res = $this->Select($query);
        if ($res){
            if ($this->num_rows > 0){
                $users = array();
                $users = explode(";", $res[0]["APP_USERS"]);
                $vals = NULL;
                foreach ($users as $key => $value) {
                    if ($value == '')                        
                        continue;
                    $vals .= "('$app_name', $id, '$value', 'P', '". A_DATE."', '".A_TIME."'),";
                }
                $vals = substr($vals, 0, -1);
                $q = "INSERT INTO approval_history ( APPH_APP_NAME, APPH_APP_NAME_ID, APPH_APP_USER, APPH_APP_STATUS"
                        . ", APPH_APP_DATE, APPH_APP_TIME ) VALUES $vals";
                return $this->Insert($q);
                //return $q;
            }
        }
    }
    
}
$cApprovals = new cApprovals;
*/

class cQuoteApprovals extends Connect
{
//    public function CreateTask($ordid) {
//        
//        if ($data = $this->TaskExist($ordid))
//        {
//            list($qad_id, $level) = explode('-',$data);
//            //if ($this->ApproveMyPendingGroupTask($ordid, $qad_id))
//            //{
//                if ($newlevel = $this->NewTaskLevel($ordid, $level)){
//                    if (isset($newlevel) && ($newlevel !== $level)){
//                        return $this->AddNewTask($ordid, $newlevel);
//                    } elseif (isset($newlevel) && ($newlevel === $level)){
//                        return $this->DoneTask($ordid);
//                    }
//                }
//            //}
//        } elseif ($this->TaskCompleted($ordid)){
//            return 'task already completed';
//        } else {
//            return $this->StartTask($ordid); //$this->NewTask($ordid);
//        }
//    }
    
    public function TaskExist($ordid) {
        $query = "SELECT QAD_ID, QAD_QAL_ID FROM quote_approve_details WHERE QAD_ORD_ID = $ordid AND QAD_APPROVE = '".PENDING."' AND QAD_STATUS = '".DISABLE."' ORDER BY QAD_ID DESC LIMIT 1";
        if ($result = $this->Select($query)){
            return $result[0]["QAD_ID"].'-'.$result[0]["QAD_QAL_ID"];
        }
    }
    
    public function TaskCompleted($ordid) {
        $query = "SELECT 1 FROM quote_approve_details WHERE QAD_ORD_ID = $ordid AND QAD_STATUS = '".ENABLE."' ORDER BY QAD_ID DESC LIMIT 1";
        if ($this->Select($query)){
            if ($this->num_rows > 0)
                return $this->Select($query);
        }
    }
    
    public function AddNewTask($ordid, $level) {
        $user = $_SESSION["LOGIN"]["US_EMAIL"];
        $query = "INSERT INTO quote_approve_details (QAD_ID,QAD_ORD_ID,QAD_QAU_USER_NAME,QAD_QAL_ID,QAD_APPROVE,QAD_DATE,QAD_TIME,QAD_STATUS) "
                . "VALUES (NULL,$ordid,'',$level,'".PENDING."','".A_DATE."','".A_TIME."','".DISABLE."')";
        if ($this->Insert($query)){
            return $this->NewTaskLevel($ordid, $level);
        }
    }
    
    public function DoneTask($ordid, $app_status = APPROVE) {
        $q = "UPDATE quote_details SET QUOD_APP_DATE='".A_DATE."',QUOD_APP_TIME='".A_TIME."',QUOD_APPROVE='$app_status' WHERE QUOD_ORD_ID=$ordid ;";
        $this->Update($q);            
        
        $this->Update("UPDATE quote_approve_details SET QAD_STATUS = '".ENABLE."' WHERE QAD_ORD_ID = $ordid");
        return 'DONE!!!! TASK!!!';
    }
    
    public function StartTask($ordid) {
        $level = $this->NewTaskLevel($ordid);
        if ($level){
            return $this->AddNewTask($ordid, $level);
        } else {
            //return 'Can not initiate a new task: no available user assigned';
        }
    }
    
    public function NewTaskLevel($ordid, $current_level = NULL) {
        if ($current_level === NULL){
            $query = "SELECT QAL_ID FROM quote_approve_levels WHERE QAL_ENABLE = '".ENABLE."' ORDER BY QAL_ID LIMIT 1";
            if ($result = $this->Select($query)){
                return $result[0]["QAL_ID"];
            }
        }else{
            $query = "SELECT QAL_ID FROM quote_approve_levels WHERE QAL_ID > $current_level AND QAL_ENABLE = '".ENABLE."' ORDER BY QAL_ID LIMIT 1";
            if ($result = $this->Select($query)){
                return $result[0]["QAL_ID"];
            } else {
                return $current_level;
            }
        }
   }
   
   public function GetCurrentTaskLevel($qad_id) {
       $rec = $this->Select("SELECT QAD_QAL_ID FROM quote_approve_details WHERE QAD_ID = $qad_id");
       return $rec[0]["QAD_QAL_ID"];
   }
    // MY ISSUES
    public function MyPendingGroupTask($ordid = NULL) {
        $byordid = ($ordid !== NULL)? " AND QAD_ORD_ID = $ordid":'';
        $query = "SELECT QAD_ID FROM quote_approve_details WHERE QAD_APPROVE = '".PENDING."' AND QAD_QAL_ID IN "
                . "(SELECT QAL_ID FROM quote_approve_levels WHERE QAL_USERS LIKE '%".$_SESSION["LOGIN"]["US_EMAIL"]."%' AND QAL_ENABLE = '".ENABLE."') "
                . " AND QAD_STATUS = '".DISABLE."' $byordid";
        return $this->Select($query);
    }
    
    public function ApproveMyPendingGroupTask($ordid,$qad_id,$txtcom ='') { //echo $txtcom;
        //$byordid = ($ordid !== NULL)? " AND QAD_ORD_ID = $ordid":'';
        $query = "UPDATE quote_approve_details SET QAD_QAU_USER_NAME = '".$_SESSION["LOGIN"]["US_EMAIL"]."', QAD_APPROVE = '".APPROVE."', "
                . " QAD_DATE = '".A_DATE."', QAD_TIME = '".A_TIME."', QAD_COMMENTS = '$txtcom' WHERE QAD_ID = $qad_id";
        //echo $query;
        return $this->Update($query);
    }
    
    public function DeclineMyPendingGroupTask($ordid,$qad_id,$txtcom ='') {
        //$byordid = ($ordid !== NULL)? " AND QAD_ORD_ID = $ordid":'';
        $query = "UPDATE quote_approve_details SET QAD_QAU_USER_NAME = '".$_SESSION["LOGIN"]["US_EMAIL"]."', QAD_APPROVE = '".DECLINE."', "
                . " QAD_DATE = '".A_DATE."', QAD_TIME = '".A_TIME."', QAD_COMMENTS = '$txtcom' WHERE QAD_ID = $qad_id";
        return $this->Update($query);
    }
    
    public function ApprovalHistory($ordid) {
        $query = "SELECT QAD.*, QAL_NAME, US_FULLNAME FROM quote_approve_details QAD LEFT JOIN quote_approve_levels QAL ON (QAD.QAD_QAL_ID=QAL.QAL_ID) "
                . " LEFT JOIN users US ON (QAD.QAD_QAU_USER_NAME=US.US_EMAIL) WHERE QAD_ORD_ID = $ordid";
        return $this->Select($query);
    }
}

$cQuoteApprovals = new cQuoteApprovals();
?>