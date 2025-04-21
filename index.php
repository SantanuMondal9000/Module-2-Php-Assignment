<?php
	include 'php/header.php';
	session_start();
	if (isset($_GET['q'])) {
		$q = $_GET['q'];
		if (isset($_SESSION['username'])) {
				if ($q<7) {
					header("Location: Assignment$q/");
					exit();
				}
				else {
					header("Location: ./");
					exit();
				}
		} 
		else {
			header("Location: php/login.php");
			exit();
		}
	}

?>
<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="css/style.css">
		<title>Php Assignment</title>
	</head>

	<body>
		<section>
			<div class="container">
				<h1 class="banner-heading">Welcome To Php Assignment</h1>
			</div>
		</section>
		</header>
	</body>	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="js/assignment7.js"></script>
</html>
