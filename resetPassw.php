<?php 
    session_start();   
    if(empty($_SESSION["user"])){
        if(isset($_COOKIE["user"])){
            $_SESSION["user"] = $_COOKIE["user"];
        }
    }
    if(empty($_SESSION["userLogin"])){
        header("Location: forgotPassw.php");
    }
?>
<!DOCTYPE html>
<html lang="it">
       <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <script src="jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" href="css/components.css">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="css/loginRegister.css">
        <link rel="stylesheet" href="css/navBar.css">
        <script src="jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" href="css/components.css">
        <title>Reset Password</title>
    </head>
    <body>
        <?php 
            if(isset($_SESSION["check"]) && $_SESSION["check"]){
                echo'<style>
                        input[name="Cpsw"]{
                            background-color: rgba(255, 78, 113, 0.4);
                        }
                    </style>';
                $_SESSION["check"]=False;
            }
        ?>
        <div class="container">
                <div class="log">
                    <h1>Reset password</h1>
                    <span>Cambia la password con una nuova</span>
                    <form action="access/resetPasswDB.php" method="POST">
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="min. 8 caratteri" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve contenere almeno un numero e una lettera maiuscola e minuscola e almeno 8 o più caratteri" required>
                        <label for="Cpsw"><b>Conferma password</b></label>
                        <input type="password" placeholder="inserisci la stessa password" name="Cpsw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve contenere almeno un numero e una lettera maiuscola e minuscola e almeno 8 o più caratteri" required>
                        <button type="submit" name="register" class="logbtn">Cambia</button>
                    </form>
            </div>
        </div>
        <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>
    <div class="divWrapper">
            <a href="camera.php" class="camera"><img src="assets/icon/camButton.svg" alt="" class="icon"></a>
            <nav class="bottomNav">
                <div class="insideNav">
                <a href="map.php"><img src="assets/icon/searchOff.svg" alt="" class="icon"></a>
                <a href="index.php"><img src="assets/icon/boardsOff.svg" alt="" class="icon"></a>
                </div>
                <div class="insideNav">
                <a href="liked.php"><img src="assets/icon/preferOff.svg" alt="" class="icon"></a>
                <a href="profile.php"><img src="assets/icon/profileOn.svg" alt="" class="icon"></a>
                </div>
            </nav>
        </div>
    <script>
        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });
    </script>
    </body>
</html>