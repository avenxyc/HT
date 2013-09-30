<?php
		$title_name = 'Log out';
		include("includes/header.html");
		session_start();
		$old_user = $_SESSION['valid_user'];
		
		//Store to test if they 'were' logged in
		unset($_SESSION['valid_user']);
		$result_dest = session_destroy();
		
		//Display log out info
		echo '<h3>Logging out...</h3>';
		
		
		if(!empty($old_user)) {
			if($result_dest) {
				// if they were logged in and now are logged out
				echo 'We are redirecting you to the home page.<br />';
				header('Refresh: 3;url=index.php');
			} else {
				// can not be logged out
				echo 'Can not log you now right now, please try again.';
			}
		} else {
			// If they weren't logged out but came to this page
			echo 'You are not logged in';
			header('Refresh: 3;url=index.php');
		}
		
		include("includes/footer.html");
?>