<?php
  $config = simplexml_load_file("config.xml") or die("error");

  $host=$config->MySQL->host;
  $servername = $config->MySQL->database;
  $username = $config->MySQL->username;
  $password = $config->MySQL->password;
  $db = new mysqli($host, $username, $password, $servername);

  function parseToXML($htmlStr)
  {
    $xmlStr=str_replace('<','&lt;',$htmlStr);
    $xmlStr=str_replace('>','&gt;',$xmlStr);
    $xmlStr=str_replace('"','&quot;',$xmlStr);
    $xmlStr=str_replace("'",'&#39;',$xmlStr);
    $xmlStr=str_replace("&",'&amp;',$xmlStr);
    return $xmlStr;
  }
  // Opens a connection to a MySQL server
  $connection=mysqli_connect ($host, $username, $password);
  if (!$connection) {
    die('Not connected : ' . mysql_error());
  }

  // Set the active MySQL database
  $db_selected = mysqli_select_db($connection, $servername);
  if (!$db_selected) {
    die ('Can\'t use db : ' . mysqli_error());
  }

  // Select all the rows in the markers table
  $query = "SELECT * FROM PlaceOfInterest";
  $result = mysqli_query($connection, $query);
  if (!$result) {
    die('Invalid query: ' . mysqli_error());
  }
  
  
  // Start XML file, echo parent node
 // $xml = "<?xml version='1.0'";
  
  $xml = "<?xml version='1.0'?>";
  $xml.= '<markers>';

  $ind=0;
  // Iterate through the rows, printing XML nodes for each
  while ($row = @mysqli_fetch_assoc($result)){
    // Add to XML document node
    $xml.=  '<marker';
    $xml.=  ' id="' . $row['POI_ID'] . '" ';
    $xml.=  'name="' . parseToXML($row['namedb']) . '" ';
    $xml.=  'address="' . parseToXML($row['addressdb']) . '" ';
    $xml.=  'lat="' . $row['Lat'] . '" ';
    $xml.= 'lng="' . $row['Long'] . '" ';
    $xml.=  'workinghours="' . $row['WorkingHours'] . '" ';
    $xml.=  'age="' . $row['Age'] . '" ';
    $xml.= 'accessibility="' . $row['Accessibility'] . '" ';
    $xml.=  'photos="' . $row['Photos'] . '" ';
    $xml.= 'City_woeID="' . $row['City_woeID'] . '" ';
    $xml.= 'type="' . $row['Type'] . '" ';
    $xml.=  '/>';
    $ind = $ind + 1;
    

  }

    // End XML file
    $xml.= '</markers>';

    header("Content-type: text/xml");
    echo $xml;
?>