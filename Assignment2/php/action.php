<?php

if (isset($_POST['submit'])) {
    $fullname = $_POST['first-name'] . " " . $_POST['last-name'];
    $imagePath=imageUpload();
}
function imageUpload(){
    $target_dir = __DIR__ . "/../image/";
    $target_file = $target_dir . basename($_FILES["image-file"]["name"]);
    if (file_exists($target_file)) {
        return "../image/" . basename($_FILES["image-file"]["name"]);
    }
    else{
        move_uploaded_file($_FILES["image-file"]["tmp_name"], $target_file);
        return "../image/" . basename($_FILES["image-file"]["name"]);
    }
    
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
    <div class="image-container">
    <img src="<?php echo $imagePath; ?>" alt="image" width="500" height="500">

    </div>
</body>

</html>
