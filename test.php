<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<head>
<title>Untitled Document</title>
	<script src="http://code.jquery.com/jquery-latest.min.js"></script>

  <script>
	$(document).ready(function(){
		var len = $('#my_slider li').length;
		var i = 0;
		$('#my_slider li').click(function(){
			if((i+1)%len != 0){
			$('li').animate({width:'-=150px'});	
			$('li').nextAll().animate({left:'-=150px'});
			
			
			};
		});
	});
  </script>
  <style>
	body {
		background-color: #eeeeee;
		margin:0;	
		padding:0;
	}
	
	.example {
		background:#FFFFFF;
		width:400px;
		border:1px #000000 solid;
		overflow:hidden;
		position: relative;
		margin: 20px auto;
		padding: 15px;
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
	}
	
	/*My slider style */
	#my_slider {
		width: 1000px;
		height:340px;;
		overflow: hidden;
		list-style: none;
		padding:0;
		margin:0;
	}
	#my_slider li{
		left: -50px;
	}
	
	#my_slider li {
		display: inline-block;
		position: relative;
	
	}
	
	#counter {
		text-align: right;
		font-size: 16px;
		width: 500px;
	}
	
	img {
		height: 300px;
		
	}
	
	</style>
  

</head>
	<body>
	<div class="example">
	    <h3><a href="#">My Slider example</a></h3>
	    <ul id="my_slider">
	      <li><img src="Komal-Jha-Hot-Photo-Shoot-Photos-1952.jpg" alt="" /></li>
	      <li><img src="Komal-Jha-Hot-Photo-Shoot-Photos-1952.jpg" alt="" /></li>
        <li><img src="Komal-Jha-Hot-Photo-Shoot-Photos-1952.jpg" alt="" /></li>
        <li><img src="Komal-Jha-Hot-Photo-Shoot-Photos-1952.jpg" alt="" /></li>
        <li><img src="Komal-Jha-Hot-Photo-Shoot-Photos-1952.jpg" alt="" /></li>
        <li><img src="Komal-Jha-Hot-Photo-Shoot-Photos-1952.jpg" alt="" /></li>
        <li><img src="Komal-Jha-Hot-Photo-Shoot-Photos-1952.jpg" alt="" /></li>
	    </ul>
	     <div id="counter"></div>
 </div>
 </body>
 </html>
