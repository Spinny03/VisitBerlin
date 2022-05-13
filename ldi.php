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
        //echo "<img style='height: 100%; width: 100%;' src='assets/berlinPhotosProva/".$ldi["image"]."' alt=''>";
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
            <a href="access/ldiDB.php?ldi=<?php  echo $_GET["ldi"];?>" ><img src="assets/icon/whiteLike.svg" style="height: 25px; width: 25px;" alt=""></a>
            <a href="#" id="share"><img src="assets/icon/share.svg" style="height: 25px; width: 25px;" alt=""></a>
            <a href="map.php?ldi=<?php  echo $_GET["ldi"];?>" ><img src="assets/mapsIcon/noImgWhite.svg" style="height: 25px; width: 25px;" alt=""></a>
        </div>
    </div>

    <div class="hid-box">
            <div class="open">
                <span>Panoramica</span>
            </div>
            <div class="titleDiv">
                <h2><?php echo strtoupper($ldi["name"])?></h2>
            </div>
        </div>
    </body>
     
    <script>
        aperto = true
        $( ".open" ).click(function() {
            if(aperto){
                $(".hid-box").css("top", "35%");
                aperto = false
            }
            else{
                $(".hid-box").css("top", "calc(100vh - 100px)");
                aperto = true
            }
        });

        const shareData = {
            title: 'MDN',
            text: 'Learn web development on MDN!',
            url: 'https://developer.mozilla.org'
        }

        $( "#share" ).click(async () => {
            try {
            await navigator.share(shareData)
            resultPara.textContent = 'MDN shared successfully'
            } catch(err) {
            resultPara.textContent = 'Error: ' + err
            }
        });
    </script>

</html>