<?php
	require("../properties.php");
	require("encryption.php");
	require("../inc/decrypt_db_creds.php");

	session_start();

	$reset_id = $_GET["userid"];
	$reset_username = $_GET["username"];
	$reset_password = $_GET["password"];
	
	echo $reset_username."<br />".$reset_password."<br />".$reset_id;

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);
	
	$sql = "UPDATE CONTACT SET PASSWORD = '".$reset_password."' WHERE ID = '".$reset_id."'";
	
	//echo $sql;

	if ($conn->query($sql) === TRUE) {
		echo "Record updated successfully";
	} else {
		echo "Error updating record: ".$conn->error;
	}

	$conn->close();
	
	header("Location: ../record_edit.php?tok=".$_SESSION["sessiontoken"]."&userrecord=".$reset_id);
	
	
?>
