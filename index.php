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

<script>
    $(function(){
      $("#slides").slidesjs({
        width: 800,
				height: 329,
      });
    });
</script>

<div id="slider-wrapper">
<!--    <div class="arrow"> 
    <img class="slidesjs-previous slidesjs-navigation" id="left_arrow" src="images/left-arrow.fw.png" /> 
    <img class="slidesjs-next slidesjs-navigation" id="right_arrow" src="images/right-arrow.fw.png" />
    </div>-->
		<div id="slides"> 
     <!-- <div class="arrows">
        <img class="slidesjs-previous slidesjs-navigation" id="left_arrow" src="images/left-arrow.fw.png" /> 
        <img class="slidesjs-next slidesjs-navigation" id="right_arrow" src="images/right-arrow.fw.png" />
      </div> -->
      <img src="images/recycle_its_easy.jpg" width="800"  alt="Recycling"  /> 
      <img src="images/recycle_its_easy.jpg" width="800"  alt="Recycling"  />
      <img src="images/recycle_its_easy.jpg" width="800"  alt="Recycling"  /> 	
    </div>
</div>


<div class="tile">
  <div id="b-tile">
    <p>fdafds</p>
  </div>
  <div id="o-tile">
    <p>fdafds</p>
  </div>
  <div id="b-tile">
    <p>fdafds</p>
  </div>
  <div id="o-tile">
    <p>fdafds</p>
  </div>
  <div id="b-tile">
    <p>fdafds</p>
  </div>
  <div id="o-tile">
    <p>fdafds</p>
  </div>
</div>

<!--Above are the content of the site-->
<?php include("/includes/footer.html"); ?>
