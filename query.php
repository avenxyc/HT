<!-- For searching items -->

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

.s-button {
    background: rgba(0,153,255,0.6);
    border-width: 0;
    color: #FFF;
    cursor: pointer;
    display: inline-block;
    font: 12px;
    width: 150px;
		height: 20px;
}

.no_data {
	text-align:center;
	background-color: rgba(0,204,51,0.1);
	padding: 10px 0px;;
	width: 100%;
	font: "Times New Roman", Times, serif;
	font-size:24px;
	border-radius: 10px;
}


</style>

<?php

require_once ('mysqli_connect.php');//connect to the database
session_start();



$cv = $_GET['cv']; //class_val
$rv = $_GET['rv']; //region_val
$kw = $_GET['kw']; //keyword



// query
$q = "SELECT  DISTINCT  products.upccode, weight, product_name, last_updated from constituents, products, prod_const, regions_recyclability 
				where products.upccode = prod_const.upccode and products.class ='$cv' and regions_recyclability.region_name ='$rv'
							and (products.product_name like '%$kw%' or products.upccode like '%$kw%') 
							and prod_const.cname=constituents.cname 
							and constituents.cname = regions_recyclability.cname order by products.upccode";	

$r = mysqli_query($dbc, $q); // Run the query.
$num = mysqli_num_rows($r);// get the number of row

if($num > 0){
		echo '<table id="output" border="1">
						<tr>
							<th>UPC code</th>
							<th>Product Name</th>
							<th class="extra">Weight/Volumn(g/L)</th>
							<th class="extra">Modified date</th>
							<th class="extra">Action</th>
						</tr>';

		while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
			echo '<tr>
							<td><a id="details" href="view-specific.php?upccode=' . $row['upccode'].'&region='.$rv. '">' . $row['upccode'] . '</a></td>
							<td>' . $row['product_name']. '</td>
							<td class="extra">' . $row['weight']. '</td>
							<td class="extra">' . $row['last_updated']. '</td>';
						if(isset($_SESSION['valid_user'])){	
							echo '<td  class="extra"><a href="edit.php?upccode='.$row["upccode"].'">
											<button type="button" class="s-button" style="width: 40px" >Edit</button></a>
										</td>';
						} else { 
							echo '<td class="extra">---</td>';
						}
			echo	'</tr>';
			}
		echo '</table>';
} else {
	echo '<p class="no_data">No data in the database</p>';
}



?>