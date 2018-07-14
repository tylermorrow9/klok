<?php
	#set properties
	require("../properties.php");
	#include encryption device
	require("encryption.php");
	require("../inc/decrypt_db_creds.php");

	session_start();

	$database_index = 0;

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);

	$sql = "SELECT ID FROM TIMETRACK ORDER BY ID ASC";
	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$database_index = $row["ID"];
			$database_index += 1;
		}
	} else {
		#echo "0 results";
	}
	$conn->close();

	insertTime($server, $user, $pass, $db, $database_index);

	function insertTime($server, $user, $pass, $db, $database_index) {
		$time_status = 0;

		if (isset($_POST['check_in'])) {
	        $time_status = 0;
	    }
	    if (isset($_POST['check_out'])) {
	        $time_status = 1;
	    }

	    // Create connection
		$conn = new mysqli($server, $user, $pass, $db);

		$sql = "INSERT INTO TIMETRACK VALUES (".$database_index.", ".$_SESSION["user_id"].", '".date('y-m-d H:i:s')."', ".$time_status.", '".date('y-m-d H:i:s')."', '".date('y-m-d H:i:s')."');";

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();

		// Create connection
		$conn = new mysqli($server, $user, $pass, $db);

		$sql = "INSERT INTO APPROVAL VALUES (".$database_index.", 0, '', '', '', 0);";

		if ($conn->query($sql) === TRUE) {
		    echo "New record created successfully";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}

		$conn->close();
		header("Location: ../time.php?tok=".$_SESSION['sessiontoken']);
	}
?>