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
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <title>Last</title>
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
            <div class="left">
                <div class="log">
                    <h1>Reset password</h1>
                    <span>Reset passwordReset passwordReset passwordReset password</span>
                    <form action="access/resetPasswDB.php" method="POST">
                        <label for="psw"><b>Password</b></label>
                        <input type="password" placeholder="min. 8 caratteri" name="psw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve contenere almeno un numero e una lettera maiuscola e minuscola e almeno 8 o più caratteri" required>
                        <label for="Cpsw"><b>Conferma password</b></label>
                        <input type="password" placeholder="inserisci la stessa password" name="Cpsw" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Deve contenere almeno un numero e una lettera maiuscola e minuscola e almeno 8 o più caratteri" required>
                        <button type="submit" name="register" class="logbtn">Registrati</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>