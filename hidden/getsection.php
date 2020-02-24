<?php
	$servername = "localhost";
	$username = "id9106402_sections";
	$password = "pwdpwd";
	$dbname = "id9106402_sections";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT table_name FROM information_schema.tables WHERE table_schema ='id9106402_sections' ORDER BY `table_name` ASC";
	
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