<?php
	//  Core session start
	session_start();
	//  Resetting $_SESSION array
    $_SESSION = array();
	//  Unsetting cookies
    foreach(array_keys($_SESSION) as $k) unset($_SESSION[$k]);
	//  Destroying the session
    session_destroy();
	//  Redirecting user to home page
    header("location: ../index.php");

?>