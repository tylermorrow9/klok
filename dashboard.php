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

?>

<body>
<?php include("inc/navigation.php"); ?>
<div style="border: solid;">
	<div style="border: solid;">
		<h2 class="open_tasks">My Open Tasks</h2>
		<div>
			<button id="rcorners">
				Time Track Module<br/>
				[<?php echo 100;?>] Approvals Required
			</button>
			<button id="rcorners">
				Scheduling Module<br/>
				[<?php echo 200;?>] Schedule Approvals Required
			</button>
			<button id="rcorners">
				Payroll Module<br/>
				[<?php echo 10;?>] PTO Day Approvals Required
			</button>
		</div>
	</div>
	<div style="border: solid;">
		<h2 class="open_tasks">Message Board</h2>
		<hr>
		<div class="xscroll">
			<?php
				// Create connection
				$conn = new mysqli($server, $user, $pass, $db);
				for ($x = 1; $x < 4;$x++) {
					$sql = "SELECT * FROM MESSAGE WHERE TYPE = ".$x." AND STATUS = 1 AND EFFECTIVE_DATE < '".date('y-m-d H:i:s')."' AND EXPIRATION_DATE > '".date('y-m-d H:i:s')."' ORDER BY PRIORITY ASC";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							echo "<hr>";
							echo "<label>";
							echo "<img src='img/".$row["ICON"]."' width='50' height='50'><br/>";
							echo $row["TITLE"]."<br />";
							echo $row["MESSAGE"];
							echo "</label>";
						}
					} else {
						#echo date('y-m-d H:i:s');
					}
				}
				$conn->close();
			?>
		</div>
	</div>
</div>
<link rel="stylesheet" type="text/css" href="css/dashboard.css">
</body>
</html>