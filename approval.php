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
<?php include("inc/navigation.php"); ?>

<div class="row">
	<div class="leftcolumn">
		<div class="card">
			<h2>Approval Administration</h2>
			<input type="button" value="Approval Rules" class="button" onclick="alert('Approval Rules')">			
		</div>
	</div>
	<div class="rightcolumn">
		<div class="card">
			<h2>My Approvals:</h2>
		</div>
	</div>
</div>

<?php require("html/footer.html");?>
</body>
</html>