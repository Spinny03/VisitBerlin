<?php 
    session_start();

    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE Last");
    
    $email = $_SESSION["userLogin"];
    $token = $_POST["token"];
    $result = $conn->query("SELECT token FROM username WHERE email = '". $email."';");
    $result = mysqli_fetch_assoc($result);

    if($result['token'] == $token){
        $conn->query("UPDATE username SET token=NULL WHERE email='".$email."';");
        $_SESSION["tokenSucc"] = True;
        header("Location: ../resetPassw.php");
    }
    else{
        $_SESSION["tokenFail"] = True;
        header("Location: ../tokenVerify.php");
    }

    $conn->close();
    exit();
?>