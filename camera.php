<!DOCTYPE html>
<html>
  <head>
    <title>Camera</title>
    <script type="text/javascript" src="instascan.min.js"></script>
  </head>
  <body>
    <video id="preview"></video>
    <script type="text/javascript">
      let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });
      scanner.addListener('scan', function (content) {
        console.log(content);
      });
      Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
          scanner.start(cameras[0]);
        } else {
          alert('No cameras found.');
        }
      }).catch(function (e) {
        console.error(e);
      });

      scanner.addListener('scan', function (c) {
        document.getElementById('text').value = c;
      });
    </script>
  </body>
  <?php $conn->close(); ?>
</html>