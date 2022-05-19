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
    if(empty($_GET["ldi"])){
        header("Location: index.php");
    }
    else{
        $query = "SELECT * FROM ldi WHERE ldi.id = ".$_GET["ldi"];
        $result = $conn->query($query);
        $ldi = $result->fetch_assoc();
        if(!empty($_SESSION["user"])){
            $query = "SELECT * FROM preferiti WHERE email = '".$_SESSION["user"]."' AND ldi_id = '".$_GET["ldi"]."';";
            $result = $conn->query($query);
            if($result->num_rows == 0){
                $conLike = false;
            }
            else{
                $conLike = true;
            }
        }
 
        //echo "<img style='height: 100%; width: 100%;' src='assets/berlinPhotosProva/".$ldi["image"]."' alt=''>";
    }

?>


<!DOCTYPE html>
<html lang="it">
            <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <script src="jquery-2.1.4.min.js"></script>

    <link rel="stylesheet" href="css/ldi.css">
    <title>Document</title>
</head>
    <body style="background-image:url('assets/berlinPhotosProva/<?php echo $ldi["image"]?>');">
    <!--    NON SO PERCHE MA ROMPE TUTTO spinella -->
    <!--    PERCHE SEI SCARSO barletta-->
    <div class="outerTopDiv">
            <a href="<?php  echo $_SESSION["prevPage"]?>"><img src="assets/icon/back.svg" alt="" class="backIcon"></a>
        <div class="topDiv"> 
            <form class="liked" method="post">
            <?php
            if(isset($conLike)){
                if(!$conLike) {
                echo  '<a id="like" ><img id="likeImg" src="assets/icon/whiteLike.svg" style="height: 25px; width: 25px;" alt=""></a>';
                }
                else {
                echo  '<a id="like" ><img id="likeImg" src="assets/icon/preferOn.svg" style="height: 25px; width: 25px;" alt=""></a>';
                }
            }
           ?>
                </form>
            <a href="#" id="share"><img src="assets/icon/share.svg" style="height: 25px; width: 25px;" alt=""></a>
            <a href="map.php?ldi=<?php  echo $_GET["ldi"];?>" ><img src="assets/mapsIcon/noImgWhite.svg" style="height: 25px; width: 25px;" alt=""></a>
        </div>
    </div>

    <div class="clickable"></div>

    <div class="hid-box">
            <div class="open">
                <span>Panoramica</span>
            </div>
        <div class="box">
            <div class="titleDiv">
                <h2><?php echo strtoupper($ldi["name"])?></h2>
            </div>
            <div class="infoDiv">
                <div>
                    <span class="smallTitle">Categoria principale:</span>
                    <span> <b> Musei</b></span>
                </div>
                <div>
                    <span class="smallTitle">Sottocategorie:</span>
                    <span>Musei Musei MuseiMusei</span>
                </div>
            </div>
            <div class="titleDiv descriptionDiv">
                <span>
                    dfdfsdf aaaaaasgf dfdfsdf aaaaaasgf dfdfsdf dfdfsdf aaaaaasgf dfdfsdf aaaaaasgf dfdfsdf dfdfsdf aaaaaasgf dfdfsdf aaaaaasgf dfdfsdfdfdfsdf aaaaaasgf dfdfsdf aaaaaasgf dfdfsdf
                </span>
            </div>
            <div class="titleDiv audioDiv">
                <audio controls><source src="#" type="audio/mp3"><source src="#" type="audio/wav">Your browser does not support the audio element.</audio>
            </div>
        </div>
    </div>
    </body>
     
    <script>
        $(".clickable").css("display", "none");

        $( ".hid-box" ).click(function() {
                $(".hid-box").css("top", "35%");
                $(".clickable").css("display", "block");
        });

        $( ".clickable" ).click(function() {
                $(".hid-box").css("top", "calc(100vh - 100px)");
                $(".clickable").css("display", "none");
                aperto = true
        });

        const shareData = {
            title: 'Last',
            text: 'Viene a vedere questa opera su Last!',
            url: "http://localhost/Last/ldi.php?ldi=<?php echo $_GET["ldi"];?>"
        }

        $( "#share" ).click(async () => {
            try {
            await navigator.share(shareData)
            resultPara.textContent = 'MDN shared successfully'
            } catch(err) {
            resultPara.textContent = 'Error: ' + err
            }
        });

        $('.liked').on('click', '#like', function(){
            if(document.getElementById('likeImg').src.split(/(\\|\/)/g).pop() == 'whiteLike.svg'){
            $.ajax({
                    url:"access/ldiDB.php",
                    method:"POST",
                    data:{metti:"<?php echo $_GET["ldi"];?>"},
                    success:function(data){

                        document.getElementById('likeImg').src ='assets/icon/preferOn.svg';                    }
                });
            }
            else{
                $.ajax({
                        url:"access/ldiDB.php",
                        method:"POST",
                        data:{togli:"<?php echo $_GET["ldi"];?>"},
                        success:function(data){
                            document.getElementById('likeImg').src ='assets/icon/whiteLike.svg';                    }
                    });
            }
        });

    </script>

</html>