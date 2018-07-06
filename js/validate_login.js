function validateForm() {
	var user = document.getElementById("username_text").value;
	var pass = document.getElementById("password_text").value;

	if (user == "") {
		//username is blank
		alert("You must enter a username");
		document.getElementById("username_text").focus();
		return false;
	} else {
		if (pass == "") {
			//password is blank
			alert("You must enter a password");
			document.getElementById("password_text").focus();
			return false;
		} else {
			//both are not blank
			//encrypt password field
			pass = sha256(pass);
			window.location.href = "php/login_validate.php?username=" + user + "&password=" + pass;
			return true;
		}
	}
}