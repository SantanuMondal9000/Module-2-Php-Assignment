<?php
// Form Handling.
    
if (isset($_POST['submit'])) {
    $fullName = $_POST['first-name'] . " " . $_POST['last-name'];
    $marks = trim($_POST['marks-area']);
    $imagePath = imageUpload();
    $phoneNumber.=$_POST['phone-number'];
    $email=$_POST['email'];
    $emailNotValid="";
    phoneNumberSet();
    emailValidate($email);
    
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
    if(substr($phoneNumber,0,3)!="+91"){
        $temp=$phoneNumber;
        $phoneNumber="+91";
        $phoneNumber.=$temp;
    }
}
//Function Validate Email.

function emailValidate($email){
    $apiKey = "70bbcf56fcfa21dc46c561537c40877f";
    $url = "http://apilayer.net/api/check?access_key=$apiKey&email=$email";
    try {
        $ch = curl_init($url);
        if ($ch === false) {
            throw new Exception("Failed to initialize cURL session.");
        }
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);

        if ($response === false) {
            throw new Exception("cURL request failed: " . curl_error($ch));
        }
        curl_close($ch);
        $data = json_decode($response, true);
        if (isset($data['smtp_check']) && $data['smtp_check'] != true) {
            global $emailNotValid;
            $emailNotValid.="Email Not Valid!";
        } 
    } 
    catch (Exception $e) {
        echo "Error: " . $e->getMessage();
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
        <h1>Phone Number: <?= $phoneNumber ?></h1>
        <h1>Email: <?= $emailNotValid == "" ? $email: $emailNotValid ?></h1>
    </section>
</body>
</html>
