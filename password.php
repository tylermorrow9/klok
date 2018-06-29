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
	
	<script>
		function encryptPass() {
			
			var pass = document.getElementById("password_text").value;
			
			if (document.getElementById("password_text").value != "") {
				document.getElementById("enc_password_text").value = sha256(document.getElementById("password_text").value);
			} else {
				alert("Please enter Password.");
			}
		}
		
		function submitPassChange() {
			if (document.getElementById("username_text").value != "") {
				var user = document.getElementById("username_text").value;
				if (document.getElementById("enc_password_text").value != "") {
					//success
					var pass = document.getElementById("enc_password_text").value;
					window.location.href = "php/password_reset.php?username=" + user + "&password=" + pass;
				} else {
					//encryption box is blank
					alert("Please generate an encrypted a Password.");
				}
			} else {
				//username field is blank
				alert("Please enter a Username.");
			}
		}
	</script>
</body>
</html>
