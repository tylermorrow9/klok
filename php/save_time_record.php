<?php
	require("../properties.php");
	require("encryption.php");
	require("../inc/decrypt_db_creds.php");

	session_start();

	$recordID = $_GET['recordID'];

	$inDate = $_GET['newCheckInDate'];
	$inTime = $_GET['newCheckInTime'];
	$in_format = $inDate." ".$inTime;

	$outDate = $_GET['newCheckOutDate'];
	$outtime = $_GET['newCheckOutTime'];
	$out_format = $outDate." ".$outtime;

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);
	
	$sql = "UPDATE TIMETRACK SET CHECK_IN_DATE = '".$in_format."', CHECK_OUT_DATE = '".$out_format."', MODIFY_DATE = '".date('Y-m-d H:i:s')."' WHERE ID = ".$recordID;

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

	if ($DEBUG_REDIRECT_LINKS) {
				
	} else {
		header("Location: ../time.php?tok=".$_SESSION["sessiontoken"]);
	}
?>