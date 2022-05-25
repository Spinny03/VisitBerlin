<?php 
    session_start(); 
    $_SESSION["prevPage"] = $_SERVER['REQUEST_URI'];
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

    if(!empty($_GET["username"])){
        $data = $conn->query('SELECT * FROM username WHERE email ="'.$_GET["username"].'";');
        $data = mysqli_fetch_assoc($data); 
        if(!empty($data["image"])){
        $link = "assets/userPhoto/".$data["image"];
        }else{
            $link = "assets/icon/profileOff.svg";
        }
        $usermail = $_GET["username"];
    }
    elseif(!empty($_SESSION["user"])){
        $data = $conn->query('SELECT * FROM username WHERE email ="'.$_SESSION["user"].'";');
        $data = mysqli_fetch_assoc($data); 
        $usermail = $_SESSION["user"];
        if(!empty($data["image"])){
        $link = "assets/userPhoto/".$data["image"];
        }else{
            $link = "assets/icon/profileOff.svg";
        }
    }
    else{
        header('location: index.php');
    }
    
    if(isset($_POST["searchBtn"])){
        $search_query = $_POST["searchbar"];
        $sql = "SELECT * FROM username WHERE `email` LIKE '%".$search_query."%'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            header('location: profile.php?username='.$row["email"].'');
            $conn->close();
            exit();
        }
        elseif($result->num_rows > 1){
            header('location: category.php?query='.$search_query.'');
            $conn->close();
            exit();
        }

    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/navBar.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/cardsMenu.css">
    <link rel="stylesheet" href="css/textFormat.css">
    <link rel="stylesheet" href="css/imageGallery.css">
    <link rel="stylesheet" href="css/components.css">
    <script src="jquery-2.1.4.min.js"></script>
    <title>Document</title>
</head>
<body>
    
    <div class="container-fluid">
        <?php 
            if(!empty($_GET["username"])){
                echo '<a href="profile.php"><img src="assets/icon/back.svg" alt="" style="margin:0;" class="backIcon"></a>';
            }
        ?>

        <form class="searchBar" method="post" style="margin-top: 20px;">
            <div class="input-group">
                <input type="text" class="form-control" id="searchbar" name="searchbar" placeholder="Search" autocomplete="off" required/>
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit" name="searchBtn" id="searchBtn">
                        <i class="glyphicon glyphicon-search"></i>
                    </button>
                </div>
            </div>
            <div class="countryList"></div>
        </form>
        <a href="account.php"><img width="30" height="30" src="assets/icon/settings.svg" alt=""></a>
    </div>
    <div class="upperDiv">
        <div class="imgDiv">
            <img width="200" height="200" src=<?php echo "'$link'"; ?> class="profilePhotoBig">
        </div>
        <div class="nameDiv">
            <h1>
                <?php 
                    if(isset($data["firstName"])){
                        echo $data["firstName"] ." ";
                        if(isset($data["surname"])){
                            echo $data["surname"];
                        }
                        else{
                            echo "";
                        }
                    }
                    else{
                        echo "";
                        if(isset($data["surname"])){
                            echo $data["surname"];
                        }
                        else{
                            echo "";
                        }
                    }
                ?>
            </h1>
            <span class="email">
                <?php 
                    echo "ID: ".$usermail;
                ?>
            </span>
        </div>
    </div>
    <h3>Progressi:</h3>
    <div class="infoDiv">
        <div class="categoryDiv">
            
        <?php 
            $query13 = "SELECT * FROM visitati WHERE email = '".$usermail."';";
            $result13 = $conn->query($query13);
            $query14 = "SELECT * FROM ldi;";
            $result14 = $conn->query($query14);

            
            $perc = $result13->num_rows  / $result14->num_rows;
            $hue = ($perc * 120);
            $perc = $perc * 100;
            $perc = round($perc, 1);
        ?>
            <span class="titleSpan" style="color: #ff4d3c">totale </span><span class="percentage" <?php echo 'style="color: hsl( '.$hue.' ,80%,50%)"';?>><?php echo $perc?>%</span>
        </div>
        <?php 
            

           $sql = 'SELECT * FROM tipo;';
           $tipo = $conn->query($sql); 
           if($tipo->num_rows > 0){
               while($row = $tipo->fetch_assoc()){ 
                    $query13 = "SELECT * FROM visitati, tipo_ldi WHERE tipo_ldi.ldi_id = visitati.ldi_id AND tipo_ldi.tipo_id = ".$row["id"]." AND email = '".$usermail."';";
                    $result13 = $conn->query($query13);
                    $query14 = "SELECT * FROM tipo_ldi WHERE tipo_id = ".$row["id"].";";
                    $result14 = $conn->query($query14);

                    
                    $perc = $result13->num_rows  / $result14->num_rows;
                    $hue = ($perc * 120);
                    $perc = $perc * 100;
                    $perc = round($perc, 1);
                    //echo '<progress id="file" value="'.$perc.'" max="100"></progress><span class="cardTitle">'.$result13->num_rows.'/'.$result14->num_rows.' </span>';
                    echo'<div class="categoryDiv">
                            <span class="titleSpan">'.$row["name"].' </span><span class="percentage" style="color: hsl( '.$hue.' ,80%,50%)">'.$perc.'%</span>
                        </div>';
               }
            } 
        ?>
    </div>
    <h3>Preferiti:</h3>
    <?php
            if(!empty($usermail)){
                $query = "SELECT * FROM ldi,preferiti WHERE ldi.id = preferiti.ldi_id AND email='".$usermail."' ORDER BY RAND()";
                $result = $conn->query($query);
                if($result->num_rows > 0){
                    $i = 0;
                    $tipo = array("topImage image","left1 image","left2 image","bigRight image","bottomleft image","bottomRight image");
                    echo '<div class="imageGallery">';
                    while($row = $result->fetch_assoc()){  
                        if($i==6){
                            echo '<div class="imageGallery notFirst">';
                            $i=0;
                        }
                        echo '
                        <a href="ldi.php?ldi='.$row["id"].'" class="'.$tipo[$i].'" style="background-image: url(assets/berlinPhotosProva/'.$row["image"].');">

                        </a>';                        
                        $i++;
                        if($i==6){
                            echo '</div>';
                        }
                    }
                    if($i<6){
                        echo '</div>';
                    }
                }
                else{
                    echo '<h2>Nessuna opera tra i preferiti</h2>';
                }
            }
            else{
                echo "<h1>Non hai effetuato l'accesso</h1>";
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
            <a href="profile.php"><img src="assets/icon/profileOn.svg" alt="" class="icon"></a>
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


        $(document).ready(function(){
            $('#searchbar').keyup(function(){

                var query = $(this).val();
                if(query != ''){
                    $.ajax({
                        url:"searchAjaxprofile.php",
                        method:"POST",
                        data:{query:query},
                        success:function(data){
                            $('.countryList').html(data);
                        }
                    });
                }
                else{
                    $('.countryList').html('');
                }

            });

            $(document).on('click', '.list-group-item', function(){
                $('#searchbar').val($.trim($(this).text()));
                $('.countryList').html('');
            });
        });
    </script>
</body>
</html>