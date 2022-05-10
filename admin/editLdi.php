<?php
    session_start();/*
    if((empty($_SESSION["admin"]) && empty($_COOKIE["admin"]))){
        header("Location: home.php");
        exit();
    }
    if(empty($_SESSION["admin"])){
        if(isset($_COOKIE["admin"])){
            $_SESSION["admin"] = $_COOKIE["admin"];
        }
    }*/
    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE Last");
    if(!empty($_GET["ldi"])){
        $query = "SELECT * FROM ldi WHERE ldi.id = ".$_GET["ldi"];
        $result = $conn->query($query);
        $ldi = $result->fetch_assoc();    
        $img = "../assets/berlinPhotosProva/".$ldi["image"];
        $name = $ldi["name"];
        $id = $ldi["id"];
        $description = $ldi["description"];
        $lon = $ldi["lon"];
        $lat = $ldi["lat"];
        $mainTipo = $ldi["mainTipo"];
      }  
    else{    
    $img = "../assets/add.svg";          
    if(file_exists("../assets/berlinPhotosProva/new.jpg")){
        $img = "../assets/berlinPhotosProva/new.jpg";
    }
    if( file_exists("../assets/berlinPhotosProva/new.png")){
        $img = "../assets/berlinPhotosProva/new.png";
    }
    if(file_exists("../assets/berlinPhotosProva/new.jpeg")){
        $img = "../assets/berlinPhotosProva/new.jpeg";
    }
    if(file_exists("../assets/berlinPhotosProva/new.gif")){
        $img = "../assets/berlinPhotosProva/new.gif";
    }
        $name = "";
        $id = "new";
        $description = "";
        $lon = "";
        $lat = "";
        $mainTipo = "";
    }   

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <link rel="stylesheet" href="../css/navBar.css">
        <link rel="stylesheet" href="../css/cardsMenu.css">
        <link rel="stylesheet" href="../css/textFormat.css">
        <link rel="stylesheet" href="../css/imageGallery.css">
        <link rel="stylesheet" href="../css/components.css">
        <title>Admin</title>
    </head>
    <body>
    <div class="leftScrollMenu">
            <?php 
                $query = "SELECT * FROM ldi";
                $result = $conn->query($query);
                echo  '     
                <a href="editLdi.php">   
                    <div class="item">
                        <div class="menuImage image" style="background-image: url(../assets/add.svg);">
                        </div>
                        <div class="bottomText">
                            <span class="smallText">add</span>
                        </div>
                    </div>
                    </a>';
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo  '     
                        <a href="editLdi.php?ldi='.$row["id"].'">   
                            <div class="item">
                                <div class="menuImage image" style="background-image: url(../assets/berlinPhotosProva/'.$row["image"].');">
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
        <form id="pform" action="access/editLdiDB.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idLdi" value="<?php echo $id;?>">
            <img width="200" height="200" src="<?php echo $img; ?>" class="profilePhotoBig">
            <label class="photoBtn" for="apply"><input class="inPhoto" type="file" name="pfile" id="apply" accept="image/*">Modifica</label>
            <button type="submit" name="change" value="False" class="photoBtn removeBtn">Rimuovi</button>
        </form>
        <script>
            document.getElementById("apply").onchange = function() {
            document.getElementById("pform").submit();
        }
        </script>
        <form action="access/editLdiDB.php" method="POST">
            <input type="hidden" name="ldi" value="<?php echo $id;?>">
            <input type="text" name="name" value="<?php echo $name;?>">
            <input type="text" name="description" value="<?php echo $description;?>">
            <input type="text" name="lon" value="<?php echo $lon;?>">
            <input type="text" name="lat" value="<?php echo $lat;?>">
            <input type="text" name="mainTipo" value="<?php echo $mainTipo;?>">
                <?php 
                    if(!empty($_GET["ldi"])){
                        echo '<button type="submit" name="change" value="True" class="logbtn">Salva le modifiche</button>';
                    }
                    else{
                        echo '<button style="background-color: green;" type="submit" name="change" value="add" class="logbtn">Aggiungi</button>';
                    }     
                ?>       
        </form>
        <form action="access/editLdiDB.php" method="POST">
            <button type="submit" class="itemNumber formBtn" name="del" value="<?php echo $id;?>" style="background-color: white; margin-left:10px;">
                Elimina
            </button>
        </form>
    </body>
</html>