<?php 
	require("inc/header.php");
?>

<body>

<label>Username: </label><input type="text" placeholder="username" id="username_text" name="username_text">
<br />
<label>Password: </label><input type="password" placeholder="password" id="password_text" name="password_text"><a href="#">Forgot Password</a>
<br />
<button onClick="encryptPassLogin();">Login</button>

<script src="js/password_encryption.js"></script>

</body>
</html>