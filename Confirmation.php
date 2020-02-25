<?php
echo "Your submission has been verified";

$servername = "us-cdbr-iron-east-04.cleardb.net";
$username = "be346908c3321d";
$password = "47897b06";
$dbname = "heroku_bc49f21d14a9948";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Passkey that got from link

function testInput($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);

	return $data;
}

$passkey=testInput($_GET["passkey"]);

$sql = "UPDATE applicantlist SET Status='1' WHERE Passkey = '$passkey' ";
$result = $conn->query($sql);

$conn->close();
?>
