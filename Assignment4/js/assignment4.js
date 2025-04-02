// Update the Full name
function updateFullname() {
	let firstName = document.getElementById("first_name").value;
	let lastName = document.getElementById("last_name").value;
	document.getElementById("full_name").value = firstName + " " + lastName;
}
// Validate Form
function validateForm() {
	let firstName = document.forms["my-form"]["first-name"].value;
	let lastName = document.forms["my-form"]["last-name"].value;
	let fileInput = document.getElementById("image-file");
	let filePath = fileInput.value;
	let allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
	let namePattern = /^[A-Za-z]+$/;
	let phoneNumber = document.forms["my-form"]["phone-number"].value.trim();

	if (firstName.trim() === "") {
		alert("First Name must be filled");
		return false;
	}
	if (!namePattern.test(firstName)) {
		alert("First name must contain only alphabets.");
		return false;
	}
	if (lastName.trim() === "") {
		alert("Last Name must be filled");
		return false;
	}
	if (!namePattern.test(lastName)) {
		alert("Last name must contain only alphabets.");
		return false;
	}
	if (fileInput.files.length === 0) {
		alert("Image File must be selected");
		return false;
	}
	if (!allowedExtensions.test(filePath)) {
		alert("File Type Should Be PNG, JPEG, JPG, or GIF");
		fileInput.value = "";
		return false;
	}
	if (phoneNumber === "") {
		alert("Phone Number Must be Filled!")
	}
	if (phoneNumber.startsWith("+91")) {
		phoneNumber = phoneNumber.slice(3);
	}

	if (isNaN(phoneNumber)) {
		alert("Phone Number should contain only numbers!");
		return false;
	}

	if (phoneNumber.length !== 10) {
		alert("Phone Number must be exactly 10 digits!");
		return false;
	}

	return true;
}
