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
        <link rel="stylesheet" href="css/loginRegister.css">
        <link rel="stylesheet" href="css/navBar.css">
        <title>Last</title>
    </head>
    <body>

        <div class="container">
            <div class="log">
                <h1 style="font-size: 30px">Token verify</h1>
                <span>Inserisci il token che ti è stato inviato</span>
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
                    <input type="text" placeholder="123456" name="token" required>
                    <button type="submit" name="login" class="logbtn">conferma</button>
                </form>
                <a href="<?php echo $_SERVER["HTTP_REFERER"] ?>" class="Link">indietro</a>
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