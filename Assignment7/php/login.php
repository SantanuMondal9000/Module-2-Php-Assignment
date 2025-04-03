<?php
session_start();

$USERNAME="Santanu";
$PASSWORD="1234";


if (isset($_POST['formData'])) {
  $dataUser = json_decode($_POST['formData'], true);
  
  if ($dataUser['username'] == $USERNAME && $dataUser['password'] == $PASSWORD) {
    $_SESSION['username'] = $dataUser['username'];
    echo json_encode(["status" => true]);
} 
else {
    echo json_encode(["status" => false]);
}
}
?>
