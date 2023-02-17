<?php



 #mail function defenition 
$mail = new PHPMailer();
require("class.phpmailer.php");
$mail->getAddress();

function mailtoemail($to,$message){


	$mail = new PHPMailer();

	$mail->IsSMTP();
	$mail->Host = "smtp.gmail.com";

	$mail->SMTPAuth = true;
	$mail->SMTPSecure = "ssl";
	$mail->Port = 465;
	$mail->Username = "mailtesting123.dd@gmail.com";
	$mail->Password = "testing@1234";

	$mail->From = "mailtesting123.dd@gmail.com";
	$mail->FromName = "Test mail";
	$mail->AddAddress($to);

//$mail->AddReplyTo("mail@mail.com");

	$mail->IsHTML(true);

	$mail->Subject = "Test mail";
	$mail->Body = "$message";
//$mail->AltBody = "This is the body in plain text for non-HTML mail clients";
	$mail->Send();

	return 1;

}

?>