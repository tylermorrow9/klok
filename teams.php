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
			<button class='button' id="myBtn">Create Team</button>
			<?php require("inc/create_team_modal.php"); ?>
		</div>
	</div>
	<div class="rightcolumn">
		<div class="card">
			<h2>Team Management</h2>
			<input type="text" class="filterTableInput" id="myInput" onkeyup="searchInput()" placeholder="Search..">
			<div style="overflow-x:auto;">
				<table id="myTable" style="width: 100%;">
					<tr class="header">
						<th>Team Name</th>
						<th>Team Parent</th>
						<th>Status</th>
						<th>Update</th>
					</tr>
					<?php
						// Create connection
						$conn = new mysqli($server, $user, $pass, $db);
						
						#search for records with active users
						$sql = "SELECT TEAM.ID, TEAM.NAME, TEAMS.NAME AS PARENT_NAME, TEAM.STATUS, TEAM.CREATE_DATE, TEAM.MODIFY_DATE FROM TEAM INNER JOIN TEAM as TEAMS ON TEAM.PARENT_ID = TEAMS.ID WHERE TEAM.STATUS != -1 ORDER BY TEAM.ID ASC;";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
					?>
					<tr>
						<td><?php echo $row['NAME'] ?></td>
						<td><?php if ($row['NAME'] != $row['PARENT_NAME']) { echo $row['PARENT_NAME']; } ?></td>
						<td><?php if ($row['STATUS'] == 0) { echo "Disabled"; } else { echo "Enabled"; } ?></td>
						<td>
							<a href="<?php echo 'record_edit.php?tok='.$_SESSION["sessiontoken"].'&teamrecord='.$row['ID'];?>"><img class="iconimg" src="img/edit_icon.png"></a>
							<a href="<?php echo 'php/record_delete.php?tok='.$_SESSION["sessiontoken"].'&teamrecord='.$row['ID'];?>" onclick="return validateDelete()"><img class="iconimg" src="img/delete_icon.png" id="delete_record"></a>
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