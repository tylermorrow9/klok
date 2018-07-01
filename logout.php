<?php 
	require("inc/header.php");
	
	session_start();

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
