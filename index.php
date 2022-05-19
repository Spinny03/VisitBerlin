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
    if(isset($_POST["searchBtn"])){
        $search_query = preg_replace("#[^a-z 0-9?!]#i", "", $_POST["searchbar"]);
        $sql = "SELECT * FROM ldi WHERE `name` LIKE '%".$search_query."%'";
        $result = $conn->query($sql);
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            header('location: ldi.php?ldi='.$row["id"].'');
            $conn->close();
            exit();
        }
        elseif($result->num_rows > 1){
            header('location: category.php?query='.$search_query.'');
            $conn->close();
            exit();
        }

    }
    $_SESSION["prevPage"] = $_SERVER['REQUEST_URI'];
?>
<!DOCTYPE html>
<html lang="it">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="jquery-2.1.4.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/navBar.css">
        <link rel="stylesheet" href="css/cardsMenu.css">
        <link rel="stylesheet" href="css/textFormat.css">
        <link rel="stylesheet" href="css/components.css">
        <title>Home</title>
    </head>
    <body>
<!-- barra di ricerca-->
        <form class="searchBar" method="post">
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
<!-- barra di ricerca-->

        <h1>Categorie</h1>
        <div class="cardsContainer">
            <?php 
                $sql = 'SELECT * FROM ldi ORDER BY RAND() LIMIT 3';
                $all = $conn->query($sql);
                if($all->num_rows > 0){
                    if($all->num_rows >= 1){
                        $rowIm1 = mysqli_fetch_array($all);
                        $rowIm1 = $rowIm1["image"];
                    }
                    else{
                        $rowIm1 = "NoImg.png";
                    }
                    if($all->num_rows >= 2){
                        $rowIm2 = mysqli_fetch_array($all);
                        $rowIm2 = $rowIm2["image"];
                    }
                    else{
                        $rowIm2 = "NoImg.png";
                    }
                    if($all->num_rows >= 3){
                        $rowIm3 = mysqli_fetch_array($all);
                        $rowIm3 = $rowIm3["image"];
                    }
                    else{
                        $rowIm3 = "NoImg.png";
                    }
                    echo  '
                        <div class="card">
                            <a href="category.php">
                                <div class="imageGallery">
                                    <div class="big image" style="background-image: url(assets/berlinPhotosProva/'.$rowIm1.');">
                                    </div>
                                    <div class="small image" style="background-image: url(assets/berlinPhotosProva/'.$rowIm2.');">
                                    </div>
                                    <div class="small image" style="background-image: url(assets/berlinPhotosProva/'.$rowIm3.');">
                                    </div>
                                </div>
                                <div  style="background-color: #ffab5c;"class="cardBottom">
                                    <span class="cardTitle">Tutto</span>
                                </div>
                            </a>
                        </div>';
                }
                $sql = 'SELECT * FROM tipo;';
                $tipo = $conn->query($sql); 
                if($tipo->num_rows > 0){
                    while($row = $tipo->fetch_assoc()){ 
                        $sql = 'SELECT * FROM ldi, tipo_ldi WHERE ldi.id = tipo_ldi.ldi_id AND tipo_ldi.tipo_id ='.$row["id"].' ORDER BY RAND() LIMIT 3';
                        $foto = $conn->query($sql);
                        if($foto->num_rows > 0){
                            if($foto->num_rows >= 1){
                                $rowIm1 = mysqli_fetch_array($foto);
                                $rowIm1 = $rowIm1["image"];
                            }
                            else{
                                $rowIm1 = "NoImg.png";
                            }
                            if($foto->num_rows >= 2){
                                $rowIm2 = mysqli_fetch_array($foto);
                                $rowIm2 = $rowIm2["image"];
                            }
                            else{
                                $rowIm2 = "NoImg.png";
                            }
                            if($foto->num_rows >= 3){
                                $rowIm3 = mysqli_fetch_array($foto);
                                $rowIm3 = $rowIm3["image"];
                            }
                            else{
                                $rowIm3 = "NoImg.png";
                            }
                        }
                        else{
                            $rowIm1 = "NoImg.png";
                            $rowIm2 = "NoImg.png";
                            $rowIm3 = "NoImg.png";
                        }
                        echo  '
                            <div class="card">
                                <a href="category.php?categ='.$row["id"].'">
                                    <div class="imageGallery">
                                        <div class="big image" style="background-image: url(assets/berlinPhotosProva/'.$rowIm1.');">
                                        </div>
                                        <div class="small image" style="background-image: url(assets/berlinPhotosProva/'.$rowIm2.');">
                                        </div>
                                        <div class="small image" style="background-image: url(assets/berlinPhotosProva/'.$rowIm3.');">
                                        </div>
                                    </div>
                                    <div class="cardBottom">
                                        <span class="cardTitle">'.$row["name"].'</span>
                                    </div>
                                </a>
                            </div>';
                    }
                }
            ?>
        </div>

        <div class="divWrapper">
            <a href="camera.php" class="camera"><img src="assets/icon/camButton.svg" alt="" class="icon"></a>
            <nav class="bottomNav">
                <div class="insideNav">
                <a href="map.php"><img src="assets/icon/searchOff.svg" alt="" class="icon"></a>
                <a href="index.php"><img src="assets/icon/boardsOn.svg" alt="" class="icon"></a>
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
        // AJAX
        $(document).ready(function(){
        $('#searchbar').keyup(function(){

            var query = $(this).val();
            if(query != ''){
                $.ajax({
                    url:"searchAjax.php",
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
    // AJAX
    
    $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
        });
    </script>


    </body>
    <?php $conn->close(); ?>
</html>

