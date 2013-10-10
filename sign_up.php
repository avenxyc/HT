<?php
	$title_name = 'Sign Up';
	include("includes/header.html");
	session_start();
	
	if(isset($_SESSION['valid_user'])){
		echo 'You are logged in as: '. $_SESSION['valid_user'] . '<br />';
		echo '<a href="log_out.php">Log out</a><br />';
	}else{
		//Output error message
		include("includes/sign_up_form.html");
		
	}
		


	
	include("includes/footer.html");
?>