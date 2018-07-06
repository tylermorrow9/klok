<?php
	#start and set session details
	session_start();
	
	if (isset($_SESSION["sessionid"])) {
		//set sessionid
	} else {
		//unset sessionid
		header("Location: http://192.168.1.100:8080/klok/login.php");
	}
?>
