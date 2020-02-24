<?php

		function testInput($data) {
			$data = trim($data);
			$data = stripslashes($data);
			$data = htmlspecialchars($data);

			return $data;
		}

		$club1 = testInput($_REQUEST["club1"]);
		$club2 = testInput($_REQUEST["club2"]);
		$email = testInput($_REQUEST["email"]);

		$passkey=md5(uniqid(rand()));
		$error;

		if ($club1 == $club2){
			$club2 = "";
		}

		//error_log(substr($email, -16));

		if (empty($email)) {
			echo "Error: Email is empty \n\nPlease resubmit";
		}
		else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			echo "Invalid email \n\nPlease resubmit";
		}
		else if (!(preg_match("/^[-a-zA-Z]*$/",substr($email, 0, -16)) AND strcmp(substr($email, -16) , "@clc.pshs.edu.ph") == 0)) {
			echo "Invalid email format \n\nPlease resubmit";
		}
		else{
			$servername = "localhost";
			$username = "root";
			$password = "pwdpwd";
			$dbname = "test";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * from `applicantlist` where Email='$email' AND Status = '1' " ;
			$result = $conn->query($sql);

			if($result->num_rows > 0){
				echo "It appears the class number is already in use.";
			}
			else if($result){
				$sql = "INSERT INTO `applicantlist` (Passkey, Email, Club1, Club2, Status) VALUES ('$passkey', '$email','$club1','$club2','0')";
				$result = $conn->query($sql);
				echo $sql;
				/*if ($conn->query($sql1) === TRUE) {

					$subject="Your confirmation link here";

					$header="from: PSHS-CLC Club management";

					$message="Your Confirmation link: \r\n";
					$message.="Click on this link to verify your submission \r\n";
					$message.="https://pshsclcclub.000webhostapp.com/Confirmation?passkey=$passkey";
					$message.="\n\nYour Submission";
					$message.="\nFirst Choice: $club1";
					if($club2 != ""){
						$message.="\nSecond Choice: $club2";
					}

					$sentmail = mail($email,$subject,$message,$header);

					if ($sentmail){
						echo "Your Confirmation link Has Been Sent To $email";

						$text = $email." has applied for ".$club1 ;
						$sql = "INSERT INTO `alerts`(`Alert`, `Type`, `Email`, `Club`) VALUES ('$text','Application','$email','$club1')";
						$conn->query($sql);

						if ($club2 != ""){
							$text = $email." has applied for ".$club2 ;
							$sql = "INSERT INTO `alerts`(`Alert`, `Type`, `Email`, `Club`) VALUES ('$text','Application','$email','$club2')";
							$conn->query($sql);
						}
					}
					else{
						$sql1 = "DELETE FROM totaldb WHERE Passkey = '$passkey' ";
						$conn->query($sql1);
						echo "Cannot send Confirmation link to your e-mail address or e-mail address is Invalid";
					}
				}
				else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}*/
			}
			else{
				echo "Nothing Happened";
			}
			$conn->close();
		}

?>
