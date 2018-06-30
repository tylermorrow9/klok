<?php
	#set properties
	require("../properties.php");
	
	#include encryption device
	require("../php/encryption.php");
	
	#decrypt all database connection details
	$server = encrypt_decrypt('decrypt', $DB_CONNECTION_SERVER);
	$user = encrypt_decrypt('decrypt', $DB_CONNECTION_USER);
	$pass = encrypt_decrypt('decrypt', $DB_CONNECTION_PASS);
	$db = encrypt_decrypt('decrypt', $DB_CONNECTION_DB);

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
?>
