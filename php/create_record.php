<?php
#set properties
require("../properties.php");
#include encryption device
require("encryption.php");
require("../inc/decrypt_db_creds.php");

session_start();

if (isset($_POST['create_user'])) {
	$database_index = generateID($server, $user, $pass, $db, "CONTACT");
    insertUser($server, $user, $pass, $db, $database_index);
}
if (isset($_POST['create_team'])) {
	$database_index = generateID($server, $user, $pass, $db, "TEAM");
    insertTeam($server, $user, $pass, $db, $database_index);
}

function generateID($server, $user, $pass, $db, $table) {
	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);

	$sql = "SELECT ID FROM ".$table." ORDER BY ID ASC";
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

	return $database_index;
}

//used to create user record
function insertUser($server, $user, $pass, $db, $database_index) {
	$username = $_POST['username'];
	$managerID = $_POST['managerID'];
	$teamID = $_POST['teamID'];
	$firstName = $_POST['firstName'];
	$lastName = $_POST['lastName'];
	$emailAddress = $_POST['emailAddress'];
	$primaryPhone = $_POST['primaryPhone'];
	$alternatePhone = $_POST['alternatePhone'];
	$locale = $_POST['locale'];
	$statusID = $_POST['statusID'];

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);

	$sql = "INSERT INTO CONTACT VALUES (".$database_index.", '".$username."', '', '".$emailAddress."', '".$primaryPhone."', '".$alternatePhone."', '".$firstName."', '".$lastName."', '".$statusID."', '".date('y-m-d H:i:s')."', '".date('y-m-d H:i:s')."', '".$managerID."', '".$teamID."', '".$locale."')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();
	
	header("Location: ../users.php?tok=".$_SESSION['sessiontoken']);
}

//used to create team record
function insertTeam($server, $user, $pass, $db, $database_index) {
	$teamName = $_POST['teamName'];
	$parentID = $_POST['parentID'];
	$statusID = $_POST['statusID'];

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);

	$sql = "INSERT INTO TEAM VALUES (".$database_index.", '".$teamName."', '".$parentID."', '".$statusID."', '".date('y-m-d H:i:s')."', '".date('y-m-d H:i:s')."')";

	if ($conn->query($sql) === TRUE) {
	    echo "New record created successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . $conn->error;
	}

	$conn->close();

	header("Location: ../teams.php?tok=".$_SESSION['sessiontoken']);
}
?>