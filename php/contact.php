<?php

/*
	The Send Mail php Script for Contact Form
	Server-side data validation is also added for good data validation.
*/

header('Content-Type: application/json');

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

if( $name == '' ){
	echo json_encode(array('type' => 'warning', 'message' => 'لطفا نام خود را وارد نمایید!'));
}
else if( $email == '' ){
	echo json_encode(array('type' => 'warning', 'message' => 'لطفا ایمیل خود را وارد نمایید!'));
}
else if(filter_var($email, FILTER_VALIDATE_EMAIL) == false){
	echo json_encode(array('type' => 'warning', 'message' => 'لطفا یک ایمیل معتبر وارد نمایید!'));
}
else if( $message == '' ){
	echo json_encode(array('type' => 'warning', 'message' => 'لطفا پیام خود را وارد نمایید!'));
}
else{

	$formcontent="نام: $name\nایمیل: $email\n\nپیام:\n$message";

	//Place your Email Here
	$recipient = "info@example.com";

	$mailheader = "From:$email\r\n";

	if( mail($recipient, 'پیام جدید در سایت', $formcontent, $mailheader) ){
		echo json_encode(array('type' => 'success', 'message' => 'پیام شما با موفقیت ارسال شد!'));
	}
	else{
		echo json_encode(array('type' => 'danger', 'message' => 'خطا در ارسال پیام!'));
	}
}

?>