<?php

    require_once("utilities/connect.php");
    
    /*
        Editable Area Start
        Only edit lines 7,9,10,11
    */
    
    $SQL_DATABASE_NAME     = "";
    
    $USER_TABLE_ADMINNAME  = "zac";
    $USER_TABLE_ADMINPASS  = "zac";
    $USER_TABLE_ADMINEMAIL = "zac@test.com";
    
    /*
        Editable Area Finish
        Do NOT edit anything after this line
    */
    global $connection;
    
    function doesDBExist(){
        if($SQL_DATABASE_NAME == ""){
            return false;
        }
        
        global $connection;
        $SQL_DATABASE_QUERY_DEC = "SHOW DATABASES LIKE '".$SQL_DATABASE_NAME."';";
        $SQL_DATABASE_QUERY = $connection->query($SQL_DATABASE_QUERY_DEC);
        if($SQL_DATABASE_QUERY->num_rows == 0){
            return false;
        }else{
            return true;
        }
    }
    
    if(isset($_GET["step"])){
        $step = $_GET["step"];
        if($step == 1){//User has entered admin details, just need database name
            if(isset($_POST["an"]) && isset($_POST["ap"]) && isset($_POST["ae"])){// Previous form was filled in and hasn't ended up here by chance
                
            }else{// Redirect them to step 0 I guess with some additonal warings
                header("Location: ./installation.php?w=order");
            }
        }
    }else{// If step not set check if db exists and set default to 1
        if(doesDBExist()){
            echo nl2br("Database already exsists!\n");
            echo "Install either completed or conflicting ".'$SQL_DATABASE_NAME'." values.";
            header("Location: ./installation.php?w=comp");
            $connection->close();
            die();
        }else{
            printHTMLTop();
            if(isset($_GET["w"])){
                $warning = $_GET["w"];
                if($warning == "comp"){
                    printWarning("Looks like you've already completed the installation");
                }else if($warning == "order"){
                  //  echo "<div class='warning'>You need to complete the installation in the correct order, please try again</div>";
                }
            }
            echo "<div class='container'>";
            echo "<h1>Blank Box</h1>";
            echo "<form action='?step=1' method='post'>";
                echo "<input name='au' type='text' placeholder='Admin username'/></br></br>";
                echo "<input name='ap' type='password' placeholder='Admin password'/></br></br>";
                echo "<input name='ae' type='email' placeholder='Admin email'/></br></br>";
                echo "<input type='submit' value='Create user'/>";
            echo "</form>";
            echo "</div>";
            printHTMLBottom();
        }
    }
    
    if ($SQL_DATABASE_NAME != "") {
        if(!doesDBExist()){
            $SQL_DATABASE_QUERY_DEC = "CREATE DATABASE ".$SQL_DATABASE_NAME.";";
            $SQL_DATABASE_QUERY = $connection->query($SQL_DATABASE_QUERY_DEC);
        }
    }
    $connection->close();
    
    function printWarning($w){
        echo "<div id='warn' class='warning'>".$w."</div>";
        echo "<script>setTimeout(function(){document.getElementById('warn').classList.add('hidden');},3000)</script>";
    }
    
    function printHTMLTop(){
        echo "<html>";
        echo "<head>";
        echo "<title>Blank Box - Installation</title>";
        echo "<link rel='stylesheet' type='text/css' href='../assets/style.css'/>";
        echo "</head>";
        echo "<body>";
    }
    
    function printHTMLBottom(){
        echo "</body>";
        echo "</html>";
    }
?>
