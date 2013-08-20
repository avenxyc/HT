<?php 
// This script retrieves all the records from the database.

$title_name= 'View';
include ('includes/header.html');
echo "<script src=\"includes/view-specific-jQuery.js\"></script>";

// Get the upccode and region_val
$upccode = $_GET['upccode'];
$rv = $_GET['region'];


require_once ('mysqli_connect.php'); // Connect to the db.

$q1 = "SELECT * from products where products.upccode= ".$upccode.";";
$Pinfo = mysqli_query($dbc,$q1);
$product = mysqli_fetch_assoc($Pinfo);


//Web Page layout.
echo '<br /><div id="view-specific-detail">';
echo '<div id="view-specific-image"></div>';
echo '<div id="view-specific-info">
				<p class="title">Product Name: </p>
				<p class="info">'.$product['description'].'</p>
				<p class="title">UPC code: </p>
				<p class="info">'.$product['upccode'].'</p>
				<p class="title">Company Name: </p>
				<p class="info">'.$product['company_name'].'</p>
				<p class="title">Parent Company Name: </p>
				<p class="info">'.$product['parent_company'].'</p>
				<p class="title">Weight/Volumn: </p>
				<p class="info">'.$product['weight'].'(g/L)</p>
				
			
			</div>';
echo '</div>';





		
// Make the query:
$q = "SELECT * from constituents, products, prod_const, regions_recyclability 
				where products.upccode = prod_const.upccode and prod_const.upccode= ".$upccode."
							and prod_const.cname=constituents.cname and regions_recyclability.region_name ='".$rv."'
							and constituents.cname = regions_recyclability.cname order by regions_recyclability.region_name";		
$r = mysqli_query($dbc, $q); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r);

if ($num > 0) { // If it ran OK, display the records.

	// Print how many users there are:
	echo "<p>This is the detail information for ". $upccode."</p>\n";
	
	// Fetch and print all the records:
	  echo '<p><table border="2">';
		echo '<tr>
				<th>Product Name</th>
				<th>parent_company</th>
				<th>constituent name</th>
				<th>constituent weight</th>
				<th>C percentage</th><br/ >
				<th>type</th>
				<th>region</th>
			  </tr>';
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		echo '<tr>
				<td>' . $row['description']. '</td>
				<td>' . $row['parent_company']. '</td>
				<td>' . $row['cname']. '</td>
				<td>' . $row['part_weight']. '</td>
				<td>' . number_format($row['part_weight']/$row['weight'], 2). '</td>
				<td>' . $row['type']. '</td>
				<td>' . $row['region_name']. '</td>
			  </tr>';
	}
	  echo '</table></p>';
	
	mysqli_free_result ($r); // Free up the resources.	

} else { // If no records were returned.

	echo '<p class="error">There are currently no data.</p>';

}

mysqli_close($dbc); // Close the database connection.

include ('includes/footer.html');
?>
