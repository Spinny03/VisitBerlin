<?php 
    session_start();

    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE Last");


    $email = $_POST["email"];
    $_SESSION["userLogin"] = $email;
    $psw = $_POST["psw"];
    $checkPsw = $_POST["Cpsw"];

    $result = $conn->query("SELECT email FROM username WHERE email = '". $email."';");
    $result = mysqli_fetch_assoc($result);

    if($result['email'] == $email){
        $_SESSION["userLogin"] = "";
        $_SESSION["exist"] = true;
        header("Location: ../signUp.php");
        $conn->close();
        exit();
    }
    
    if($psw == $checkPsw){
        mail(
            $email,
            "Grazie per eserti registrato!",
            "Ciao!\n\nTi ringraziamo per esserti registrato su Last.\n\nGrazie,\n\nLast"	
        );
        $conn->query("INSERT INTO username (email, pasw) VALUES ('".$email."', '".hash("sha256",$psw)."');");
        header("Location: ../logIn.php");
    }
    else{
        $_SESSION["check"] = true;
        header("Location: ../signUp.php");
    }
    $conn->close();
?>