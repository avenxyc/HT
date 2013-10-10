<?php //Edit a product
	$title_name = "Edit product";
	
	include("includes/header.html");
	include("includes/functions.php");
	
	$upccode = $_GET['upccode'];
	
	echo "<script src=\"includes/add-jQuery.js\"></script>";
	
	require_once ('mysqli_connect.php');//connect to the database
	
  // Make the query:
	$cq = "SELECT *  from item_class order by class_name ASC";		
	$cqrow = mysqli_query ($dbc, $cq); // Run the query.


	// Check if the form has been submitted:
	if (isset($_POST['submitted'])) {
					
		require_once ('mysqli_connect.php'); // Connect to the db.
			
		$errors = array(); // Initialize an error array.
		
		
		
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
			$pn = 'Not applicable';
		} else {
			$pn = mysqli_real_escape_string($dbc, trim($_POST['product_name']));
		}
	
		// Check for weight:
		if (empty($_POST['weight'])) {
			$errors[] = 'You forgot to enter the product weight.';
		} else {
			$w = mysqli_real_escape_string($dbc, trim($_POST['weight']));
		}
		
		// Check for total weight
		if (empty($_POST['t_weight'])) {
			$errors[] = 'You forgot to enter the product weight.';
		} else {
			$t_w = mysqli_real_escape_string($dbc, trim($_POST['t_weight']));
		}
	
		 $cform_number = count($_POST['cform']['cname']); //Get the number of constituent form
		 
		 // Save cform data to arrays for query
		 for ($i = 0; $i < $cform_number; $i++) {
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
				
				// Check for a type:
				if (empty($_POST['cform']['Type'][$i])) {
					$errors[] = 'You forgot to enter the type of Constituents.';
				} else {
					$type[$i] = mysqli_real_escape_string($dbc, trim($_POST['cform']['Type'][$i]));
					//echo $type[$i];
				}
				
				$classification[$i] = mysqli_real_escape_string($dbc, trim($_POST['cform']['classification'][$i]));	
		 }; 
		
	
		$region_name = mysqli_real_escape_string($dbc, trim($_POST['Regions']));
	
	
		
		// Check if the imege is valid
		if (isset($_FILES['image']) && $_FILES['image']['size'] > 0) { 
		
			/*//This is the directory where images will be saved
				$target = "pics/";
				$target = $target . basename( $_FILES['image']['name']);
				
				//This gets all the other information from the form
				$content = basename( $_FILES['image']['name']);
				
				
				//Writes the Filename to the server
				if(move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
						//Tells you if its all ok
						echo "The file ". basename( $_FILES['image']['name']). " has been uploaded, and your information has been added to the directory";
	
	
				} else {
						//Gives and error if its not
						echo "Sorry, there was a problem uploading your file.";
				}
	
				
	
		 
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
				}*/
				
				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$temp = explode(".", $_FILES["image"]["name"]);
				$extension = end($temp);
				$path = "pics/" . $_FILES["image"]["name"];
				if ((($_FILES["image"]["type"] == "image/gif")
				|| ($_FILES["image"]["type"] == "image/jpeg")
				|| ($_FILES["image"]["type"] == "image/jpg")
				|| ($_FILES["image"]["type"] == "image/pjpeg")
				|| ($_FILES["image"]["type"] == "image/x-png")
				|| ($_FILES["image"]["type"] == "image/png"))
				&& ($_FILES["image"]["size"] < 20000000)
				&& in_array($extension, $allowedExts)) {
					if ($_FILES["image"]["error"] > 0){
						echo "Return Code: " . $_FILES["image"]["error"] . "<br>";
						}
					else
						{
							echo "Upload: " . $_FILES["image"]["name"] . "<br>";
							echo "Type: " . $_FILES["image"]["type"] . "<br>";
							echo "Size: " . ($_FILES["image"]["size"] / 1024) . " kB<br>";
							echo "Temp file: " . $_FILES["image"]["tmp_name"] . "<br>";
				
							if (file_exists("pics/" . $_FILES["image"]["name"])) {
								echo $_FILES["image"]["name"] . " already exists. ";
							}
							else {
								move_uploaded_file($_FILES["image"]["tmp_name"], $path);
								echo "Stored in: " . "pics/" . $_FILES["image"]["name"];
							}
						}
					}
				else {
						echo "Invalid file";
					}
	
		}
		
	
					
					
		if (empty($errors)) { // If everything's OK.
		
			// Put the info in the database...
			
				
			// Make the query:
			$q1 = "UPDATE product SET class='$c', company_name='$cn',parent_company='$pc', product_name='$pn', weight='$w', img_path=$path, total_weight='$t_w' WHERE upccode = ".$upccode.";";		
			//$q2 = "INSERT IGNORE INTO constituents (cname, type) VALUES ('$cname', '$type')";
			//$q3 = "INSERT IGNORE INTO regions_recyclability (region_name ,cname , classification)VALUES ('$region_name',  '$cname',  '$classification')";
			//$q4 = "INSERT IGNORE INTO prod_const (upccode, cname, part_weight) VALUES ('$uc', '$cname', '$pweight')";	
			$r1 = @mysqli_query ($dbc, $q1); // Run the first query.
			//$r2 = @mysqli_query ($dbc, $q2);  // Run the second query.
			//$r3 = @mysqli_query ($dbc, $q3);  // Run the second query.
			//$r4 = @mysqli_query ($dbc, $q4);  // Run the second query.
			
			for($i = 0; $i < $cform_number; $i++){
				$q2[$i] = "INSERT IGNORE INTO constituents (cname, type) VALUES ('$cname[$i]', '$type[$i]')";
				$q3[$i] = "INSERT IGNORE INTO regions_recyclability (region_name ,cname , classification)VALUES ('$region_name',  '$cname[$i]',  '$classification[$i]')";
				$q4[$i] = "INSERT IGNORE INTO prod_const (upccode, cname, part_weight) VALUES ('$uc', '$cname[$i]', '$pweight[$i]')";	
				$r2[$i] = @mysqli_query ($dbc, $q2[$i]);  // Run the second query.
				$r3[$i] = @mysqli_query ($dbc, $q3[$i]);  // Run the second query.
				$r4[$i] = @mysqli_query ($dbc, $q4[$i]);  // Run the second query.
			}
	
			if ($r1 && (sizeof($r2)==$cform_number) && (sizeof($r3)==$cform_number) && (sizeof($r4)==$cform_number)) { // If it ran OK.
			
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
	do_html_header('Edit this product');
	echo "
				<form action='edit.php' id='form1' method='post' enctype='multipart/form-data'>
			 <div id='enterInfo'>
					<p>Upccode: $upccode</p>
					<p>Product Name: <input type='text'  name='product_name'  size='30' maxlength='20' value='Please enter' ></p>    
					<p>Class:
					<select name='class'>";
						while ($crow = mysqli_fetch_array($cqrow, MYSQLI_ASSOC)){
						echo "<option value='".$crow['class_name']."'>".$crow['class_name']."</option>";
						};
	echo		 "</select></p>
					<p>Company_name: <input type='text' name='company_name' size='20' maxlength='80' value='Please enter'  /> </p>
					<p>Parent_company: <input type='text' name='parent_company' size='20' maxlength='80' value='Please enter'  /> </p>
					<!-- choose weight or volumn-->
					<p style='display:inline'>
								<select id='wORv'>
								<option>Weight</option>
								<option>Volumn</option>
								</select>
								: <input type='text' name='weight' size='20' maxlength='10' value='Please enter'  /><p id='gORl' style='display:inline'>g</p>
							</p>
					<p style='display:inline'>Total Weight: <input type='text' name='t_weight' size='20' maxlength='10' value='Please enter'  />g</p>
					 
					<p>Number of constituents:
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
					</div>
					<p><input type='submit' id='send' name='submit' value='Submit' /></p>
				
				 
					<input type='hidden' name='submitted' value='TRUE' />
				</form>";
	
	
	

	include ('includes/footer.html');
?>