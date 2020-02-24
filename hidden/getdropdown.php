<?php
	
	$entree = $_POST['entree'];
	$club = $_POST['club'];
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
    if($entree == "Email" or $entree == "Type" or $entree == "Club"){
	    $sql = "SELECT DISTINCT `$entree` FROM `alerts` ORDER BY `$entree` ASC";
    }
    else{
        $sql = "SELECT DISTINCT `$entree` FROM `totaldb` WHERE Confirmed = 'TRUE' ORDER BY `$entree` ASC";
    }
	if (!(empty($club))){
	    $sql = "SELECT DISTINCT `$entree` FROM `alerts` WHERE Club = '$club' ORDER BY `$entree` ASC";
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
		 die('Could not get data: ' . $conn->connect_error);
	}
	$conn->close();
?>