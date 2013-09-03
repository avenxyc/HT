<!--<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="includes/style.css" type="text/css" media="all" />
<title>Test site</title>
<script src="includes/jquery-1.10.2.js" type="text/javascript"></script>
</head>-->

<?php //This is the home page
	
	$title_name = 'Test site';  //Title name of this page
	include("/includes/header.html"); // include the header file
	echo"<script src='includes/index-jQuery.js' type='text/javascript'></script>" ;
?>
<!-- This is the header, the following content is for the body -->

<!--Script for the slider 
<script>
    $(function(){
      $("#slides").slidesjs({
        width: 800,
				height: 329,
      });
    });
</script>
-->
<div id="slider-wrapper">
	 <!-- Arrows -->
    <div class="arrows" id="left-arrow">
    	<img src="images/left.png" />
    </div>
    <div class="arrows" id="right-arrow">
    	<img src="images/right.png" />	
    </div>
		<div id="slides"> 
    	<ul>
  	   <li><img src="images/recycle_its_easy.jpg" alt="Recycling"  /></li>
       <li><img src="images/recycle_its_easy.jpg" alt="Recycling"  /></li>
       <li><img src="images/recycle_its_easy.jpg" alt="Recycling"  /></li>
       <li><img src="images/recycle_its_easy.jpg" alt="Recycling"  /></li>
       <li><img src="images/recycle_its_easy.jpg" alt="Recycling"  /></li>
       <li><img src="images/recycle_its_easy.jpg" alt="Recycling"  /></li>
       </ul> 	
    </div>
</div>


<div class="tiles">
  <div class="tile">
 	  <p>Title</p>
  	<div class="inner-content">
    	<p>Content</p>  
    </div>
  </div>
  <div class="tile">
  	<p>Title</p>
    <div class="inner-content">
      <p>Content</p>  
    </div>
  </div>
  <div class="tile">
  	<p>Title</p>
    <div class="inner-content">
      <p>Content</p>  
    </div>
  </div>
  <div class="tile">
  	<p>Title</p>
    <div class="inner-content">
      <p>Content</p>  
    </div>
  </div>
  <div class="tile">
  	<p>Title</p>
    <div class="inner-content">
      <p>Content</p>  
    </div>
  </div>
  <div class="tile">
  	<p>Title</p>
    <div class="inner-content">
      <p>Content</p>  
    </div>
  </div>
</div>

<!--Above are the content of the site-->
<?php include("/includes/footer.html"); ?>
