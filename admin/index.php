<?php 
    session_start(); 
    if((empty($_SESSION["admin"]) && empty($_COOKIE["admin"]))){
        header("Location: logIn.php");
        exit();
    }
    if(empty($_SESSION["admin"])){
        if(isset($_COOKIE["admin"])){
            $_SESSION["admin"] = $_COOKIE["admin"];
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/index.css">
    <title>Admin</title>
</head>
<body>
    <div class="nav">
        <h1>Pannello di controllo</h1>
        <a href="access/accountDB.php?change=logOUT">esci</a>
    </div>
    <div class="flex">
        <a href="editldi.php">Modifica luoghi di interesse</a>
        <a href="editType.php">Modifica le categorie</a>
    </div>
</body>
</html>