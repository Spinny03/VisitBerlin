<?php 
    session_start();
    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE Last");
    if(isset($_POST["del"])){
        echo "9";
        $delPhoto = 'SELECT `image` FROM ldi WHERE id = "'.$_POST["del"].'";';
        $result = $conn->query($delPhoto); 
        $result = mysqli_fetch_assoc($result);
        if(!empty($oldphoto["image"]) && $result["image"] != "NoImg.png"){
            unlink("../../assets/berlinPhotosProva/".$result["image"]);
        }
        $sql = 'DELETE FROM ldi WHERE id = "'.$_POST["del"].'";';
        $conn->query($sql); 
        $sql = 'DELETE FROM preferiti WHERE ldi_id = "'.$_POST["del"].'";';
        $conn->query($sql); 
        $sql = 'DELETE FROM tipo_ldi WHERE ldi_id = "'.$_POST["del"].'";';
        $conn->query($sql); 
        header("Location: ../editLdi.php");
        $conn->close();
        exit();
    }
    elseif(isset($_POST["change"]) && $_POST["change"]  == "True"){
        echo "18";
        if(!empty($_POST["name"])  || !empty($_POST["description"] || !empty($_POST["lon"]) || !empty($_POST["lat"]) || !empty($_POST["mainTipo"]))){
            echo "20";
            $delPhoto = 'SELECT `image` FROM ldi WHERE id = "'.$_POST["ldi"].'";';
            $result = $conn->query($delPhoto); 
            $result = mysqli_fetch_assoc($result);
            $sql = "";
            if(!empty($_POST["name"])){
                $sql .= 'name = "'.$_POST["name"].'",';   
            }

            if(!empty($_POST["description"])){
                $sql .= 'description = "'.$_POST["description"].'",';
            }

            if(!empty($_POST["lon"])){
                $sql .= 'lon = "'.$_POST["lon"].'",';
            }

            if(!empty($_POST["lat"])){
                $sql .= 'lat = "'.$_POST["lat"].'",';
            }

            if(!empty($_POST["mainTipo"])){
                $sql .= 'mainTipo = "'.$_POST["mainTipo"].'",';
            }
            $cut = "DELETE FROM tipo_ldi WHERE ldi_id = '".$_POST["ldi"]."';";
            echo $cut;
            $conn->query($cut);
            if(isset($_POST["tipo"])){
                foreach($_POST["tipo"] as $tipo){
                    $add = "INSERT INTO tipo_ldi SET ldi_id = '".$_POST["ldi"]."', tipo_id = '".$tipo."';";
                    echo $add;
                    $conn->query($add);
                }
            }



            $sql = substr($sql, 0, -1);
            $conn->query('UPDATE ldi SET '.$sql.' WHERE id = "'.$_POST["ldi"].'";');

            $id = 'SELECT id FROM ldi WHERE `image` = "'.$result["image"].'";';
            $id = $conn->query($id); 
            $id = mysqli_fetch_assoc($id);
            if(!empty($result["image"]) && $result["image"] != "NoImg.png"){
                $oldname = "../../assets/berlinPhotosProva/".$result["image"];
                $imageFileType = strtolower(pathinfo($result["image"], PATHINFO_EXTENSION));
                $newname = "../../assets/berlinPhotosProva/".$id["id"].".". $imageFileType;
                rename($oldname, $newname);
                $conn->query('UPDATE ldi SET `image` ="'.$id["id"].".". $imageFileType.'" WHERE id="'.$id["id"].'";');
            }
            header("Location: ../editLdi.php?ldi=".$id["id"]);
            $conn->close();
            exit();
        }
    }
    elseif(isset($_POST["change"]) && $_POST["change"] == "add"){
        echo "60";
        if(!empty($_POST["name"])  || !empty($_POST["description"] || !empty($_POST["lon"]) || !empty($_POST["lat"]) || !empty($_POST["mainTipo"]))){
            echo "62";
            $sql = "";
            if(!empty($_POST["name"])){
                $sql .= 'name = "'.$_POST["name"].'",';   
            }

            if(!empty($_POST["description"])){
                $sql .= 'description = "'.$_POST["description"].'",';
            }

            if(!empty($_POST["lon"])){
                $sql .= 'lon = "'.$_POST["lon"].'",';
            }

            if(!empty($_POST["lat"])){
                $sql .= 'lat = "'.$_POST["lat"].'",';
            }

            if(!empty($_POST["mainTipo"])){
                $sql .= 'mainTipo = "'.$_POST["mainTipo"].'",';
            }
            $sql = substr($sql, 0, -1);
            $conn->query("INSERT INTO ldi SET ".$sql.";");

            //da provare a casa
            $sql1 = "SELECT * From users WHERE newsletter = 1;";
            $result = $conn->query($sql1);
            while($row = mysqli_fetch_assoc($result)){
                $to = $row["email"];
                $subject = "Novità sulla città di Berlino";
                $message = "Ciao ".$row["firstName"]." ".$row["surname"]."!\n\n";
                $message .= "Abbiamo aggiunto: ".$_POST["name"].".\n\n";
                $message .= "http://localhost/Last/ldi.php?ldi='.$id.'";
                $message .= "Grazie per averci scelto!\n\n";
                $message .= "Cordiali saluti,\n\n";
                $message .= "Il team di Last";
                $headers = "From: Last <filippospi03@gmail.com>";
                mail($to, $subject, $message, $headers);
            }

            
            $sql = 'SELECT id FROM ldi WHERE '.$sql.';';
            $sql = str_replace(",", " AND ", $sql);
            $result = $conn->query($sql);
            $result = mysqli_fetch_assoc($result);

            if(isset($_POST["tipo"])){
                foreach($_POST["tipo"] as $tipo){
                    $add = "INSERT INTO tipo_ldi SET ldi_id = '".$result["id"]."', tipo_id = '".$tipo."';";
                    echo $add;
                    $conn->query($add);
                }
            }

            if(file_exists("../../assets/berlinPhotosProva/new.jpg")){
                $sql = 'UPDATE ldi SET `image` = "'.$result["id"].'.jpg" WHERE id = "'.$result["id"].'"';
                $conn->query($sql);
                rename('../../assets/berlinPhotosProva/new.jpg', '../../assets/berlinPhotosProva/'.$result["id"].'.jpg');
            }
            elseif( file_exists("../../assets/berlinPhotosProva/new.png")){
                $sql = 'UPDATE ldi SET `image` = "'.$result["id"].'.png" WHERE id = "'.$result["id"].'"';
                $conn->query($sql);
                rename('../../assets/berlinPhotosProva/new.png', '../../assets/berlinPhotosProva/'.$result["id"].'.png');
            }
            elseif(file_exists("../../assets/berlinPhotosProva/new.jpeg")){
                $sql = 'UPDATE ldi SET `image` = "'.$result["id"].'.jpeg" WHERE id = "'.$result["id"].'"';
                $conn->query($sql);
                rename('../../assets/berlinPhotosProva/new.jpeg', '../../assets/berlinPhotosProva/'.$result["id"].'.jpeg');
            }
            elseif(file_exists("../../assets/berlinPhotosProva/new.gif")){
                $sql = 'UPDATE ldi SET `image` = "'.$result["id"].'.gif" WHERE id = "'.$result["id"].'"';
                $conn->query($sql);
                rename('../../assets/berlinPhotosProva/new.gif', '../../assets/berlinPhotosProva/'.$result["id"].'.gif');
            }
            else{
                echo "122";
                $sql = 'UPDATE ldi SET `image` = "NoImg.png" WHERE id = "'.$result["id"].'"';
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
                $old ="SELECT `image` FROM ldi WHERE id = '".$_POST["idLdi"]."'";
                $oldphoto = $conn->query($old);
                $oldphoto = mysqli_fetch_assoc($oldphoto); 
                if(!empty($oldphoto["image"]) && $oldphoto["image"] != "NoImg.png"){
                    unlink("../../assets/berlinPhotosProva/".$oldphoto["image"]);
                    $del = "UPDATE ldi SET `image` = 'NoImg.png' WHERE id = '".$_POST["idLdi"]."'";
                    $conn->query($del);
                }
                header("Location: ../editLdi.php?ldi=".$_POST["idLdi"]);
                $conn->close();
                exit();
            }
        
        
            $target_dir = "../../assets/berlinPhotosProva/";
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
                $old = "SELECT `image` FROM ldi WHERE id = '".$_POST["idLdi"]."'";
                $oldphoto = $conn->query($old);
                $oldphoto = mysqli_fetch_assoc($oldphoto); 
                if(!empty($oldphoto["image"]) && $oldphoto["image"] != "NoImg.png"){
                    unlink("../../assets/berlinPhotosProva/".$oldphoto["image"]);
                }
                if (move_uploaded_file($_FILES["pfile"]["tmp_name"], $target_file)) {
                    $sql = "UPDATE ldi SET `image` = '".$_POST["idLdi"] .".". $imageFileType. "' WHERE id = '".$_POST["idLdi"]."'";
                    $conn->query($sql);
                } 
            }
        
            $oldname = "../../assets/berlinPhotosProva/".htmlspecialchars(basename( $_FILES["pfile"]["name"]));
            $newname = "../../assets/berlinPhotosProva/".$_POST["idLdi"] .".". $imageFileType;
            rename($oldname, $newname);
            header("Location: ../editLdi.php?ldi=".$_POST["idLdi"]);
            $conn->close();
            exit();
        }
        else{
            echo "173";
            if(file_exists("../../assets/berlinPhotosProva/new.jpg")){
                unlink("../../assets/berlinPhotosProva/new.jpg");
            }
            if( file_exists("../../assets/berlinPhotosProva/new.png")){
                unlink("../../assets/berlinPhotosProva/new.png");
            }
            if(file_exists("../../assets/berlinPhotosProva/new.jpeg")){
                unlink("../../assets/berlinPhotosProva/new.jpeg");
            }
            if(file_exists("../../assets/berlinPhotosProva/new.gif")){
                unlink("../../assets/berlinPhotosProva/new.gif");
            }
            $target_dir = "../../assets/berlinPhotosProva/";
            $target_file = $target_dir . basename($_FILES["pfile"]["name"]);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            move_uploaded_file($_FILES["pfile"]["tmp_name"], $target_file);
            $oldname = "../../assets/berlinPhotosProva/".htmlspecialchars(basename( $_FILES["pfile"]["name"]));
            $newname = "../../assets/berlinPhotosProva/new.". $imageFileType;
            rename($oldname, $newname);
        }
    }
    header("Location: ../editLdi.php");
    $conn->close();
    exit();
?>