<?php
		$title_name = 'Log out';
		include("includes/header.html");
		session_start();
		$old_user = $_SESSION['valid_user'];
		
		//Store to test if they 'were' logged in
		unset($_SESSION['valid_user']);
		$result_dest = session_destroy();
		
		//Display log out info
		do_html_header ('<h3>Logging out...</h3>');
		
		
		if(!empty($old_user)) {
			if($result_dest) {
				// if they were logged in and now are logged out
				redirect_home();
			} else {
				// can not be logged out
				echo 'Can not log you now right now, please try again.';
			}
		} else {
			// If they weren't logged out but came to this page
			redirect_home();
		}
		
		include("includes/footer.html");
?>