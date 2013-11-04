<?php
	$title_name = 'Log in';
	include("includes/header.html");
	 
	
	if(isset($_SESSION['valid_user'])){
		do_html_content('You are logged in as: '. $_SESSION['valid_user'] .'','center_text');
		do_html_header('<a href="log_out.php">Log out</a>');
	}else{
		//Output error message
		include("includes/log_in_form.html");
		do_html_error('You are not logged in or your username/password may be wrong, please try again');
		
	}
		


	
	include("includes/footer.html");
?>