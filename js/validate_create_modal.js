//validate user create modal
function validateUserModal() {
	var username = document.getElementById("username").value;
	var managerID = document.getElementById("managerID").selectedIndex;
	var teamID = document.getElementById("teamID").selectedIndex;
	var firstName = document.getElementById("firstName").value;
	var lastName = document.getElementById("lastName").value;
	var emailAddress = document.getElementById("emailAddress").value;
	var primaryPhone = document.getElementById("primaryPhone").value;
	var alternatePhone = document.getElementById("alternatePhone").value;
	var locale = document.getElementById("locale").selectedIndex;
	var statusID = document.getElementById("statusID").selectedIndex;

	var error = "";
	if (username == '') {
		error += "Please enter a Username\n";
	}
	if (managerID == '') {
		error += "Please select a Manager\n";
	}
	if (teamID == '') {
		error += "Please select a Team\n";
	}
	if (firstName == '') {
		error += "Please enter a First Name\n";
	}
	if (lastName == '') {
		error += "Please enter a Last Name\n";
	}
	if (emailAddress == '') {
		error += "Please enter an Email Address\n";
	}
	if (primaryPhone == '') {
		error += "Please enter a Primary Phone Number\n";
	}
	if (alternatePhone == '') {

	}
	if (locale == '') {
		error += "Please select a Locale\n";
	}
	if (statusID == '') {
		error += "Please select a Status\n";
	}

	//check for errors
	if (error != "") {
		//show users errors
		alert(error);
		return false;
	} else {
		//successful submission
		return true;
	}
}

//validate team create modal
function validateTeamModal() {
	var teamName = document.getElementById("teamName").value;
	var parentID = document.getElementById("parentID").value;
	var statusID = document.getElementById("statusID").value;

	var error = "";

	if (teamName == '') {
		error += "Please input a Team Name\n";
	}
	if (parentID == '') {
		error += "Please select a Parent\n";
	}
	if (statusID == '') {
		error += "Please select a Status\n";
	}
	
	//check for errors
	if (error != "") {
		//show users errors
		alert(error);
		return false;
	} else {
		//successful submission
		return true;
	}
}