<?php // send_email.php
	session_start();
	$title_name = "Send email";
	include("includes/header.html");
	
	$email = $_POST['email'];
	
	require_once ('mysqli_connect.php');//connect to the database
	$query = "select * from user_info where email = '". $email . "'";
	$result = mysqli_query($dbc, $query);
	
	if(mysqli_num_rows($result) > 0){
		do_html_content("You email will be sent shortly, please reset your password as soon as possible.");
		/*$to = "yichuan.xu@outlook.com";
		$subject = "Test mail";
		$message = "Hello! This is a simple email message.";
		$from = "avenxyc@gmail.com";
		$headers = "From:" . $from;
		mail($to,$subject,$message,$headers);
		echo "Mail Sent.";*/
		ini_set("SMTP","aspmx.l.google.com");
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1" . "\r\n";
		$headers .= "From: test@gmail.com" . "\r\n";
		mail("yichuan.xu@gmail..com","test subject","test body",$headers);
	}else {
		do_html_content("Your email is invalid, please try again.");
		header('Refresh: 3;url=index.php');
	}
	
	
	do_html_header('Email has been sent');
	
	// TODO: finish the email
	
	
	
	include("includes/footer.html");
?>