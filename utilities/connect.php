<?php
    /*
        Server Control
        
        ONLY edit lines 8,9,10,11
    */
    
    $SQL_SERVER_ADRRESS  = "127.0.0.1";
    $SQL_SERVER_USERNAME = "h2n0954";
    $SQL_SERVER_PASSWORD = "";
    $SQL_SERVER_DATABASE = "";
    
    /*
        End of editable area
        Do NOT edit any lines after this
    */
    
    $connection = new mysqli($SQL_SERVER_ADRRESS, $SQL_SERVER_USERNAME, $SQL_SERVER_PASSWORD, $SQL_SERVER_DATABASE);
    

    if(!$connection) { 
        echo "server_init_failed";
    }
?>