<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/style.css">
  <title>Document</title>
</head>

<body>
  <header>
    <div class="container">
      <?php if (isset($_SESSION['username'])) { ?>
        <a href="http://mywebsite.local/php/logout.php">Logout</a>
      <?php } else { ?>
        <a href="Assignment7/login.html">Login</a>
      <?php } ?>
    </div>
  </header>
</body>

</html>
