<?php 
	require("inc/header.php");
	require("inc/session.php");
?>

<body>
	<label>Current username: </label><input type="text" id="username_text">
	<br />
	<label>Set Password: </label><input type="text" id="password_text">
	<br />
	<input type="hidden" id="enc_password_text">
	<br />
	<button onClick="encryptPass();">Generate</button><button onClick="submitPassChange();">Submit</button>
	
	<script src="js/password_encryption.js"></script>
</body>
</html>
