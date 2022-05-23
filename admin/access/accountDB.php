<?php 
    session_start();

    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE my_visitberlin");

    if(isset($_GET["change"]) && $_GET["change"] == "logOUT"){
            if(isset($_COOKIE["admin"])){
                unset($_COOKIE['admin']);
                setcookie('admin', null, -1, '/');
            }
            $_SESSION["admin"] = "";
            header("Location: ../index.php");
            exit();
    }
    $conn->close();

?>