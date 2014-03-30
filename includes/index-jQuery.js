// jQuery code for index.php
$( document ).ready(function() {
	//Set width for slides. But must be at least 3 images.
  $('.hero-carousel').heroCarousel({
                    css3pieFix: true
                });
	$('.tile:odd').css({'background-color':'#CCCC00', 'text-align':'center',
											 });
	$('.tile:even').css({'background-color':'#78BA00', 'text-align':'center',
											 });	

	if($(window).width() > 1049){
		$('.tile:eq(1), .tile:eq(4)').css({ "margin":"0px 1px"});
		$('.tile:gt(2)').css("margin-top","1px");
	};

	// Get the width of slider and content
	var wrapper_width = $('#slider-wrapper').width();
	
	// Get the width of the content.
	var content_width = $('#content').width();
	
	// Show the content of tiles when mouse is hovering on the tile
	if(content_width > 800){	
		$('.tile').hover(
			function(){
				var tile = $(this);			
				tile.find('> p').hide(200);
				tile.find('.inner-content').show(200);
				
			},
			function(){
				var tile = $(this);
				tile.find('.inner-content').hide(200);
				//fadeTo(function(){
				tile.find('> p').show(200);
				
			});
	} else {
		$('.inner-content').show('normal');
	}

  
	//$('#sign-in').css('width', content_width-wrapper_width -1);

});



$(window).resize(function(){
	if($(window).width() > 1049){
		$('.tile:eq(1), .tile:eq(4)').css({ "margin":"0px 1px"});
		$('.tile:gt(2)').css("margin-top","1px");
	}else {
		$('.tile:eq(1), .tile:eq(4)').css({ "margin":"0px 0px"});
		$('.tile:gt(2)').css("margin-top","0px");
	}
});