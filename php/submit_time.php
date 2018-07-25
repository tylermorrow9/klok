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
		// Create connection
		$conn = new mysqli($server, $user, $pass, $db);

		if (isset($_POST['check_in'])) {
	        $sql = "INSERT INTO TIMETRACK VALUES (".$database_index.", ".$_SESSION["user_id"].", '".date('y-m-d H:i:s')."', '', 1, '".date('y-m-d H:i:s')."', '".date('y-m-d H:i:s')."');";

	        if ($conn->query($sql) === TRUE) {
			    echo "Time created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();

			// Create connection
			$conn = new mysqli($server, $user, $pass, $db);

			$sql = "INSERT INTO APPROVAL VALUES (".$database_index.", 0, '', '', '', 0);";

			if ($conn->query($sql) === TRUE) {
			    echo "Approval created successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();
	    }
	    if (isset($_POST['check_out'])) {
	        $sql = "UPDATE TIMETRACK SET CHECK_OUT_DATE = '".date('y-m-d H:i:s')."' WHERE USER_ID = ".$_SESSION["user_id"]." AND CHECK_OUT_DATE = ''";

	        if ($conn->query($sql) === TRUE) {
			    echo "Time updated successfully";
			} else {
			    echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();
	    }

		if ($DEBUG_REDIRECT_LINKS) {
			
		} else {
			header("Location: ../time.php?tok=".$_SESSION['sessiontoken']);
		}
	}
?>