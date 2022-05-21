<?php 
    session_start();

    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE my_visitberlin");
    
    $email = $_POST["email"];
    $_SESSION["userLogin"] = $email;

    $result = $conn->query("SELECT email FROM username WHERE email = '". $email."';");
    $result = mysqli_fetch_assoc($result);

    if($result['email'] == $email){
        $token = rand(0, 999999);
        mail(
            $email,
            "Recupero password ".$token,
            "Ciao!\n\nQuesto è il codice di recupero. ".$token."\n\nGrazie,\n\Visit Berlin",
            "From: Visit Berlin <noreply@visitberlin.com>"		
        );
        $conn->query("UPDATE username SET token='".$token."' WHERE email='".$email."';");
        header("Location: ../tokenVerify.php");
    }
    else{
        $_SESSION["emailFail"] = True;
        header("Location: ../forgotPassw.php");
    }
    
    $conn->close();
    exit();
?>