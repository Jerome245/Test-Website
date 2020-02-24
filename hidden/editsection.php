<?php
	
	$array = $_POST['array'];
	$section = $_POST['section'];
	$rows = $_POST['rows'];
	$type = $_POST['type'];
	$lastname = "";
	$echothis = "";
	
	$servername = "localhost";
	$username = "id9106402_sections";
	$password = "pwdpwd";
	$dbname = "id9106402_sections";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	if($type == "Create"){
	    $sql = "CREATE TABLE `$section` (
                    `Class No.` TINYINT UNSIGNED NOT NULL PRIMARY KEY,
                    `Last Name` VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL,
                    Name VARCHAR(40) COLLATE latin1_swedish_ci NOT NULL UNIQUE,
                    `Mobile No.` VARCHAR(13) COLLATE latin1_swedish_ci NOT NULL,
                    Email VARCHAR(40) COLLATE latin1_swedish_ci NOT NULL UNIQUE
                    )";
	
    	if ($conn->query($sql) === FALSE) {
    		echo "Error";
    	}
    	else{
    	    for ($x = 0; $x <= 30; $x++) {
    	        $lastname = substr($array[$x * 3], 0, strpos($array[$x * 3], ','));
    	        
    	        $sql = "INSERT INTO `$section`(`Class No.`, `Last Name`, `Name`, `Mobile No.`, `Email`) VALUES ('$x','$lastname','$array[($x * 3)]','$array[($x * 3) + 1]', '$array[($x * 3) + 2]')";
                if ($conn->query($sql) === FALSE) {
            	    die('Error cound not change data: ' . $conn->connect_error);
                } 
                $echothis = $echothis." ".$lastname;
            } 
    	    
    	    echo $echothis;
    	    
    	    $conn->close();
    	    
    	    $servername = "localhost";
        	$username = "id9106402_root";
        	$password = "pwdpwd";
        	$dbname = "id9106402_clubs";
        	
        	$conn = new mysqli($servername, $username, $password, $dbname);
    	    
    	    $text = "New Section Created Named ".$club;
        	
            $sql = "INSERT INTO `alerts`(`Alert`, `Email`, `Type`, `Club`) VALUES ('$text','_N/A','ClubCreation','$club')";
            if ($conn->query($sql) === FALSE) {
            	die('Error cound not change data: ' . $conn->connect_error);
            } 
            /*else{
                echo "Success";
            }*/
	    } 
	}
	
	if($type == "Delete"){
	    $sql = "DROP TABLE $section";
	
    	if ($conn->query($sql) === FALSE) {
    		echo "Error";
    	}
    	else{
    	    $conn->close();
    	    
    	    $servername = "localhost";
        	$username = "id9106402_root";
        	$password = "pwdpwd";
        	$dbname = "id9106402_clubs";
        	
        	$conn = new mysqli($servername, $username, $password, $dbname);
    	    
    	    $text = $section." was Deleted";
        	
            $sql = "INSERT INTO `alerts`(`Alert`, `Email`, `Type`, `Club`) VALUES ('$text','_N/A','SectionDeletion','$section')";
            if ($conn->query($sql) === FALSE) {
            	die('Error cound not change data: ' . $conn->connect_error);
            } 
            else{
                echo "Success";
            }
	    } 
	}
	
	if($type == "Empty"){
	    $sql = "TRUNCATE TABLE `$club`";
	
    	if ($conn->query($sql) === FALSE) {
    		echo "Error";
    	}
    	else{
    	    $text = $club." was Emptied";
        	
            $sql = "INSERT INTO `alerts`(`Alert`, `Email`, `Type`, `Club`) VALUES ('$text','_N/A','ClubEmpty','$club')";
            if ($conn->query($sql) === FALSE) {
            	die('Error cound not change data: ' . $conn->connect_error);
            } 
            else{
                echo "Success";
            }
	    } 
	}
	
	$conn->close();
?>