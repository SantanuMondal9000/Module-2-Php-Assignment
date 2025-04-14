<?php
 include '../../php/userPermission.php';
 include '../../php/FormControler.php';
 include '../../php/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    $formControler=new FormControler($_POST,$_FILES);
}

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../../css/style.css">
    <title>Assignment</title>
  </head>
  <body>
    <section class="content-part">
      <?php 
      $formControler->assignment1Render();
      $formControler->assignment2Render();
      $formControler->assignment3Render();    
      ?>
    </section>
  </body>
</html>
