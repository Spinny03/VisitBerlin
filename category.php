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
    $query = "SELECT * FROM tipo WHERE tipo.id = ".$_GET["categ"];
    $result = $conn->query($query);
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
        <link rel="stylesheet" href="css/imageGallery.css">
        <title><?php echo "ciao";?></title>
    </head>
    <body>
        <a href="index.php"><img src="assets/icon/back.svg" alt=""></a>
        <h1>Illustrations</h1>
        <h2>CURATED GALLERIES</h2>
        <div class="leftScrollMenu">
            <?php 
                for($i=0; $i<20; $i++){
                    echo  '        
                    <div class="item">
                        <div class="menuImage image" style="background-image: url(assets/berlinPhotosProva/1.jpg);">
                        </div>
                        <div class="bottomText">
                            <span class="smallText">WW1</span>
                        </div>
                    </div>';
                }
            ?>
        </div>

       
            <?php
                $query = "SELECT * FROM ldi,tipo_ldi WHERE ldi.id = tipo_ldi.ldi_id AND tipo_ldi.tipo_id = ".$_GET["categ"]." ORDER BY RAND()";
                $result = $conn->query($query);
                if($result->num_rows > 0){
                    $i = 0;
                    $first = true;
                    $tipo = array("topImage image","left1 image","left2 image","bigRight image","bottomleft image","bottomRight image");
                    // controllare chiusura div che non funziona mettere vincoli per i gli if
                    while($row = $result->fetch_assoc()){  
                        if($first && $i==0){
                            echo '<div class="imageGallery">';
                            $first = false;
                        }
                        else{
                            echo '<div class="imageGallery notFirst">';
                        }
                        echo '<div class="'.$tipo[$i].'" style="background-image: url(assets/berlinPhotosProva/'.$row["image"].');"></div>';
                        $i++;
                        if($i==6 && $first){
                            echo '</div>';
                            $i=0;
                        }
                    }
                }
            ?>

        <div class="divWrapper">
            <a href="camera.php" class="camera"><img src="assets/icon/camButton.svg" alt="" class="icon"></a>
            <nav class="bottomNav">
                <div class="insideNav">
                <a href="map.php"><img src="assets/icon/searchOff.svg" alt="" class="icon"></a>
                <a href="index.php"><img src="assets/icon/boardsOn.svg" alt="" class="icon"></a>
                </div>
                <div class="insideNav">
                <a href="liked.php"><img src="assets/icon/preferOff.svg" alt="" class="icon"></a>
                <a href="account.php"><img src="assets/icon/profileOff.svg" alt="" class="icon"></a>
                </div>
            </nav>
        </div>

    </body>
</html>