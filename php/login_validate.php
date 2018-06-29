<?php
	session_start();
	
	if (isset($_SESSION["sessionid"])) {
		//$sessionid = $_SESSION["sessionid"];
		echo "set";
	} else {
		$_SESSION["sessionid"] = generateRandomString();
		echo "not set";
	}
	
	function generateRandomString($length = 200) {
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}

	$login_username = $_GET["username"];
	$login_password = $_GET["password"];
	$database_username = "";
	$database_password = "";
	
	include("../inc/database_connection.php");

	$sql = "SELECT USERNAME, PASSWORD FROM CONTACT WHERE USERNAME = '".$login_username."'";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$database_username = $row["USERNAME"];
			$database_password = $row["PASSWORD"];
		}
	} else {
		echo "0 results";
	}
	$conn->close();
	
	#validate user login
	if ($login_username === $database_username) {
		if ($login_password === $database_password) {
			//Login successful
			
			$msg = "Login Success";
			//redirect URL forward in URL
			header("Location: ../dashboard.php?tok=".$_SESSION["sessionid"]);
		} else {
			//Do not login and return error
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
	
	
?>
