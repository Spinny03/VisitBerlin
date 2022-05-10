<?php 
    session_start(); 
    if(empty($_SESSION["user"])){
        if(isset($_COOKIE["user"])){
            $_SESSION["user"] = $_COOKIE["user"];
        }
    }
    $conn = new mysqli("localhost", "root", "");  
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE Last");
    if(empty($_GET["ldi"])){
        header("Location: index.php");
    }
    else{
        $query = "SELECT * FROM ldi WHERE ldi.id = ".$_GET["ldi"];
        $result = $conn->query($query);
        $ldi = $result->fetch_assoc();
        //echo "<img style='height: 100%; width: 100%;' src='assets/berlinPhotosProva/".$ldi["image"]."' alt=''>";
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/ldi.css">
    <title>Document</title>
</head>
    <body style="background-image:url('assets/berlinPhotosProva/<?php echo $ldi["image"]?>');">
        <div class="hid-box">
            <div class="open">
                <span>apri</span>
            </div>
        </div>
    </body>
</html>