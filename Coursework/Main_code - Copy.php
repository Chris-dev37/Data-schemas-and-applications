<!DOCTYPE html>
<? 
$url = "http://api.openweathermap.org/data/2.5/find?q=Vancouver&units=metric&type=accurate&mode=xml&APPID=e7f136afc12e538a55ec4e4c0c9722c1";
$getweather = simplexml_load_file($url);

?>
<html>
  <head>
    <link rel="stylesheet" href="layout.css" type="text/css">
    <link rel="api" href="api.js">
  </head>
<body>

  <table id="vancouver_table" class="inline_table">
    <tr>
      <th>Vancouver</th>
    </tr> 

    <td><iframe
      width="600"
      height="450"
      frameborder="100" style="border:100"
      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBEwVa1GKs4lLB4CVi4YQ2Ptaep70MV_x8 &q= Vancouver+BC" allowfullscreen>
    </iframe></td>

    <td>
    <iframe
    width="600"
    height="200"
    frameborder="100" style="border:100"
    src="http://api.openweathermap.org/data/2.5/find?q=Vancouver&units=metric&type=accurate&mode=xml&APPID=e7f136afc12e538a55ec4e4c0c9722c1">
    </iframe></td>

  </table>

  <table id="edinburgh_table" class="inline_table"> 
      <tr>
        <th>Edinburgh</th>
      </tr>
    <td><iframe
      width="600"
      height="450"
      frameborder="100" style="border:100"
      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBEwVa1GKs4lLB4CVi4YQ2Ptaep70MV_x8 &q= Edinburgh+GB" allowfullscreen>
    </iframe></td>

    <td>
        <h3>Edinburgh Weather</h3>
        <p><? echo($getweather);?></p>
    </td>

  </table>

  <div id="googleMap" style="width:100%;height:400px;"></div>
  <div id="OpenWeather" style="width:100%; height:400px;"></div>

  <script>
    function myMap() {
    var mapProp= {
    center:new google.maps.LatLng(49.2827,-123.1207),
    zoom:13,
  };
  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  }
  </script>

  <script>
    function myWeather(){
      var URL="http://api.openweathermap.org/data/2.5/find?q=Vancouver&units=metric&type=accurate&mode=xml&APPID=e7f136afc12e538a55ec4e4c0c9722c1";
      
      var weather = new weather.api(documnet.getElementById("OpenWeather"),URL);
    }
  </script>
</body>
</html>
