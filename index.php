<?php //This is the home page
	$title_name = 'Test site';  //Title name of this page
	include("/includes/header.html"); // include the header file
	echo "<script src='includes/index-jQuery.js' type='text/javascript'></script>" ;
	echo "<script src='includes/jquery.heroCarousel-1.3/jquery.heroCarousel-1.3.js' type='text/javascript'></script>" ;
	echo "<script src='includes/jquery.heroCarousel-1.3/jquery.easing-1.3.js' type='text/javascript'></script>" ;
	echo '<link rel="stylesheet" href="includes/jquery.heroCarousel-1.3/jquery.heroCarousel.css" type="text/css" media="all" />';
?>
<!-- This is the header, the following content is for the body -->


<div id="mainContent">
  <div id="slider-wrapper">
      <div class="hero"> 
      	<div class="hero-carousel">
          <article>
          	<img src="images/recycle_its_easy.jpg" alt="Recycling"/>
          </article>
          <article>
          	<img src="images/recycle_its_easy.jpg" alt="Recycling"/>
          </article>
          <article>
          	<img src="images/recycle_its_easy.jpg" alt="Recycling"/>
          </article>
         </div>
                

      </div>
  </div>
  


<div class="tiles">
  <div class="tile">
 	  <p>This is a tile that is for test purpose</p>
  	<div class="inner-content">
    	<p>I apply different background-color values to the thead, tr, and tr.odd elements. The problem is that in most browsers, every cell has an unwanted border which is not the color of any of the table rows. Only in Firefox 3.5 does the table have no borders in any cell.</p>  
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
