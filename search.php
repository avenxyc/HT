<style>
#output {
	width: 100%;
	text-align:center;
	border-collapse:collapse;
	border: 1px solid white;
	color: #0066FF;
}

#output td {
	border: 1px solid white;
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

echo "<script>
			$(document).ready(function(){
				$('#output').show('normal');
			});
			
			</script>";

echo "<script src=\"includes/Search-Ajax.js\"></script>";


require_once ('mysqli_connect.php');//connect to the database

if(isset($_GET['delete'])){
		$upccode = $_GET['upccode'];
		$delete_q1 = "DELETE FROM prod_const WHERE prod_const.upccode = $upccode";
		$delete_q2 = "DELETE FROM products WHERE products.upccode = $upccode";
		$run_delete1 = mysqli_query($dbc, $delete_q1);
		$run_delete2 = mysqli_query($dbc, $delete_q2);
	
}

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
					echo '<button class="s-button" value="submit">Search</button>';
			if(isset($_SESSION['valid_user'])){
				echo '<a href="add.php">
   						 <button class="s-button" id="add_p">Add new product</button>
							</a>';
			}
					
			echo	'</div></div>';
	
	echo '<div id="result">';
	require_once ('mysqli_connect.php');//connect to the database

	
	// Run the query
	$default_region = 'Valley';
	$q = "SELECT  DISTINCT  products.upccode, weight, product_name, last_updated
			  FROM constituents, products, prod_const, regions_recyclability 
				WHERE	 products.upccode = prod_const.upccode
					 and prod_const.cname = constituents.cname 
					 and constituents.cname = regions_recyclability.cname
					 and regions_recyclability.region_name = 'Cape Breton'
				ORDER BY products.upccode";	
	
	$r = mysqli_query($dbc, $q); // Return a mysqli_result object if successful, otherwise return false
	$num = mysqli_num_rows($r);// get the nunber of row
	
	if($num > 0){
			echo '<table id="output">
							<tr>
								<th>UPC code</th>
								<th>Product Name</th>
								<th class="extra">Weight/Volumn(g/L)</th>
								<th class="extra">Modified date</th>
								<th class="extra">Action</th>
							</tr>';
			while ($row = mysqli_fetch_array($r, MYSQLI_ASSOC)){
			echo '<tr>
							<td><a id="details" href="view-specific.php?upccode=' . $row['upccode'].'&region='.$default_region.'">' . $row['upccode'] . '</a></td>
							<td>' . $row['product_name']. '</td>
							<td class="extra">' . $row['weight']. '</td>
							<td class="extra">' . $row['last_updated']. '</td>';
						if(isset($_SESSION['valid_user'])){	
							echo '<td class="extra"><a href="edit.php?upccode='.$row["upccode"].'"><button style="width: 40px" class="s-button" type="button">Edit</button></a></td>';
						} else { 
							echo '<td class="extra">---</td>';
						}
			echo	'</tr>';
			}
			echo '</table>';
	} else {
		do_html_content('No data in this region.', 'no_data');
	}

	echo '</div>';
	
	mysqli_close($dbc);
	
//Above are the content of the site
include('/includes/footer.html'); 
		
?>

