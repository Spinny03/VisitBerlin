

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

        <script> 
            element = document.getElementById('osm-map');
            element.style = 'height:'.concat(window.innerHeight, 'px;');
            var map = L.map(element);
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {}).addTo(map);
            map.setView(['52.51715250163406', '13.389735939802097'], 14);
            var greenIcon = L.icon({
                iconUrl: 'assets/mapsIcon/3.svg',
                iconSize:     [38, 95], // size of the icon
            });
            <?php 
                $query = "SELECT * FROM ldi";
                $result = $conn->query($query);
                if($result->num_rows > 0){
                    while($row = $result->fetch_assoc()){
                        echo "L.marker(['".$row["lon"]."', '".$row["lat"]."'],{icon: greenIcon}).addTo(map).bindPopup(`".$row["name"]."`);";
                    }
                }
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