<?php 
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
<link rel="stylesheet" type="text/css" href="css/dashboard_style.css">
<?php include("inc/navigation.php"); ?>

<div class="row">
	<div class="leftcolumn">
		<div class="card">
			<h2>Check In/Check Out</h2>			
			<?php
				$check_status = 1;
				$check_date = "";

				// Create connection
				$conn = new mysqli($server, $user, $pass, $db);

				$sql = "SELECT CHECK_DATE, CHECK_STATUS FROM TIMETRACK WHERE USER_ID = '".$_SESSION["user_id"]."' ORDER BY CHECK_DATE ASC";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$check_date = strtotime($row['CHECK_DATE']);
						$check_date_format = date('m-d-Y h:i A', $check_date);
						$check_status = $row["CHECK_STATUS"];
					}
				} else {
					#echo "0 results";
				}
				$conn->close();
				if ($check_date != '') {
			?>
			<h5>Last Check (In/Out): <?php echo $check_date_format; }?></h5>
			<form action="php/submit_time.php" method="POST">
			<?php
				if ($check_status == 0) {
					//checked in status
					echo "<p><input class='button' type='submit' name='check_out' value='Check Out'></p>";
				} else if ($check_status == -1 || $check_status == 1) {
					//checked out status
					echo "<p><input class='button' type='submit' name='check_in' value='Check In'></p>";
				}
			?>
			</form>
		</div>
	</div>
	<div class="rightcolumn">
		<div class="card">
			<h2>Time Record</h2>
			<input type="text" class="filterTableInput" id="myInput" onkeyup="searchInput()" placeholder="Search..">
			<div style="overflow-x:auto;">
				<table id="myTable" style="width: 100%;">
					<tr class="header">
						<th>First Name</th>
						<th>Last Name</th>
						<th>Check Date</th>
						<th>Status</th>
						<th>Approver</th>
						<th>Approval Status</th>
						<th>Approval Date</th>
						<th>Update</th>
					</tr>
					<?php
						// Create connection
						$conn = new mysqli($server, $user, $pass, $db);
						
						#search for records with active users
						#$sql = "SELECT CONTACT.FIRST_NAME, CONTACT.LAST_NAME, TIMETRACK.CHECK_DATE, TIMETRACK.STATUS, (SELECT CONTACT.FIRST_NAME FROM TIMETRACK INNER JOIN CONTACT ON TIMETRACK.APPROVER_ID = CONTACT.ID LIMIT 1) AS APPROVER_FIRST, (SELECT CONTACT.LAST_NAME FROM TIMETRACK INNER JOIN CONTACT ON TIMETRACK.APPROVER_ID = CONTACT.ID LIMIT 1) AS APPROVER_LAST, TIMETRACK.APPROVAL_STATUS, TIMETRACK.MODIFY_DATE FROM TIMETRACK INNER JOIN CONTACT ON TIMETRACK.USER_ID = CONTACT.ID WHERE TIMETRACK.MODIFY_DATE LIKE '".date('Y')."-07%' ORDER BY TIMETRACK.CHECK_DATE ASC";
						$sql = "SELECT TIMETRACK.ID, FIRST_NAME, LAST_NAME, CHECK_DATE, CHECK_STATUS, APPROVER_FIRST, APPROVER_LAST, APPROVAL_DATE, APPROVAL_STATUS FROM TIMETRACK INNER JOIN CONTACT ON TIMETRACK.USER_ID = CONTACT.ID INNER JOIN APPROVAL ON TIMETRACK.ID = APPROVAL.ID";
						$result = $conn->query($sql);
						#echo date('Y')."-07%";

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
					?>
					<tr>
						<td><?php echo $row['FIRST_NAME'] ?></td>
						<td><?php echo $row['LAST_NAME'] ?></td>
						<td><?php 
								$check_date = strtotime($row['CHECK_DATE']);
								$check_date_format = date('m-d-Y h:i A', $check_date);
								echo $check_date_format;
							?></a></td>
						<td><?php 
								$timetrack_status = $row['CHECK_STATUS'];
								if ($timetrack_status == -1) {/*DELETED*/} 
								else if ($timetrack_status == 0) {/*CHECK IN*/ echo "Checked In";}
								else if ($timetrack_status == 1) {/*CHECK OUT*/echo "Checked Out";}
							?></td>
						<td><?php echo $row['APPROVER_FIRST']." ".$row['APPROVER_LAST'] ?></td>
						<td><?php 
								$approval_status = $row['APPROVAL_STATUS'];
								if ($approval_status == 0) {/*NEED APPROVAL*/ echo "Need Approval";} 
								else if ($approval_status == 1) {/*APPROVED*/ echo "Approved";}
								else if ($approval_status == 2) {/*REJECTED*/ echo "Rejected";}
							?></td>
						<td><?php 
								$approve_date = $row['APPROVAL_DATE'];
								if ($approve_date != '0000-00-00 00:00:00') {
									echo $row["APPROVAL_DATE"];
								} else {

								}
							?></td>
						<td>
							<a href="<?php echo 'record_edit.php?tok='.$_SESSION["sessiontoken"].'&timerecord='.$row['ID'];?>"><img class="iconimg" src="img/edit_icon.png"></a>
							<a href="<?php echo 'php/record_delete.php?tok='.$_SESSION["sessiontoken"].'&timerecord='.$row['ID'];?>" onclick="return validateDelete()"><img class="iconimg" src="img/delete_icon.png" id="delete_record"></a>
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
		<?php
			
		?>
	</div>
</div>

<link rel="stylesheet" type="text/css" href="css/table_style.css">
<script type="text/javascript" src="js/filter_table.js"></script>
<script type="text/javascript" src="js/validate_record_delete.js"></script>
<?php require("html/footer.html");?>
</body>
</html>