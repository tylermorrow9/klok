//requests user to validate whether to delete record or not prior to actually completing the action
var record = document.getElementById("delete_record");

function validateDelete() {
	var result = confirm("Are you sure you want to delete this record?");
	if (result) {
		//alert("true");
		return true;
	} else {
		//alert("false");
		return false;
	}
}