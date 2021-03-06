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
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <meta name="viewport" content="width=device-width" />
        <link rel="stylesheet" href="css/loginRegister.css">
        <link rel="stylesheet" href="css/navBar.css">
        <script src="jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" href="css/components.css">
        <title>Password dimenticata</title>
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
        <div class="loader-wrapper">
            <span class="loader"><span class="loader-inner"></span></span>
        </div>

        <script>
            $(window).on("load",function(){
            $(".loader-wrapper").fadeOut("slow");
            });
        </script>
    </body>
</html>