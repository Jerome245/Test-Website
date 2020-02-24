<?php
	
	$club = $_POST['club'];
	$type = $_POST['type'];
	
	$servername = "localhost";
	$username = "id9106402_root";
	$password = "pwdpwd";
	$dbname = "id9106402_clubs";
	
	$conn = new mysqli($servername, $username, $password, $dbname);

	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	} 
	
	if($type == "Create"){
	    $sql = "CREATE TABLE `$club` (
                    ID INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
                    LastName VARCHAR(20) COLLATE latin1_swedish_ci NOT NULL,
                    Name VARCHAR(40) COLLATE latin1_swedish_ci NOT NULL UNIQUE,
                    Section VARCHAR(15) COLLATE latin1_swedish_ci NOT NULL,
                    Mobile VARCHAR(13) COLLATE latin1_swedish_ci NOT NULL,
                    Email VARCHAR(40) COLLATE latin1_swedish_ci NOT NULL UNIQUE,
                    Priority VARCHAR(6) COLLATE latin1_swedish_ci,
                    Status VARCHAR(10) COLLATE latin1_swedish_ci,
                    reg_date timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                    )
                COMMENT='Clubs'";
	
    	if ($conn->query($sql) === FALSE) {
    		echo "Error";
    	}
    	else{
    	    $text = "New Club Created Named ".$club;
        	
            $sql = "INSERT INTO `alerts`(`Alert`, `Email`, `Type`, `Club`) VALUES ('$text','_N/A','ClubCreation','$club')";
            if ($conn->query($sql) === FALSE) {
            	die('Error cound not change data: ' . $conn->connect_error);
            } 
            else{
                $handle = fopen("Clubs.txt", "r");
                $contents = fread($handle, filesize("Clubs.txt"));
                fclose($handle);
                
                $contents = preg_replace('/\bXXX\b/i',$club,$contents);
                
                $myfile = fopen($club.".html", "w") or die("Error cound not change data");
                fwrite($myfile, $contents);
                fclose($myfile);
                echo "Success";
            }
	    } 
	}
	
	if($type == "Delete"){
	    $sql = "DROP TABLE $club";
	
    	if ($conn->query($sql) === FALSE) {
    		echo "Error";
    	}
    	else{
    	    $text = $club." was Deleted";
        	
            $sql = "INSERT INTO `alerts`(`Alert`, `Email`, `Type`, `Club`) VALUES ('$text','_N/A','ClubDeletion','$club')";
            if ($conn->query($sql) === FALSE) {
            	die('Error cound not change data: ' . $conn->connect_error);
            } 
            else{
                unlink($club.".html");
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