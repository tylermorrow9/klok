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
				$check_in_format = "";
				$check_out_format = "";

				// Create connection
				$conn = new mysqli($server, $user, $pass, $db);

				$sql = "SELECT STATUS, CHECK_IN_DATE, CHECK_OUT_DATE FROM TIMETRACK WHERE USER_ID = '".$_SESSION["user_id"]."' ORDER BY CHECK_IN_DATE DESC LIMIT 1";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$check_in_date = strtotime($row['CHECK_IN_DATE']);
						$check_in_format = date('m-d-Y h:i A', $check_in_date);

						$check_out_date = strtotime($row['CHECK_OUT_DATE']);
						$check_out_format = date('m-d-Y h:i A', $check_out_date);
					}
				} else {
					#echo "0 results";
				}
				$conn->close();
			?>
			<h5>Last Check In: <?php echo $check_in_format; ?></h5>
			<h5>Last Check Out: <?php echo $check_out_format; ?></h5>
			<form action="php/submit_time.php" method="POST">
			<?php
				if ($check_out_format == '12-31-1969 07:00 PM' || $check_out_format == '0000-00-00 00:00:00' || $check_out_format = '') {
					//checked in status
					echo "<p><input class='button' type='submit' name='check_out' value='Check Out'></p>";
				} else {
					//checked out status
					echo "<p><input class='button' type='submit' name='check_in' value='Check In'></p>";
				}
			?>
			</form>
		</div>
		<div class="card">
			<h2>New Time Record</h2>			
			<button class='button' id="myBtn">Create Time Record</button>
			<?php require("inc/create_time_modal.php"); ?>
		</div>
	</div>
	<div class="rightcolumn">
		<div class="card">
			<h2>Time Record</h2>
			<input type="text" class="filterTableInput" id="myInput" onkeyup="searchInput()" placeholder="Search..">
			<div style="overflow-x:auto;">
				<table id="myTable" style="width: 100%;">
					<tr class="header">
						<th>Name</th>
						<th>Check IN Date</th>
						<th>Check OUT Date</th>
						<th>Approver</th>
						<th>Approval Status</th>
						<th>Approval Date</th>
						<th>Update</th>
					</tr>
					<?php
						// Create connection
						$conn = new mysqli($server, $user, $pass, $db);
						
						#search for records with active users
						$sql = "SELECT TIMETRACK.ID, FIRST_NAME, LAST_NAME, CHECK_IN_DATE, CHECK_OUT_DATE, TIMETRACK.STATUS, APPROVER_FIRST, APPROVER_LAST, APPROVAL_DATE, APPROVAL_STATUS FROM TIMETRACK INNER JOIN CONTACT ON TIMETRACK.USER_ID = CONTACT.ID INNER JOIN APPROVAL ON TIMETRACK.ID = APPROVAL.ID";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
					?>
					<tr>
						<td><?php echo $row['FIRST_NAME']." ".$row['LAST_NAME'] ?></td>
						<td><?php 
								$check_date = strtotime($row['CHECK_IN_DATE']);
								$check_date_format = date('m-d-Y h:i A', $check_date);
								echo $check_date_format;
							?></a></td>
						<td><?php 
								$check_date = strtotime($row['CHECK_OUT_DATE']);
								$check_date_format = date('m-d-Y h:i A', $check_date);
								echo $check_date_format;
							?></a></td>
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
<link rel="stylesheet" type="text/css" href="css/modal_style.css">
<script type="text/javascript" src="js/modal.js"></script>
<script type="text/javascript" src="js/validate_create_modal.js"></script>
<script type="text/javascript" src="js/validate_record_delete.js"></script>
<?php require("html/footer.html");?>
</body>
</html>