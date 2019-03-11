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
      width="500"
      height="450"
      frameborder="100" style="border:100"
      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBEwVa1GKs4lLB4CVi4YQ2Ptaep70MV_x8&q=Vancouver+BC" allowfullscreen>
    </iframe></td>

    <td>
        <h3 class="weatherTitle">Vancouver Weather</h3>
        <?php
        for($i=0; $i<40; $i+=8){
            $date = $VweatherArray['list'][$i]['dt_txt'];
            $tempCurrent = $VweatherArray['list'][$i]['main']['temp'];
            $tempMin = $VweatherArray['list'][$i]['main']['temp_min'];
            $tempMax = $VweatherArray['list'][$i]['main']['temp_max'];
            $weatherMain = $VweatherArray['list'][$i]['weather'][0]['main'];
            $weatherMainDes = $VweatherArray['list'][$i]['weather'][0]['description'];
            $Iconpull = $VweatherArray['list'][$i]['weather'][0]['icon'];
            $windSpeed = $VweatherArray['list'][$i]['wind']['speed'];
            $Image = "http://openweathermap.org/img/w/".$Iconpull.".png";
          
            echo "<br>Date: ".$date."<br>";
            echo "Main Weather: ".$weatherMain.", ".$weatherMainDes.;
            echo '<img src="data:image/jpeg;base64,'.base64_encode(file_get_contents ($Image )).'"/><br>';
            echo "Temp: ".$tempCurrent."&#176C, Temp Lows: ".$tempMin."&#176C, Temp Highs: ".$tempMax."&#176C<br>";
            echo "Wind Speed: ".$windSpeed."<br>";
        }
        ?>
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
      src="https://www.google.com/maps/embed/v1/place?key=AIzaSyBEwVa1GKs4lLB4CVi4YQ2Ptaep70MV_x8&q=Edinburgh+GB" allowfullscreen>
    </iframe></td>

    <td>
        <h3 class="weatherTitle">Edinburgh Weather</h3>
        <?php 
        for($i=0; $i<40; $i+=8){
            $date = $EweatherArray['list'][$i]['dt_txt'];
            $tempCurrent = $EweatherArray['list'][$i]['main']['temp'];
            $tempMin = $EweatherArray['list'][$i]['main']['temp_min'];
            $tempMax = $EweatherArray['list'][$i]['main']['temp_max'];
            $weatherMain = $EweatherArray['list'][$i]['weather'][0]['main'];
            $weatherMainDes = $EweatherArray['list'][$i]['weather'][0]['description'];
            $Iconpull = $EweatherArray['list'][$i]['weather'][0]['icon'];
            $windSpeed = $EweatherArray['list'][$i]['wind']['speed'];
            $Image = "http://openweathermap.org/img/w/".$Iconpull.".png";
        
            echo "<br>Date: ".$date."<br>";
            echo "Main Weather: ".$weatherMain.", ".$weatherMainDes."<br>";
            echo '<img src="data:image/jpeg;base64,'.base64_encode(file_get_contents ($Image )).'"/><br>';
            echo "Temp: ".$tempCurrent."&#176C, Temp Lows: ".$tempMin."&#176C, Temp Highs: ".$tempMax."&#176C<br>";
            echo "Wind Speed: ".$windSpeed."<br>";
        }
        ?>
    </td>
  </table>

  <div id="googleMap" style="width:100%;height:400px;"></div>


</body>
</html>