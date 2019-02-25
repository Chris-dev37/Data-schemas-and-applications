<?php
  function curl($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    $data = curl_exec($ch);
    curl_close($ch);

    return $data;
  }    
    
  $VweatherURL = curl("https://api.openweathermap.org/data/2.5/weather?q=vancouver,ca&appid=e7f136afc12e538a55ec4e4c0c9722c1");
  $EweatherURL = curl("https://api.openweathermap.org/data/2.5/weather?q=edinburgh,gb&appid=e7f136afc12e538a55ec4e4c0c9722c1");
  
  $VweatherArray = json_decode($VweatherURL, true);
  $EweatherArray = json_decode($EweatherURL, true);

  $VweatherMain = $VweatherArray['weather'][0]['main'];
  $EweatherMain = $EweatherArray['weather'][0]['main'];

  $VweatherDesc = $VweatherArray['weather'][0]['description'];
  $EweatherDesc = $EweatherArray['weather'][0]['description'];

  $VtempInCelcius = $VweatherArray['main']['temp'] - 273.15;
  $EtempInCelcius = $EweatherArray['main']['temp'] - 273.15;

  $VtempInCelciusMin = $VweatherArray['main']['temp_min'] - 273.15;
  $EtempInCelciusMin = $EweatherArray['main']['temp_min'] - 273.15;

  $VtempInCelciusMax = $VweatherArray['main']['temp_max'] - 273.15;
  $EtempInCelciusMax = $EweatherArray['main']['temp_max'] - 273.15;

  $VweatherHumid = $VweatherArray['main']['humidity'];
  $EweatherHumid = $EweatherArray['main']['humidity'];

  $VweatherWind = $VweatherArray['wind']['speed'];
  $EweatherWind = $EweatherArray['wind']['speed'];

  //print_r($VweatherArray);
  //print_r($EweatherArray);

?>

<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="layout.css" type="text/css">
  </head>

<body>

  <table id="vancouver_table" class="inline_table">
    <tr>
      <th>Vancouver</th>
    </tr> 

    <td><iframe
      width="500"
      height="450"
      frameborder="100" style="border:100"
      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBEwVa1GKs4lLB4CVi4YQ2Ptaep70MV_x8 &q= Vancouver+BC" allowfullscreen>
    </iframe></td>

    <td>
        <h3>Vancouver Weather</h3>
        <?php echo "Main Weather: ".($VweatherMain).": (".($VweatherDesc)."),  Temp: ".($VtempInCelcius)." °C, Temp lows: ".($VtempInCelciusMin)." °C, Temp Highs: ".($VtempInCelciusMax)." °C, Humidity: ".($VweatherHumid).", Wind Speeds: ".($VweatherWind)." Mph"?>
    </td>
  </table>

  <table id="edinburgh_table" class="inline_table"> 
      <tr>
        <th>Edinburgh</th>
      </tr>
    <td><iframe
      width="500"
      height="450"
      frameborder="100" style="border:100"
      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBEwVa1GKs4lLB4CVi4YQ2Ptaep70MV_x8 &q= Edinburgh+GB" allowfullscreen>
    </iframe></td>

    <td>
        <h3>Edinburgh Weather</h3>
        <?php echo "Main Weather: ".($EweatherMain).": (". ($EweatherDesc)."),  Temp: ".($EtempInCelcius)."°C, Temp lows: ".($EtempInCelciusMin)." °C, Temp Highs: ".($EtempInCelciusMax)." °C, Humidity: ".($EweatherHumid).", Wind Speeds: ".($EweatherWind)." Mph"?>
    </td>
  </table>

  <div id="googleMap" style="width:100%;height:400px;"></div>

  <script>
    function myMap() {
    var mapProp= {
    center:new google.maps.LatLng(49.2827,-123.1207),
    zoom:13,
  };
  var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
  }
  </script>

</body>
</html>
