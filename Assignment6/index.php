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
	<script src="js/assignment6.js"></script>
	<title>Assignment 6</title>
</head>

<body>
	<h2>Assignment 6</h2>
	<section class="form">
		<div class="container">
			<div class="form-wrapper">
				<div class="form-container">
					<form action="php/action.php" method="post" id="my-form" name="my-form" onsubmit="return formSubmit(event);"
						enctype="multipart/form-data">
						<label for="first_name">First Name</label>
						<input type="text" id="first_name" name="first-name" placeholder="First name"
							oninput="validateName('first-name')">
						<p class="form-status" id="first-name-status">hello</p>
						<label for="last_name">Last Name</label>
						<input type="text" id="last_name" name="last-name" placeholder="Last name"
							oninput="validateName('last-name')">
						<p class="form-status" id="last-name-status">hello</p>
						<label for="full_name">Full Name</label>
						<input type="text" id="full_name" name="full-name" placeholder="Full Name" disabled>
						<label for="image-file">Choose Image</label>
						<input type="file" name="image-file" id="image-file" onchange="imageValid('image-file')">
						<p class="form-status" id="image-file-status">hello</p>
						<textarea name="marks-area" id="marks-area" cols="30" rows="10"></textarea>
						<label for="phone-number">Phone Number</label>
						<div class="phone-number-block">
							<div class="phone-prefix">
								<p>+91</p>
							</div>
							<input type="text" name="phone-number" id="phone-number">
						</div>
						<p class="form-status" id="phone-number-status">hello</p>
						<label for="image-file">Email</label>
						<input type="text" name="email" id="email">
						<p class="form-status" id="email-status">hello</p>
						<input type="submit" name="submit" value="Submit" class="submit-btn" id="submit-btn">
					</form>
				</div>
			</div>

		</div>

	</section>

</body>

</html>
