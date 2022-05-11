<?php 
    session_start();
    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE Last");
    if(isset($_POST["del"])){
        echo "9";
        $delPhoto = 'SELECT `image` FROM tipo WHERE id = "'.$_POST["del"].'";';
        $result = $conn->query($delPhoto); 
        $result = mysqli_fetch_assoc($result);
        if(!empty($oldphoto["image"]) && $result["image"] != "NoImg.svg"){
            unlink("../../assets/mapsIcon/".$result["image"]);
        }
        $sql = 'DELETE FROM tipo WHERE id = "'.$_POST["del"].'";';
        $conn->query($sql); 
        $sql = 'DELETE FROM preferiti WHERE ldi_id = "'.$_POST["del"].'";';
        $conn->query($sql); 
        $sql = 'DELETE FROM tipo_ldi WHERE ldi_id = "'.$_POST["del"].'";';
        $conn->query($sql); 
        $sql = 'DELETE FROM ldi WHERE mainTipo = "'.$_POST["del"].'";';
        $conn->query($sql); 
        header("Location: ../editType.php");
        $conn->close();
        exit();
    }
    elseif(isset($_POST["change"]) && $_POST["change"]  == "True"){
        echo "18";
        if(!empty($_POST["name"])  || !empty($_POST["description"] )){
            echo "20";
            $delPhoto = 'SELECT `image` FROM tipo WHERE id = "'.$_POST["ldi"].'";';
            $result = $conn->query($delPhoto); 
            $result = mysqli_fetch_assoc($result);
            $sql = "";
            if(!empty($_POST["name"])){
                $sql .= 'name = "'.$_POST["name"].'",';   
            }

            if(!empty($_POST["description"])){
                $sql .= 'description = "'.$_POST["description"].'",';
            }
            $sql = substr($sql, 0, -1);
            $conn->query('UPDATE tipo SET '.$sql.' WHERE id = "'.$_POST["ldi"].'";');

            $id = 'SELECT id FROM tipo WHERE `image` = "'.$result["image"].'";';
            $id = $conn->query($id); 
            $id = mysqli_fetch_assoc($id);
            
            if(!empty($result["image"]) && $result["image"] != "NoImg.svg"){
                $oldname = "../../assets/mapsIcon/".$result["image"];
                $imageFileType = strtolower(pathinfo($result["image"], PATHINFO_EXTENSION));
                $newname = "../../assets/mapsIcon/".$id["id"].".". $imageFileType;
                rename($oldname, $newname);
                $conn->query('UPDATE tipo SET `image` ="'.$id["id"].".". $imageFileType.'" WHERE id="'.$id["id"].'";');
            }
            header("Location: ../editType.php?ldi=".$id["id"]);
            $conn->close();
            exit();
        }
    }
    elseif(isset($_POST["change"]) && $_POST["change"] == "add"){
        echo "60";
        if(!empty($_POST["name"])  || !empty($_POST["description"] )){
            echo "62";
            $sql = "";
            if(!empty($_POST["name"])){
                $sql .= 'name = "'.$_POST["name"].'",';   
            }

            if(!empty($_POST["description"])){
                $sql .= 'description = "'.$_POST["description"].'",';
            }
            $sql = substr($sql, 0, -1);
            $conn->query("INSERT INTO tipo SET ".$sql.";");

            
            $sql = 'SELECT id FROM tipo WHERE '.$sql.';';
            $sql = str_replace(",", " AND ", $sql);
            $result = $conn->query($sql);
            $result = mysqli_fetch_assoc($result);

            if(file_exists("../../assets/mapsIcon/new.jpg")){
                $sql = 'UPDATE tipo SET `image` = "'.$result["id"].'.jpg" WHERE id = "'.$result["id"].'"';
                $conn->query($sql);
                rename('../../assets/mapsIcon/new.jpg', '../../assets/mapsIcon/'.$result["id"].'.jpg');
            }
            elseif( file_exists("../../assets/mapsIcon/new.png")){
                $sql = 'UPDATE tipo SET `image` = "'.$result["id"].'.png" WHERE id = "'.$result["id"].'"';
                $conn->query($sql);
                rename('../../assets/mapsIcon/new.png', '../../assets/mapsIcon/'.$result["id"].'.png');
            }
            elseif(file_exists("../../assets/mapsIcon/new.jpeg")){
                $sql = 'UPDATE tipo SET `image` = "'.$result["id"].'.jpeg" WHERE id = "'.$result["id"].'"';
                $conn->query($sql);
                rename('../../assets/mapsIcon/new.jpeg', '../../assets/mapsIcon/'.$result["id"].'.jpeg');
            }
            elseif(file_exists("../../assets/mapsIcon/new.gif")){
                $sql = 'UPDATE tipo SET `image` = "'.$result["id"].'.gif" WHERE id = "'.$result["id"].'"';
                $conn->query($sql);
                rename('../../assets/mapsIcon/new.gif', '../../assets/mapsIcon/'.$result["id"].'.gif');
            }
            else{
                echo "122";
                $sql = 'UPDATE tipo SET `image` = "NoImg.svg" WHERE id = "'.$result["id"].'"';
                $conn->query($sql);
            }
        }
    }
    elseif(isset($_POST["idLdi"])){ 
        echo "115";
        if($_POST["idLdi"] != "new"){ 
            echo "117";
            if(!empty($_POST["change"]) && $_POST["change"] == "False" ){
                echo "132";
                $old ="SELECT `image` FROM tipo WHERE id = '".$_POST["idLdi"]."'";
                $oldphoto = $conn->query($old);
                $oldphoto = mysqli_fetch_assoc($oldphoto); 
                if(!empty($oldphoto["image"]) && $oldphoto["image"] != "NoImg.svg"){
                    unlink("../../assets/mapsIcon/".$oldphoto["image"]);
                    $del = "UPDATE tipo SET `image` = 'NoImg.svg' WHERE id = '".$_POST["idLdi"]."'";
                    $conn->query($del);
                }
                header("Location: ../editType.php?ldi=".$_POST["idLdi"]);
                $conn->close();
                exit();
            }
        
        
            $target_dir = "../../assets/mapsIcon/";
            $target_file = $target_dir . basename($_FILES["pfile"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            
            if(isset($_POST["submit"])) {
                echo "139";
                $check = getimagesize($_FILES["pfile"]["tmp_name"]);
                if($check !== false) {
                    $uploadOk = 1;
                } else {
                    $uploadOk = 0;
                }
            }
            
            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
                $uploadOk = 0;
            }
            
            if ($uploadOk != 0) {
                $old = "SELECT `image` FROM tipo WHERE id = '".$_POST["idLdi"]."'";
                $oldphoto = $conn->query($old);
                $oldphoto = mysqli_fetch_assoc($oldphoto); 
                if(!empty($oldphoto["image"]) && $oldphoto["image"] != "NoImg.svg"){
                    unlink("../../assets/mapsIcon/".$oldphoto["image"]);
                }
                if (move_uploaded_file($_FILES["pfile"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE tipo SET `image` = '".$_POST["idLdi"] .".". $imageFileType. "' WHERE id = '".$_POST["idLdi"]."'";
                    $conn->query($sql);
                } 
            }
        
            $oldname = "../../assets/mapsIcon/".htmlspecialchars(basename( $_FILES["pfile"]["name"]));
            $newname = "../../assets/mapsIcon/".$_POST["idLdi"] .".". $imageFileType;
            rename($oldname, $newname);
            header("Location: ../editType.php?ldi=".$_POST["idLdi"]);
            $conn->close();
            exit();
        }
        else{
            echo "173";
            if(file_exists("../../assets/mapsIcon/new.jpg")){
                unlink("../../assets/mapsIcon/new.jpg");
            }
            if( file_exists("../../assets/mapsIcon/new.png")){
                unlink("../../assets/mapsIcon/new.png");
            }
            if(file_exists("../../assets/mapsIcon/new.jpeg")){
                unlink("../../assets/mapsIcon/new.jpeg");
            }
            if(file_exists("../../assets/mapsIcon/new.gif")){
                unlink("../../assets/mapsIcon/new.gif");
            }
            $target_dir = "../../assets/mapsIcon/";
            $target_file = $target_dir . basename($_FILES["pfile"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            move_uploaded_file($_FILES["pfile"]["tmp_name"], $target_file);
            $oldname = "../../assets/mapsIcon/".htmlspecialchars(basename( $_FILES["pfile"]["name"]));
            $newname = "../../assets/mapsIcon/new.". $imageFileType;
            rename($oldname, $newname);
        }
    }
    header("Location: ../editType.php");
    $conn->close();
    exit();
?>