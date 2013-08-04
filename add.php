<?php // This is the products page
	$title_name = 'Products';
	include("includes/header.html");
	/*echo '<script src="/includes/add_jQuery.js"></script>';*/

// Check if the form has been submitted:
if (isset($_POST['submitted'])) {

	require_once ('mysqli_connect.php'); // Connect to the db.
		
	$errors = array(); // Initialize an error array.
	
	// Check for a upccode:
	if (empty($_POST['upccode'])) {
		$errors[] = 'You forgot to enter upccode.';
	} else {
		$uc = mysqli_real_escape_string($dbc, trim($_POST['upccode']));
	}
	
	// Check for a class:
	if (empty($_POST['class'])) {
		$errors[] = 'You forgot to enter its class.';
	} else {
		$c = mysqli_real_escape_string($dbc, trim($_POST['class']));
	}
	
	// Check for an company_name:
	if (empty($_POST['company_name'])) {
		$errors[] = 'You forgot to enter your company_name.';
	} else {
		$cn = mysqli_real_escape_string($dbc, trim($_POST['company_name']));
	}
	
	// Check for an parent_company:
	if (empty($_POST['parent_company'])) {
		$errors[] = 'You forgot to enter your parent_company name.';
	} else {
		$pc = mysqli_real_escape_string($dbc, trim($_POST['parent_company']));
	}
	
	// Check for a description:
	if (empty($_POST['description'])) {
		$d = 'Not applicable';
	} else {
		$d = mysqli_real_escape_string($dbc, trim($_POST['description']));
	}

	// Check for weight:
	if (empty($_POST['weight'])) {
		$errors[] = 'You forgot to enter the product weight.';
	} else {
		$w = mysqli_real_escape_string($dbc, trim($_POST['weight']));
	}
	
	// Check for a cname:
	if (empty($_POST['cname'])) {
		$errors[] = 'You forgot to enter Constituents name.';
	} else {
		$cname = mysqli_real_escape_string($dbc, trim($_POST['cname']));
	}
	
	
	// Check for a pweight:
	if (empty($_POST['pweight'])) {
		$errors[] = 'You forgot to enter Constituents name.';
	} else {
		$pweight = mysqli_real_escape_string($dbc, trim($_POST['pweight']));
	}	
	
	// Check for a type:
	if (empty($_POST['Type'])) {
		$errors[] = 'You forgot to enter the type of Constituents.';
	} else {
		$type = mysqli_real_escape_string($dbc, trim($_POST['Type']));
	}

	$region_name = mysqli_real_escape_string($dbc, trim($_POST['Regions']));

	$classification = mysqli_real_escape_string($dbc, trim($_POST['classification']));	
	
	// Select your database

  if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) { 
 	 
		 $fileName = $_FILES['image']['name'];
		 $tmpName  = $_FILES['image']['tmp_name'];
		 $fileSize = $_FILES['image']['size'];
		 $fileType = $_FILES['image']['type'];
	
		 $fp      = fopen($tmpName, 'r');
		 $content = fread($fp, filesize($tmpName));
		 $content = addslashes($content);
		 fclose($fp);
	
			if(!get_magic_quotes_gpc())
			{
					$fileName = addslashes($fileName);
			}

	}
				
				
	if (empty($errors)) { // If everything's OK.
	
		// Put the info in the database...
		
		// Make the query:
		$q1 = "INSERT IGNORE INTO products (upccode, class, company_name,parent_company, description, weight, image) VALUES ('$uc', '$c', '$cn', '$d', '$pc', '$w', '$content')";		
		$q2 = "INSERT IGNORE INTO constituents (cname, type) VALUES ('$cname', '$type')";
		$q3 = "INSERT IGNORE INTO regions_recyclability (region_name ,cname , classification)VALUES ('$region_name',  '$cname',  '$classification')";
		$q4 = "INSERT IGNORE INTO prod_const (upccode, cname, part_weight) VALUES ('$uc', '$cname', '$pweight')";	
		$r1 = @mysqli_query ($dbc, $q1); // Run the first query.
		$r2 = @mysqli_query ($dbc, $q2);  // Run the second query.
		$r3 = @mysqli_query ($dbc, $q3);  // Run the second query.
		$r4 = @mysqli_query ($dbc, $q4);  // Run the second query.

		if ($r1 && $r2 && $r3 && $r4) { // If it ran OK.
		
			// Print a message:
			echo '<h1>Done!</h1>
		<p>You have now successfully added a new item into the database</p><p><br /></p>';	
		
		} else { // If it did not run OK.
			
			// Public message:
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			// Debugging message:
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q1 . '</p>';
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q2 . '</p>';
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q3 . '</p>';
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q4 . '</p>';
						
		} // End of if ($r) IF.
		
		mysqli_close($dbc); // Close the database connection.

		// Include the footer and quit the script:
		include ('includes/footer.html'); 
		exit();
		
	} else { // Report the errors.
	
		echo '<h1>Error!</h1>
		<p class="error">The following error(s) occurred:<br />';
		foreach ($errors as $msg) { // Print each error.
			echo " - $msg<br />\n";
		}
		echo '</p><p>Please try again.</p><p><br /></p>';
		
	} // End of if (empty($errors)) IF.
	
	mysqli_close($dbc); // Close the database connection.

} // End of the main Submit conditional.


//-- Input info --
echo "<h1>Register</h1>
  		<form action='add.php' method='post' enctype='multipart/form-data'>
 		 <div id='enterInfo'>
				<p>upccode: <input type='text' name='upccode' size='15' maxlength='20' value='Product upccode' /></p>
				<p>class: <input type='text' name='class' size='20' maxlength='80' value='Please enter its class'  /> </p>
				<p>company_name: <input type='text' name='company_name' size='20' maxlength='80' value='Please enter'  /> </p>
				<p>parent_company: <input type='text' name='parent_company' size='20' maxlength='80' value='Please enter'  /> </p>
				<p>weight: <input type='text' name='weight' size='20' maxlength='10' value='Please enter'  /> </p>
				<p>description: <br /><textarea  name='description' rows='4' cols='50' value='Please enter' ></textarea></p>     
				<p>number of constituents:
				<select name='cnumber' id='cnumber' >
					<option value='0'>0</option>
					<option value='1'>1</option>
					<option value='2'>2</option>
					<option value='3'>3</option>
					<option value='4'>4</option>
					<option value='5'>5</option>
					<option value='6'>6</option>
					<option value='7'>7</option>
				</select></p>
				 <p>Region: 
						<select name='Regions' >
							<option value='Cape Breton'>Cape Breton</option>
							<option value='Eastern'>Eastern</option>
							<option value='HRM'>HRM</option>
							<option value='Northern'>Northern</option>
							<option value='South Shore'>South Shore</option>
							<option value='Valley'>Valley</option>
							<option value='Western'>Western</option>
						</select>
					</p>
				<p>Upload an image: <input type='file' name='image' ></p>
				
				<p><input type='submit' name='submit' value='Submit' /></p>
			 </div>
			 
				<input type='hidden' name='submitted' value='TRUE' />
			</form>";



include ('includes/footer.html');
?>