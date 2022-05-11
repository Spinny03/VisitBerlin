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
    $conn->query("USE Last");
    if(!empty($_GET["ldi"])){
        $query = "SELECT * FROM ldi WHERE ldi.id = ".$_GET["ldi"];
        $result = $conn->query($query);
        if($result->num_rows <= 0){
            header("Location: editLdi.php");
            $conn->close();
            exit();
        }
        $ldi = $result->fetch_assoc();    
        $img = "../assets/berlinPhotosProva/".$ldi["image"];
        $name = $ldi["name"];
        $id = $ldi["id"];
        $description = $ldi["description"];
        $lon = $ldi["lon"];
        $lat = $ldi["lat"];
        $mainTipo = $ldi["mainTipo"];
      }  
    else{    
    $img = "../assets/add.svg";          
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
        $name = "";
        $id = "new";
        $description = "";
        $lon = "";
        $lat = "";
        $mainTipo = "";
    }   

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
        <meta http-equiv="Pragma" content="no-cache" />
        <meta http-equiv="Expires" content="0" />
        <link rel="stylesheet" href="../css/navBar.css">
        <link rel="stylesheet" href="../css/cardsMenu.css">
        <link rel="stylesheet" href="../css/textFormat.css">
        <link rel="stylesheet" href="../css/imageGallery.css">
        <link rel="stylesheet" href="../css/components.css">
        <title>Admin</title>
    </head>
    <body>
    <div class="leftScrollMenu">
            <?php 
                $query = "SELECT * FROM ldi";
                $result = $conn->query($query);
                echo  '     
                <a href="editLdi.php">   
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
                        <a href="editLdi.php?ldi='.$row["id"].'">   
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
        <form id="pform" action="access/editLdiDB.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="idLdi" value="<?php echo $id;?>">
            <img width="200" height="200" src="<?php echo $img; ?>" class="profilePhotoBig">
            <label class="photoBtn" for="apply"><input class="inPhoto" type="file" name="pfile" id="apply" accept="image/*">Modifica</label>
            <button type="submit" name="change" value="False" class="photoBtn removeBtn">Rimuovi</button>
        </form>
        <script>
            document.getElementById("apply").onchange = function() {
            document.getElementById("pform").submit();
        }
        </script>
        <form action="access/editLdiDB.php" method="POST">
            <input type="hidden" name="ldi" value="<?php echo $id;?>">
            <input type="text" name="name" value="<?php echo $name;?>">
            <input type="text" name="description" value="<?php echo $description;?>">
            <input id = "lat" type="text" name="lon" value="<?php echo $lon;?>">
            <input id = "lng" type="text" name="lat" value="<?php echo $lat;?>">

            <input type="text" name="mainTipo" value="<?php echo $mainTipo;?>">
                <?php 
                    if(!empty($_GET["ldi"])){
                        echo '<button type="submit" name="change" value="True" class="logbtn">Salva le modifiche</button>';
                    }
                    else{
                        echo '<button style="background-color: green;" type="submit" name="change" value="add" class="logbtn">Aggiungi</button>';
                    }     
                ?>       
        </form>
        <form action="access/editLdiDB.php" method="POST">
            <button type="submit" class="itemNumber formBtn" name="del" value="<?php echo $id;?>" style="background-color: white; margin-left:10px;">
                Elimina
            </button>
        </form>
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
            element.style = 'height: 800px;';
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
                $query = "SELECT * FROM tipo where id = ".$mainTipo."";
                $result = $conn->query($query);
                $result = $result->fetch_array();
                echo "
                var Icon".$mainTipo." = L.icon({
                    iconUrl: '../assets/mapsIcon/".$result["image"]."',
                    iconSize:     [38, 95],
                });";

                echo " var marker = L.marker(
                    ['".$lon."', '".$lat."'],
                    {
                        draggable:true,
                        icon: Icon".$mainTipo."
                    }
                    ).addTo(map).bindTooltip(`".$name."`, {
                        permanent: true, 
                        direction : 'bottom',
                        className: 'transparent-tooltip',
                        offset: [0, 10]
                        });
                    ";


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
    </body>
</html>