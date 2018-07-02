<?php 
	require("inc/header.php");
	require("inc/session.php");
	#set properties
	require("properties.php");
	#include encryption device
	require("php/encryption.php");

	#decrypt all database connection details
	$server = encrypt_decrypt('decrypt', $DB_CONNECTION_SERVER);
	$user = encrypt_decrypt('decrypt', $DB_CONNECTION_USER);
	$pass = encrypt_decrypt('decrypt', $DB_CONNECTION_PASS);
	$db = encrypt_decrypt('decrypt', $DB_CONNECTION_DB);

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);

	$sql = "SELECT * FROM LOGIN INNER JOIN CONTACT ON LOGIN.USER_ID = CONTACT.ID WHERE LOGIN.STATUS = 1 AND LOGOUT_DATE = ''";
	$result = $conn->query($sql);
?>

<body>
<?php include("inc/navigation.php"); ?>

<div class="active-user-div">
	<h1>Active Users</h1>
	<table class="active-user-table">
		<tr>
			<td>User</td>
			<td>Email Address</td>
			<td>Session ID</td>
			<td>IP Address</td>
			<td>Login Date/Time</td>
		</tr>
			<?php
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
			?>
		<tr>
			<td><?php echo $row["FIRST_NAME"]." ".$row["LAST_NAME"]?></td>
			<td><?php echo $row["EMAIL_ADDRESS"]?></td>
			<td><?php echo $row["SESSION_ID"]?></td>
			<td><?php echo $row["IP_ADDRESS"]?></td>
			<td><?php echo $row["LOGIN_DATE"]?></td>
		</tr>
			<?php
					}
				} else {
					echo "0 results";
				}
				$conn->close();
			?>
	</table>
</div>

<link rel="stylesheet" type="text/css" href="css/table.css">

</body>
</html>