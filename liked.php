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
    $conn->query("USE my_visitberlin");
    $_SESSION["prevPage"] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="it">
       <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <script src="jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" href="css/navBar.css">
        <link rel="stylesheet" href="css/cardsMenu.css">
        <link rel="stylesheet" href="css/textFormat.css">
        <link rel="stylesheet" href="css/imageGallery.css">
        <link rel="stylesheet" href="css/components.css">
        <title>Preferiti</title>
    </head>
    <body>
        <h1>Preferiti</h1>
        <h2>Le tue opere preferite</h2>

            <?php
            if(!empty($_SESSION["user"])){
                $query = "SELECT * FROM ldi,preferiti WHERE ldi.id = preferiti.ldi_id AND email='".$_SESSION["user"]."' ORDER BY RAND()";
                $result = $conn->query($query);
                if($result->num_rows > 0){
                    $i = 0;
                    $tipo = array("topImage image","left1 image","left2 image","bigRight image","bottomleft image","bottomRight image");
                    echo '<div class="imageGallery">';
                    while($row = $result->fetch_assoc()){  
                        if($i==6){
                            echo '<div class="imageGallery notFirst">';
                            $i=0;
                        }
                        echo '
                        <a href="ldi.php?ldi='.$row["id"].'" class="'.$tipo[$i].'" style="background-image: url(assets/berlinPhotosProva/'.$row["image"].');">

                        </a>';                        
                        $i++;
                        if($i==6){
                            echo '</div>';
                        }
                    }
                    if($i<6){
                        echo '</div>';
                    }
                }
                else{
                    echo '<h2>Non hai ancora aggiunto nessuna opera</h2>';
                }
            }
            else{
                echo "<h1>Non hai effetuato l'accesso</h1>";
            }
            ?>

        <div class="divWrapper">
            <a href="camera.php" class="camera"><img src="assets/icon/camButton.svg" alt="" class="icon"></a>
            <nav class="bottomNav">
                <div class="insideNav">
                <a href="map.php"><img src="assets/icon/searchOff.svg" alt="" class="icon"></a>
                <a href="index.php"><img src="assets/icon/boardsOff.svg" alt="" class="icon"></a>
                </div>
                <div class="insideNav">
                <a href="liked.php"><img src="assets/icon/preferOn.svg" alt="" class="icon"></a>
                <a href="profile.php"><img src="assets/icon/profileOff.svg" alt="" class="icon"></a>
                </div>
            </nav>
        </div>

    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    </body>

    <script >
        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });
    </script>
    <?php $conn->close(); ?>
</html>