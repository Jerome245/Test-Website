<?php

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

$passkey=testInput($_GET['passkey']);
echo passkey;

// Retrieve data from table where row that match this passkey
$sql1 = "SELECT * FROM applicantlist WHERE Passkey = `$passkey`";
$result1 = $conn->query($sql1);
// If successfully queried
if($result1){

	if($result1->num_rows == 1){
		$sql = "UPDATE applicantlist SET Status='1' WHERE Passkey = '$passkey' ";
		$result = $conn->query($sql);
		if ($result){
			echo "Your account has been activated";
		}

	}
	else if ($result1->num_rows > 1) {
		echo "Error: Link is Invalid";
	}

	// if not found passkey, display message "Wrong Confirmation code"
	else {
		echo "Error: Link is Invalid";
	}

	// if successfully moved data from table"temp_members_db" to table "registered_members" displays message "Your account has been activated" and don't forget to delete confirmation code from table "temp_members_db"

}
else {
	echo "Error: Failed to connect";
}
$conn->close();
?>
