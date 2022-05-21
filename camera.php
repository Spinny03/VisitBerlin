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

    <div id="header-info"></div>
		<video id="camera--view" autoplay playsinline></video>
    <!--
    <form action="camera.php" method="post">
      <input type="hidden" name="code" id="code"  value="" placeholder="Scan the code">
    </form>
    -->

  <script>
    var constraints = { video: { facingMode: "environment" }, audio: false };
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

    window.addEventListener("load", cameraStart, false);
  </script>
  <div id="qr-reader" style="width:100%; height:100vh; visibility:hidden;"></div>
  <div id="qr-reader-results"></div>
  <script>
    var resultContainer = document.getElementById('qr-reader-results');
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
                console.log(data);
                document.getElementById("header-info").innerHTML = data;
            }
          });
      }
    }
    var html5QrcodeScanner = new Html5QrcodeScanner(
      "qr-reader", { fps: 60, qrbox: 500 });
    html5QrcodeScanner.render(onScanSuccess);  
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
      top: 0;
      z-index: 3;
      background-color: #4caf50;
      max-width: 600px;
      padding: 25px 25px 25px 75px;
      color: #fff;
    }
  </style>
  <!-- Non va -->
      <div class="loader-wrapper">
          <span class="loader"><span class="loader-inner"></span></span>
      </div>

      <script>
          $(window).on("load",function(){
          $(".loader-wrapper").fadeOut("slow");
          });
      </script>
  	</body>
</html>
