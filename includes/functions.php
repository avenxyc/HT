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
			echo "<div id='sign-in-text'> Welcome, ". $_SESSION['valid_user'] .". <br />
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
	
	function register($username, $password, $fname, $lname){
		require_once ('./mysqli_connect.php');//connect to the database
		// Add bcript later
	  $query = 'INSERT INTO user_info (username, password, first_name, last_name)
							VALUES ( "'.$username.'","'.sha1($password).'","'.$fname.'","'.$lname.'")';
		$result = mysqli_query($dbc,$query);
		
	
		if(!$result) {
			throw new Exception('Could not register you in database, please try again');
		}
		
		return true;
	}
	
	
	


?>