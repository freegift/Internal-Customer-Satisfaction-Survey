<?php //include_once 'config.php';

/**
 * Description of connect
 *
 * @author uenomfon
 */
$cConnect = new Connect;

class Connect {
    //put your code here
    
    public $db = null;
    private $server;
    private $username;
    private $password;
    private $database;
    
    public $error;
    public $num_rows = 0;
    public $affected_rows = 0;
    public $insert_id = null;
    
    
    public function __construct() {
        include_once 'config.php';
        
        $this->server = SERVER;// "localhost";
        $this->username = USERNAME;// "root";
        $this->password = PASSWORD; // "pass=123";
        $this->database = DATABASE;// "cinventory";//'inventory';//
        $this->error = NULL;
        
        if ($this->db === NULL){
            $this->db = @mysqli_connect($this->server, $this->username, $this->password, $this->database);
            if (!$this->db){
                die("Could not connect to server | " .  mysqli_connect_error());
            }
            /*if (!mysqli_select_db($this->database, $this->db)){
                die("No database selected". mysqli_error($this->db));
            }*/
        }
        return $this->db;
    }
    
    public function Select ($query = NULL){
        if ($query !== NULL){ //echo $query;
            $result = mysqli_query($this->db, $query);
            if ($result){
                $this->num_rows = mysqli_num_rows($result);
                //return mysql_fetch_assoc($result);
                //return ($this->num_rows > 0) ? $this->Fetch_All_Data($result) : NULL;
                return $this->Fetch_All_Data($result);
            } else {
                return $this->Error_Log($query);
            }
        }
    }
    
    private function Fetch_All_Data ($result) {
        $data = array();
        while ($row = mysqli_fetch_assoc($result)){
            $data[] = $row;
        }
        mysqli_free_result($result);
        return $data;
    }
    
    
    public function Insert ($query = NULL){
        if ($query !== NULL){
            $result = mysqli_query($this->db, $query);
            if ($result){
                $this->insert_id = mysqli_insert_id($this->db);
                $this->affected_rows = mysqli_affected_rows($this->db);
                return $result;
            } else {
                $this->error = mysqli_error($this->db);
                return $this->Error_Log($query);
            }
        }
    }

    public function Update ($query = NULL){
        if ($query !== NULL){
            $result = mysqli_query($this->db, $query);
            if ($result){
                $this->affected_rows = mysqli_affected_rows($this->db);
                return $result;
            } else {
                return $this->Error_Log($query);
            }
        }
    }
    
    public function Delete ($query = NULL){
        if ($query !== NULL){
            $result = mysqli_query($this->db, $query);
            if ($result){
                $this->affected_rows = mysqli_affected_rows($this->db);
                return $result;
            } else {
                return $this->Error_Log($query);
            }
        }
    }
    
    public function AuditLog($table, $action, $values) {
        error_reporting(0);
        $desc = (isset($_SESSION["LOGIN"]["l_fullname"])) ? ' by '. $_SESSION["LOGIN"]["l_fullname"]: '';
        $desc = $values . ' - ' .$desc;
        $date = A_DATE;
        $time = A_TIME;
        $query = "INSERT INTO audit_log (a_id, a_table, a_action, a_description, a_date, a_time) VALUES "
                . "(NULL,'$table','$action','$desc', '$date', '$time')";
        return $this->Insert($query);
    }
    
    public function Error_Log($query) {
        error_reporting(0);
        $_SESSION["ERROR"] = NULL;
        echo "Error: ".mysqli_error();
        $_SESSION["ERROR"]["DATE"] = date("Y-m-d H:i");
        $_SESSION["ERROR"]["ERROR NO"] = mysqli_errno();
        $_SESSION["ERROR"]["ERROR"] = mysqli_error();
        $_SESSION["ERROR"]["QUERY"] = $query;
        $_SESSION["ERROR"]["USER"] = isset($_SESSION["LOGIN"]["l_username"])? $_SESSION["LOGIN"]["l_username"]:'';
        $_SESSION["ERROR"]["IP"] = $_SERVER['REMOTE_ADDR'];
        $_SESSION["ERROR"]["FILE"] = $_SERVER['SCRIPT_FILENAME'];
        
        $content = '';
        foreach ($_SESSION["ERROR"] as $key => $value) {
            $content .= $key .': '.$value .', ';
        }
        $content .= "\n";
        
        $filename = "../web/error_log.txt";
//        if (is_writable($filename)){
            if (!$handle = fopen($filename, 'a')) {
                echo "Cannot open file ($filename)";
                exit;
            }
            if (fwrite($handle, $content) === FALSE) {
                echo "Cannot write to file ($filename)";
                exit;
            }

            fclose($handle);

//        } else {
//            echo "The file $filename is not writable";
//        }
    }
    
    public function __destruct() {
        $this->db = null;
    }
    
    public function ListAll($table = '', $field = '', $value = '', $order = 1, $order_type = "ASC") {
        if ($table != ''){
            $par = ($field !== '')? " WHERE $field = $value" : '';
            return $this->Select("SELECT * FROM $table $par ORDER BY $order $order_type");
        }
    }
    
    public function ListOne($table = '', $field = '', $value = '', $order = 1, $order_type = "ASC") {
        if ($table != '' || $field != '' || $value != ''){
            return $this->Select("SELECT * FROM $table WHERE $field = $value ORDER BY $order $order_type");
        }
    }
    
    public function AffectedRows() {
        $no = $this->affected_rows;
        $s = ($no <= 1)? " record":" records";
        return $no . $s . " affected";
    }
    
    public function SetDefaultSurvey() {
        if($default = $this->Select("SELECT c_id, c_name FROM categories WHERE c_default ='".ENABLE."' LIMIT 1"))
        {
            $_SESSION["DEFAULT"]["c_id"] = $default[0]["c_id"];
            $_SESSION["DEFAULT"]["c_name"] = $default[0]["c_name"];
        }else{
            $_SESSION["DEFAULT"]["c_id"] = NULL;
            $_SESSION["DEFAULT"]["c_name"] = NULL;
        }
        
    }
}