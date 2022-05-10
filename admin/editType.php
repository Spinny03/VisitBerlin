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
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
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
                $query = "SELECT * FROM tipo";
                $result = $conn->query($query);
                echo  '     
                <a href="editType.php">   
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
                        <a href="editType.php?Type='.$row["id"].'">   
                            <div class="item">
                                <div class="menuImage image" style="background-image: url(../assets/mapsIcon/'.$row["image"].');">
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
            if(!empty($_GET["Type"])){
                $query = "SELECT * FROM tipo WHERE tipo.id = ".$_GET["Type"];
                $result = $conn->query($query);
                $type = $result->fetch_assoc();    
                $img = "../assets/mapsIcon/".$type["image"];
                $name = $type["name"];
                $id = $type["id"];
                $description = $type["description"];
              }  
            else{  
                $img = "../assets/add.svg";
                $name = "";
                $id = null;
                $description = "";
            }       
        ?>
        <form id="pform" action="access/editTypeDB.php" method="POST" enctype="multipart/form-data">
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
        <form action="access/editTypeDB.php" method="POST">
            <input type="hidden" name="ldi" value="<?php echo $id;?>">
            <input type="text" name="name" value="<?php echo $name;?>">
            <input type="text" name="description" value="<?php echo $description;?>">
                <?php 
                    if(!empty($_GET["Type"])){
                        echo '<button type="submit" name="change" value="True" class="logbtn">Salva le modifiche</button>';
                    }
                    else{
                        echo '<button style="background-color: green;" type="submit" name="change" value="add" class="logbtn">Aggiungi</button>';
                    }     
                ?>       
        </form>
        <form action="access/editTypeDB.php" method="POST">
            <button type="submit" class="itemNumber formBtn" name="del" value="<?php echo $id;?>" style="background-color: white; margin-left:10px;">
                Elimina
            </button>
        </form>
    </body>
</html>