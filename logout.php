<?php 
	require("inc/header.php");

	#set properties
	require("properties.php");
	#include encryption device
	require("php/encryption.php");
	require("inc/decrypt_db_creds.php");
	
	require("php/logout_validation.php");

	#end current session
	session_unset(); 
	session_destroy();
?>

<?php require("html/header.html"); ?>

<div class="topnav">
  <a href="#"></a>
</div>

<div class="row">
	<div class="leftcolumn" style="width:100%;">
	    <div class="card">
			<h2>Thank you for accessing the Klok system hosted by CyberTitanSolutions!</h2>
			<p>If you wish to access the system again, please <a href="login.php">LOGIN</a></p>
	    </div>
	</div>
</div>

<?php require("html/footer.html"); ?>

<link rel="stylesheet" type="text/css" href="css/log_inout_style.css">
</body>
</html>