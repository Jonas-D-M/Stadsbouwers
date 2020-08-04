<?php
// Checks if form has been submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
} else { 
    http_response_code(412);
	// echo "<script type='text/javascript'>alert('Vul de Captcha in!');</script>";
}?>


