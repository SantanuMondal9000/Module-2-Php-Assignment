<?php

	include '../php/userPermission.php';
	include '../php/header.php';
	
?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="../../css/formpage.css">
		<title>Assignment 2</title>
	</head>

	<body>
		<h2>Assignment 2</h2>
		<section class="form">
			<div class="container">
				<div class="form-wrapper">
					<div class="form-container">
						<form action="php/action.php" method="post" name="my-form" onsubmit="return assignment2FormSubmit()"
							enctype="multipart/form-data">
							<label for="first_name">First Name</label>
							<input type="text" id="first_name" name="first-name" placeholder="First name"
								oninput="validateName('first-name')">
							<p class="form-status" id="first-name-status">&nbsp;</p>
							<label for="last_name">Last Name</label>
							<input type="text" id="last_name" name="last-name" placeholder="Last name"
								oninput="validateName('last-name')">
							<p class="form-status" id="last-name-status">&nbsp;</p>
							<label for="full_name">Full Name</label>
							<input type="text" id="full_name" name="full-name" placeholder="Full Name" disabled>
							<label for="image-file">Choose Image</label>
							<input type="file" name="image-file" id="image-file" onchange="imageValid('image-file')">
							<p class="form-status" id="image-file-status">&nbsp;</p>
							<input type="submit" name="submit" value="Submit" class="submit-btn">
						</form>
					</div>
				</div>
			</div>
		</section>
	</body>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="../js/assignments.js"></script>

</html>
