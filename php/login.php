<?php
  session_start();
  require __DIR__ . '/../vendor/autoload.php';
  $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
  $dotenv->load();
  $USERNAME = $_ENV['USERNAME'];
  $PASSWORD = $_ENV['PASSWORD'];

  if (isset($_SESSION['username'])) {
    header("Location: ../../index.php");
  }

  if (isset($_POST['formData'])) {
    $dataUser = json_decode($_POST['formData'], TRUE);
    
    if ($dataUser['username'] == $USERNAME && $dataUser['password'] == $PASSWORD) {
      $_SESSION['username'] = $dataUser['username'];
    
      echo json_encode(["status" => TRUE]);
      session_set_cookie_params([
        'lifetime' => 0,
        'secure' => TRUE,    
        'httponly' => TRUE,     
        'samesite' => 'Strict',
    ]);
  } 
  else {
    echo json_encode(["status" => FALSE]);
  }
  exit();
  }     

?>

<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Assignment 7</title>
  </head>

  <body>
    <section class="form">
      <div class="container">
        <div class="form-wrapper">
          <div class="form-container">
            <h3>LOGIN</h3>
            <form action="" method="post" enctype="multipart/form-data" name="my-form" id="loginForm">
              <label for="first_name">Username</label>
              <input type="text" id="username" name="username" placeholder="Username" oninput="hideStatus()">
              <label for="last_name">Password</label>
              <input type="password" name="password" id="password" placeholder="Password" oninput="hideStatus()">
              <input type="submit" name="submit" value="Login" class="submit-btn" id="subimt-btn">
              <label class="status-label">Invalid Username And Password</label>
            </form>
          </div>
        </div>
      </div>
    </section>
  </body>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="../js/login.js"></script>

</html>
