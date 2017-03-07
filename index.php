<?php
    require_once("utilities/connect.php");
    require_once("utilities/usermodel.php");
    
    
    session_start();

?>
<html>
    <?php
    if(!isset($_SESSION['activeuser'])) {
    ?>
        <form action='tools/login.php' method='post'>
        <input name='username' id='username' type='text' placeholder='Username'>
        <input name='password' id='password' type='password' placeholder='Password'>
        <button type='submit'>Login</button>
        </form>
        <?php
    } else {
    ?>
        
    <?php
    var_dump($_SESSION['activeuser']);
    }    
    ?>
</html>