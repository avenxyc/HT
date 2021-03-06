<?php //Edit a product
	$title_name = "Edit product";
	include("includes/header.html");
	
	if(isset($_SESSION['valid_user'])) {//Only logged in users can view this page
	
	
	$upccode = $_GET['upccode'];
	$region_name = $_GET['region'];
	
	echo "<script src=\"includes/add-jQuery.js\"></script>";
	
	require_once ('mysqli_connect.php');//connect to the database
	
	// Get data from original product
	$read_old_clist = "SELECT * FROM prod_const, regions_recyclabilityl 
										 WHERE upccode = $upccode 
										 and regions_recyclability.cname = prod_const.cname
										 and regions_recyclability.region_name = $region_name;";
	$retrieve_old_clist = mysqli_query ($dbc, $read_old_clist);
	

	
  // Make the query for item class:
	$cq = "SELECT *  from item_class order by class_name ASC";		
	$cqrow = mysqli_query ($dbc, $cq); // Run the query.
	
	$date = date('Y-m-d',time());


	// Check if the form has been submitted:
	if (isset($_POST['edited'])) {
					
		require_once ('mysqli_connect.php'); // Connect to the db.
			
		$errors = array(); // Initialize an error array.
		
		
		
		/* Check for a class:
		if (empty($_POST['class'])) {
			$errors[] = 'You forgot to enter its class.';
		} else {
			$c = mysqli_real_escape_string($dbc, trim($_POST['class']));
		}*/
		//$c = mysqli_real_escape_string($dbc, trim($_POST['class']));
		
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
	
		 //$cform_number = count($_POST['cform']['cname']); //Get the number of constituent form
		 
		 // Save cform data to arrays for query
		/* for ($i = 0; $i < $cform_number; $i++) {
				$_POST['cform']['cname'][$i];
				// Check for a cname:
				if (empty($_POST['cform']['cname'][$i])) {
					$errors[] = 'You forgot to enter Constituents name.';
				} else {
					$cname[$i] = mysqli_real_escape_string($dbc, trim($_POST['cform']['cname'][$i]));
					//echo $cname[$i];
				}
				
				
				// Check for a pweight:
				if (empty($_POST['cform']['pweight'][$i])) {
					$errors[] = 'You forgot to enter Constituents name.';
				} else {
					$pweight[$i] = mysqli_real_escape_string($dbc, trim($_POST['cform']['pweight'][$i]));
					//echo $pweight[$i];
				}	
	/*			
				// Check for a type:
				if (empty($_POST['cform']['Type'][$i])) {
					$errors[] = 'You forgot to enter the type of Constituents.';
				} else {
					$type[$i] = mysqli_real_escape_string($dbc, trim($_POST['cform']['Type'][$i]));
					//echo $type[$i];
				}
				
				$classification[$i] = mysqli_real_escape_string($dbc, trim($_POST['cform']['classification'][$i]));	
		 }; */
		
	
		//$region_name = mysqli_real_escape_string($dbc, trim($_POST['Regions']));
	
	
				
		// Check if the imege is valid
		if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) { 
		
				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$temp = explode(".", $_FILES["image"]["name"]);
				$extension = end($temp);
				$path = "pics/".$upccode.".jpg";
				if ((($_FILES["image"]["type"] == "image/gif")
				|| ($_FILES["image"]["type"] == "image/jpeg")
				|| ($_FILES["image"]["type"] == "image/jpg")
				|| ($_FILES["image"]["type"] == "image/pjpeg")
				|| ($_FILES["image"]["type"] == "image/x-png")
				|| ($_FILES["image"]["type"] == "image/png"))
				&& ($_FILES["image"]["size"] < 100000000)
				&& in_array($extension, $allowedExts)) {
					if ($_FILES["image"]["error"] > 0){
						$errors[]= "Return Code: " . $_FILES["image"]["error"] . "<br>";
						}
					else
						{
							if (file_exists($path)) {
								unlink($path);
								move_uploaded_file($_FILES["image"]["tmp_name"], $path);
							}
							else {
								move_uploaded_file($_FILES["image"]["tmp_name"], $path);
								//echo "Stored in: " . "pics/" . $_FILES["image"]["name"];
							}
						}
					}
				else {
						$errors[]= "Invalid file";
					}
		} else {
		 $path = "";
		}
		
		
					
					
		if (empty($errors)) { // If everything's OK.
		
			// Put the info in the database...
			
				
			// Make the query:
			$q1 = "UPDATE products SET  product_name='$pn', weight='$w', img_path='$path', total_weight='$t_w', last_updated = '$date'  WHERE upccode = '$upccode';";		
			//$q2 = "INSERT IGNORE INTO constituents (cname, type) VALUES ('$cname', '$type')";
			//$q3 = "INSERT IGNORE INTO regions_recyclability (region_name ,cname , classification)VALUES ('$region_name',  '$cname',  '$classification')";
			//$q4 = "INSERT IGNORE INTO prod_const (upccode, cname, part_weight) VALUES ('$uc', '$cname', '$pweight')";	
			$r1 = @mysqli_query ($dbc, $q1); // Run the first query.
			//$r2 = @mysqli_query ($dbc, $q2);  // Run the second query.
			//$r3 = @mysqli_query ($dbc, $q3);  // Run the second query.
			//$r4 = @mysqli_query ($dbc, $q4);  // Run the second query.
			
		/*	for($i = 0; $i < $cform_number; $i++){
				$q2[$i] = "INSERT IGNORE INTO constituents (cname, type) VALUES ('$cname[$i]', '$type[$i]')";
				$q3[$i] = "INSERT IGNORE INTO regions_recyclability (region_name ,cname , classification)VALUES ('$region_name',  '$cname[$i]',  '$classification[$i]')";
				$q4[$i] = "INSERT IGNORE INTO prod_const (upccode, cname, part_weight) VALUES ('$uc', '$cname[$i]', '$pweight[$i]')";	
				$r2[$i] = @mysqli_query ($dbc, $q2[$i]);  // Run the second query.
				$r3[$i] = @mysqli_query ($dbc, $q3[$i]);  // Run the second query.
				$r4[$i] = @mysqli_query ($dbc, $q4[$i]);  // Run the second query.
			}*/
	
			if ($r1 /*&& (sizeof($r2)==$cform_number) && (sizeof($r3)==$cform_number) && (sizeof($r4)==$cform_number)*/) { // If it ran OK.
			
				// Print a message:
				do_html_header('Done!','center_header');
			  do_html_content('You have now successfully added a new item into the database','center_header');	
			
			} else { // If it did not run OK.
				
				// Public message:
				echo '<div class="error">';
				do_html_header('System Error');
				do_html_error('You could not be registered due to a system error. We apologize for any inconvenience');
				 
				
				// Debugging message:
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q1 . '</p>';
				//echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q2 . '</p>';
				//echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q3 . '</p>';
				//echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q4 . '</p>';
				echo '</div>';
							
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
	do_html_header('Edit this product','center_header');
	echo "
			<form action='edit.php?upccode=".$upccode."' class='form' method='post' enctype='multipart/form-data'>
			 <div id='enterInfo'>
					<label>Upccode:</label><p>$upccode</p><br />
					<label>Product Name:</label>
					<input type='text'  name='product_name'  size='30' maxlength='20' placeholder='Product name' >
					<br />
					<!-- choose weight or volumn-->
					<label style='display:inline'>
						<select id='wORv'>
							<option>Weight</option>
							<option>Volumn</option>
						</select>
						: </label>
					<input type='text' name='weight' size='20' maxlength='10' placeholder='Please enter'  />
					<p id='gORl' style='display:inline'>g</p>
					<br />
					<label style='display:inline'>Total Weight: </label>
					<input type='text' name='t_weight' size='20' maxlength='10' placeholder='Please enter'  />g
					<br />
					
				
				 <label>Change the image: </label>
				 <input type='file' name='image' >
				 <br>";
				 
				 // Count for constituent numbers
				 $clist_count = 0;
				 while($result_clist = mysqli_fetch_array($retrieve_old_clist, MYSQLI_ASSOC)){
					 $clist_count += 1;
					 // Enter new constituent name if needed
					 echo '<label style="display:inline">Constituent name: </label>
					 			 <input type="text" name="cname" size="20" maxlength="15" value="'. $result_clist["cname"]. '">';
					 // Enter new constituent name
					 echo '<label style="display:inline">Part weight: </label>
					 			 <input type="text" name="part_weight" size="20" maxlength="15" value="'. $result_clist["part_weight"]. '">';
					}
				 
	echo"	<br>
				</div>
				<input type='submit' class='button' name='submit' value='Submit' />
				<br />
				<input type='hidden' name='edited' value='TRUE' />
				<br />
			</form>";
	
	
	
	}
	include ('includes/footer.html');
?>