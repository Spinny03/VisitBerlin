<?php 
    session_start();

    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE my_visitberlin");

    if(isset($_POST["change"]) && $_POST["change"] == "logOUT"){
            if(isset($_COOKIE["user"])){
                unset($_COOKIE['user']);
                setcookie('user', null, -1, '/');
            }
            $_SESSION["user"] = "";
            header("Location: ../index.php");
            exit();
    }
    if(isset($_POST["change"]) && $_POST["change"] == "True"){
        //aggiorna il nome e il cognome dell utente nel database
        $query = "UPDATE username SET `firstName` = '".$_POST["name"]."', `surname` = '".$_POST["surname"]."' WHERE `email` = '".$_SESSION["user"]."';";
        $statement = $conn->query($query);
        header("Location: ../account.php");
        exit();
    }
    if(isset($_POST["check"]) && isset($_SESSION["user"]) && $_POST["check"] == "true"){
        //modifica il campo notice a true
        $query = "UPDATE `username` SET `notice`=1 WHERE `email`='".$_SESSION["user"]."';";
        $statement = $conn->query($query);
    }
    elseif(isset($_POST["check"]) && isset($_SESSION["user"]) && $_POST["check"] == "false"){
        //modifica il campo notice a false
        $query = "UPDATE `username` SET `notice`=0 WHERE `email`='".$_SESSION["user"]."';";
        $statement = $conn->query($query);
    }
    if(isset($_POST["control"]) && $_POST["control"] == "true"){
        //controlla che il campo notice sia 1
        $query = "SELECT * FROM `username` WHERE `email`='".$_SESSION["user"]."' AND `notice`=1;";
        $statement = $conn->query($query);
        if($statement->num_rows > 0){
            echo "true";
        }
        else{
            echo "false";
        }
    }
    $conn->close();

?>