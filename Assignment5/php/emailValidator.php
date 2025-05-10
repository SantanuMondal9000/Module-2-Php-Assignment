<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
  header('Content-Type: application/json');
  echo json_encode(emailValidate($_POST['email']));
  exit;
}

/**
 * This function will check the validity of the given email by user.
 * 
 * @param string The user email.
 * @return bool
 */
function emailValidate($email) {
  $api_key = "9d99973fb334a5b79af2180863be469";
  $url = "http://apilayer.net/api/check?access_key=$api_key&email=" . urlencode($email);

  try {
    $ch = curl_init($url);
    if (!$ch) throw new Exception("Failed to init cURL");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    if (!$response) throw new Exception("cURL error: " . curl_error($ch));
    curl_close($ch);
    $data = json_decode($response, TRUE);
    if (isset($data['success']) && $data['success'] === FALSE) {
        return FALSE;
    }
    if (!isset($data['smtp_check'])) {
        return FALSE;
    }
    return $data['smtp_check'] === TRUE;
  } 
  catch (Exception $e) {
      return FALSE;
  }
}
?>
