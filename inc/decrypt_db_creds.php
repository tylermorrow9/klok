<?php
	#include encryption device
	require("../php/encryption.php");
	
	#decrypt all database connection details
	$server = encrypt_decrypt('decrypt', $DB_CONNECTION_SERVER);
	$user = encrypt_decrypt('decrypt', $DB_CONNECTION_USER);
	$pass = encrypt_decrypt('decrypt', $DB_CONNECTION_PASS);
	$db = encrypt_decrypt('decrypt', $DB_CONNECTION_DB);
?>