<?php
	$input = $_REQUEST['input'];
	$data = [];
	$row = "";
	$str_data = "";
	$output = [];

	$servername = "localhost";
	$username = "root";
	$password = "pwdpwd";
	$dbname = "db_club";
	
	//error_log(implode(",",$input));

	$conn = new mysqli($servername, $username, $password, $dbname);
	
	if ($conn->connect_error) {
		error_log("Connection failed: " . $conn->connect_error);
	} 
	foreach ($input as $entree){
		if($entree == "clublist_Name" or $entree == "app_1st" or $entree == "app_2nd"){
			$sql = "SELECT DISTINCT `Name` FROM `clublist` ORDER BY `Name` ASC";
		}
		if($entree == "Batch"){
			$sql = "SELECT DISTINCT `Batch` FROM `applicantlist` ORDER BY `Batch` ASC";
		}
		if($entree == "app_Name"){
			$sql = "SELECT DISTINCT `Batch_ID` FROM `applicantlist` ORDER BY `Batch_ID` ASC";
		}
		$result = $conn->query($sql);
		if ($result AND $result -> num_rows == 0){
			error_log('Could not get data: ' . $conn->connect_error . __LINE__);
		}
		else if ($result AND $result->num_rows > 0){
			while($row = mysqli_fetch_array ($result,MYSQLI_NUM)) {
				$data[] = $row[0];
			}
			$str_data = implode("</option><option>",$data);
			array_push($output,array ($entree, "<option>".$str_data."</option>"));
			$data = [];
		}
		else{
			 error_log('Could not get data: ' . $conn->connect_error . __LINE__);
		}
	}
	echo json_encode($output, JSON_UNESCAPED_SLASHES );
	$conn->close();
?>