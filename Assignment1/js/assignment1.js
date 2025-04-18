// Variable.
var firstNameValid = false;
var lastNameValid = false;
var nameLength = 30;

// Update the Full name.

function updateFullname() {
	let firstName = document.getElementById("first_name").value;
	let lastName = document.getElementById("last_name").value;
	document.getElementById("full_name").value = firstName + " " + lastName;
}
// Validate Form.

function validateForm(id) {
	updateFullname();
	let lastName = document.forms["my-form"]["last-name"].value;
	let namePattern = /^[A-Za-z]+$/;
	if (id == "first-name") {
		let firstName = document.forms["my-form"]["first-name"].value;
		if (firstName.trim() == "") {
			formStatus("#" + id + "-status", "First Name Should Be Filled!");
			firstNameValid = false;
		}
		else if (!namePattern.test(firstName)) {
			formStatus("#" + id + "-status", "first name must contain only alphabets.");
			firstNameValid = false;

		}
		else if (firstName.length >= nameLength) {
			formStatus("#" + id + "-status", "first name must below " + nameLength + " characters!");
			firstNameValid = false;
		}
		else {
			hideStatus("#" + id + "-status");
			firstNameValid = true;
		}
	}
	if (id == "last-name") {
		if (lastName.trim() == "") {
			formStatus("#" + id + "-status", "last Name Should Be Filled");
			lastNameValid = false;
		}
		else if (!namePattern.test(lastName)) {
			formStatus("#" + id + "-status", "Last name must contain only alphabets.");
			lastNameValid = false;
		}
		else if (lastName.length >= nameLength) {
			formStatus("#" + id + "-status", "last name must below " + nameLength + " characters!");
			firstNameValid = false;
		}
		else {
			hideStatus("#" + id + "-status");
			lastNameValid = true;
		}
	}

}

// Fucntion Validate Form Submit.

function formSubmit() {
	validateForm("first-name");
	validateForm("last-name");
	if (firstNameValid && lastNameValid) {
		return true;
	}
	else {
		return false;
	}
}

// Function Form Status.

function formStatus(id, message) {
	$(id).text(message).css({
		"opacity": "1",
		"text-transform": "capitalize"

	});
}

// Function Hide Status.

function hideStatus(id) {
	$(id).css({
		"opacity": "0"
	});
}

