<?php
use Snipworks\Smtp\Email;
require_once(dirname(__DIR__) . '/vendor/autoload.php');
require_once(dirname(__DIR__) . '/config.php');



if(!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['phone'])){
  
	$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
	$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
	$phone = filter_var($_POST['phone'], FILTER_SANITIZE_STRING);

	if( empty($name) || empty($email) || empty($phone) ) {
		return false;   
	}
	$mail = new Email('smtp.gmail.com', 587);
	$mail->setProtocol(Email::SSL)
		->setLogin(SMTP_PRIMARY_EMAIL, SMTP_PRIMARY_PASSWORD)
		->setFrom('sender@example.com')
		->setSubject('New contact')
		->setTextMessage("$name - $email - $phone")
		//->setHtmlMessage('<strong>HTML Text Message</strong>')
		->addTo('hieu.luu@niteco.se');
		
		

	if ($mail->send()) {
		echo 'SMTP Email has been sent' . PHP_EOL;
		exit(0);
	}

	echo 'An error has occurred. Please check the logs below:' . PHP_EOL;
	print_r($mail->getLogs());
}else{
	echo "nothing";
}
?>
