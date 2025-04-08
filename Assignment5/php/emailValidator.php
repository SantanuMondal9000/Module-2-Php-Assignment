<?php
//Function Validate Email.
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
  header('Content-Type: application/json');
  echo json_encode(emailValidate($_POST['email']));
  exit;
}
//Function Validate Email.

function emailValidate($email) {
  $apiKey = "9d99973fb334a5b79af2180863be4697";
  $url = "http://apilayer.net/api/check?access_key=$apiKey&email=" . urlencode($email);

  try {
      $ch = curl_init($url);
      if (!$ch) throw new Exception("Failed to init cURL");
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      if (!$response) throw new Exception("cURL error: " . curl_error($ch));
      curl_close($ch);

      $data = json_decode($response, true);
      if (isset($data['success']) && $data['success'] === false) {
          return false;
      }

      if (!isset($data['smtp_check'])) {
          return false;
      }

      return $data['smtp_check'] === true;
  } 
  catch (Exception $e) {
      return false;
  }
}



?>
