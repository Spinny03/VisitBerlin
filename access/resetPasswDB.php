<?php 
    session_start();

    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE my_visitberlin");

    if(!empty($_SESSION["userLogin"]) && !empty($_SESSION["tokenSucc"])){
        $email = $_SESSION["userLogin"];
        $psw = $_POST["psw"];
        $checkPsw = $_POST["Cpsw"];
        
        if($psw == $checkPsw){
            mail(
                $email,
                "Password Modificata",
                "Ciao!\n\nÈ stata modificata la tua password, se non sei stato tu contatacci.\n\nGrazie,\n\nLast",
                "From: Last <noreply@last.com>"		
            
            );
            $conn->query("UPDATE username SET pasw='".hash("sha256",$psw)."' WHERE email='".$email."';");
            header("Location: ../logIn.php");
        }
        else{
            $_SESSION["check"] = true;
            header("Location: ../resetPassw.php");
        }
    }
    else{
        header("Location: ../forgotPassw.php");
    }
    $conn->close();
?>