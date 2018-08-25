<?php
require_once('faultLogin.php');
$conn = mysqli_connect($host, $user, $pass, $db);
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM faults";
$result = mysqli_query($conn, $sql);

$rows = array();

while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) {
	$rows[] = $row;
}

echo = json_encode($rows);

mysqli_free_result($result);
mysqli_close($conn);
?>