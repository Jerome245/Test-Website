<?php
	
	$email = $_POST['email'];
	$club = $_POST['club'];
	$sql = "";
	$sql1 = "";
	
	$servername = "localhost";
	$username = "id9106402_root";
	$password = "pwdpwd";
	$dbname = "id9106402_clubs";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	$sql = "DELETE FROM `$club` WHERE Email = '$email' ";
	
	if ($conn->query($sql) === FALSE) {
		die('Error cound not change data: ' . $conn->connect_error);
	}
	
	$sql = "SELECT Club1, Club2 FROM `totaldb` WHERE Email = '$email' ";
	$result = $conn->query($sql);

	$row = mysqli_fetch_array ($result,MYSQLI_NUM);
	
	$club1 = $row[0];
	$club2 = $row[1];
	
	
	if ($club == $club1){
		$sql1 = "UPDATE `totaldb` SET Club1 = '$club2',Club2 = '' WHERE Email = '$email' ";
	}
	else if ($club == $club2){
		$sql1 = "UPDATE `totaldb` SET `Club2` = '' WHERE Email = '$email'";
	}
	
	$result = $conn->query($sql1);
	
	$text = $email." rejected from ".$club;
	
	$sql = "INSERT INTO `alerts`(`Alert`, `Type`, `Email`,`Club`) VALUES ('$text','Rejected','$email','$club')";
	if ($conn->query($sql) === FALSE) {
		die('Error cound not change data: ' . $conn->connect_error);
	}
	
	$subject="Rejected from $club";
						
	$header="from: PSHS-CLC Club management";
						
	$message="Sadly\n\n";
	$message.="You have been rejected from $club";
								
	$sentmail = mail($email,$subject,$message,$header);
	
	$conn->close();
?>