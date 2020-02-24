<?php
	$email = $_POST['Email'];
	$type = $_POST['Type'];
	$club = $_POST['Club'];
	$count = 0;
	
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

	$sql = "SELECT `Alert`, `reg_date` FROM `alerts`";
	
	if(($email != "None" or $type != "None" or $club != "None")){
	    $sql .= " WHERE";
	    if ($email != "None"){
	        $sql .= " Email = '$email'";
	    }
	    if ($email != "None" and ($type != "None" or $club != "None")){
	        $sql .= " AND";
	    }
	    if ($type != "None"){
	        $sql .= " Type = '$type'";
	    }
	    if ($type != "None" and $club != "None"){
	        $sql .= " AND";
	    }
	    if ($club != "None"){
	        $sql .= " Club = '$club'";
	    }
	}
	
	$sql .= " ORDER BY `ID` DESC";
	
	$result = $conn->query($sql);
	if ($result AND $result -> num_rows == 0){
		echo "Empty";
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