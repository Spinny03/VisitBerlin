<?php 
    session_start();

    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE my_visitberlin");


    $email = $_POST["email"];
    $_SESSION["adminLogin"] = $email;
    $psw = hash("sha256",$_POST["psw"]);

    //doppia query almeno possiamo dare come feedback l'errore se username o pasw 
    $result1 = $conn->query("SELECT email FROM username WHERE `admin` = 1 and email = '". $email."';");
    $result1 = mysqli_fetch_assoc($result1);

    if($result1['email'] == $email){

        $result2 = $conn->query("SELECT pasw FROM username WHERE `admin` = 1 and email = '". $email."' AND pasw = '". $psw."';");
        $result2 = mysqli_fetch_assoc($result2);
        
        if($result2['pasw'] == $psw ){
            if(isset($_POST["remember"]) && $_POST["remember"] == 1){
                $cookie_name = "admin";
                $cookie_value = $email;
                setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); 
            } 
            $_SESSION["admin"] = $email;
            header("Location: ../editLdi.php");
        }
        else{
            $_SESSION["paswFail"] = True;
            header("Location: ../logIn.php");
        } 

    }
    else{
        $_SESSION["emailFail"] = True;
        $_SESSION["paswFail"] = True;
        header("Location: ../logIn.php");
    }

    $conn->close();
    exit();
?>