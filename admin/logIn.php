<?php 
    session_start(); 
    if(!empty($_SESSION["admin"]) || !empty($_COOKIE["admin"])){
        if(!empty($_COOKIE["admin"]) && empty($_SESSION["admin"])){
            $_SESSION["admin"] = $_COOKIE["admin"];
        }
    }
?>
<!DOCTYPE html>
<html lang="it">
       <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <meta name="viewport" content="width=device-width" />
        <script src="jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" href="../css/navBar.css">
        <link rel="stylesheet" href="../css/cardsMenu.css">
        <link rel="stylesheet" href="../css/textFormat.css">
        <link rel="stylesheet" href="../css/loginRegister.css">
        <link rel="stylesheet" href="../css/components.css">
        <title>Log In</title>
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
                    <h1>Admin accedi</h1>
                    <span>Accedi con i dati che hai inserito durante la registrazione.</span>
                    <form action="access/logInDB.php" method="POST">
                        <label for="email"><b>Email</b></label>
                        <input type="text" placeholder="nome@esempio.com" name="email" 
                            <?php
                                if(isset($_SESSION["adminLogin"])){
                                    echo "value='".$_SESSION["adminLogin"]."'";
                                }
                            ?> 
                        pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>

                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="min. 8 caratteri" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve contenere almeno un numero e una lettera maiuscola e minuscola e almeno 8 o più caratteri" required>
                        <label><input type="checkbox" id="remember" value="1" name="remember"><a id="labelCheck">Ricordami su questo dispositivo</a></label>
                        <button type="submit" name="login" class="logbtn">Accedi</button>
                    </form>
                </div>  
            
        </div>
    </body>
</html>