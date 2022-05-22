<!DOCTYPE html>
<html lang=”it”>
	<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
		<meta charset="utf-8">
    <script src="html5-qrcode.min.js"></script>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="jquery-2.1.4.min.js"></script>
    <!--<link rel="stylesheet" href="css/components.css">-->
    <title>Camera</title>
	</head>
	<body>
    <a href="index.php"><img src="assets/icon/back.svg" alt="" class="backIcon"></a>
    <div id="header-info">ciao</div>
		<!--<video id="camera--view" autoplay playsinline></video>-->
    <!--
    <form action="camera.php" method="post">
      <input type="hidden" name="code" id="code"  value="" placeholder="Scan the code">
    </form>
    -->

  <script>
    /*var constraints = { video: { facingMode: "environment" }, audio: false };
    var track = null;
    const cameraView = document.querySelector("#camera--view");
    function cameraStart() {
        navigator.mediaDevices
            .getUserMedia(constraints)
            .then(function(stream) {
                track = stream.getTracks()[0];
                cameraView.srcObject = stream;
            })
            .catch(function(error) {
                console.error("Oops. Something is broken.", error);
            });
    }

    window.addEventListener("load", cameraStart, false);*/
  </script>
  <div id="qr-reader" style="width:100%; height:100vh; "></div>
  <script>
    var lastResult, countResults = 0;
    function onScanSuccess(decodedText, decodedResult) {
      if (decodedText !== lastResult) {
          ++countResults;
          lastResult = decodedText;
          console.log(`Scan result ${decodedText}`, decodedResult);
          $.ajax({
              url:"cameraAjax.php",
              method:"POST",
              data:{link:lastResult},
              success:function(data){
                $( "#header-info" ).hide( "slow" );
                console.log(data);
                document.getElementById("header-info").innerHTML = data;
                $( "#header-info" ).show( "slow" );
                $('#header-info').css('display', 'flex');
            }
          });
      }
    }
    let qrboxFunction = function(viewfinderWidth, viewfinderHeight) {
    let minEdgePercentage = 0.7; // 70%
    let minEdgeSize = Math.min(viewfinderWidth, viewfinderHeight);
    let qrboxSize = Math.floor(minEdgeSize * minEdgePercentage);
    return {
        width: qrboxSize,
        height: qrboxSize
    };
}
    const html5QrCode = new Html5Qrcode("qr-reader");
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        onScanSuccess(decodedText, decodedResult);
    };
    const config = { fps: 15, qrbox: qrboxFunction, aspectRatio: window.innerWidth / window.innerHeight };
    html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);
    


  </script>

  <style>
    video{
      width: 100% !important; 
      /*height: 100vh;
      position: fixed;
      object-fit: cover;*/
    }

    *{
      margin: 0;
    }
    body{
      overflow: hidden;
    }
    #header-info {
      position: absolute;
      top: 20px;
      left: 0; 
      right: 0; 
      margin-left: auto; 
      margin-right: auto; 
      z-index: 3;
      background-color: #fafafa;
      max-width: 600px;
      padding: 12px 25px 12px 25px;
      color: #FF4D3C;
      width: 200px;
      border-radius: 20px;
      display: none;
      text-align: center;
      justify-content: center;
      align-items: center;
      gap: 5px;

    }
    #header-info a{
        text-decoration: none;
        color: #FF4D3C;
    }
    .smallImage{
      min-width: 30px;
      height: 30px;
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
      display: inline-block;
      border-radius: 10px;
    }

    .backIcon{
      position: absolute;
      top: 0;
      left: 0;
      z-index: 100;
    }

  </style>
      <div class="loader-wrapper">
          <span class="loader"><span class="loader-inner"></span></span>
      </div>

      <script eval>
          $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
          });


      </script>
      <script eval>
        
          $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
          });

      </script>
  	</body>
</html>
