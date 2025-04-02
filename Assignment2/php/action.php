<?php
// Form Handling.
    
if (isset($_POST['submit'])) {
    $fullName = $_POST['first-name'] . " " . $_POST['last-name'];
    $imagePath=imageUpload();
}
// Function Image Upload.

function imageUpload(){
    $targetDir = __DIR__ . "/../image/";
    $targetFile = $targetDir . basename($_FILES["image-file"]["name"]);

    if (file_exists($targetFile)) {
        return "../image/" . basename($_FILES["image-file"]["name"]);
    } 
    else {
        if (move_uploaded_file($_FILES["image-file"]["tmp_name"], $targetFile)) {
            return "../image/" . basename($_FILES["image-file"]["name"]);
        } 
        else {
            return false;
        }
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
    <h1>Hello <?php echo $fullName ?></h1>
    <div class="image-container">
    <img src="<?php echo $imagePath; ?>" alt="image" width="500" height="500">

    </div>
</body>

</html>
