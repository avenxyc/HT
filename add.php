<?php // This is the products page
	$title_name = 'Add Products';
	include("includes/header.html");
	echo "<script src='includes/add-jQuery.js'></script>";
	
	if(isset($_SESSION['valid_user'])) {//Only logged in users can view this page
		
		
		require_once ('mysqli_connect.php');//connect to the database
		
		// Make the query:
		$cq = "SELECT *  from item_class order by class_name ASC";		
		$cqrow = mysqli_query ($dbc, $cq); // Run the query.
	
	
	// Check if the form has been submitted:
	if (isset($_POST['submitted'])) {
					
		require_once ('mysqli_connect.php'); // Connect to the db.
			
		$errors = array(); // Initialize an error array.
		
		// Check for a upccode:
		if(empty($_POST['upccode'])) {
			$errors[] = 'UPC code should not be empty.';
		} else if(!is_numeric($_POST['upccode'])) {
			$errors[] = 'UPC code should be numbers.';
		} else {
			$uc = mysqli_real_escape_string($dbc, trim($_POST['upccode']));
		}
		
		/* Check for a class:
		if (empty($_POST['class'])) {
			$errors[] = 'You forgot to enter its class.';
		} else {
			$c = mysqli_real_escape_string($dbc, trim($_POST['class']));
		}*/
		$c = mysqli_real_escape_string($dbc, trim($_POST['class']));
		
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
		
		// Check for a product_name:
		if (empty($_POST['product_name'])) {
			$errors[] = 'The product name can not be empty.';
		} else {
			$pn = mysqli_real_escape_string($dbc, trim($_POST['product_name']));
		}
	
		// Check for weight:
		if (empty($_POST['weight'])) {
			$errors[] = 'You forgot to enter the product weight.';
		} else if(!is_numeric($_POST['weight'])) {
			$errors[] = 'The weight must be numbers.';
		} else {
			$w = mysqli_real_escape_string($dbc, trim($_POST['weight']));
		}
		
		// Check for total weight
		if (empty($_POST['t_weight'])) {
			$errors[] = 'You forgot to enter the product weight.';
		} else if(!is_numeric($_POST['t_weight'])) {
			$errors[] = 'The total weight must be numbers.';
		} else if($_POST['weight'] >= $_POST['t_weight']) {
			$errors[] = 'The total weight should be greater than the weight';
		} else {
			$t_w = mysqli_real_escape_string($dbc, trim($_POST['t_weight']));
		}
	
		// Check for a valid cform
		if(isset($_POST['cform'])) {
			$cform_number = count($_POST['cform']['cname']); //Get the number of constituent form
			
			// Save cform data to arrays for query
		 for ($i = 0; $i < $cform_number; $i++) {
				$_POST['cform']['cname'][$i];
				// Check for a cname:
				if (empty($_POST['cform']['cname'][$i])) {
					$errors[] = 'You forgot to enter Constituents name.';
				} else {
					$cname[$i] = mysqli_real_escape_string($dbc, trim($_POST['cform']['cname'][$i]));
				}
				
				
				// Check for a pweight:
				if (empty($_POST['cform']['pweight'][$i]) || !is_numeric($_POST['cform']['pweight'][$i])) {
					$errors[] = 'You forgot to enter Constituents name.';
				} else {
					$pweight[$i] = mysqli_real_escape_string($dbc, trim($_POST['cform']['pweight'][$i]));
				}	
				
				// Check for a type:
				if (empty($_POST['cform']['Type'][$i])) {
					$errors[] = 'You forgot to enter the type of Constituents.';
				} else {
					$type[$i] = mysqli_real_escape_string($dbc, trim($_POST['cform']['Type'][$i]));
				}
				
				$classification[$i] = mysqli_real_escape_string($dbc, trim($_POST['cform']['classification'][$i]));	
		 }; 
		 
		} else {
			$errors[] = 'You didn\'t enter any constituent.';
		}
		 
		
	
		$region_name = mysqli_real_escape_string($dbc, trim($_POST['Regions']));
	
	
		
		// Check if the imege is valid
		if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) { 
				
				$allowedExts = array("gif", "jpeg", "jpg", "png", "JPG");
				$temp = explode(".", $_FILES["image"]["name"]);
				$extension = end($temp);
				$path = "pics/" . $_POST['upccode'] . ".jpg";
				if ((($_FILES["image"]["type"] == "image/gif")
				|| ($_FILES["image"]["type"] == "image/jpeg")
				|| ($_FILES["image"]["type"] == "image/jpg")
				|| ($_FILES["image"]["type"] == "image/JPG")
				|| ($_FILES["image"]["type"] == "image/pjpeg")
				|| ($_FILES["image"]["type"] == "image/x-png")
				|| ($_FILES["image"]["type"] == "image/png"))
				&& ($_FILES["image"]["size"] < 40000000)
				&& in_array($extension, $allowedExts)) {
					if ($_FILES["image"]["error"] > 0){
						$errors[] = "Return Code: " . $_FILES["image"]["error"] . "<br>";
						}
					else
						{
							/*echo "Upload: " . $_FILES["image"]["name"] . "<br>";
							echo "Type: " . $_FILES["image"]["type"] . "<br>";
							echo "Size: " . ($_FILES["image"]["size"] / 1024) . " kB<br>";
							echo "Temp file: " . $_FILES["image"]["tmp_name"] . "<br>";*/
							
				
							if (file_exists("pics/" . $_POST['upccode'] . '.jpg')) {
								$errors[] =  $_FILES["image"]["name"] . " already exists. ";
							}
							else {
								//Move pictures
								move_uploaded_file($_FILES["image"]["tmp_name"], $path);
								//echo "Stored in: " . "pics/" . $_FILES["image"]["name"];
							}
						}
					}
				else {
						$path = '';
						$error[] = "Invalid file";
					}
	
		}
		
		// Check for author name
		if (empty($_POST['author'])) {
			$errors[] = 'You forgot to enter the author name.';
		} else {
			$author = mysqli_real_escape_string($dbc, trim($_POST['author']));
		}
		
		$date = date('Y-m-d', time());
					
					
		if (empty($errors)) { // If everything's OK.
		
			
		
			// Put the info in the database...
			
				
			// Make the query:
			$q1 = "INSERT IGNORE INTO 
							products (upccode, class, company_name,parent_company, product_name, weight, img_path, total_weight, author, last_updated)
							VALUES ('$uc', '$c', '$cn', '$pc', '$pn', '$w', '$path', '$t_w', '$author', '$date')";		
			
			$r1 = @mysqli_query ($dbc, $q1); // Run the first query.
	
			
			for($i = 0; $i < $cform_number; $i++){
				$q2[$i] = "REPLACE INTO constituents (cname, type) VALUES ('$cname[$i]', '$type[$i]')";
				$q3[$i] = "REPLACE INTO regions_recyclability (region_name ,cname , classification)VALUES ('$region_name',  '$cname[$i]',  '$classification[$i]')";
				$q4[$i] = "REPLACE INTO prod_const (upccode, cname, part_weight) VALUES ('$uc', '$cname[$i]', '$pweight[$i]')";	
				$r2[$i] = @mysqli_query ($dbc, $q2[$i]);  // Run the second query.
				$r3[$i] = @mysqli_query ($dbc, $q3[$i]);  // Run the third query.
				$r4[$i] = @mysqli_query ($dbc, $q4[$i]);  // Run the forth query.
				 
			}
	
			if ($r1 && (sizeof($r2)==$cform_number) && (sizeof($r3)==$cform_number) && (sizeof($r4)==$cform_number)) { // If it ran OK.
			
				// Print a message:
				do_html_header('Done!');
				do_html_content('You have now successfully added a new item into the database');	
			
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
			echo '<div class="error">';	
			do_html_header('Error');
			do_html_error('The following error(s) occurred: ');
			foreach ($errors as $msg) { // Print each error.
				do_html_content(" - $msg");
			}
			do_html_error('Please try again.');
			echo '</div>';
			
		} // End of if (empty($errors)) IF.
		
		mysqli_close($dbc); // Close the database connection.
	
	} // End of the main Submit conditional.
	
	
	//-- Input info --
		do_html_header('Add new product','center_header');
		include('includes/add-form.html');
	

	}

include ('includes/footer.html');
?>
