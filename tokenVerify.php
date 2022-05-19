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
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" href="css/formStyles.css">
        <link rel="stylesheet" href="css/scrollBarStyles.css">
        <title>Last</title>
    </head>
    <body>

        <div class="container">
            <div class="left">
                <div class="log">
                    <h1>Token</h1>
                    <span>Bhoooooooooooo</span>
                    <?php 
                        if(isset($_SESSION["tokenFail"]) && $_SESSION["tokenFail"]){
                            echo'<style>
                                    input[name="token"]{
                                        background-color: rgba(255, 78, 113, 0.7);
                                    }
                                </style>';
                            $_SESSION["tokenFail"]=False;
                            echo "<a>token non trovata</a>";
                        }
                    ?>
                    <form action="access/tokenVerifyDB.php" method="POST">
                        <label for="token"><b>Token</b></label>
                        <input type="text" placeholder="123456" name="token">
                        <button type="submit" name="login" class="logbtn">Invia codice</button>
                    </form>
                </div>  
            </div>
        </div>
    </body>
</html>