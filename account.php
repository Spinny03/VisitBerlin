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
    $conn->query("USE my_visitberlin");
    if(!empty($_SESSION["user"])){
        $data = $conn->query('SELECT * FROM username WHERE email ="'.$_SESSION["user"].'";');
        $data = mysqli_fetch_assoc($data); 
        if(!empty($data["image"])){
        $link = "assets/userPhoto/".$data["image"];
        }else{
            $link = "assets/icon/profileOff.svg";
        }
    }
    else{
        $link = "assets/icon/profileOff.svg";
    }
    

?>

<!DOCTYPE html>
<html lang="it">
       <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
        <script src="jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" href="css/navBar.css">
        <link rel="stylesheet" href="css/cardsMenu.css">
        <link rel="stylesheet" href="css/textFormat.css">
        <link rel="stylesheet" href="css/account.css">
        <link rel="stylesheet" href="css/components.css">
        <title>Profilo</title>
    </head>
    <body>
        <?php 
            if(!empty($_SESSION["user"])){
                echo '<h2>Impostazioni Account</h2>
                <div class="pSettings">
                    <form id="pform" action="access/photoDB.php" method="POST" enctype="multipart/form-data">
                        <img width="200" height="200" src="'.$link.'" class="profilePhotoBig">
                        <label class="photoBtn" for="apply" style="font-size:14px"><input class="inPhoto" type="file" name="pfile" id="apply" accept=".png,.jpg,.gif,.jpeg">Modifica</label>
                        <button type="submit" name="change" value="False" class="photoBtn">Rimuovi</button>
                        
                    </form>
                    <script>
                        document.getElementById("apply").onchange = function() {
                        document.getElementById("pform").submit();
                    }
                    </script>

                    <form action="access/accountDB.php" method="POST" class="profileInfo">
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
        echo '              pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" readonly>
                        </div>
                        <span class="choice">Notifiche email
                            <label class="switch" id="emailSwitch">
                                <input type="checkbox" id="emailSwitchBox">
                                <span class="slider round"></span>
                            </label>
                        </span>

                        <div class="btnDiv"> 
                            <button type="submit" name="change" value="False" class="logbtn">Annulla modifiche</button>
                            <button type="submit" name="change" value="True" class="logbtn">Salva le modifiche</button>
                            <button type="submit" name="change" value="logOUT" class="removeBtn genBtn">Esci</button>
                        </div>
                    </form>
                </div>';
           }
           else{
                echo '
                    <div class="loginDiv">              
                        <form action="logIn.php">
                            <input type="submit" value="Accedi" class="notLogged"/>
                        </form>
                        <form action="signUp.php">
                            <input type="submit" value="Registrati" class="notLogged" />
                        </form>
                    </div>
                    <div class="box">
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>';
           }
        ?>
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
        </div>
        
    <div class="loader-wrapper">
        <span class="loader"><span class="loader-inner"></span></span>
    </div>

    </body>

    <script >
        $.ajax({
                    url:"access/accountDB.php",
                    method:"POST",
                    data:{control:"true"},
                    success:function(data){
                        console.log(data);
                        if(data == "true"){
                            $("#emailSwitchBox").attr('checked', true);
                            //console.log("checked");
                        }
                        else{
                            $("#emailSwitchBox").attr('checked', false);
                            //console.log("unchecked");
                        }                  
                    }
        });


        $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });

        $('#emailSwitch').on('change', function(){
            if($(this).find('input').is(':checked')){
                //$(this).find('input').prop('checked', false);
                //console.log("checked");
                $.ajax({
                    url:"access/accountDB.php",
                    method:"POST",
                    data:{check:"true"},
                    success:function(data){
                        //console.log("ciao checked");                  
                    }
                });
            }
            else{
                //$(this).find('input').prop('checked', true);
                //console.log("unchecked");
                $.ajax({
                    url:"access/accountDB.php",
                    method:"POST",
                    data:{check:"false"},
                    success:function(data){
                        //console.log("ciao unchecked");                  
                    }
                });
            }
        });

    </script>
    <?php $conn->close(); ?>
</html>