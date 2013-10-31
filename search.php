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
	color: #0066FF;
}


#output tr:nth-child(odd) {
	background-color: rgba(255,255,255,1);
}
#output tr:nth-child(even) {
	background-color: rgba(153,204,0,0.6);
}


</style>

<?php //Search Page

$title_name= 'Search';
include ('includes/header.html');
session_start();

echo "<script src=\"includes/Search-Ajax.js\"></script>";

require_once ('mysqli_connect.php');//connect to the database

//The class option
// Make the query:
	echo '<div id="filter">
					<a href="images/recycle_page_image.jpg" > <img id="search_background_image" src="images/recycle_page_image_half.jpg"></img> </a>
					<div id="search_wrapper">';
					$cq = "SELECT *  from item_class order by class_name ASC";		
					$cqrow = mysqli_query ($dbc, $cq); // Run the query.
					echo '<select id="class">';
					while($crow = mysqli_fetch_array($cqrow, MYSQLI_ASSOC)){
						echo '<option value="'.$crow["class_name"].'">'.$crow['class_name'].'</option>';
					}
					echo '</select>';
					
					$rq = "SELECT * from regions order by region_name ASC";
					$rqrow = mysqli_query($dbc, $rq);
					echo '<select id="region">';
					while($rrow = mysqli_fetch_array($rqrow, MYSQLI_ASSOC)){
						echo '<option value="'.$rrow["region_name"].'">'.$rrow['region_name'].'</option>';
					}
					echo '</select>';
					
					echo '<div id="keyword_wrap">  Keyword:<input id="keyword"></input></div>';
					echo '<button id="submit" value="submit">Search</button>';
			if(isset($_SESSION['valid_user'])){
				echo '<a href="add.php">
   						 <button id="add_p">Add new product</button>
							</a>';
			}
					
			echo	'</div></div>';
	
	echo '<div id="result">';
	require_once ('mysqli_connect.php');//connect to the database

	
	// query
	$default_region = 'Cape Breton';
	$q = "SELECT  DISTINCT  products.upccode, weight, product_name, last_updated
			  FROM constituents, products, prod_const, regions_recyclability 
				WHERE	 products.upccode = prod_const.upccode
					 and prod_const.cname = constituents.cname 
					 and constituents.cname = regions_recyclability.cname
					 and regions_recyclability.region_name = 'Cape Breton'
				ORDER BY products.upccode";	
	
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
							<td><a id="details" href="view-specific.php?upccode=' . $row['upccode'].'&region='.$default_region.'">' . $row['upccode'] . '</a></td>
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
	} else {
		do_html_content('No data in the database', 'no_data');
	}

	echo '</div>';
	
//Above are the content of the site
include("/includes/footer.html"); 
		
?>

