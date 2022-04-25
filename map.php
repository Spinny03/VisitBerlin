

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
            //se cambia risoluzione si deve ricaricare la pagina
            element.style = 'height:'.concat(window.innerHeight, 'px;');;
            var map = L.map(element);
            L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {}).addTo(map);
            var target = L.latLng('52.52081982659567', '13.408958613189439');
            map.setView(target, 15);
            L.marker(target).addTo(map);
            var target = L.latLng('52.514103540169955', '13.37873063528018');
            L.marker(target).addTo(map);
        </script>
        
        <div class="divWrapper">
            <a href="#" class="camera"><img src="assets/icon/camButton.svg" alt="" class="icon"></a>
            <nav class="bottomNav">
                <div class="insideNav">
                <a href="map.php"><img src="assets/icon/searchON.svg" alt="" class="icon"></a>
                <a href="index.php"><img src="assets/icon/boardsOff.svg" alt="" class="icon"></a>
                </div>
                <div class="insideNav">
                <a href="liked.php"><img src="assets/icon/preferOff.svg" alt="" class="icon"></a>
                <a href="account.php"><img src="assets/icon/profileOff.svg" alt="" class="icon"></a>
                </div>
            </nav>
        </div>


    </body>
</html>