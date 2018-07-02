<?php
	require("properties.php");

	#start and set session details
	session_start();
	
	if (isset($_SESSION["sessiontoken"])) {
		//set sessiontoken
		#DEBUG echo "session set";
	} else {
		//unset sessiontoken
		#DEBUG echo "session not set";
		header("Location: http://192.168.1.100:8080/klok/login.php");
	}

	if (!isset($_SESSION["sessioncreated"])) {
	    $_SESSION["sessioncreated"] = time();
	    #DEBUG echo "session created";
	} else if (time() - $_SESSION["sessioncreated"] > $SESSION_TIMEOUT_IN_SEC) {
	    #session started more than 30 minutes ago

	    #normally would be "../php/logout_validation.php", but since root level files are using, it is properly used as "php/logout_validation.php"
	    require("php/logout_validation.php");
	    
	    #unset all session variables
		session_unset();
		#destroy current session
		session_destroy();
	} else if (time() - $_SESSION["sessioncreated"] < $SESSION_TIMEOUT_IN_SEC) {
		#session started less than 30 minutes ago
		if (time() - $_SESSION["sessioncreated"] > ($SESSION_TIMEOUT_IN_SEC / 2)) {
			#change session ID for the current session and invalidate old session ID
			session_regenerate_id(true);
			
		}
		$_SESSION["sessioncreated"] = time();
	}
	#DEBUG echo session_id();
	#DEBUG echo "session time ".$_SESSION["CREATED"];
?>
