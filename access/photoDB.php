<?php 
    session_start(); 
    $conn = new mysqli("localhost", "root", "");  

    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE my_visitberlin");
    if(!empty($_POST["change"]) && $_POST["change"] == "False"){
        $old ="SELECT `image` FROM username WHERE email = '".$_SESSION["user"]."'";
        $oldphoto = $conn->query($old);
        $oldphoto = mysqli_fetch_assoc($oldphoto); 
        if(!empty($oldphoto["image"])){
            unlink("../assets/userPhoto/".$oldphoto["image"]);
            $del = "UPDATE username SET `image` = '' WHERE email = '".$_SESSION["user"]."'";
            $conn->query($del); 
        }
        header("Location: ../account.php");
        $conn->close();
        exit();
    }


    $target_dir = "../assets/userPhoto/";
    $target_file = $target_dir . basename($_FILES["pfile"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    if(isset($_POST["submit"])) {
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
        $old = "SELECT `image` FROM username WHERE email = '".$_SESSION["user"]."'";
        $oldphoto = $conn->query($old);
        $oldphoto = mysqli_fetch_assoc($oldphoto); 
        if(!empty($oldphoto["image"])){
            unlink("../assets/userPhoto/".$oldphoto["image"]);
        }
        if (move_uploaded_file($_FILES["pfile"]["tmp_name"], $target_file)) {
            $sql = "UPDATE username SET `image` = '".$_SESSION["user"] .".". $imageFileType. "' WHERE email = '".$_SESSION["user"]."'";
            $conn->query($sql);
            $oldname = "../assets/userPhoto/".htmlspecialchars(basename( $_FILES["pfile"]["name"]));
            $newname = "../assets/userPhoto/".$_SESSION["user"] .".". $imageFileType;
            rename($oldname, $newname);
        } 
    }

    header("Location: ../account.php");
    $conn->close();
    exit();
?>