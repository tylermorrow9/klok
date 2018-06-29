<?php
	$servername = "localhost";
	$username = "devapplin1";
	$password = "OOX6PjkAxiVnExWw";
	$dbname = "development_lin1";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>
