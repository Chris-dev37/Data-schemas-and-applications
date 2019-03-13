<link rel="stylesheet" type="text/css" href="layout.css"/>

<?php
	$config = simplexml_load_file("config.xml") or die("Error");

	$host = $config->MySQL->host;
	$username = $config->MySQL->username;
	$password = $config->MySQL->password;
	$database = $config->MySQL->database;
?>

<?php

	// Create connection
	$conn = new mysqli($host, $username, $password, $servername);

	// Check connection
	if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>

<div id="mytable">
	<div id="twitter">
		<table>
			<?php
			header('Content-Type: text/html; charset="UTF-8"');

			/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
			$settings = array(
			'oauth_access_token' => $config->keys->twitter_auth_access_token,
			'oauth_access_token_secret' => $config->keys->twitter_auth_access_token_secret,
			'consumer_key' => $config->keys->twitter_consumer_key,
			'consumer_secret' => $config->keys->twitter_consumer_secret);
			

			/** Perform a GET request and echo the response **/
			/** Note: Set the GET field BEFORE calling buildOauth(); **/
			$url = 'https://api.twitter.com/1.1/search/tweets.json';
			$getfield = "?q=&geocode=$long,$lat,10km";
			$requestMethod = 'GET';
			$twitter = new TwitterAPIExchange($settings);
			$data=$twitter->setGetfield($getfield)
						 ->buildOauth($url, $requestMethod)
						 ->performRequest();
			?>
		</table>
	</div>
</div>

<?php
/* echo "Input your comment below: ";
echo "<input type='text' placeholder='Please enter your comment' name='comment' required>";
echo "<input type='submit'>  ";
 echo "<input type='hidden' name=cityid value = $cID >"; */
?>
</form>
<?php
/* $sql = "SELECT * FROM comments WHERE $cID = comments.city_idcity ORDER BY datetime";
$result = mysqli_query($conn, $sql);
if ($result->num_rows > 0) {
    echo "<table><tr><th>Comment ID</th><th>Date of posted comment</th><th>Comment</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>".$row["comment_id"]."</td><td>".$row["datetime"]."</td><td>".$row["comment"]."</td></tr>";

	}
}
$conn->close(); */
?>