<?php
    require_once("../utilities/connect.php");
    require_once("../utilities/usermodel.php");
    
    
//public static function checkLogin($username, $password) {

    if(isset($_POST['username']) && isset($_POST['password'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
        
        global $connection;
        
        $USERNAME_LOWER = strtolower($username);
        $ENCRYPTED_PASSWORD = md5($password);
        
        $SQL_QUERY_LOGIN_CHECK_DEC = "SELECT Username FROM USERS WHERE Username = '".$USERNAME_LOWER."' AND UserPassword = '".$ENCRYPTED_PASSWORD."';";
        $SQL_QUERY_LOGIN_CHECK = $connection->query($SQL_QUERY_LOGIN_CHECK_DEC);
        $SQL_QUERY_LOGIN_CHECK_ROWS = $SQL_QUERY_LOGIN_CHECK->num_rows;
        
        if($SQL_QUERY_LOGIN_CHECK_ROWS == 1) {
            $_SESSION['activeuser'] = User::fromUsername($USERNAME_LOWER);
            $connection->close();
            header("location: ../index.php");
            
        } else {
            echo "username or password fail";
        }
    } else {
        echo "failed";
    }

    

?>    