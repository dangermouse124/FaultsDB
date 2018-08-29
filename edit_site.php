<?php

require_once('faultLogin.php');

// Create connection
$conn = mysqli_connect($host, $user, $pass, $db);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
//echo "Connected!<br>";


if (!isset($_POST['site_num']) || strlen((string)$_POST['site_num']) < 4 || strlen((string)$_POST['site_num']) > 6) {
	echo "Invalid site number";
	include('error_page.html');
	exit();
}

if (!isset($_POST['site_name']) || $_POST['site_name'] == '') {
	echo "Invalid site name";
	include('error_page.html');
	exit();
}

$site_num = mysqli_real_escape_string($conn, $_POST['site_num']);
$site_name = mysqli_real_escape_string($conn, $_POST['site_name']);

if ($_POST['edit_item'] == "site_num") {
	$sql = "UPDATE sites SET site_num=" . $site_num . " WHERE site_name='" . $site_name . "'";
} elseif ($_POST['edit_item'] == "site_name") {
	$sql = "UPDATE sites SET site_name='" . $site_name . "' " . "WHERE site_num=" . $site_num;
} else {
	$returnMsg["message"] = "POST method error!";
	$jsonMsg = json_encode($returnMsg);
	echo $jsonMsg;
	exit(1);
}

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