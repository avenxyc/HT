<?php  //Functions for this project
	function is_logged_in(){
		if(!isset($_SESSION['valid_user'])) {
?>  <!-- finish the form later -->
    <form action="../auth_log_in.php" method="post" id="index_sign_in">
      <div id="sign-in-text">
        <div class="members-info">
          <label>Username: </label>
          <input type="text" name="username" />
        </div>
        <div class="members-info">
          <label>Password: </label>
          <input type="password" name="password" />
         </div>
        <button class="members-login" value="Sign in">Sign in</button>
        <a href="../sign_up.php"> <button type="button" class="members-login"  value="Sign up">Sign up</button></a>
        </div>
      </form>

<?php 
		} else {
			echo "<div id='signed-in-text'> Welcome, ". $_SESSION['valid_user'] .". <br />
						<a href='log_out.php'><button type='button' value='Log out'>Log out</div>";
		}
	}
	      

	function check_valid_user() {
		// check if the user has already logged in
		if(isset($_SESSION['valid_user'])) {
			echo "You have already logged in as ".$_SESSION['valid_user'].".";
		} else {
			echo "<h3>Problem: You are logged in right now, redirecting you to the home page...";
			header('Refresh: 3;url=index.php');
		}
	}
			
  

	function filled_out($form_vars) {
		// Check if the information is full
		foreach($form_vars as $key => $value){
			if((!isset($key)) || ($value == ' ')){
				return false;
			}
		}
		return true;
	}
	
	function register($username, $email, $password, $fname, $lname){
		require_once ('mysqli_connect.php');//connect to the database
		
		
		if(!check_existence($dbc, 'username', $username)) {
			redirect_home();
			throw new Exception('Your user already exists, please try again.');
		}
		if(!check_existence($dbc, 'email', $email)) {
			redirect_home();
			throw new Exception('Your email already exists, please try again.');
		}
		// Add bcript later
	  $query = 'INSERT INTO user_info (email, username, password, first_name, last_name)
							VALUES ( "'.$email.'","'.$username.'","'.sha1($password).'","'.$fname.'","'.$lname.'")';
		$result = mysqli_query($dbc,$query);
		
		
			
		if(!$result) {
			throw new Exception('Could not register you in database, please try again');
			redirect_home();
		}
		
		
		
		mysqli_close($dbc);
		return true;
	}
	
	
	// Output content header in a proper way
	function do_html_header($header) {
		if(!empty($header)){
			echo '<h3 class="content_header">'.$header.'</h3>';
		}
	}
	
	// Ouput content text in a proper way	
	function do_html_content($content) {
		if(!empty($content)){
			echo '<p class="content_text">'.$content.'</p>';
		}
	}	
		
		//Check existance in Database	
	function check_existence($dbc, $field, $name) {
		$query = "select * from user_info where ".$field." = '". $name . "';";
		$result = mysqli_query($dbc,$query);
		
		if(mysqli_num_rows($result) > 0){
			return false;
		}else{
			return true;
		}
		
	}
	
	// Redirect to home page
	function redirect_home() {
		do_html_content('Redirecting you back to home page...');
		header('Refresh: 3;url=index.php');
	}

?>