<?php
    /*
        Server Control
        
        ONLY edit lines 8,9,10,11
    */
    
   $SQL_SERVER_ADRRESS = "127.0.0.1";
   $SQL_SERVER_USERNAME = "h2n0954";
   $SQL_SERVER_PASSWORD = "";
   $SQL_SERVER_DATABASE = "";
    
    /*
        End of editable area
        Do NOT edit any lines after this
    */
    
    function getConnection(){
        global $SQL_SERVER_ADRRESS;
        global $SQL_SERVER_USERNAME;
        global $SQL_SERVER_PASSWORD;
        global $SQL_SERVER_DATABASE;
        
        if($SQL_SERVER_DATABASE == ""){
            $connection = new mysqli($SQL_SERVER_ADRRESS, $SQL_SERVER_USERNAME, $SQL_SERVER_PASSWORD);
        }else{
            $connection = new mysqli($SQL_SERVER_ADRRESS, $SQL_SERVER_USERNAME, $SQL_SERVER_PASSWORD, $SQL_SERVER_DATABASE);
        }
    
        if(!$connection) { 
            die("server_init_failed");
            return NULL;
        }else{
            return $connection;
        }
    }
    
    /**
     *  Checks if the DB already exists
     **/
    function doesDBExist(){
        global $SQL_SERVER_DATABASE;
        if($SQL_SERVER_DATABASE == ""){
            return false;
        }
        
        $connection = getConnection();
        $SQL_DATABASE_QUERY_DEC = "SHOW DATABASES LIKE '".$SQL_SERVER_DATABASE."';";
        $SQL_DATABASE_QUERY = $connection->query($SQL_DATABASE_QUERY_DEC);
        $connection->close();
        if($SQL_DATABASE_QUERY->num_rows == 0){
            return false;
        }else{
            return true;
        }
    }
?>
















