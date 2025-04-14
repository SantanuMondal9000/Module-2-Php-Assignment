<?php

	include '../php/userPermission.php';
	include '../php/header.php';

?>

<!DOCTYPE html>
<html lang="en">
		
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
		<link rel="stylesheet" href="css/style.css">
		<script src="js/assignment1.js"></script>
		<title>Assignment 1</title>
	</head>
																		
	<body>
		<h2>Assignment 1</h2>
		<div class="form-container">
			<form action="php/action.php" method="post" name="my-form" onsubmit="return formSubmit()">
				<label for="first_name">First Name</label>
				<input type="text" id="first_name" name="first-name" placeholder="First name"
					oninput="validateForm('first-name')">
				<p class="form-status" id="first-name-status">&nbsp;</p>
				<label for="last_name">Last Name</label>
				<input type="text" id="last_name" name="last-name" placeholder="Last name" oninput="validateForm('last-name')">
				<p class="form-status" id="last-name-status">&nbsp;</p>
				<label for="full_name">Full Name</label>
				<input type="text" id="full_name" name="full-name" placeholder="Full Name" disabled>
				<input type="submit" value="Submit" class="submit-btn" name="submit">
			</form>
		</div>
	</body>
</html>
