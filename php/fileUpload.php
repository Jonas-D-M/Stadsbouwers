<?php
$target_dir = "plans/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "pdf") {
  echo "Sorry, only PDF's files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}

function post_captcha($user_response) {
  $fields_string = '';
  $fields = array('secret' => '6LcinOUUAAAAAAo_Ok8frDNNUATo1653ONGamNl6', 'response' => $user_response);
  foreach ($fields as $key => $value) $fields_string.= $key . '=' . $value . '&';
  $fields_string = rtrim($fields_string, '&');
  $ch = curl_init();
  curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
  curl_setopt($ch, CURLOPT_POST, count($fields));
  curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
  $result = curl_exec($ch);
  curl_close($ch);
  return json_decode($result, true);
}
// Call the function post_captcha
$res = post_captcha($_POST['g-recaptcha-response']);
if (!$res['success']) {
  // What happens when the CAPTCHA wasn't checked
echo '<p>Please go back and make sure you check the security CAPTCHA box.</p><br>';
} else {
  // If CAPTCHA is successfully completed...
  #form variables
  $voornaam = $_POST['voornaam'];
  $naam = $_POST['naam'];
  $email = $_POST['email'];
  $opmerking = $_POST['opmerking'];
  $to = "info@stadsbouwers.be";
  $subject = "Upcheck - Stadsbouwers";
  #filters out characters from email and replaces them with spaces
  function filter_email_header($form_field) {
      return preg_replace('/[\0\n\r\|\!\/\<\>\^\$\%\*\&]+/', '', $form_field);
  }
  function create_message($voornaam, $naam, $telefoonnr, $opmerking) {
      return $message = strval($voornaam) . " " . strval($naam) . "\r\n" . strval($telefoonnr) . "\r\n" . strval($target_file) "\r\n\r\nOpmerking:\r\n" . strval($opmerking);
  };



  $email = filter_email_header($email);
  $bericht = create_message($voornaam, $naam, $telefoonnr, $opmerking);
  $headers = "From: $email\n";
  $sent = mail($to, $subject, $bericht, $headers);
  if ($sent) {
      // header("Location: ./index.html");
      http_response_code(200);
  } else {
?><html>
  <head>
  <title>Er ging iets mis</title>
  </head>
  <body>
  <h1>Er ging iets mis</h1>
  <p>Er ging iets mis in het proces. Probeer later opnieuw.</p>
  </body>
  </html>
  <?php
      // header("Location: ./index.html");
      http_response_code(500);
  }
}
?>