<?php

require_once('faultLogin.php');


// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected!<br>";

$name1 = 'INSERT INTO faults (';
$value1 = ' VALUES (';
//escapes special characters and builds sql query with POST data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	foreach($_POST as $key => $value) {
		$value = mysqli_real_escape_string($conn, $value);
		$name1 = $name1 . $key . ",";
		$value1 = $value1 . "'" . $value . "'" . ",";
	}
} else {
	$returnMsg["message"] = "POST method error!";
	$jsonMsg = json_encode($returnMsg);
	echo $jsonMsg;
	exit(1);
}
//Gets rid of the last comma
$name1 = substr($name1, 0, -1);
$name1 = $name1 . ")";
$value1 = substr($value1, 0, -1);
$value1 = $value1 . ")";
$sql = $name1 . $value1;
echo $sql;


if (mysqli_query($conn, $sql)) {
	$returnMsg["message"] = "Successful DB entry!";
	include('success_page.html');
	exit();
} else {
    $returnMsg["message"] = "Error: " . $sql . "<br>" . mysqli_error($conn);
	include('error_page.html');
	exit();
}
$jsonMsg = json_encode($returnMsg);
echo $jsonMsg;


mysqli_close($conn);
?>