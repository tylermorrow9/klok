<?php
	session_start();

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);

	$sql = "SELECT ID FROM LOGIN ORDER BY ID ASC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$database_loginid = $row["ID"];
			$database_loginid += 1;
		}
	} else {
		echo "0 results";
	}
	$conn->close();

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);

	$sql = "UPDATE LOGIN SET LOGOUT_DATE = '".date('y-m-d H:i:s')."' WHERE SESSION_ID = '".session_id()."'";

	if ($conn->query($sql) === TRUE) {
	    #echo "New record created successfully";
	} else {
	    #echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
?>