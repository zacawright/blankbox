<?php
    /*
        Server Control
        
        ONLY edit lines 8,9,10,11
    */
    
    $SQL_SERVER_ADRRESS  = "127.0.0.1";
    $SQL_SERVER_USERNAME = "zacawright";
    $SQL_SERVER_PASSWORD = "";
    $SQL_SERVER_DATABASE = "blankbox";
    
    /*
        End of editable area
        Do NOT edit any lines after this
    */
    
    $connection = new mysqli($SQL_SERVER_ADRRESS, $SQL_SERVER_USERNAME, $SQL_SERVER_PASSWORD, $SQL_SERVER_DATABASE);

    if(!$connection) { 
        die("server_init_failed");
    }
?>