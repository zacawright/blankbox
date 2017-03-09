<?php
    require_once("./utilities/connect.php");
    require_once("./utilities/usermodel.php");
    
    session_start();
?>
<html>
    <?php
    if(!isset($_SESSION['activeuser'])) {
    ?>
        <form action='./tools/login.php' method='post'>
        <input name='username' id='username' type='text' placeholder='Username'>
        <input name='password' id='password' type='password' placeholder='Password'>
        <button type='submit'>Login</button>
        </form>
        <?php
    } else {
        echo $_SESSION['activeuser']->UserID.", ";
        echo $_SESSION['activeuser']->Username.", ";
        echo $_SESSION['activeuser']->UserEmail;
        echo "<div>";
        echo "<a href='./tools/logout.php'>Logout</a>";
        echo "</div>";
    }    
    ?>
</html>