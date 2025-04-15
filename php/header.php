<?php

  session_start();

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>PHP</title>
  </head>

  <body>
    <header>
      <div class="container">
        <div class="header-wrapper">
          <?php if (isset($_SESSION['username'])) { ?>
            <ul class="menu">
              <li><a href="/Assignment1/">Assignment 1</a></li>
              <li><a href="/Assignment2/">Assignment 2</a></li>
              <li><a href="/Assignment3/">Assignment 3</a></li>
              <li><a href="/Assignment4/">Assignment 4</a></li>
              <li><a href="/Assignment5/">Assignment 5</a></li>
              <li><a href="/Assignment6/">Assignment 6</a></li>
            </ul>
            <a href="../../php/logout.php">Logout</a>
          <?php } 
            else { ?>
              <a href="php/login.php">Login</a>
          <?php } ?>
        </div>
      </div>
    </header>
  </body>

</html>
