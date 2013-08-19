<?php //Search Page

$title_name= 'Search';
include ('includes/header.html');

echo "<script src=\"includes/Search-Ajax.js\"></script>";

require_once ('mysqli_connect.php');//connect to the database

//The class option
// Make the query:
	echo '<div id="filter">';
		$cq = "SELECT *  from item_class order by class_name ASC";		
		$cqrow = mysqli_query ($dbc, $cq); // Run the query.
		echo '<select id="class">';
		while($crow = mysqli_fetch_array($cqrow, MYSQLI_ASSOC)){
			echo '<option value="'.$crow["class_name"].'">'.$crow['class_name'].'</option>';
		}
		echo '</select><br />';
		
		$rq = "SELECT * from regions order by region_name ASC";
		$rqrow = mysqli_query($dbc, $rq);
		echo '<select id="region">';
		while($rrow = mysqli_fetch_array($rqrow, MYSQLI_ASSOC)){
			echo '<option value="'.$rrow["region_name"].'">'.$rrow['region_name'].'</option>';
		}
		echo '</select>';
		
		echo '<div id="keyword_wrap"><p style="color:white">Please enter a keyword: </p><input id="keyword"></input></div>';
		echo '<button id="submit" value="submit">Search</button>';
	echo '</div>';
	
	echo '<div id="result"><p>Your result will be shown here</div>';
	
	
		
?>

