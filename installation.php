<?php

    require_once("utilities/connect.php");
    
    global $connection;
    global $SQL_SERVER_DATABASE;
    
    
    //Main install loop
    if(isset($_GET["step"])){ // Check if we have a step var
        $step = $_GET["step"];
        if($step == 1){//User has entered admin details, just need database name
            if(isset($_POST["au"]) && isset($_POST["ap"]) && isset($_POST["ae"])){// Previous form was filled in and hasn't ended up here by chance
                setCookie("au", $_POST["au"]);
                setCookie("ap", $_POST["ap"]);
                setCookie("ae", $_POST["ae"]);
                printHTMLTop();
                echo "<p>Enter the server details</p>";
                echo "<form action='?step=2' method='post'>";
                    echo "<input name='sl' type='text' placeholder='IP address' value='127.0.0.1' required/></br></br>";
                    echo "<input name='su' type='text' placeholder='Username' required/></br></br>";
                    echo "<input name='sp' type='password' placeholder='Password'/></br></br>";
                    echo "<input type='submit' value='Next step'/>";
                echo "</form>";
                printHTMLBottom();
            }else{// Redirect them to step 0 I guess with some additonal warings
                $connection->close();
                header("Location: ./installation.php?w=order");
            }
        }else if($step == 2){// User is entering server connection details
            if(isset($_POST["sl"]) && isset($_POST["su"]) && isset($_POST["sp"])){
                setCookie("sl", $_POST["sl"]);
                setCookie("su", $_POST["su"]);
                setCookie("sp", $_POST["sp"]);
                printHTMLTop();
                echo "<p>Enter the name for the database</p>";
                echo "<form action='?step=3' method='post'>";
                    echo "<input name='dbn' type='text' placeholder='Name' value='blankbox' required/></br></br>";
                    echo "<input type='submit' value='Next step'/>";
                echo "</form>";
                printHTMLBottom();
            }else{
                $connection->close();
                header("Location: ./installation.php?w=order");
            }
        }else if($step == 3){// Player
            if(isset($_POST["dbn"])){
                $fileName = "./utilities/connect.php";
                
                $newFile = "";
                $lines = explode("\n", file_get_contents($fileName));
                for($i = 0; $i < sizeof($lines); $i++){
                    $l = $lines[$i];
                    if($i == 7){
                        $newFile .= '   $SQL_SERVER_ADRRESS = "'.$_COOKIE["sl"].'";';
                    }else if($i == 8){
                        $newFile .= '   $SQL_SERVER_USERNAME = "'.$_COOKIE["su"].'";';
                    }else if($i == 9){
                        $newFile .= '   $SQL_SERVER_PASSWORD = "'.$_COOKIE["sp"].'";';
                    }else if($i == 10){
                        $newFile .= '   $SQL_SERVER_DATABASE = "'.$_POST['dbn'].'";';
                    }else{
                        $newFile .= $l;
                    }
                    $newFile .= "\n";
                }
                
                $file = fopen($fileName,"w");
                if(fwrite($file, $newFile) == false){
                    fclose($file);
                    printHTMLTop();
                    printWarning("ERROR Reading file!");
                    printHTMLBottom();
                    die();
                }else{
                    fclose($file);
                    $SQL_DATABASE_NAME = $_POST["dbn"];
                    $SQL_DATABASE_QUERY_DEC = "CREATE DATABASE ".$SQL_DATABASE_NAME.";";
                    $SQL_DATABASE_QUERY = $connection->query($SQL_DATABASE_QUERY_DEC);
                    
                    $connection->select_db($_POST["dbn"]);
                    $SQL_QUERY_CREATE_USER_TABLE_DEC = "CREATE TABLE USERS(UserID int AUTO_INCREMENT PRIMARY KEY, Username varchar(64) NOT NULL, UserPassword varchar(32) NOT NULL, UserEmail varchar(64) NOT NULL);";
                    $SQL_QUERY_CREATE_USER_TABLE = $connection->query($SQL_QUERY_CREATE_USER_TABLE_DEC);
                    
                    $USER_TABLE_ADMINNAME = strtolower($_COOKIE["au"]);
                    $USER_TABLE_ADMINPASS = ($_COOKIE["ap"]);
                    $USER_TABLE_ADMINEMAIL = $_COOKIE["ae"];
                    
                    $SQL_QUERY_INSERT_DATA_DEC = "INSERT INTO USERS (Username, UserPassword, UserEmail) VALUES ('$USER_TABLE_ADMINNAME','".md5($USER_TABLE_ADMINPASS)."','".$USER_TABLE_ADMINEMAIL."');";
                    $SQL_QUERY_INSERT_DATA = $connection->query($SQL_QUERY_INSERT_DATA_DEC);
                    if($SQL_QUERY_INSERT_DATA) {
                        echo "Installation Successful. Refer back to the README for the next step.";
                    }
                    
                    wipeCookies();
                    header("Location: ./installation.php?w=comp&step=4");
                }
            }else{
                $connection->close();
                header("Location: ./installation.php?w=order");
            }
        }else if($step == 4){
            printHTMLTop();
            if(isset($_GET["w"])){
                $warning = $_GET["w"];
                if($warning == "comp"){
                    printWarning("Tada! Blank Box is setup!");
                }
            }
            echo "<p>Successfully setup blankbox database</p>";
            echo "<p>You should be able to use the site now</p>";
            printHTMLBottom();
        }
    }else{// If step not set check if db exists and set default to 1
        if(doesDBExist()){
            header("Location: ./installation.php?w=comp&step=4");
            die();
        }else{
            printHTMLTop();
            if(isset($_GET["w"])){
                $warning = $_GET["w"];
                if($warning == "comp"){
                    printWarning("Looks like you've already completed the installation");
                }else if($warning == "order"){
                  printWarning("You need to complete the installation in the correct order, please try again");
                }
            }
            echo "<p>Enter admin details</p>";
            echo "<form action='?step=1' method='post'>";
                echo "<input name='au' type='text' placeholder='Username' required/></br></br>";
                echo "<input name='ap' type='password' placeholder='Password' required/></br></br>";
                echo "<input name='ae' type='email' placeholder='Email' required/></br></br>";
                echo "<input type='submit' value='Next step'/>";
            echo "</form>";
            printHTMLBottom();
        }
    }
    $connection->close();
    
    /**
     *  Easy function to add warnings upon a user error
     **/
    function printWarning($w){
        echo "<div id='warn' class='warning'>".$w."</div>";
        echo "<script>setTimeout(function(){document.getElementById('warn').classList.add('hidden');},3000)</script>";
    }
    
    /**
     *  Print the top half of the html file
     **/
    function printHTMLTop(){
        echo "<html>";
        echo "<head>";
        echo "<title>Blank Box - Installation</title>";
        echo "<link rel='stylesheet' type='text/css' href='../assets/style.css'/>";
        echo "</head>";
        echo "<body>";
        echo "<div class='container'>";
        echo "<h1>Blank Box</h1>";
    }
    
    /**
     *  Print the bottom part of the html file
     **/
    function printHTMLBottom(){
        echo "</div>";
        echo "</body>";
        echo "</html>";
    }
    
    /**
     *  Wipes all of the cookies that this script uses
     **/
    function wipeCookies(){
        setCookie("sl", "", time() - 3600);
        setCookie("su", "", time() - 3600);
        setCookie("sp", "", time() - 3600);
        setCookie("au", "", time() - 3600);
        setCookie("ap", "", time() - 3600);
        setCookie("ae", "", time() - 3600);
    }
    
    /**
     *  Checks if the DB already exists
     **/
    function doesDBExist(){
        global $SQL_SERVER_DATABASE;
        global $connection;
        if($SQL_SERVER_DATABASE == ""){
            return false;
        }
        $SQL_DATABASE_QUERY_DEC = "SHOW DATABASES LIKE '".$SQL_SERVER_DATABASE."';";
        $SQL_DATABASE_QUERY = $connection->query($SQL_DATABASE_QUERY_DEC);
        if($SQL_DATABASE_QUERY->num_rows == 0){
            return false;
        }else{
            return true;
        }
    }
?>
