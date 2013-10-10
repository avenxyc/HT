<?php
	session_start();
	$title_name = "Logging in...";
	include("includes/header.html");

	if(isset($_POST['username']) && isset($_POST['password'])){
		// If the user has just tried to log in 
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		require_once ('mysqli_connect.php');//connect to the database
		
		
		$query = 'select * from user_info '
						 ."where username = '".$username."'"
						 ."and password = '".sha1($password)."';"; // Add bcript later
		
		$result = mysqli_query($dbc, $query);
				
		
		// Check if there is a correct match in the result
		if(mysqli_num_rows($result) > 0){
			$_SESSION['valid_user'] = $username;
			header('Refresh: 3;url=index.php');
			echo '<h3>Welcome, '.$username.'. We are redirecting to the home page.';
		}else {
			echo '<div id="password_error">';
			echo '<p > Wrong username or password</p>';
			echo '<br /><a href="reset_pw.php">Forget password?</a>';
			echo '</div>';
		}
		
		mysqli_close($dbc); // Close the database connection.
	}

	include("includes/footer.html");
?>	