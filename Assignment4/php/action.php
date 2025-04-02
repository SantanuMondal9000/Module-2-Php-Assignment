<?php
// Form Handling.
    
if (isset($_POST['submit'])) {
    $fullName = $_POST['first-name'] . " " . $_POST['last-name'];
    $marks = trim($_POST['marks-area']);
    $imagePath = imageUpload();
    $phoneNumber.=$_POST['phone-number'];
    phoneNumberSet();
    
}
// Function to handle file upload.

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
//Function Phone Number Set.

function phoneNumberSet(){
    global $phoneNumber;
    if(substr($phoneNumber,0,3)=="+91"){
        echo substr($phoneNumber,0,3);
    }
    else{
        $temp=$phoneNumber;
        $phoneNumber="+91";
        $phoneNumber.=$temp;
    }
}


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
    <section class="content-part">
            
        <h1>Hello <?php echo htmlspecialchars($fullName); ?></h1>

        <div class="image-container">
            <img src="<?php echo htmlspecialchars($imagePath); ?>" alt="image" width="500" height="500">
        </div>

        <table>
            <thead>
                <tr>
                    <th>Subject</th>
                    <th>Marks</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $marksLine = explode("\n", $marks);
                foreach ($marksLine as $line) {
                    $marksPart = explode("|", $line);

                    if (count($marksPart) == 2) {
                        ?>
                        <tr>
                            <td><?= htmlspecialchars(trim($marksPart[0])); ?></td>
                            <td><?= htmlspecialchars(trim($marksPart[1])); ?></td>
                        </tr>
                        <?php
                    }
                }
                ?>
            </tbody>
        </table>
        <h1>Phone Number:<?= $phoneNumber ?></h1>
    </section>
</body>
</html>
