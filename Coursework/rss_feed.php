<?php
  $config = simplexml_load_file("config.xml") or die("error");

  $rssfeed = "";
  $host=$config->MySQL->host;
  $servername = $config->MySQL->database;
  $username = $config->MySQL->username;
  $password = $config->MySQL->password;
  $db = new mysqli($host, $username, $password, $servername);

  header("Content-Type: application/rss+xml; charset=ISO-8859-1");
  $rssfeed = '<?xml version="1.0" encoding="ISO-8859-1"?>';
  $rssfeed .= '<rss version="2.0">';
  $rssfeed .= '<channel>';
  $rssfeed .= '<title>Twin Cities RSS</title>';
  $rssfeed .= '<link>http://cems.uwe.ac.uk/~a2-matuzeviciu/</link>';
  $rssfeed .= '<description>RSS feed showing city and point of interest data currently in the database.</description>';
  $rssfeed .= '<language>en-us</language>';

  function add_post($title, $desc, $link){
    global $rssfeed;
    $rssfeed .= '<item>';
    $rssfeed .= '<title>' . $title . '</title>';
    $rssfeed .= '<description>' . $desc . '</description>';
    $rssfeed .= '<link>' . $link . '</link>';
    $rssfeed .= '</item>';
  }

//Display the city names and information
  $sql = "SELECT * FROM City";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $post = "";
        $title = $row["Name"];
        foreach($row as $key=>$value){
          $post.= $key . ":" . $value. " | ";
        }
          add_post($title,$post,"http://cems.uwe.ac.uk/~a2-matuzeviciu/");
      }
  }

//Display all the places if interest and the info as they appear in the database
  $sql = "SELECT * FROM PlaceOfInterest";
  $result = $db->query($sql);
  if ($result->num_rows > 0) {
      while($row = $result->fetch_assoc()) {
        $post = "";
        $title = $row["Name"];
        foreach($row as $key=>$value){
          $post.= $key . ":" . $value. " | ";
        }
        add_post($title,$post,"http://cems.uwe.ac.uk/~a2-matuzeviciu/");
      }
  }


  $rssfeed .= '</channel>';
  $rssfeed .= '</rss>';
  echo $rssfeed;


//https://www.carronmedia.com/create-an-rss-feed-with-php/
//https://www.w3schools.in/php/php-rss-feed/
//www.pontikis.net/blog/simple-rss-class-create-rss-feed
 ?>


