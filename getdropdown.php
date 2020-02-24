<?php
	$data = [];
	$row = "";
	$str_data = "";
	$output = "";

	$servername = "localhost";
	$username = "root";
	$password = "pwdpwd";
	$dbname = "test";
	
	//error_log(implode(",",$input));

	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		error_log("Connection failed: " . $conn->connect_error);
	} 
	$sql = "SELECT DISTINCT `Name` FROM `clublist` ORDER BY `Name` ASC";

	$result = $conn->query($sql);
	if ($result AND $result -> num_rows == 0){
		error_log('Could not get data: ' . $conn->connect_error . __LINE__);
	}
	else if ($result AND $result->num_rows > 0){
		while($row = mysqli_fetch_array ($result,MYSQLI_NUM)) {
			$data[] = $row[0];
		}
		$str_data = implode("</option><option>",$data);
		echo json_encode("<option>".$str_data."</option>", JSON_UNESCAPED_SLASHES );
	}
	else{
		 error_log('Could not get data: ' . $conn->connect_error . __LINE__);
	}
	
	//echo json_encode($output, JSON_UNESCAPED_SLASHES );
	//error_log(implode(" ",$output) . __LINE__);
	$conn->close();
?>