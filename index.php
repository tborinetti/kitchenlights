<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ARE THE KITCHEN LIGHTS ON</title>
    <link rel="stylesheet" href="style.css">
  </head>
  <body>
    <div class="header">
      <h1>ARE THE KITCHEN LIGHTS ON</h1>
    </div>
    <div class="main_content">
      <div class="left_screen">
        <p id='xx'>Lights OFF</p>
      </div>
      <div class="right_screen">
        <img id="stream" src="http://192.168.1.194:8080/?action=stream" width="960" height="720">
      </div>
    </div>

  </body>

  <script type="text/javascript">
      let intervalID;


      function changeLights(lightsOn) {
        if (lightsOn == true) {
          document.getElementById('xx').innerHTML = "LIGHTS ON";
        } else {
          document.getElementById('xx').innerHTML = "LIGHTS OFF";
        }

      }

      // function getPixelColours(callback) {
      //   const myImg = new Image().;
      //   console.log(myImg);
      //
      //   myImg.onload = () => {
      //     const context = document.createElement('canvas').getContext('2d');
      //     context.drawImage(myImg, 0, 0);
      //     const imgData = context.getImageData(299, 100, 1, 1);
      //     const pixelData = imgData.data;
      //
      //     console.log(pixelData);
      //     const sumPix = pixelData[0] + pixelData[1] + pixelData[2];
      //     const avgPix = sumPix / 3;
      //
      //     if (avgPix > 70) {
      //       console.log(avgPix);
      //       callback(true);
      //     } else {
      //       console.log(avgPix);
      //       callback(false);
      //     }
      //
      //   }
      // }

      function getPixelColours(callback) {
        const myImg = new Image();
        myImg.crossOrigin = "Anonymous";

        myImg.onload = () => {
          const context = document.createElement('canvas').getContext('2d');
          context.drawImage(myImg, 0, 0);
          const imgData = context.getImageData(299, 100, 1, 1);
          const pixelData = imgData.data;

          console.log(pixelData);
          const sumPix = pixelData[0] + pixelData[1] + pixelData[2];
          const avgPix = sumPix / 3;

          if (avgPix > 70) {
            console.log(avgPix);
            callback(true);
          } else {
            console.log(avgPix);
            callback(false);
          }

        }

        myImg.src = 'http://192.168.1.194:8080/?action=stream';
      }

      function run() {
        getPixelColours(changeLights);
      }

      setInterval(run, 2000);

      // if (myImg.data) {
      //
      // }

  </script>
</html>
