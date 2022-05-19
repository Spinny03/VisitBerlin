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
    if(empty($_GET["categ"]) && empty($_GET["query"])){
        $typeName = "Tutto";
        $typeDescription = "Tutte i luoghi di interesse";
    }
    elseif(!empty($_GET["categ"])){
        $query = "SELECT * FROM tipo WHERE tipo.id = ".$_GET["categ"];
        $result = $conn->query($query);
        $type = $result->fetch_assoc();
        $typeName = $type["name"];
        $typeDescription = $type["description"];
    }
    elseif(!empty($_GET["query"])){
        $typeName = "Ricerca Personalizzata";
        $typeDescription = "Risultati per: ".$_GET["query"]."";
    }

    $_SESSION["prevPage"] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="it">
   <head>
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/navBar.css">
        <link rel="stylesheet" href="css/cardsMenu.css">
        <link rel="stylesheet" href="css/textFormat.css">
        <link rel="stylesheet" href="css/imageGallery.css">
        <link rel="stylesheet" href="css/components.css">
        <script src="jquery-2.1.4.min.js"></script>
        <title><?php echo $typeName;?></title>
    </head>
    <body>
        <a href="index.php"><img src="assets/icon/back.svg" alt="" class="backIcon"></a>
        <h1><?php echo $typeName;?></h1>
        <h2><?php echo $typeDescription;?></h2>
        <div class="leftScrollMenu">
            <?php 
                if(empty($_GET["categ"])){
                    $query = "SELECT * FROM tipo";
                }
                else{
                    $query = "SELECT * FROM tipo WHERE id != ".$_GET["categ"];
                }
                $result = $conn->query($query);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){ 
                        $query = "SELECT * FROM ldi WHERE maintipo = ".$row["id"]." ORDER BY RAND() LIMIT 1";
                        $result1 = $conn->query($query);
                        if($result1->num_rows > 0){
                            $rowIm1 = mysqli_fetch_array($result1);
                            $rowIm1 = $rowIm1["image"];
                        }
                        else{
                            $rowIm1 = "NoImg.png";
                        }
                        echo  ' 
                        <a href="category.php?categ='.$row["id"].'">       
                            <div class="item">
                                <div class="menuImage image" style="background-image: url(assets/berlinPhotosProva/'.$rowIm1.');">
                                </div>
                                <div class="bottomText">
                                    <span class="smallText">'.$row["name"].'</span>
                                </div>
                            </div>
                        </a>';
                    }
                }
            ?>
        </div>
   
            <?php                
                if(!empty($_GET["query"])){
                    $query = "SELECT * FROM ldi where `name` LIKE '%".$_GET["query"]."%'";
                }
                elseif(empty($_GET["categ"])){
                    $query = "SELECT * FROM ldi";
                }
                else{
                    $query = "SELECT * FROM ldi,tipo_ldi WHERE ldi.id = tipo_ldi.ldi_id AND tipo_ldi.tipo_id = ".$_GET["categ"];
                }
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
                        <a href="ldi.php?ldi='.$row["id"].'" class="'.$tipo[$i].'" style="background-image: url(assets/berlinPhotosProva/'.$row["image"].');">';
                            if(!empty($_SESSION["user"])){
                                $query13 = "SELECT * FROM visitati WHERE ldi_id = ".$row["id"]." AND email = '".$_SESSION["user"]."';";
                                $result13 = $conn->query($query13);
                                if($result13->num_rows == 1){
                                    $row13 = $result13->fetch_assoc();
                                    echo '<img src="assets/icon/tick.svg" alt="" >';
                                }
                            }
                        echo '</a>';
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
                    echo "<h1>Nessun luogo di interesse trovato</h1>";
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

    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    <script>
        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });
    </script>

    </body>
    <?php $conn->close(); ?>
</html>