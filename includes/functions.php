<?php  //Functions for this project

	
		
  

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
		require_once ('../mysqli_connect.php');//connect to the database
		echo '<h3>'.$username . ' ' . $password . '</h3>';
		
	  $query = 'INSERT INTO user_info (username, password, first_name, last_name)
							VALUES (' .$username. ',' .$password . ',' . $fname . ',' . $lname . ')';
		$result = mysqli_query($dbc,$query);
		
		if(!$result) {
			throw new Exception('Could not register you in database, please try again');
		}
		
		return true;
	}
	
	
	


?>