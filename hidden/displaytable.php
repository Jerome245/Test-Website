<?php
	
	$club = $_POST['club'];
	$status = $_POST['status'];
	$priority = $_POST['priority'];
	$data = array();
	$row = "";
	
	$servername = "localhost";
	$username = "id9106402_root";
	$password = "pwdpwd";
	$dbname = "id9106402_clubs";

	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT Name, Section, Mobile, Email, Priority FROM `$club` WHERE Status = '$status' ";
	
	if($status == "Accepted"){
		$sql = "SELECT Name, Section, Mobile, Email FROM `$club` WHERE Status = '$status' AND Priority = '$priority' ";
	}
	
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
	    echo "Error";
	}
	$conn->close();
?>