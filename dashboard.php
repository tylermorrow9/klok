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
			<h2>My Open Tasks:</h2>
			<?php
				$category_id = "";
				$category_name = "";

				// Create connection
				$conn = new mysqli($server, $user, $pass, $db);
				
				$sql = "SELECT CATEGORY_ID FROM SCHEDULE ORDER BY CATEGORY_ID ASC";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						$category_id = $row["CATEGORY_ID"];
					}
				} else {
					#echo date('y-m-d H:i:s');
				}

				$conn->close();

				// Create connection
				$conn = new mysqli($server, $user, $pass, $db);
				
				for ($x = 1; $x <= $category_id; $x++) {
					$sql = "SELECT COUNT(*) AS COUNT, CATEGORY_NAME FROM SCHEDULE WHERE CATEGORY_ID = ".$x." AND APPROVAL_STATUS = 0";
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// output data of each row
						while($row = $result->fetch_assoc()) {
							if ($row["COUNT"] > 0) {
								echo "<a href='schedule.php'><button id='rcorners'>";
								echo $row["COUNT"]." ".$row["CATEGORY_NAME"]."<br /> Needs Approval";
								echo "</button></a>";
							} else {
								if ($x == 1) {
									echo "<h3>You have no open tasks!</h3>";
								}
							}
						}
					} else {
						#echo "You have no open tasks!";
					}
				}
				$conn->close();
			?>
		</div>
	</div>
	<div class="rightcolumn">
		<div class="card">
			<h2>Message Board</h2>
			<h5>Date: <?php echo date('m-d-y h:i A');?></h5>
		</div>
		<?php
			// Create connection
			$conn = new mysqli($server, $user, $pass, $db);
			for ($x = 1; $x < 4;$x++) {
				$sql = "SELECT * FROM MESSAGE WHERE CATEGORY = ".$x." AND STATUS = 1 AND EFFECTIVE_DATE < '".date('y-m-d H:i:s')."' AND EXPIRATION_DATE > '".date('y-m-d H:i:s')."' ORDER BY PRIORITY ASC";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
						echo "<div class='card'>";
						echo "<img src='img/".$row["ICON"]."' width='50' height='50'><br/>";
						if ($INCLUDE_TITLE_IN_MESSAGE) {echo $row["TITLE"]."<br />";}
						echo $row["MESSAGE"];
						echo "</label>";
						echo "</div>";
					}
				} else {
					#echo date('y-m-d H:i:s');
				}
			}
			$conn->close();
		?>
	</div>
</div>

<?php require("html/footer.html");?>
</body>
</html>