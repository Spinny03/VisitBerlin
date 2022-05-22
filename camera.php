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
    <link rel="stylesheet" href="css/components.css">
    <title>Camera</title>
	</head>
	<body>

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
  <div id="qr-reader-results"></div>
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
            }
          });
      }
    }

    const html5QrCode = new Html5Qrcode("qr-reader");
    const qrCodeSuccessCallback = (decodedText, decodedResult) => {
        onScanSuccess(decodedText, decodedResult);
    };
    const config = { fps: 10, qrbox: { width: 250, height: 250 } };
    html5QrCode.start({ facingMode: "environment" }, config, qrCodeSuccessCallback);
  </script>

  <style>
    #camera--view{
      width: 100vw;
      height: 100vh;
      position: fixed;
      object-fit: cover;
    }
    *{
      margin: 0;
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
    }
    #header-info a{
        text-decoration: none;
        color: #FF4D3C;
    }
  </style>
  <!-- Non va -->
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

            
        window.onload = function(){
			document.getElementById('qr-reader__camera_permission_button').click();
        };
      </script>
  	</body>
</html>
