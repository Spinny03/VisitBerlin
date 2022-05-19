<?php 
    session_start(); 
    if(!empty($_SESSION["user"]) || !empty($_COOKIE["user"])){
        if(!empty($_COOKIE["user"]) && empty($_SESSION["user"])){
            $_SESSION["user"] = $_COOKIE["user"];
        }
        header("Location: index.php");
        exit();
    }
?>
<!DOCTYPE html>
<html lang="it">
   <head>
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
            if(isset($_SESSION["emailFail"]) && $_SESSION["emailFail"]){
                echo'<style>
                        input[name="email"]{
                            background-color: rgba(255, 78, 113, 0.7);
                        }
                    </style>';
                $_SESSION["emailFail"]=False;
            }
            if(isset($_SESSION["paswFail"]) && $_SESSION["paswFail"]){
                echo'<style>
                        input[name="psw"]{
                            background-color: rgba(255, 78, 113, 0.7);
                        }
                    </style>';
                $_SESSION["paswFail"]=False;
            }
        ?>
        <div class="container">
                <div class="log">
                    <h1>Accedi</h1>
                    <span>Accedi con i dati che hai inserito durante la registrazione.</span>
                    <form action="access/logInDB.php" method="POST">
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
                        <label><input type="checkbox" id="remember" value="1" name="remember"><a id="labelCheck">Ricordami su questo dispositivo</a></label>
                        <button type="submit" name="login" class="logbtn">Accedi</button>
                    </form>
                </div>  
                <div class="bottom">
                    <span><a href="forgotPassw.php" class="Link">Password dimenticata?</a></span></br>
                    <span>Non hai un account? <a href="signUp.php" class="Link">Registrati</a></span>
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