<?php 
// This script retrieves all the records from the database.

$title_name= 'View';
include ('includes/header.html');
echo "<script type=\"text/javascript\" src=\"includes/view-specific-jQuery.js\"></script>";
echo "<script type=\"text/javascript\" src=\"https://www.google.com/jsapi\"></script>";

				
// Get the upccode and region_val
$upccode = $_GET['upccode'];
$rv = $_GET['region'];


require_once ('mysqli_connect.php'); // Connect to the db.

// Get the product info
$q1 = "SELECT * from products where products.upccode= ".$upccode.";";
$Pinfo = mysqli_query($dbc,$q1);
$product = mysqli_fetch_assoc($Pinfo);


$q2 = "SELECT part_weight, weight, classification, product_name from prod_const , products, regions_recyclability
				where products.upccode = prod_const.upccode and prod_const.upccode= ".$upccode." 
					and regions_recyclability.cname = prod_const.cname and regions_recyclability.region_name = '".$rv."';";	

$r1 = mysqli_query($dbc, $q2); // Run the query.
// Count the number of returned rows:
$n = mysqli_num_rows($r1);
$part_weight_total = 0;
$total_weight = 0;
$unrecyc_weight = 0;
$recyc_weight = 0;
while($row = mysqli_fetch_assoc($r1)){
	if($row['classification'] == 'Clear Garbage Bag'){
		$unrecyc_weight += $row['part_weight'];
	}else{
	  $recyc_weight += $row['part_weight'];
	}
		$total_weight = $row['weight'];
}

echo $row['part_weight'];

//Web Page layout.
echo '<br /><div id="view-specific-detail">';
echo '<div id="view-specific-image"></div>';
echo '<div id="view-specific-info">
				<p class="title">Product Name: </p>
				<p class="info">'.$product['product_name'].'</p>
				<p class="title">UPC code: </p>
				<p class="info">'.$product['upccode'].'</p>
				<p class="title">Company Name: </p>
				<p class="info">'.$product['company_name'].'</p>
				<p class="title">Parent Company Name: </p>
				<p class="info">'.$product['parent_company'].'</p>
				<p class="title">Weight/Volumn: </p>
				<p class="info">'.$product['weight'].'(g/L)</p>
				<p class="title">Recyclability</p>
				<p class="info">'.number_format($recyc_weight / ($unrecyc_weight+$recyc_weight),2).'</p>
			
				
			
			</div>';
echo '</div>';






		
// Make the query:
$q3 = "SELECT * from constituents, products, prod_const, regions_recyclability 
				where products.upccode = prod_const.upccode and prod_const.upccode= ".$upccode."
							and prod_const.cname=constituents.cname and regions_recyclability.region_name ='".$rv."'
							and constituents.cname = regions_recyclability.cname order by regions_recyclability.region_name";		
$r2 = mysqli_query($dbc, $q3); // Run the query.

// Count the number of returned rows:
$num = mysqli_num_rows($r2);

$rowset[] =array();
$i = 0;

if ($num > 0) { // If it ran OK, display the records.
	
	// Fetch and print all the records:
	  echo '<table id="view-specific-table" border="1">';
		echo '<tr>
						<th>constituent name</th>
						<th>constituent weight</th>
						<th>Percentage</th><br/ >
						<th>type</th>
						<th>region</th>
					</tr>';
	while ($row = mysqli_fetch_array($r2, MYSQLI_ASSOC)){
		$rowset[$i] = $row;
		$i++;
		echo '<tr>
						<td>' . $row['cname']. '</td>
						<td>' . $row['part_weight']. '</td>
						<td>' . number_format($row['part_weight']/$row['weight'], 2). '</td>
						<td>' . $row['type']. '</td>
						<td>' . $row['region_name']. '</td>
			 	 </tr>';
	}
	  echo '</table>';
	
	mysqli_free_result ($r2); // Free up the resources.	

} else { // If no records were returned.

	echo '<p class="error">There are currently no data.</p>';

}



echo "<script type=\"text/javascript\">
      google.load(\"visualization\", \"1\", {packages:[\"corechart\"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Name', 'Weight'],";
          foreach( $rowset as $value){
						echo "['".$value['cname']."',".$value['part_weight']."],";
					}
echo      "]);

        var options = {
          title: 'Percetage of Consituents',
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>";
echo '	<div id="piechart_3d" style="width: 800px; height: 400px;"></div>';		



mysqli_close($dbc); // Close the database connection.

include ('includes/footer.html');
?>
