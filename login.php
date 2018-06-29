<?php 
	require("inc/header.php");
	
	#end any previous sessions
	session_unset(); 
	session_destroy();
?>

<body>

<label>Username: </label><input type="text" placeholder="username" id="username_text" name="username_text">
<br />
<label>Password: </label><input type="password" placeholder="password" id="password_text" name="password_text"><a href="#">Forgot Password</a>
<br />
<button onClick="encryptPass();">Login</button>

<script>
	function encryptPass() {
		var user = document.getElementById("username_text").value;
		
		window.location.href = "php/login_validate.php?username=" + user + "&password=" + sha256(document.getElementById("password_text").value);
	}
</script>

</body>
</html>
