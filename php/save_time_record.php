<?php
	require("../properties.php");
	require("encryption.php");
	require("../inc/decrypt_db_creds.php");

	session_start();

	$recordID = $_GET['recordID'];

	#$oldCheckDate = $_GET['oldCheckDate'];
	$oldtime = strtotime($_GET['oldCheckDate']);
	$oldCheckFormat = date('Y-m-d H:i:s', $oldtime);
	echo $oldCheckFormat."<br/>";

	$newtime = strtotime($_GET['newCheckDate']);
	$newCheckFormat = date('Y-m-d H:i:s', $newtime);
	echo $newCheckFormat."<br/>";

	$newCheckStatus = $_GET['newCheckStatus'];

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);

	if ($_GET['newCheckDate'] == '') {
		//if new check date field blank, do not update it
		$sql = "UPDATE TIMETRACK SET CHECK_STATUS = ".$newCheckStatus.", MODIFY_DATE = '".date('y-m-d H:i:s')."' WHERE ID = ".$recordID;
	} else {
		$sql = "UPDATE TIMETRACK SET CHECK_DATE = '".$newCheckFormat."', CHECK_STATUS = ".$newCheckStatus.", MODIFY_DATE = '".date('y-m-d H:i:s')."' WHERE ID = ".$recordID;
	}

	

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

	header("Location: ../time.php?tok=".$_SESSION["sessiontoken"]);
?>