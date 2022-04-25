<?php 
    session_start(); 
    if(empty($_SESSION["user"])){
        if(isset($_COOKIE["user"])){
            $_SESSION["user"] = $_COOKIE["user"];
        }
    }
    $conn = new mysqli("localhost", "root", "");  
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE Last");
    if(!empty($_SESSION["user"])){
        $data = $conn->query('SELECT * FROM username WHERE email ="'.$_SESSION["user"].'";');
        $data = mysqli_fetch_assoc($data); 
    }
    $link = "assets/icon/profileOff.svg";
?>

<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/navBar.css">
        <link rel="stylesheet" href="css/cardsMenu.css">
        <link rel="stylesheet" href="css/textFormat.css">
        <title>PROFILO</title>
    </head>
    <body>
        <?php 
            if(!empty($_SESSION["user"])){
                echo '<h2>Impostazioni Account</h2>
                <div class="pSettings">
                    <form id="pform" action="access/photoDB.php" method="POST" enctype="multipart/form-data">
                        <img width="200" height="200" src="'.$link.'" class="profilePhotoBig">
                        <label class="photoBtn" for="apply"><input class="inPhoto" type="file" name="pfile" id="apply" accept="image/*">Modifica</label>
                        <button type="submit" name="change" value="False" class="photoBtn removeBtn">Rimuovi</button>
                    </form>
                    <script>
                        document.getElementById("apply").onchange = function() {
                        document.getElementById("pform").submit();
                    }
                    </script>

                    <form action="access/profileDB.php" method="POST" >
                        <div class="data" id="p25">
                            <label for="name"><b>Nome</b></label>
                            <input type="text" placeholder="Mario" name="name"';
                                if(isset($data["firstName"])){
                                    echo "value='".$data["firstName"]."'";
                                }
        echo '              >
                        </div>

                        <div class="data" id="p25">
                            <label for="surname"><b>Cognome</b></label>
                            <input type="text" placeholder="Rossi" name="surname"';
                                if(isset($data["surname"])){
                                    echo "value='".$data["surname"]."'";
                                }
        echo '              >
                        </div>

                        <div class="data" id="p50">
                            <label for="email"><b>Email</b></label>
                            <input type="text" placeholder="nome@esempio.com" name="email" ';
                                if(isset($data["email"])){
                                    echo "value='".$data["email"]."'";
                                }
        echo '              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                        </div>

                        <button type="submit" name="change" value="False" class="logbtn">Annulla modifiche</button>
                        <button type="submit" name="change" value="True" class="logbtn">Salva le modifiche</button>
                        <button type="submit" name="change" value="logOUT" class="removeBtn genBtn">Esci</button>
                    </form>
                </div>';
           }
           else{
                echo '              
                <form action="logIn.php">
                    <input type="submit" value="Accedi" />
                </form>
                <form action="signUp.php">
                    <input type="submit" value="Registrati" />
                </form>';
           }
        ?>
        <div class="divWrapper">
            <a href="#" class="camera"><img src="assets/icon/camButton.svg" alt="" class="icon"></a>
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
    <?php $conn->close(); ?>
</html>