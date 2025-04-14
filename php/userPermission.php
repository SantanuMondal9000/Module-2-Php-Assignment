<?php

  session_start();
  if(!isset($_SESSION['username'])) {
    header("Location: ../../Assignment7/login.html");
    exit();
  }

?>
