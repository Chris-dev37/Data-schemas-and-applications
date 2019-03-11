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

     $EweatherURL = curl("api.openweathermap.org/data/2.5/forecast?lat=$Elatitude&lon=$Elongitude&units=metric&appid=$apiKey");
     $EweatherArray = json_decode($EweatherURL, true);
   
     //print_r($EweatherArray);
?>
<div id="edinburgh">
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