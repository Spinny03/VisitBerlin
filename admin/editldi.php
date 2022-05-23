<?php
    session_start();/*
    if((empty($_SESSION["admin"]) && empty($_COOKIE["admin"]))){
        header("Location: home.php");
        exit();
    }
    if(empty($_SESSION["admin"])){
        if(isset($_COOKIE["admin"])){
            $_SESSION["admin"] = $_COOKIE["admin"];
        }
    }*/
    $conn = new mysqli("localhost", "root", "");
    if ($conn->connect_error){
        exit("Connessione fallita: " . $conn->connect_error);
    }
    $conn->query("USE my_visitberlin");
    $esiste = false;
    if(!empty($_GET["ldi"])){
        $query = "SELECT * FROM ldi WHERE ldi.id = ".$_GET["ldi"];
        $result = $conn->query($query);
        if($result->num_rows <= 0){
            header("Location: editldi.php");
            $conn->close();
            exit();

        }
        $esiste = true;
        $ldi = $result->fetch_assoc();    
        $img = "../assets/berlinPhotosProva/".$ldi["image"];
        if(!empty($ldi["audio"])){
            $audio = "../assets/audioLdi/".$ldi["audio"];
        }
        else{
            $audio = "";
        }
        $name = $ldi["name"];
        $id = $ldi["id"];
        $description = $ldi["description"];
        $lon = $ldi["lon"];
        $lat = $ldi["lat"];
        $maintipo = $ldi["maintipo"];
      }  
    else{    
        $img = "../assets/add.svg"; 
        $audio = "";     
        if(file_exists("../assets/audioLdi/new.mp3")){
            $audio = "../assets/audioLdi/new.mp3";
        }    
        if(file_exists("../assets/audioLdi/new.wav")){
            $audio = "../assets/audioLdi/new.wav";
        } 
        if(file_exists("../assets/berlinPhotosProva/new.jpg")){
            $img = "../assets/berlinPhotosProva/new.jpg";
        }
        if( file_exists("../assets/berlinPhotosProva/new.png")){
            $img = "../assets/berlinPhotosProva/new.png";
        }
        if(file_exists("../assets/berlinPhotosProva/new.jpeg")){
            $img = "../assets/berlinPhotosProva/new.jpeg";
        }
        if(file_exists("../assets/berlinPhotosProva/new.gif")){
            $img = "../assets/berlinPhotosProva/new.gif";
        }
        $name = "Nuovo";
        $id = "new";
        $description = "";
        $lon = "52.51715250163406";
        $lat = "13.389735939802097";
        $maintipo = "";

    }   

