<?php
session_start();
if(isset($_GET['q'])){
	$q = $_GET['q'];
	if(isset($_SESSION['username'])){
		if($q=="1"){
			header("Location: http://mywebsite.local/Assignment1/"); 
			exit(); 
		}
		else if($q=="2"){
			header("Location: http://mywebsite.local/Assignment2/"); 
			exit(); 
		}
		else if($q=="3"){
			header("Location: http://mywebsite.local/Assignment3/"); 
			exit(); 
		}
		else if($q=="4"){
			header("Location: http://mywebsite.local/Assignment4/"); 
			exit(); 
		}
		else if($q=="5"){
			header("Location: http://mywebsite.local/Assignment5/"); 
			exit(); 
		}
		else if($q=="6"){
			header("Location: http://mywebsite.local/Assignment6/"); 
			exit(); 
		}
		else{
			header("Location: http://mywebsite.local"); 
			exit(); 
		}
		
	}
	else{
		header("Location: Assignment7/login.html"); 
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
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script src="js/assignment7.js"></script>
	<title>Assignment 7</title>
</head>

<body>
		<header>
			<div class="container">
				<a href="Assignment7/login.html">Login</a>
			</div>
		</header>
		<section>
			<div class="container">
					<h1>Welcome To Php Assignment</h1>
			</div>
		</section>

</header>
</body>

</html>

