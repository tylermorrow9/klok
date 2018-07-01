<?php 
	require("inc/header.php");
	
	require("php/logout_validation.php");

	#end current session
	session_unset(); 
	session_destroy();
?>

<body>
	<div class="topnav">
		<a href="login.php">Login</a>
	</div>
</body>
</html>
