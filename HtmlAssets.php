<!-- NAV BAR -->
<div class="divWrapper">
    <a href="#" class="camera"><img src="assets/icon/camButton.svg" alt="" class="icon"></a>
    <nav class="bottomNav">
        <div class="insideNav">
        <a href="#"><img src="assets/icon/searchOff.svg" alt="" class="icon"></a>
        <a href="#"><img src="assets/icon/boardsOff.svg" alt="" class="icon"></a>
        </div>
        <div class="insideNav">
        <a href="#"><img src="assets/icon/preferOff.svg" alt="" class="icon"></a>
        <a href="#"><img src="assets/icon/profileOff.svg" alt="" class="icon"></a>
        </div>
    </nav>
</div>

<!-- menu orizontale -->
<div class="leftScrollMenu">
    <?php 
        for($i=0; $i<20; $i++){
            echo  '        
            <div class="item">
                <div class="menuImage image" style="background-image: url(assets/berlinPhotosProva/1.jpg);">
                </div>
                <div class="bottomText">
                    <span class="smallText">WW1</span>
                </div>
            </div>';
        }
    ?>
</div>

<!-- card block -->
<div class="cardsContainer">
    <?php 
        for($i=0; $i<20; $i++){
            echo  '<div class="card">
            <div class="imageGallery">
                <div class="big image" style="background-image: url(assets/berlinPhotosProva/1.jpg);">
                </div>
                <div class="small image" style="background-image: url(assets/berlinPhotosProva/2.jpg);">
                </div>
                <div class="small image" style="background-image: url(assets/berlinPhotosProva/3.avif);">
                </div>
            </div>
            <div class="cardBottom">
                <span class="cardTitle">paintings</span>
            </div>
        </div>';
        }
    ?>
</div>