

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

    $_SESSION["prevPage"] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="jquery-2.1.4.min.js"></script>

        <link rel="stylesheet" href="css/components.css">
        <link rel="stylesheet" href="css/navBar.css">
        <link rel="stylesheet" href="css/cardsMenu.css">
        <link rel="stylesheet" href="css/textFormat.css">
        <title>Mappa</title>
    </head>
    <body>
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
            element.style = 'height:'.concat(window.innerHeight, 'px;');
            var southWest = L.latLng(52.42791052543574, 13.243731349843626),
                northEast = L.latLng(52.60222351729074, 13.555910816201685),
                bounds = L.latLngBounds(southWest, northEast);
            var map = L.map(element, {
                    minZoom: 14,
                    maxBounds: bounds
                });
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {}).addTo(map);
            <?php 
                if(!empty($_GET["ldi"])){
                    $id = $_GET["ldi"];
                    $query = "SELECT * FROM ldi where id = ".$id."";
                    $result = $conn->query($query);
                    if($result->num_rows > 0){
                        $row = $result->fetch_array();
                        $lat = $row["lat"];
                        $lng = $row["lon"];
                        echo "map.setView(['".$lng."', '".$lat."'], 17);";
                    }
                    else{
                        echo "map.setView(['52.51715250163406', '13.389735939802097'], 14);";
                    }
                }
                else{
                    echo "map.setView(['52.51715250163406', '13.389735939802097'], 14);";
                }
                $query = "SELECT * FROM tipo";
                $result = $conn->query($query);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "
                        var Icon".$row["id"]." = L.icon({
                            iconUrl: 'assets/mapsIcon/".$row["image"]."',
                            iconSize:     [38, 95],
                        });";
                    }
                }
                $query = "SELECT * FROM ldi";
                $result = $conn->query($query);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "L.marker(
                            ['".$row["lon"]."', '".$row["lat"]."'],
                            {
                                icon: Icon".$row["mainTipo"]."
                            }
                            ).addTo(map).on('click', function(e) {
                                window.location.href = 'ldi.php?ldi=".$row["id"]."';
                            }).bindTooltip(`".$row["name"]."`, {
                                permanent: true, 
                                direction : 'bottom',
                                className: 'transparent-tooltip',
                                offset: [0, 10]
                              });
                            ";
                    }
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
            window.addEventListener('resize', function(event) {
                element = document.getElementById('osm-map');
                element.style = 'height:'.concat(window.innerHeight, 'px;');
            }, true);
        </script>

        <div class="divWrapper">
            <a href="camera.php" class="camera"><img src="assets/icon/camButton.svg" alt="" class="icon"></a>
            <nav class="bottomNav">
                <div class="insideNav">
                <a href="map.php"><img src="assets/icon/searchOn.svg" alt="" class="icon"></a>
                <a href="index.php"><img src="assets/icon/boardsOff.svg" alt="" class="icon"></a>
                </div>
                <div class="insideNav">
                <a href="liked.php"><img src="assets/icon/preferOff.svg" alt="" class="icon"></a>
                <a href="account.php"><img src="assets/icon/profileOff.svg" alt="" class="icon"></a>
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
    <?php $conn->close(); ?>
</html>