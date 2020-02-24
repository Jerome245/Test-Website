<?php
$result1 = $result2 = $result3 = $result4 = "";

$servername = "localhost";
$username = "id9106402_root";
$password = "pwdpwd";
$dbname = "id9106402_clubs";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Passkey that got from link
$passkey=$_GET['passkey'];

// Retrieve data from table where row that match this passkey
$sql1 = "SELECT * FROM totaldb WHERE Passkey = '$passkey' ";
$result1 = $conn->query($sql1);
// If successfully queried
if($result1){

	if($result1->num_rows == 1){

		$rows = mysqli_fetch_array($result1);

		$lastname = $rows['Lastname'];
		$name =$rows['Name'];
		$email = $rows['Email'];
		$batch = $rows['Section'];
		$mobile= $rows['Mobile'];

		$club1 = $rows['Club1'];
		$club2 = $rows['Club2'];

		// Insert data that retrieves from "temp_members_db" into table "registered_members"
		$sql2 = "INSERT INTO `$club1` (Lastname, Name, Section, Mobile, Email, Priority, Status) VALUES ('$lastname', '$name', '$batch', '$mobile', '$email', 'First', 'Limbo')";
		$result2 = $conn->query($sql2);

		if ($club2 != ""){
			$sql3 = "INSERT INTO `$club2` (Lastname, Name, Section, Mobile, Email, Priority, Status) VALUES ('$lastname', '$name', '$batch', '$mobile', '$email'', 'Second', 'Limbo')";
			$result3 = $conn->query($sql3);
		}

		if($result2){
			if ($club2 == "" or $result3){
				$sql4 = "UPDATE totaldb SET Confirmed='TRUE' WHERE Passkey = '$passkey' ";
				$result4 = $conn->query($sql4);
			}
		}


		if ($result4){
			echo "Your account has been activated";

			$sql4 = "DELETE FROM totaldb WHERE Email = '$email' AND Confirmed = 'FALSE' ";
			$conn->query($sql4);

			$text = $email." verified for ".$club1." as First priority";
			$sql = "INSERT INTO `alerts`(`Alert`, `Type`, `Email`, `Club`) VALUES ('$text','Verification','$email','$club1')";

			if($club2 != ""){
			    $text = $email." verified for ".$club2." as Second priority";
			    $sql = "INSERT INTO `alerts`(`Alert`, `Type`, `Email`, `Club`) VALUES ('$text','Verification','$email','$club2')";
			}

			$conn->query($sql);
		}

	}

	else if ($result1->num_rows > 1) {
		echo "Error: Confirmation code is Invalid";
	}

	// if not found passkey, display message "Wrong Confirmation code"
	else {
		echo "Wrong Confirmation code";
	}

	// if successfully moved data from table"temp_members_db" to table "registered_members" displays message "Your account has been activated" and don't forget to delete confirmation code from table "temp_members_db"

}
else {
	echo "Failed to connect";
}
$conn->close();
?>
