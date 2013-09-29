<?php //Register a new user
	$title_name = "Processing";
	
	include("header.html");
	echo '<link rel="stylesheet" href="style.css" type="text/css" media="all" />';
	include("functions.php");
	
	$username = $_POST['username'];
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
		register($username, $passwd1, $fname, $lname);
		
		//register seesion variable
		$_SESSION['valid_user'] = $username;
		
		//Provide link to members page
		//do_html_header('Registration successful');
		echo 'Your registration was successful.';
		// Return to a pagedo_html_url('

		include("footer.html");
	}
	catch(Exception $e) {
		echo 'problem';
		echo $e->getMessage();
		include("footer.html");
		exit;
	}
?>