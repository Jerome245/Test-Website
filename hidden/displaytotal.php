<?php
	$name = $_POST['Name'];
	$section = $_POST['Section'];
	$club1 = $_POST['Club1'];
	$club2 = $_POST['Club2'];
	
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

	$sql = "SELECT `Name`, `Section`,`Mobile`,`Email`,`Club1`,`Club2` FROM `totaldb` WHERE Confirmed = 'TRUE'";
	
    if ($name != "None"){
        $sql .= "AND Name = '$name'";
    }
    if ($section != "None"){
        $sql .= "AND Section = '$section'";
    }
	if ($club1 != "None"){
	    $sql .= "AND Club1 = '$club1'";
	}
	if ($club2 != "None"){
	    $sql .= "AND Club2 = '$club2'";
	}
	
	$sql .= " ORDER BY `reg_date` DESC";
	
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