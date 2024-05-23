<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>ARE THE KITCHEN LIGHTS ON</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  </head>
  <body>
    <div class="header">
      <div class="header_container">
        <h1 id="title_heading">ARE THE KITCHEN LIGHTS ON</h1>
        <img id="fire_bar" src="images/firebar.gif" alt="">
      </div>
      
    </div>
    <div class="main_content">
      <div class="left_container">
        <div class="left_content">
          <p id='xx'>Lights OFF</p>

        </div>
        
      </div>
      <div class="right_container">
        <div class="stream_container">
          <div id="stream_heading">
            <h1 id="stream_title">KITCHEN CAM 01 </h1>
            <img src="images/redbar.gif">
          </div>
          <img id="stream" src="http://192.168.1.199:8080/camera">
        </div>
        
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
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
