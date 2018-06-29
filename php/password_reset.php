<?php
	$reset_username = $_GET["username"];
	$reset_password = $_GET["password"];
	
	//echo $reset_username." ".$reset_password;
	
	include("../inc/database_connection.php");
	
	$sql = "UPDATE CONTACT SET PASSWORD = '".$reset_password."' WHERE USERNAME = '".$reset_username."'";
	
	//echo $sql;

	if ($conn->query($sql) === TRUE) {
		$msg = "Record updated successfully";
	} else {
		$msg = "Error updating record: ".$conn->error;
	}

	$conn->close();
	
	header("Location: ../login.php?msg=".$msg);
	
	
?>
