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
        <title>Home</title>
    </head>
    <body>
        <h1>Boards</h1>
        <h2>Following galleries to power up your art careere</h2>
        <div class="cardsContainer">
            <?php 
                $sql = 'SELECT * FROM tipo;';
                $tipo = $conn->query($sql); 
                if($tipo->num_rows > 0){
                    while($row = $tipo->fetch_assoc()){ 
                        $sql = 'SELECT * FROM LDI, tipo_ldi WHERE LDI.id = tipo_ldi.ldi_id AND tipo_ldi.tipo_id ='.$row["id"].' ORDER BY RAND() LIMIT 3';
                        $foto = $conn->query($sql);
                        $rowIm1 = mysqli_fetch_array($foto);
                        $rowIm2 = mysqli_fetch_array($foto);
                        $rowIm3 = mysqli_fetch_array($foto);
                        echo  '
                                <div class="card">
                                    <a href="category.php?categ='.$row["id"].'">
                                        <div class="imageGallery">
                                            <div class="big image" style="background-image: url(assets/berlinPhotosProva/'.$rowIm1["image"].');">
                                            </div>
                                            <div class="small image" style="background-image: url(assets/berlinPhotosProva/'.$rowIm2["image"].');">
                                            </div>
                                            <div class="small image" style="background-image: url(assets/berlinPhotosProva/'.$rowIm3["image"].');">
                                            </div>
                                        </div>
                                        <div class="cardBottom">
                                            <span class="cardTitle">'.$row["name"].'</span>
                                        </div>
                                    </a>
                                </div>';
                    }
                }
            ?>
        </div>

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
    <?php $conn->close(); ?>
</html>

