<?php
    if (isset($_POST['submit'])) {
        $fullname=$_POST['first-name'] ." ". $_POST['last-name'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment 1</title>
</head>
<body>
    <h1>Hello <?php echo $fullname ?></h1>
</body>
</html>

