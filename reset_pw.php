<?php // reset_pw.php
	 
	$title_name = "Reset Password";
	include("includes/header.html");
	
	do_html_header('Reset your password');
	echo '<form action="../reset_pw_send_email.php" class="form" method="post">';
	echo '<p>Please enter your email:</p>';
	echo '<input type="email" name="email"/>';
	echo '<button class="s-button" type="submit">Send email</button></form>';
	

	
	
	
	include("includes/footer.html");
?>