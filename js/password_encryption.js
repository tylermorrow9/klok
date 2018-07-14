//referenced in password.php page
function encryptPass() {
	
	var pass = document.getElementById("password_text").value;
	
	if (document.getElementById("password_text").value != "") {
		document.getElementById("enc_password_text").value = sha256(document.getElementById("password_text").value);
	} else {
		alert("Please enter Password.");
	}
}

//referenced in password.php page
function submitPassChange() {
	//if (document.getElementById("username_text").value != "") {
		var user = document.getElementById("username_text").value;
		var id = document.getElementById("userid").value;
		if (document.getElementById("enc_password_text").value != "") {
			//success
			var pass = document.getElementById("enc_password_text").value;
			window.location.href = "php/password_reset.php?userid=" + id + "&username=" + user + "&password=" + pass;
		} else {
			//encryption box is blank
			alert("Please generate an encrypted a Password.");
		}
	//} else {
		//username field is blank
		//alert("Please enter a Username.");
	//}
}