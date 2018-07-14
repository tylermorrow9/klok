<?php 
	#include header here
	require("inc/header.php");
	require("inc/session.php");
	#set properties
	require("properties.php");
	#include encryption device
	require("php/encryption.php");
	require("inc/decrypt_db_creds.php");

	//edits any records that are sent to this page
	$timerecord = $_GET['timerecord'];
	$userrecord = $_GET['userrecord'];
	$teamrecord = $_GET['teamrecord'];

	
?>

<body>
<?php require("html/header.html"); ?>
<?php include("inc/navigation.php"); ?>

<div class="row">
	<div style="width:100%;">
		<div class="card">
			<h2>Edit Record</h2>
				<table style="width:25%;">
				<?php
					if (isset($_GET['timerecord'])) {
						echo "<form action='php/save_time_record.php' method='GET'>";
						// Create connection
						$conn = new mysqli($server, $user, $pass, $db);
						
						#search for records with active users
						$sql = "SELECT CONTACT.FIRST_NAME, CONTACT.LAST_NAME, TIMETRACK.CHECK_DATE, TIMETRACK.CHECK_STATUS FROM TIMETRACK INNER JOIN CONTACT ON CONTACT.ID = TIMETRACK.USER_ID WHERE TIMETRACK.ID = ".$timerecord;
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>Name: </td>";
								echo "<td>".$row['FIRST_NAME']." ".$row['LAST_NAME']."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Current Check Date: </td>";
								$check_date = strtotime($row['CHECK_DATE']);
								$check_date_format = date('m-d-Y h:i A', $check_date);
								echo "<td>".$check_date_format."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>New Check Date: </td>";
								echo "<td><input type='datetime-local' name='newCheckDate'></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Status: </td>";
								if ($row['CHECK_STATUS'] == 1) {
									echo "<td><select name='newCheckStatus'><option value='1' selected>Check Out</option><option value='0'>Check In</option></select></td>";
								} else {
									echo "<td><select name='newCheckStatus'><option value='1'>Check Out</option><option value='0' selected>Check In</option></select></td>";
								}
								echo "<td><input type='hidden' name='recordID' value=".$timerecord."></td>";
								echo "<td><input type='hidden' name='oldCheckDate' value='".$row['CHECK_DATE']."'></td>";
								echo "<td><input type='hidden' name='newerCheckDate' value='".$row['CHECK_DATE']."'></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td><input type='submit' class='button'><button class='button' onClick='window.history.back()'>Cancel</button></td>";
								echo "</tr>";
							}
						} else {
							#echo "0 results";
						}
					} else if (isset($_GET['userrecord'])) {
						echo "<form action='php/save_user_record.php' method='GET'>";
						// Create connection
						$conn = new mysqli($server, $user, $pass, $db);
						
						#search for records with active users
						$sql = "SELECT CONTACT.ID, CONTACT.USERNAME, MANAGER.FIRST_NAME AS MANAGER_FIRST, MANAGER.LAST_NAME AS MANAGER_LAST, TEAM.NAME AS TEAM_NAME, CONTACT.FIRST_NAME, CONTACT.LAST_NAME, CONTACT.EMAIL_ADDRESS, CONTACT.PRIMARY_PHONE, CONTACT.ALTERNATE_PHONE, CONTACT.LOCALE, CONTACT.STATUS FROM CONTACT INNER JOIN TEAM ON CONTACT.TEAM_ID = TEAM.ID INNER JOIN CONTACT AS MANAGER ON MANAGER.ID = CONTACT.MANAGER_ID WHERE CONTACT.ID = ".$userrecord;
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
							while($row = $result->fetch_assoc()) {
								echo "<tr>";
								echo "<td>Username: </td>";
								echo "<td><input type='text' name='username_text' value='".$row['USERNAME']."'></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Password: </td>";
								echo "<td><a href='password.php?tok=".$_SESSION['sessiontoken']."&username=".$row['USERNAME']."&userrecord=".$row['ID']."';>Reset Password</a></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Manager: </td>";
								echo "<td><select name='managerID'>";
								echo "<option value=''>Leave blank for no update</option>";
								// Create connection
								$managerconn = new mysqli($server, $user, $pass, $db);
								#search for records with active users
								$managersql = "SELECT * FROM CONTACT WHERE STATUS != -1 ORDER BY ID ASC";
								$managerresult = $managerconn->query($managersql);
								if ($managerresult->num_rows > 0) {
									while($rows = $managerresult->fetch_assoc()) {
								echo "<option value='".$rows['ID']."'>".$rows['FIRST_NAME']." ".$rows['LAST_NAME']."</option>";
									}
								}
								$managerconn->close();
								echo "</select></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Team: </td>";
								echo "<td><select name='teamID'>";
								echo "<option value=''>Leave blank for no update</option>";
								// Create connection
								$teamconn = new mysqli($server, $user, $pass, $db);
								#search for records with active users
								$teamsql = "SELECT TEAM.ID, TEAM.NAME, TEAMS.NAME AS PARENT_NAME, TEAM.STATUS, TEAM.CREATE_DATE, TEAM.MODIFY_DATE FROM TEAM INNER JOIN TEAM as TEAMS ON TEAM.PARENT_ID = TEAMS.ID WHERE TEAM.STATUS != -1 ORDER BY TEAM.ID ASC";
								$teamresult = $teamconn->query($teamsql);
								if ($teamresult->num_rows > 0) {
									while($rowz = $teamresult->fetch_assoc()) {
								echo "<option value='".$rowz['ID']."'>".$rowz['PARENT_NAME']." > ".$rowz['NAME']."</option>";
									}
								}
								$teamconn->close();
								echo "</select></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>First Name: </td>";
								echo "<td><input type='text' name='firstname_text' value='".$row['FIRST_NAME']."'></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Last Name: </td>";
								echo "<td><input type='text' name='lastname_text' value='".$row['LAST_NAME']."'></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Email Address: </td>";
								echo "<td>".$row['EMAIL_ADDRESS']."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Primary Phone: </td>";
								echo "<td><input type='text' name='primaryphone_text' value='".$row['PRIMARY_PHONE']."'></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Alernate Phone: </td>";
								echo "<td><input type='text' name='alternatephone_text' value='".$row['ALTERNATE_PHONE']."'></td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Locale: </td>";
								echo "<td>".$row['LOCALE']."</td>";
								echo "</tr>";
								echo "<tr>";
								echo "<td>Status: </td>";
								if ($row['STATUS'] == 1) {
									echo "<td><select name='contact_status_text'><option value='1' selected>Enabled</option><option value='0'>Disabled</option></select></td>";
								} else {
									echo "<td><select name='contact_status_text'><option value='1'>Enabled</option><option value='0' selected>Disabled</option></select></td>";
								}
								echo "<td><input type='hidden' name='recordID' value=".$userrecord."></td>";
								echo "<tr>";
								echo "<td><input type='submit' class='button'></td>";
								echo "<td><button class='button' onClick='window.history.back()'>Cancel</button></td>";
								echo "</tr>";
							}
						} else {
							#echo "0 results";
						}
						$conn->close();
					} else if (isset($_GET['teamrecord'])) {
						echo "Team Record ".$teamrecord;
					}
				?>
				</table>
			</form>
		</div>
	</div>
</div>
<?php require("html/footer.html");?>
</body>
</html>