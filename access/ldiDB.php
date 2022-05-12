<?php 
    session_start();

    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE Last");

    $sql = "INSERT INTO preferiti(`ldi_id`,`email`) VALUES (".$_GET["ldi"].",'".$_SESSION["user"]."');";
    $conn->query($sql);
    header("Location: ".$_SERVER['HTTP_REFERER']."");
?>