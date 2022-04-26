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
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/navBar.css">
        <link rel="stylesheet" href="css/cardsMenu.css">
        <link rel="stylesheet" href="css/textFormat.css">
        <title>Preferiti</title>
    </head>
    <body>
        <h1>Preferiti</h1>
        <h2>Le tue opere preferite</h2>

        <div class="cardsContainer">
            <?php 
                for($i=0; $i<20; $i++){
                    echo  '
                    <div class="card">
                        <div class="imageGallery">
                            <div class="big image" style="background-image: url(assets/berlinPhotosProva/1.jpg);">
                            </div>
                            <div class="small image" style="background-image: url(assets/berlinPhotosProva/2.jpg);">
                            </div>
                            <div class="small image" style="background-image: url(assets/berlinPhotosProva/3.avif);">
                            </div>
                        </div>
                        <div class="cardBottom">
                            <span class="cardTitle">DOVREBBERO ESSERE SOLO IMAGINI </span>
                        </div>
                    </div>';
                }
            ?>
        </div>

        <div class="divWrapper">
            <a href="camera.php" class="camera"><img src="assets/icon/camButton.svg" alt="" class="icon"></a>
            <nav class="bottomNav">
                <div class="insideNav">
                <a href="map.php"><img src="assets/icon/searchOff.svg" alt="" class="icon"></a>
                <a href="index.php"><img src="assets/icon/boardsOff.svg" alt="" class="icon"></a>
                </div>
                <div class="insideNav">
                <a href="liked.php"><img src="assets/icon/preferON.svg" alt="" class="icon"></a>
                <a href="account.php"><img src="assets/icon/profileOff.svg" alt="" class="icon"></a>
                </div>
            </nav>
        </div>

    </body>
</html>