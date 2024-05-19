<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ARE THE KITCHEN LIGHTS ON</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
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
        <img id="stream" src="http://192.168.1.199:8080/camera" width="960" height="720">
      </div>
    </div>

  </body>

  <script type="text/javascript">


      function changeLights(state) {
        if (state == "True") {
          document.getElementById('xx').innerHTML = "LIGHTS ON";
        } else if (state == "False") {
          document.getElementById('xx').innerHTML = "LIGHTS OFF";
        }
      }

      function getJsonFile(callback){
        // const lightsOnData;
        $.getJSON("info.json", function( data) {
            let jsonData = data.lightsOn;
            console.log(jsonData);
            // lightsOnData = jsonData;
            callback(jsonData);
        });
      }


      $(document).ready(function(){
        setInterval(function() { getJsonFile(changeLights); }, 500);

      });


  </script>
</html>
