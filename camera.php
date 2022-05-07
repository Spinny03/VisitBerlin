<!DOCTYPE html>
<html>
  <head>
    <script src="html5-qrcode.min.js"></script>
    <title>Camera</title>

  </head>
  <body>
  <div id="qr-reader" style="width:100%;"></div>
  <div id="qr-reader-results"></div>
    <script>
      var resultContainer = document.getElementById('qr-reader-results');
      var lastResult, countResults = 0;

      function onScanSuccess(decodedText, decodedResult) {
        if (decodedText !== lastResult) {
            ++countResults;
            lastResult = decodedText;
            console.log(`Scan result ${decodedText}`, decodedResult);
        }
      }

      var html5QrcodeScanner = new Html5QrcodeScanner(
        "qr-reader", { fps: 10, qrbox: 250 });
      html5QrcodeScanner.render(onScanSuccess);
      
    </script>
  </body>
</html>
