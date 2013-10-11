<script>
$(document).ready(function(){
	$('#output').show('normal');
});

</script>

<style>
#output {
	width: 100%;
	text-align:center;
	border-collapse:collapse;
}


#output tr:nth-child(odd) {
	background-color: rgba(255,255,255,1);
}
#output tr:nth-child(even) {
	background-color: rgba(153,204,0,0.6);
}


</style>

<?php

require_once ('mysqli_connect.php');//connect to the database
session_start();



$cv = $_GET['cv']; //class_val
$rv = $_GET['rv']; //region_val
$kw = $_GET['kw']; //keyword


echo $cv;
echo $rv;

// query
$q = "SELECT  DISTINCT  products.upccode, weight, product_name, last_updated from constituents, products, prod_const, regions_recyclability 
				where products.upccode = prod_const.upccode and products.class ='".$cv."' and regions_recyclability.region_name ='".$rv."'
							and prod_const.cname=constituents.cname 
							and constituents.cname = regions_recyclability.cname order by products.upccode";	

$r = mysqli_query($dbc, $q); // Run the query.
$num = mysqli_num_rows($r);// get the nunber of row

if($num > 0){
		echo '<table id="output" border="1">
						<tr>
							<th>UPC code</th>
							<th>Product Name</th>
							<th>Weight/Volumn(g/L)</th>
							<th>Modified date</th>
							<th>Action</th>
						</tr>';

		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
			echo '<tr>
							<td><a id="details" href="view-specific.php?upccode=' . $row['upccode'].'&region='.$rv. '">' . $row['upccode'] . '</a></td>
							<td>' . $row['product_name']. '</td>
							<td>' . $row['weight']. '</td>
							<td>' . $row['last_updated']. '</td>';
						if(isset($_SESSION['valid_user'])){	
							echo '<td><a href="edit.php?upccode='.$row["upccode"].'"><button type="button">Edit</button></a></td>';
						} else { 
							echo '<td>---</td>';
						}
			echo	'</tr>';
			}
		echo '</table>';
}



?>