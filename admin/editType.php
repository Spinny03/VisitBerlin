<?php
    session_start();
    if((empty($_SESSION["admin"]) && empty($_COOKIE["admin"]))){
        header("Location: logIn.php");
        exit();
    }
    if(empty($_SESSION["admin"])){
        if(isset($_COOKIE["admin"])){
            $_SESSION["admin"] = $_COOKIE["admin"];
        }
    }
    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE my_visitberlin");
    if(!empty($_GET["ldi"])){
        $query = "SELECT * FROM tipo WHERE tipo.id = ".$_GET["ldi"];
        $result = $conn->query($query);
        if($result->num_rows <= 0){
            header("Location: editType.php");
            $conn->close();
            exit();
        }
        $ldi = $result->fetch_assoc();    
        $img = "../assets/mapsIcon/".$ldi["image"];
        $name = $ldi["name"];
        $id = $ldi["id"];
        $description = $ldi["description"];
      }  
    else{    
    $img = "../assets/add.svg";          
    if(file_exists("../assets/mapsIcon/new.jpg")){
        $img = "../assets/mapsIcon/new.jpg";
    }
    if( file_exists("../assets/mapsIcon/new.png")){
        $img = "../assets/mapsIcon/new.png";
    }
    if(file_exists("../assets/mapsIcon/new.jpeg")){
        $img = "../assets/mapsIcon/new.jpeg";
    }
    if(file_exists("../assets/mapsIcon/new.gif")){
        $img = "../assets/mapsIcon/new.gif";
    }
        $name = "";
        $id = "new";
        $description = "";
    }   

?>
<!DOCTYPE html>
<html lang="it">
       <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
        <meta charset="UTF-8">
    
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <link rel="stylesheet" href="../css/navBar.css">
        <link rel="stylesheet" href="../css/cardsMenu.css">
        <link rel="stylesheet" href="../css/textFormat.css">
        <link rel="stylesheet" href="../css/imageGallery.css">
        <link rel="stylesheet" href="../css/components.css">
        <link rel="stylesheet" href="css/editldi.css">
        <title>Admin</title>
    </head>
    <body style="display: block; width:100%;">
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
                        <a href="editType.php?ldi='.$row["id"].'">   
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
        <form id="pform" action="access/editTypeDB.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idldi" value="<?php echo $id;?>">
            <img width="200" height="200" src="<?php echo $img; ?>" class="profilePhotoBig">
            <label class="photoBtn" for="apply"><input class="inPhoto" type="file" name="pfile" id="apply" accept="image/*">Modifica</label>
            <button type="submit" name="change" value="False" class="photoBtn removeBtn" style="border: 1px solid #b8382f;">Rimuovi</button>
        </form>
        <script>
            document.getElementById("apply").onchange = function() {
            document.getElementById("pform").submit();
        }
        </script>
        <form action="access/editTypeDB.php" method="POST">
            <input type="hidden" name="ldi" value="<?php echo $id;?>">
            <input type="text" name="name" value="<?php echo $name;?>" placeholder="nome">
            <textarea type="text" name="description" placeholder="descrizione" rows="3"><?php echo $description;?></textarea>
                <?php 
                    if(!empty($_GET["ldi"])){
                        echo '<button type="submit" name="change" value="True" class="green">Salva le modifiche</button>';
                    }
                    else{
                        echo '<button style="" type="submit" name="change" value="add" class="green">Aggiungi</button>';
                    }     
                ?>       
        </form>
        <form action="access/editTypeDB.php" method="POST">
            <button type="submit" class="elimina" name="del" value="<?php echo $id;?>" style="">
                Elimina
            </button>
        </form>
        <div class="divWrapper">
            <nav class="bottomNav">
                <div class="insideNav">
                <a href="editLdi.php"><img src="../assets/icon/searchOff.svg" alt="" class="icon"></a>
                <a href="editType.php"><img src="../assets/icon/boardsOn.svg" alt="" class="icon"></a>
            </div>
            <div class="insideNav"> 
            <a href="logIn.php"><img src="../assets/icon/login.svg" width="25" height="25" alt="" class="icon"></a>
                <a href="access/accountDB.php?change=logOUT"><img src="../assets/icon/logout.svg" width="25" height="25" alt="" class="icon"></a>
            </div>
            </nav>
        </div>
    </body>
    <style>
        form{
            margin-top: .25rem;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap:.25rem;
        }
        .elimina{
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 16px;
            margin-top: .25rem;
            width: 50%;
        }
        .green{
            background-color: green;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 12px 16px;
            margin-top: .25rem;
            width: 50%;
        }
    </style>
</html>