<?php

require_once ('mysqli_connect.php');//connect to the database

$cv = $_GET['cv']; //class_val
$rv = $_GET['rv']; //region_val
$kw = $_GET['kw']; //keyword

echo $cv.' and '.$rv;

$q = "SELECT  DISTINCT  products.upccode,company_name, weight, description, parent_company from constituents, products, prod_const, regions_recyclability 
				where products.upccode = prod_const.upccode and products.class ='".$cv."' and regions_recyclability.region_name ='".$rv."'
							and prod_const.cname=constituents.cname 
							and constituents.cname = regions_recyclability.cname order by products.upccode";	

$r = mysqli_query($dbc, $q); // Run the query.
$num = mysqli_num_rows($r);// get the nunber of row

if($num > 0){
	while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
		echo '<tr>
						<td><a id="details" href="view-specific.php?upccode=' . $row['upccode']. '">' . $row['upccode'] . '</a></td>
						<td>' . $row['company_name'].'</td>
						<td>' . $row['weight']. '</td>
						<td>' . $row['description']. '</td>
						<td>' . $row['parent_company']. '</td>
 			 	  </tr>';
	}
}



?>