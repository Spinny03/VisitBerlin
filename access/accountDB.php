<?php 
    session_start();

    if($_POST["change"] == "logOUT"){
            if(isset($_COOKIE["user"])){
                unset($_COOKIE['user']);
                setcookie('user', null, -1, '/');
            }
            $_SESSION["user"] = "";
            header("Location: ../index.php");
            exit();
    }

?>