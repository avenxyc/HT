<?php
	$title_name = 'Log in';
	include("includes/header.html");
	session_start();
	
	if(isset($_SESSION['valid_user'])){
		echo 'You are logged in as: '. $_SESSION['valid_user'] . '<br />';
		echo '<a href="#">Log out</a><br />';
	}else{
		//Output error message
		include("includes/log_in_form.html");
		echo 'You are not logged in or your username/password may be wrong, please try again';
		
	}
		


	
	include("includes/footer.html");
?>