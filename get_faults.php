<?php

require_once('login.php');

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected!<br>";

$sql = "SELECT * FROM sites ORDER BY site_name DESC";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
	foreach($row as $key => $value) {
		echo $key . ':' . $value;
		echo '<br>';
	}
	echo '<br>';
}
mysqli_free_result($result);

mysqli_close($conn);
?>