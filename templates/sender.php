<?php
require '../vendor/autoload.php';

function getCustomEmail(){
	$headerPattern = '/<div class="header">(.+)<\/div>/';
	$messagePattern = '/<div class="message">(.+)<\/div>/';
	$signaturePattern = '/<div class="signature">(.+)<\/div>/';
	$buttonTextPattern = '/<div class="btn-text">(.+)<\/div>/';
	$header = "My custom header";
	$message = "My custom message";
	$buttonText = "My custom button text";
	$signature = "My custom signature";
	$email = file_get_contents("inlined/action.html");
	$email = preg_replace($headerPattern,$header,$email);
	$email = preg_replace($messagePattern,$message,$email);
	$email = preg_replace($signaturePattern,$signature,$email);
	$email = preg_replace($buttonTextPattern,$buttonText,$email);
	return $email;
}

$mail = new PHPMailer;

//$mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp1.example.com;smtp2.example.com';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'user@example.com';                 // SMTP username
$mail->Password = 'secret';                           // SMTP password
$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 587;                                    // TCP port to connect to

$mail->setFrom('from@example.com', 'Mailer');
$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
$mail->addReplyTo('info@example.com', 'Information');

$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = '<subject>Here is the subject</subject>';
$mail->Body    = getCustomEmail();

$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

echo getCustomEmail();

/*if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}
*/
?>