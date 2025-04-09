
// Variable.
var firstNameValid = false;
var lastNameValid = false;
var nameLength = 30;
var imageSelect = false;
var marksValidation = false;
var phoneNumberValid = false;

// Update the Full name.

function updateFullname() {
	let firstName = document.getElementById("first_name").value;
	let lastName = document.getElementById("last_name").value;
	document.getElementById("full_name").value = firstName + " " + lastName;

}

// Validate Form.

function validateName(id) {
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
// Function Image Valid.

function imageValid(id) {
	var fileInput = document.getElementById("image-file");
	var filePath = fileInput.value;
	var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
	if ($("#" + id).get(0).files.length === 0) {
		formStatus("#" + id + "-status", "image must be select!.");
		imageSelect = false;
	}
	else if (!allowedExtensions.test(filePath)) {
		formStatus("#" + id + "-status", "File Type Should Be PNG, JPEG, JPG, or GIF!.");
		fileInput.value = "";
		imageSelect = false;
	}
	else {
		hideStatus("#" + id + "-status");
		imageSelect = true;
	}


}
// Validate Phone Number.

function validatePhone(id) {
	let phonePattern = /^[6-9]\d{9}$/;
	let phoneNumber = $("#" + id).val().trim();
	if (id == "phone-number") {
		if (phoneNumber.startsWith("+91")) {
			phoneNumber = phoneNumber.slice(3);
		}

		if (phoneNumber == "") {
			formStatus("#" + id + "-status", "phone number must be filled!");
			phoneNumberValid = false;

		}
		else if (isNaN(phoneNumber)) {
			formStatus("#" + id + "-status", "Phone Number should contain only numbers!");
			phoneNumberValid = false;
		}
		else if (phoneNumber.length !== 10) {
			formStatus("#" + id + "-status", "Phone Number must be exactly 10 digits!");
			phoneNumberValid = false;
		}
		else if (!phonePattern.test(phoneNumber)) {
			formStatus("#" + id + "-status", "Phone Number can be start only 6,7,8,9");
			phoneNumberValid = false;
		}
		else {
			hideStatus("#" + id + "-status");
			phoneNumberValid = true;
		}
	}
}

// Function Marks Valid. 
function marksValid(id) {
	let input = document.getElementById(id).value.trim();
	let lines = input.split('\n');

	const pattern = /^[A-Za-z]+(?: [A-Za-z]+)*\|(100|[1-9][0-9]?|0)$/;

	let isValid = true;
	let errorMsg = '';
	let cleanedLines = [];

	for (let i = 0; i < lines.length; i++) {
		let line = lines[i].trim();

		if (line === '') continue;

		if (!line.includes('|')) {
			isValid = false;
			errorMsg += `Line ${i + 1} missing "|": "${lines[i]}"\n`;
			continue;
		}
		let [subjectRaw, marksRaw] = line.split('|');

		let subject = subjectRaw.trim().replace(/\s+/g, ' ');
		let marks = marksRaw.trim();

		let cleanedLine = `${subject}|${marks}`;

		if (!pattern.test(cleanedLine)) {
			isValid = false;
			errorMsg += `Line ${i + 1} is invalid format \n`;
		} else {
			cleanedLines.push(cleanedLine);
		}
	}

	if (input === "") {
		formStatus("#" + id + "-status", "Marks to be filled!");
	} else if (isValid) {
		document.getElementById(id).value = cleanedLines.join('\n');
		marksValidation = true;
	} else {
		formStatus("#" + id + "-status", errorMsg);
	}
}

// Fucntion Validate Form Submit.

function formSubmit() {
	validateName("first-name");
	validateName("last-name");
	imageValid("image-file");
	marksValid("marks-area");
	validatePhone("phone-number");
	console.log(phoneNumberValid);
	if (firstNameValid && lastNameValid && imageSelect && marksValidation && phoneNumberValid) {
		//return true;
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
