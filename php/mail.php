<?php
// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
        $subject = "Contact - Stadsbouwers";
        #filters out characters from email and replaces them with spaces
        function filter_email_header($form_field) {
            return preg_replace('/[\0\n\r\|\!\/\<\>\^\$\%\*\&]+/', '', $form_field);
        }
        function create_message($voornaam, $naam, $telefoonnr, $opmerking) {
            return $message = strval($voornaam) . " " . strval($naam) . "\r\n" . strval($telefoonnr) . "\r\n\r\nOpmerking:\r\n" . strval($opmerking);
        };



        $email = filter_email_header($email);
        $bericht = create_message($voornaam, $naam, $telefoonnr, $opmerking);
        $headers = "From: $email\n";
        $sent = mail($to, $subject, $bericht, $headers);
        if ($sent) {
            header("Location: ./index.html");
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
            header("Location: ./index.html");
        }
    }
} else { 
	echo "<script type='text/javascript'>alert('Vul de Captcha in!');</script>";
}?>


