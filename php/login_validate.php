<?php
	require("../properties.php");
	require("encryption.php");
	require("../inc/decrypt_db_creds.php");

	session_start();
	
	#set sessiontoken if not set
	if (isset($_SESSION["sessiontoken"])) {
		
	} else {
		$_SESSION["sessiontoken"] = generateRandomString();
		session_regenerate_id(true);		
	}

	$login_username = $_GET["username"];
	$login_password = $_GET["password"];

	//SANITIZE LOGIN STRING to remove HTML tags in response
	$login_username = filter_var($login_username, FILTER_SANITIZE_STRING);

	#if user inputs more than the allotted amount of characters in the username textbox, the string will be shortened
	if ($login_username > $USERNAME_LOGIN_CHAR_LIMIT) {
		$login_username = substr($login_username, 0, $USERNAME_LOGIN_CHAR_LIMIT);
	}

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);

	$sql = "SELECT ID FROM LOGIN ORDER BY ID ASC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$database_loginid = $row["ID"];
			$database_loginid += 1;
		}
	} else {
		echo "0 results";
	}
	$conn->close();

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);

	$sql = "SELECT ID, USERNAME, PASSWORD FROM CONTACT WHERE USERNAME = '".$login_username."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$_SESSION["user_id"] = $row["ID"];
			$database_userid = $row["ID"];
			$database_username = $row["USERNAME"];
			$database_password = $row["PASSWORD"];
		}
	} else {
		echo "0 results";
	}
	$conn->close();
	
	//ONLY LOGIN IF COMPANY HAS AN ACTIVE SYSTEM
	if ($SYSTEM_ACTIVE) {
		#validate user login
		if ($login_username === $database_username) {
			if ($login_password === $database_password) {
				//Login successful

				// Create connection
				$conn = new mysqli($server, $user, $pass, $db);

				$sql = "INSERT INTO LOGIN VALUES ('".$database_loginid."', '".$database_userid."', 1, '".session_id()."', '".$_SESSION["sessiontoken"]."', '".getRealIpAddr()."', '".date('y-m-d H:i:s')."', '')";

				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully";
				} else {
				    #echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();
				
				$msg = "Login Success";
				//redirect URL forward in URL
				header("Location: ../dashboard.php?tok=".$_SESSION["sessiontoken"]);
			} else {
				//Do not login and return error

				// Create connection
				$conn = new mysqli($server, $user, $pass, $db);

				$sql = "INSERT INTO LOGIN VALUES ('".$database_loginid."', '".$database_userid."', 0, '".session_id()."', '".$_SESSION["sessiontoken"]."', '".getRealIpAddr()."', '".date('y-m-d H:i:s')."', '".date('y-m-d H:i:s')."')";

				if ($conn->query($sql) === TRUE) {
				    echo "New record created successfully";
				} else {
				    #echo "Error: " . $sql . "<br>" . $conn->error;
				}

				$conn->close();

				$msg = "Username or Password does not match";
				//redirect URL back to index page with error in URL
				header("Location: ../login.php?msg=".$msg);
			}
		} else {
			//Do not login and return error
			$msg = "Username or Password does not match";
			//redirect URL back to index page with error in URL
			header("Location: ../login.php?msg=".$msg);
		}
	} else {
		header("Location: ../inactive_system.php");
	}
	
	#used to generate the token
	function generateRandomString($length = 200) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	#get the remote or local ip address of the logging in user
	function getRealIpAddr() {
	    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
	    {
	      $ip=$_SERVER['HTTP_CLIENT_IP'];
	    }
	    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
	    {
	      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
	    }
	    else
	    {
	      $ip=$_SERVER['REMOTE_ADDR'];
	    }
	    return $ip;
	}
?>