?>
<!DOCTYPE html>
<html lang="it">
       <head>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
        <link rel="icon" type="image/x-icon" href="../assets/favicon.ico">
        <meta charset="UTF-8">
    
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <script type="text/javascript" src="../qrcode/jquery.min.js"></script>
        <script type="text/javascript" src="../qrcode/qrcode.min.js"></script>
        <script src="../jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" href="../css/navBar.css">
        <link rel="stylesheet" href="../css/cardsMenu.css">
        <link rel="stylesheet" href="../css/textFormat.css">
        <link rel="stylesheet" href="../css/imageGallery.css">
        <link rel="stylesheet" href="../css/components.css">
        <link rel="stylesheet" href="css/editldi.css">
        <title>Admin</title>
    </head>
    <body style="width:100%">
    <div class="left">
        <div class="leftScrollMenu">
                <?php 
                    $query = "SELECT * FROM ldi";
                    $result = $conn->query($query);
                    echo  '     
                    <a href="editldi.php">   
                        <div class="item">
                            <div class="menuImage image" style="background-image: url(../assets/add.svg);">
                            </div>
                            <div class="bottomText">
                                <span class="smallText">add</span>
                            </div>
                        </div>
                        </a>';
                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()){
                            echo  '     
                            <a href="editldi.php?ldi='.$row["id"].'">   
                                <div class="item">
                                    <div class="menuImage image" style="background-image: url(../assets/berlinPhotosProva/'.$row["image"].');">
                                    </div>
                                    <div class="bottomText">
                                        <span class="smallText">'.$row["name"].'</span>
                                    </div>
                                </div>
                                </a>';
                        }
                    }
                ?>

            </div>
            <div class="ldiContainer">
                <form id="pform" action="access/editldiDB.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="idldi" value="<?php echo $id;?>">
                    <img width="200" height="200" src="<?php echo $img; ?>" class="profilePhotoBig">
                    <label class="photoBtn" for="apply"><input class="inPhoto" type="file" name="pfile" id="apply" accept=".png,.jpg,.gif,.jpeg">Modifica</label>
                    <button type="submit" name="change" value="False" class="photoBtn" style="border: 1px solid red;">Rimuovi</button>
                </form>
                <script>
                    document.getElementById("apply").onchange = function() {
                    document.getElementById("pform").submit();
                }

                </script>

    <!-- mp3 audio file input -->
                <form id="afile" action="access/editldiDB.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="audio" value="<?php echo $id;?>">
                    <audio controls><source src="<?php echo $audio;?>" type="audio/mp3"><source src="<?php echo $audio;?>" type="audio/wav">Your browser does not support the audio element.</audio>
                    <label for="audioFile"><input type="file" name="afile" id="audioFile" accept=".wav,.mp3" class="">Modifica</label>
                    <button type="submit" name="change" value="False" class="audioBtn" style="border: 1px solid red;">Rimuovi</button>
                </form>
                <script>
                    document.getElementById("audioFile").onchange = function() {
                    document.getElementById("afile").submit();
                }

                </script>
    <!-- mp3 audio file input -->

        <!-- QRCode -->
                <?php 
                    if($esiste){
                        echo '
                        <div id="qrcode" v-loading="PanoramaInfo.bgenerateing"></div>
                        <button id="download" onclick="myFunction()" >Download</button>';
                    }
                ?> 
                <script> 
                    <?php 
                        if($esiste){
                        echo 'var qrcode = new QRCode(document.getElementById("qrcode"), "visitberlin.altervista.org/ldi.php?ldi='.$id.'")';
                        }
                    ?> 
                    function downloadURI(uri, name){
                    var link = document.createElement("a");
                    link.download = name;
                    link.href = uri;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                    delete link;
                    };
                    function myFunction(){
                        console.log('onload');
                        setTimeout(
                            function ()
                            {
                                let dataUrl = document.querySelector('#qrcode').querySelector('img').src;
                                downloadURI(dataUrl, 'qrcode.png');
                            }
                            ,1000);
                    };
                    </script>
        <!-- QRCode -->


                <form action="access/editldiDB.php" method="POST" class="innerForm">
                    <input type="hidden" name="ldi" value="<?php echo $id;?>">
                    <input type="text" name="name" value="<?php echo $name;?>">
                    <textarea name="description" rows="10"><?php echo $description;?></textarea>
                    <input id = "lat" type="text" name="lon" value="<?php echo $lon;?>">
                    <input id = "lng" type="text" name="lat" value="<?php echo $lat;?>">

                        <?php 
                        $query = "SELECT * FROM tipo;";
                        $result = $conn->query($query);
                        echo "<br><h3>Icon:</h3>";
                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()){
                                if($row["id"] == $maintipo){
                                    echo '<div style="width:100%;"><input type="radio" name="maintipo" value="'.$row["id"].'" checked required>'.$row["name"].'<br></div>';
                                }else{
                                    echo '<div style="width:100%;"><input type="radio" name="maintipo" value="'.$row["id"].'" required>'.$row["name"].'<br></div>';
                                }
                            }
                        }
                        echo "<br><h3>tipo:</h3>";
                            $query = "SELECT * FROM tipo;";
                            $result = $conn->query($query);

                            if($result->num_rows > 0){
                                while($row = $result->fetch_assoc()){
                                    echo '<div  style="width:100%;"><input type="checkbox" name="tipo[]" value="'.$row["id"].'"';
                                    if($id != "new"){
                                        $query1 = "SELECT * FROM tipo_ldi WHERE ldi_id = ".$id." AND tipo_id = ".$row["id"].";";
                                        $result12 = $conn->query($query1);
                                        if($result12->num_rows > 0){
                                            echo 'checked';
                                        }
                                    }
                                    echo '>'.$row["name"].'</div>';
                                    
                                }
                            }
                            


                            if(!empty($_GET["ldi"])){
                                echo '<button type="submit" name="change" value="True" class="add">Salva le modifiche</button>';
                            }
                            else{
                                echo '<button style="" type="submit" name="change" value="add" class="add">Aggiungi</button>';
                            }     
                        ?>       
                </form>
                <form action="access/editldiDB.php" method="POST" style="width:80%;">
                    <button type="submit" class="del" name="del" value="<?php echo $id;?>" >
                        Elimina
                    </button>
                </form>
            </div>
        </div>    

        <div class="right">
            <p ></p>
            <p ></p>
            <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
            <link href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" rel="stylesheet"/>
            <div id="osm-map"></div>
            <style>
                .transparent-tooltip {
                    text-overflow: ellipsis;
                    overflow: hidden; 
                    width: 50px; 
                    height: 1em; 
                    white-space: nowrap;
                }
            </style>
            <script> 
                element = document.getElementById('osm-map');
                //element.style = 'height:'.concat(window.innerHeight, 'px;');
                element.style = 'height: 100vh;';
                var southWest = L.latLng(52.42791052543574, 13.243731349843626),
                    northEast = L.latLng(52.60222351729074, 13.555910816201685),
                    bounds = L.latLngBounds(southWest, northEast);
                var map = L.map(element, {
                        minZoom: 14,
                        maxBounds: bounds
                    });
                L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {}).addTo(map);
                
                <?php 
                
                echo "map.setView(['".$lon."', '".$lat."'], 17)";

                    if($esiste){
                        $query = "SELECT * FROM tipo where id = ".$maintipo."";
                        $result = $conn->query($query);
                        $result = $result->fetch_array();
                        echo "
                        var Icon".$maintipo." = L.icon({
                            iconUrl: '../assets/mapsIcon/".$result["image"]."',
                            iconSize:     [38, 95],
                        });";
                        echo " var marker = L.marker(
                            ['".$lon."', '".$lat."'],
                            {
                                draggable:true,
                                icon: Icon".$maintipo."
                            }
                            ).addTo(map).bindTooltip(`".$name."`, {
                                permanent: true, 
                                direction : 'bottom',
                                className: 'transparent-tooltip',
                                offset: [0, 10]
                                });
                            ";
                    }
                    else{
                        echo "
                            var IconNew = L.icon({
                                iconUrl: '../assets/mapsIcon/noImg.svg',
                                iconSize:     [38, 95],
                            });";
                        echo " var marker = L.marker(
                            ['".$lon."', '".$lat."'],
                            {
                                draggable:true,
                                icon: IconNew 
                            }
                            ).addTo(map).bindTooltip(`".$name."`, {
                                permanent: true, 
                                direction : 'bottom',
                                className: 'transparent-tooltip',
                                offset: [0, 10]
                                });
                            ";
                    }



                    /*
                    .bindPopup('<img src=`".$row["image"]."`  width=`500` height=`600`>');
                    bindTooltip(`".$row["name"]."`, {
                        permanent: true, 
                        direction : 'bottom',
                        className: 'transparent-tooltip',
                        offset: [0, 10]
                    })*/
                ?>
                marker.on('dragend', function(event){
                    //alert('drag ended');
                    var marker = event.target;
                    var location = marker.getLatLng();
                    var lat = location.lat;
                    var lon = location.lng;
                    addToTextBox(lat,lon);
                    //alert(lat);
                    //retrieved the position
                });
                function addToTextBox(lt,ln){
                    document.getElementById('lat').value = lt;
                    document.getElementById('lng').value = ln;
                    
                }
                
                /*
                window.addEventListener('resize', function(event) {
                    element = document.getElementById('osm-map');
                    element.style = 'height:'.concat(window.innerHeight, 'px;');
                }, true);*/
            </script>
    </div>        
        
    </body>
</html>