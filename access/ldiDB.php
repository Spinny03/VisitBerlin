<?php /*
    session_start();

    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE my_visitberlin");


    if(isset($_SESSION["user"])){
        $sql = "INSERT INTO preferiti(`ldi_id`,`email`) VALUES (".$_GET["ldi"].",'".$_SESSION["user"]."');";
        $conn->query($sql);
    }
    header("Location: ".$_SERVER['HTTP_REFERER']."");*/
    session_start();
    $conn = new mysqli("localhost", "root", "");  
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }

    $conn->query("USE my_visitberlin");

    echo '<script>console.log("dentro")</script>';

    if(isset($_POST["metti"])){
        $query = "INSERT INTO `preferiti`(`email`, `ldi_id`) VALUES ('".$_SESSION["user"]."',".$_POST["metti"].")";
        $statement = $conn->query($query);
    }
    elseif(isset($_POST["togli"])){
        $query = "DELETE FROM `preferiti` WHERE email = '".$_SESSION["user"]."' AND ldi_id = '".$_POST["togli"]."'";
        $statement = $conn->query($query);
    }

?>