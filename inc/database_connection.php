<?php
	#set properties
	require("../properties.php");

	// Create connection
	$conn = new mysqli($DB_CONNECTION_SERVER, $DB_CONNECTION_USER, $DB_CONNECTION_PASS, $DB_CONNECTION_DB);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>
