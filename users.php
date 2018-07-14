<?php
	#include header here
	require("inc/header.php");
	require("inc/session.php");
	#set properties
	require("properties.php");
	#include encryption device
	require("php/encryption.php");
	require("inc/decrypt_db_creds.php");
	
?>

<body>
<?php require("html/header.html"); ?>
<?php include("inc/navigation.php"); ?>

<div class="row">
	<div class="leftcolumn">
		<div class="card">
			<!-- Trigger/Open The Modal -->
			<button class='button' id="myBtn">Create User</button>
			<?php require("inc/create_user_modal.php"); ?>
		</div>
	</div>
	<div class="rightcolumn">
		<div class="card">
			<h2>User Management</h2>
			<input type="text" class="filterTableInput" id="myInput" onkeyup="searchInput()" placeholder="Search..">
			<div style="overflow-x:auto;">
				<table id="myTable" style="width: 100%;">
					<tr class="header">
						<th>Username</th>
						<th>Manager</th>
						<th>Team</th>
						<th>First Name</th>
						<th>Last Name</th>
						<th>Email Address</th>
						<th>Primary Phone</th>
						<th>Alternate Phone</th>
						<th>Locale</th>
						<th>Update</th>
					</tr>
					<?php
						// Create connection
						$conn = new mysqli($server, $user, $pass, $db);
						
						#search for records witd active users
						$sql = "SELECT CONTACT.ID, CONTACT.USERNAME, MANAGER.FIRST_NAME AS MANAGER_FIRST, MANAGER.LAST_NAME AS MANAGER_LAST, TEAM.NAME AS TEAM_NAME, CONTACT.FIRST_NAME, CONTACT.LAST_NAME, CONTACT.EMAIL_ADDRESS, CONTACT.PRIMARY_PHONE, CONTACT.ALTERNATE_PHONE, CONTACT.LOCALE FROM CONTACT INNER JOIN TEAM ON CONTACT.TEAM_ID = TEAM.ID INNER JOIN CONTACT AS MANAGER ON MANAGER.ID = CONTACT.MANAGER_ID WHERE CONTACT.STATUS != -1 ORDER BY CONTACT.ID ASC";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
					?>
					<tr>
						<td><?php echo $row['USERNAME'] ?></td>
						<td><?php echo $row['MANAGER_FIRST']." ".$row['MANAGER_LAST'] ?></td>
						<td><?php echo $row['TEAM_NAME'] ?></td>
						<td><?php echo $row['FIRST_NAME'] ?></td>
						<td><?php echo $row['LAST_NAME'] ?></td>
						<td><a href="mailto:<?php echo $row['EMAIL_ADDRESS'] ?>" target="_top"><?php echo $row['EMAIL_ADDRESS'] ?></a></td>
						<td><?php echo $row['PRIMARY_PHONE'] ?></td>
						<td><?php echo $row['ALTERNATE_PHONE'] ?></td>
						<td><?php echo $row['LOCALE'] ?></td>
						<td>
							<a href="<?php echo 'record_edit.php?tok='.$_SESSION["sessiontoken"].'&userrecord='.$row['ID'];?>"><img class="iconimg" src="img/edit_icon.png"></a>
							<a href="<?php echo 'php/record_delete.php?tok='.$_SESSION["sessiontoken"].'&userrecord='.$row['ID'];?>" onclick="return validateDelete()"><img class="iconimg" src="img/delete_icon.png" id="delete_record"></a>
						</td>
					</tr>
					<?php
							}
						} else {
							#echo "0 results";
						}
					$conn->close();
					?>
				</table>
			</div>
		</div>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="css/table_style.css">
<script type="text/javascript" src="js/filter_table.js"></script>
<link rel="stylesheet" type="text/css" href="css/modal_style.css">
<script type="text/javascript" src="js/modal.js"></script>
<script type="text/javascript" src="js/validate_create_modal.js"></script>
<script type="text/javascript" src="js/validate_record_delete.js"></script>
<?php require("html/footer.html");?>
</body>
</html>