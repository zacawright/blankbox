<?php

    
    require_once("utilities/usermodel.php");
    require_once("utilities/connect.php");
    
    if(!isset($_SESSION['activeuser'])) {
        echo "<form action='tools/login.php' method='post'>";
        echo "<input name='username' id='username' type='text' placeholder='Username'>";
        echo "<input name='password' id='password' type='password' placeholder='Password'>";
        echo "<button type='submit'>Login</button>";
        echo "</form>";
    } else {
        
    }

?>
<html>
    
</html>