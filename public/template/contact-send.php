<?php
	$mailto= "";
	$nameto = "Contact us";
	
	$header .= "Content-Type: text/plain; charset=utf-8\n";
	$header .= "Content-Transfer-Encoding: 8bit\n\n";
	$subject=($_POST["subject"]);
	$subject1 = "=?utf-8?B?".base64_encode("$subject")."?=";
	$body .= "Contact Form\r\n==============================\r\n\r\n";
	$body .= "Name : ". $_POST['name'] . "\n";
	$body .= "E-mail : ". $_POST['email'] . "\n";
	$body .= "Telephone : ". $_POST['telephone'] . "\n";
	$body .= "Message : ". $_POST['message'] . "\n";
			 
	mail($mailto, $subject1, $body, $header);
?>