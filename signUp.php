<?php 
    session_start();   
    if(!empty($_SESSION["user"]) || !empty($_COOKIE["user"])){
        if(!empty($_COOKIE["user"]) && empty($_SESSION["user"])){
            $_SESSION["user"] = $_COOKIE["user"];
        }
        header("Location: home.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="it">
       <head>
       <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <meta name="viewport" content="width=device-width" />
    <link rel="stylesheet" href="css/navBar.css">
        <link rel="stylesheet" href="css/cardsMenu.css">
        <link rel="stylesheet" href="css/textFormat.css">
        <link rel="stylesheet" href="css/loginRegister.css">
        <link rel="stylesheet" href="css/components.css">
        <title>Last</title>
    </head>
    <body>
        <?php 
            if(isset($_SESSION["exist"]) && $_SESSION["exist"]){
                echo'<style>
                        input[name="email"]{
                            background-color: rgba(255, 78, 113, 0.4);
                        }
                    </style>';
                $_SESSION["exist"]=False;
            }
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
                    <h1>Registrati</h1>
                    <span>Inserire i tuoi dati personali per creare un nuovo account</span>
                
                    <form action="access/signUpDB.php" method="POST" class="logForm">
                        
                        <label for="email"><b>Email</b></label>
                        <input type="text" placeholder="nome@esempio.com" name="email" 
                            <?php
                                if(isset($_SESSION["userLogin"])){
                                    echo "value='".$_SESSION["userLogin"]."'";
                                }
                            ?> 
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                        
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="min. 8 caratteri" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve contenere almeno un numero e una lettera maiuscola e minuscola e almeno 8 o più caratteri" required>
                        <label for="Cpsw"><b>Conferma password</b></label>
                        <input type="password" placeholder="inserisci la stessa password" name="Cpsw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve contenere almeno un numero e una lettera maiuscola e minuscola e almeno 8 o più caratteri" required>
                        <button type="submit" name="register" class="logbtn">Registrati</button>
                    </form>
                </div>
                <div class="bottom">
                        <span>Sei già registrato? <a href="logIn.php" class="Link">Accedi</a></span>
                </div>
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
                <a href="account.php"><img src="assets/icon/profileOn.svg" alt="" class="icon"></a>
                </div>
            </nav>
        </div>
    </body>
</html>