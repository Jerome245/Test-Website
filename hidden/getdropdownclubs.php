<?php
	
	$data[] = "";
	$row = "";
	
	$servername = "localhost";
	$username = "id9106402_root";
	$password = "pwdpwd";
	$dbname = "id9106402_clubs";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT `TABLE_NAME` FROM information_schema.tables WHERE TABLE_SCHEMA = 'id9106402_clubs' AND TABLE_COMMENT = 'Clubs' ORDER BY `TABLE_NAME` ASC";
	
	$result = $conn->query($sql);
	if ($result AND $result -> num_rows == 0){
		echo "Error";
	}
	else if ($result AND $result->num_rows > 0){
	    while($row = mysqli_fetch_array ($result,MYSQLI_NUM)) {
			$data[] = $row;
		}
			
		echo json_encode($data);
	}
	else{
		 die('Could not get data: ' . $conn->connect_error);
	}
	$conn->close();
?>