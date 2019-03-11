<link rel="stylesheet" type="text/css" href="layout.css"/>

<?php
    $config = simplexml_load_file("config.xml") or die("Error");
    $apiKey = $config->keys->weather;
    
    $host = $config->MySQL->host;
    $username = $config->MySQL->username;
    $password = $config->MySQL->password;
    $database = $config->MySQL->database;
?>
    
<?php
    $connect = new mysqli($host, $username, $password, $database);

    $Vsql = "SELECT latitude FROM City WHERE Name = 'Vancouver'";
    $result = $connect->query($Vsql);
        while ($row = $result->fetch_assoc())
	   {
		   $Vlatitude = $row["latitude"];
        }
    $Vsql = "SELECT longitude FROM City WHERE Name = 'Vancouver'";
    $result = $connect->query($Vsql);
        while ($row = $result->fetch_assoc())
	   {
		   $Vlongitude = $row["longitude"];
        }
    $Esql = "SELECT latitude FROM City WHERE Name = 'Edinburgh'";
    $result = $connect->query($Esql);
        while ($row = $result->fetch_assoc())
	   {
		   $Elatitude = $row["latitude"];
        }
    $Esql = "SELECT longitude FROM City WHERE Name = 'Edinburgh'";
    $result = $connect->query($Esql);
        while ($row = $result->fetch_assoc())
	   {
		   $Elongitude = $row["longitude"];
        }

//    $Vsql = "SELECT * FROM City WHERE Name = 'Vancouver'";   
//    $result = $connect->query($Vsql);
//	   while ($row = $result->fetch_assoc())
//	   {
//		   $Vlatitude = $row["latitude"];
//		   $Vlongitude = $row["longitude"];
//	   }
//
//    $Esql = "SELECT * FROM City WHERE Name = 'Edinburgh'";   
//    $result = $connect->query($Esql);
//	   while ($row = $result->fetch_assoc())
//	   {
//		   $Elatitude = $row["latitude"];
//		   $Elongitude = $row["longitude"];
//	   }

?>

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
       
     $VweatherURL = curl("api.openweathermap.org/data/2.5/forecast?lat=$Vlatitude&lon=$Vlongitude&units=metric&appid=$apiKey");
     $EweatherURL = curl("api.openweathermap.org/data/2.5/forecast?lat=$Elatitude&lon=$Elongitude&units=metric&appid=$apiKey");
     
     $VweatherArray = json_decode($VweatherURL, true);
     $EweatherArray = json_decode($EweatherURL, true);
   
   
     //print_r($VweatherArray);
     //print_r($EweatherArray);
?>
<div id="vancouverWeather">
    <h3 class="weatherTitle">Vancouver Weather</h3>
    <p>
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
            echo "Main Weather: ".$weatherMain.", ".$weatherMainDes."<br>";
            echo '<img src="data:image/jpeg;base64,'.base64_encode(file_get_contents ($Image )).'"style="width:50px;height:50px;"/><br>';
            echo "Temp: ".$tempCurrent."&#176C, Temp Lows: ".$tempMin."&#176C, Temp Highs: ".$tempMax."&#176C<br>";
            echo "Wind Speed: ".$windSpeed."<br>";
        }
        ?>
    </p>
</div>

<div id="edinburghWeather">
    <h3 class="weatherTitle">Edinburgh Weather</h3>
    <p>
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
    </p>

</div>