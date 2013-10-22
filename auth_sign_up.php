<?php //Register a new user
	$title_name = "Processing";
	
	include("includes/header.html");
	
	$username = $_POST['username'];
	$email = $_POST['email'];
	$passwd1 = $_POST['passwd1'];
	$passwd2 = $_POST['passwd2'];
	$fname = $_POST['first_name'];
	$lname = $_POST['last_name'];

	
	session_start();
	
	try {
		// Check forms filled in
		if(!filled_out($_POST)){
			throw new Exception('You have not filled the form out correctly, please go back and try again.');
		}
	
		// Check if the email is valid. Do it later
		
		// Password should be the same
		if($passwd1 != $passwd2) {
			throw new Exception('The passwords you enter do not match, please go back and try again.');
		}
		
		// Check if the password length is valid
		if((strlen($passwd1) < 6) || (strlen($passwd1) > 16)) {
			throw new Exception('You password has to be between 6 and 16 digits, please enter it again');
		}
		
		// Attempt to register
		// The function can throw an exception 
		register($username, $email, $passwd1, $fname, $lname);
		
		//register seesion variable
		$_SESSION['valid_user'] = $username;
		
		//Provide link to members page
		//do_html_header('Registration successful');
		do_html_header('Your registration was successful.');
		redirect_home();
		// Return to a pagedo_html_url('

		include("includes/footer.html");
	}
	catch(Exception $e) {
		do_html_header('Problem: ');
		do_html_content($e->getMessage());
		include("includes/footer.html");
		exit;
	}
?>