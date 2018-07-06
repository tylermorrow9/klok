<?php 
	require("inc/header.php");
?>

<body>
<!--form onsubmit="return validateForm(this);"-->
<label>Username: </label><input type="text" placeholder="username" id="username_text" name="username_text" />
<br />
<label>Password: </label><input type="password" placeholder="password" id="password_text" name="password_text" /><a href="#">Forgot Password</a>
<br />
<!--input type="submit" value="Submit"/-->
<button onClick="validateForm();">Login</button>

<script src="js/validate_login.js"></script>

</body>
</html>