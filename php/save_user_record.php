<?php
	require("../properties.php");
	require("encryption.php");
	require("../inc/decrypt_db_creds.php");

	session_start();

	$recordID = $_GET['recordID'];
	$username = $_GET['username_text'];
	$managerID = $_GET['managerID'];
	$teamID = $_GET['teamID'];
	$firstname = $_GET['firstname_text'];
	$lastname = $_GET['lastname_text'];
	#$emailaddress = $_GET['userrecord'];
	$primaryphone = $_GET['primaryphone_text'];
	$alternatephone = $_GET['alternatephone_text'];
	#$locale = $_GET['locale_text'];
	$status = $_GET['contact_status_text'];


	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);

	if ($teamID != '') {
		$sql = "UPDATE CONTACT SET USERNAME = '".$username."', TEAM_ID = '".$teamID."', FIRST_NAME = '".$firstname."', LAST_NAME = '".$lastname."', PRIMARY_PHONE = '".$primaryphone."', ALTERNATE_PHONE = '".$alternatephone."', STATUS = ".$status.", MODIFY_DATE = '".date('y-m-d H:i:s')."' WHERE ID = ".$recordID;
	}
	if ($managerID != '') {
		$sql = "UPDATE CONTACT SET USERNAME = '".$username."', MANAGER_ID = '".$managerID."', FIRST_NAME = '".$firstname."', LAST_NAME = '".$lastname."', PRIMARY_PHONE = '".$primaryphone."', ALTERNATE_PHONE = '".$alternatephone."', STATUS = ".$status.", MODIFY_DATE = '".date('y-m-d H:i:s')."' WHERE ID = ".$recordID;
	}
	if ($teamID != '' && $managerID != '') {
		$sql = "UPDATE CONTACT SET USERNAME = '".$username."', MANAGER_ID = '".$managerID."', TEAM_ID = '".$teamID."', FIRST_NAME = '".$firstname."', LAST_NAME = '".$lastname."', PRIMARY_PHONE = '".$primaryphone."', ALTERNATE_PHONE = '".$alternatephone."', STATUS = ".$status.", MODIFY_DATE = '".date('y-m-d H:i:s')."' WHERE ID = ".$recordID;
	}
	if ($teamID == '' && $managerID == '') {
		$sql = "UPDATE CONTACT SET USERNAME = '".$username."', FIRST_NAME = '".$firstname."', LAST_NAME = '".$lastname."', PRIMARY_PHONE = '".$primaryphone."', ALTERNATE_PHONE = '".$alternatephone."', STATUS = ".$status.", MODIFY_DATE = '".date('y-m-d H:i:s')."' WHERE ID = ".$recordID;
	}

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

	if ($DEBUG_REDIRECT_LINKS) {
				
	} else {
		header("Location: ../users.php?tok=".$_SESSION["sessiontoken"]);
	}
?>