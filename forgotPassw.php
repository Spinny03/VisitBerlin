<?php 
    session_start(); 
    if(empty($_SESSION["user"])){
        if(isset($_COOKIE["user"])){
            $_SESSION["user"] = $_COOKIE["user"];
        }
    }
    
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="css/loginRegister.css">
        <link rel="icon" type="image/x-icon" href="images/favicon.ico">
        <title>Last</title>
    </head>
    <body>

        <div class="container">
            <div class="log">
                <h1 style="font-size: 30px">Password dimenticata</h1>
                <span>Inserisci la mail utilizzata per il login</span>
                <?php 
                    if(isset($_SESSION["emailFail"]) && $_SESSION["emailFail"]){
                        echo'<style>
                                input[name="email"]{
                                    background-color: rgba(255, 78, 113, 0.7);
                                }
                            </style>';
                        $_SESSION["emailFail"]=False;
                        echo "<a>Email non trovata</a>";
                    }
                ?>
                <form action="access/forgotPasswDB.php" method="POST">
                    <label for="email"><b>Email</b></label>
                    <input type="text" placeholder="nome@esempio.com" name="email" 
                        <?php
                            if(isset($_SESSION["userLogin"])){
                                echo "value='".$_SESSION["userLogin"]."'";
                            }
                        ?> 
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                    <button type="submit" name="login" class="logbtn">Invia codice</button>
                </form>
            </div>  
        </div>
    </body>
</html>