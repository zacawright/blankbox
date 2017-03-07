<?php
    /*
    This is the user model which allows for data to be easily retrieved from the databases
    */
    
    require_once("connect.php");
    
    class User {
        
        public $UserID;
        public $Username;
        public $UserEmail;
        
        protected static function fromDBRow($data) {
            $instance = new static();
            
            $instance->UserID= $data['UserID'];
            $instance->Username = $data['Username'];
            $instance->UserEmail = $data['UserEmail'];
            
            return $instance;
        }
        
        public static function fromUserID($UID) {
            global $connection;
            
            $SQL_SELECT_QUERY_DEC = "SELECT UserID, Username, UserEmail from USERS WHERE UserID = $UID;";
            $SQL_SELECT_QUERY = $connection->query($SQL_SELECT_QUERY_DEC);
            $SQL_SELECT_QUERY_ROWS = $SQL_SELECT_QUERY->fetch_assoc();
            if(!$SQL_SELECT_QUERY_ROWS) { return "no_data"; }
            else { return User::fromDBRow($SQL_SELECT_QUERY_ROWS); }
        }
        
        public static function fromUsername($USERNAME) {
            global $connection;
            
            $SQL_SELECT_QUERY_DEC = "SELECT UserID, Username, UserEmail from USERS WHERE Username = '$USERNAME';";
            $SQL_SELECT_QUERY = $connection->query($SQL_SELECT_QUERY_DEC);
            $SQL_SELECT_QUERY_ROWS = $SQL_SELECT_QUERY->fetch_assoc();
            
            if(!$SQL_SELECT_QUERY_ROWS) { return "no_data"; }
            else { return User::fromDBRow($SQL_SELECT_QUERY_ROWS); }
        }
    }
?>