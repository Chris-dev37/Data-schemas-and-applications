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
    
  $VweatherURL = curl("api.openweathermap.org/data/2.5/forecast?q=Vancouver,ca&units=metric&appid=e7f136afc12e538a55ec4e4c0c9722c1");
  $EweatherURL = curl("api.openweathermap.org/data/2.5/forecast?q=Edinburgh,gb&units=metric&appid=e7f136afc12e538a55ec4e4c0c9722c1");
  
  $VweatherArray = json_decode($VweatherURL, true);
  $EweatherArray = json_decode($EweatherURL, true);


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
      width="600"
      height="450"
      frameborder="100" style="border:100"
      src="vancouverMap.php" allowfullscreen>
    </iframe></td>

    <td>
        <h3 class="weatherTitle">Vancouver Weather</h3>
        <iframe
      width="600"
      height="450"
      frameborder="100" style="border:100"
      src="vancouverWeather.php">
    </iframe>
    </td>
  </table>

  <table id="edinburgh_table" class="inline_table"> 
      <tr>
        <th>Edinburgh</th>
      </tr>
    <td><iframe
      width="600"
      height="450"
      frameborder="100" style="border:100"
      src="edinburghMap.php" allowfullscreen>
    </iframe></td>

    <td>
        <h3 class="weatherTitle">Edinburgh Weather</h3>
        <iframe
      width="600"
      height="450"
      frameborder="100" style="border:100"
      src="edinburghWeather.php">
    </iframe>
    </td>
  </table>

  <div id="googleMap" style="width:100%;height:400px;"></div>


</body>
</html>