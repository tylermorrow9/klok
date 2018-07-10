<?php 
	session_start();
	
	#include header here
	require("inc/header.php");
	require("inc/session.php");
	#set properties
	require("properties.php");
	#include encryption device
	require("php/encryption.php");
	require("inc/decrypt_db_creds.php");

	// Create connection
	$conn = new mysqli($server, $user, $pass, $db);
	
	#search for records with active users
	$sql = "SELECT * FROM CONTACT WHERE STATUS = 1 ORDER BY ID ASC";
	$result = $conn->query($sql);
	
	
?>

<body>
<?php include("inc/navigation.php"); ?>
<br />
<table>
	<tr>
		<th>Username</th>
		<th>Manager</th>
		<th>Team</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email Address</th>
		<th>Primary Phone</th>
		<th>Alternate Phone</th>
		<th>Locale</th>
		<th>Create Date</th>
		<th>Update</th>
	</tr>
	<?php
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
	?>
	<tr>
		<td><?php echo $row['USERNAME'] ?></td>
		<td><?php echo $row['MANAGER_ID'] ?></td>
		<td><?php echo $row['TEAM_ID'] ?></td>
		<td><?php echo $row['FIRST_NAME'] ?></td>
		<td><?php echo $row['LAST_NAME'] ?></td>
		<td><a href="mailto:<?php echo $row['EMAIL_ADDRESS'] ?>" target="_top"><?php echo $row['EMAIL_ADDRESS'] ?></a></td>
		<td><?php echo $row['PRIMARY_PHONE'] ?></td>
		<td><?php echo $row['ALTERNATE_PHONE'] ?></td>
		<td><?php echo $row['LOCALE'] ?></td>
		<td><?php echo $row['CREATE_DATE'] ?></td>
		<td><a href="#"><img src="img/edit_icon.png"></a><a href="#"><img src="img/delete_icon.png"></a></td>
	</tr>
	<?php
			}
		} else {
			echo "0 results";
		}
	$conn->close();
	?>
</table>

<link rel="stylesheet" type="text/css" href="css/table_styles.css">
<link rel="stylesheet" type="text/css" href="css/image_styles.css">

</body>
</html>