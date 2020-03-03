<?php

		error_reporting(E_ALL);
		ini_set("display_errors", 1);
		require 'vendor/autoload.php';

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
			$servername = "us-cdbr-iron-east-04.cleardb.net";
			$username = "be346908c3321d";
			$password = "47897b06";
			$dbname = "heroku_bc49f21d14a9948";

			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "SELECT * from `applicantlist` where Email='$email' AND Status = '1' " ;
			$result = $conn->query($sql);

			if($result->num_rows > 0){
				echo "It appears that email is already in use.";
			}
			else if($result){
				$sql = "INSERT INTO `applicantlist` (Passkey, Email, Club1, Club2, Status) VALUES ('$passkey', '$email','$club1','$club2','0')";
				$result = $conn->query($sql);
				if ($result === TRUE) {

					$emailsent = new \SendGrid\Mail\Mail();
					$emailsent->setFrom("emailbotsender@gmail.com", "PSHS-CLC Management");
					$emailsent->setSubject("Please Verify your club application");
					$emailsent->addTo($email, "Dear Student");

					$message="<p>Please click on this link to verify your submission <br>";
					$message.="Do note that you cannot change your clubs after you verify but you may still send another submission<br>";
					$message.="http://pshsclcclub.herokuapp.com//Confirmation.php?passkey=".$passkey;
					$message.="<br><br>This is your choice of clubs:";
					$message.="<br>First Choice: ". $club1 . "<br>";
					if($club2 != ""){
						$message.="Second Choice: ". $club2 . "<br>";
					}
					else{
						$message.="Second Choice: None <br>";
					}
					$message .="<br> If you have time may you please assess my website through this survey<br>https://docs.google.com/forms/d/e/1FAIpQLSf1GPoLvYL-NhHWVKuJZCLXp2PvH_4DhkTTy2wSd1udoTwNUQ/viewform?usp=sf_link";
					$emailsent->addContent("text/html", $message."</p>");

					$sendgrid = new \SendGrid('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');
					try {
					    $response = $sendgrid->send($emailsent);
					} catch (Exception $e) {
					    echo 'Caught exception: '. $e->getMessage() ."\n";
					}

					echo "Your submission has been processed and recorded\n\nPlease Check your email for verfication\n\nIf you have time may you please assess my website through the assessment survey";

					/*$subject="Your confirmation link here";

					$header="from: PSHS-CLC Club management";

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
					}*/
				}
				else {
					echo "Error: " . $sql . "<br>" . $conn->error;
				}
			}
			else{
				echo "Nothing Happened";
			}
			$conn->close();
		}

?>
