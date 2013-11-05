// jQuery code for index.php
$( document ).ready(function() {
	//Set width for slides. But must be at least 3 images.		
	$('.tile:odd').css({'background-color':'#CCCC00', 'text-align':'center',
											 });
	$('.tile:even').css({'background-color':'#78BA00', 'text-align':'center',
											 });	

	if($(window).width() > 1049){
		$('.tile:eq(1), .tile:eq(4)').css({ "margin":"0px 1px"});
		$('.tile:gt(2)').css("margin-top","1px");
	};
	/*$('.tile').hover(function(){
		var text_content = $(this).val();
		$(this).text('Test test').css("z-index","99")
					 .animate({width:"280",height:"170"},fast);
					 },function(){
						 $(this).text(text_content);
					 });
*/
	var i = 0;

/*The slider provide a alider effect;
	$('#left-arrow').click(function(){
		var lg = $("#slides li").length;
			if(i < lg - 2){
				$('#slides li').animate({left:'-=700px'});
				i++;
			}else{
				// An elastic efftect
				$('#slides li').animate({left:'-=50px'})
											 .animate({left:'+=50px'});
			}
		});

	
	$('#right-arrow').click(function(){
			if(i >= 0){
				$('#slides li').animate({left:'+=700px'});
				i--;
			}else{
				// An elastic efftect
				$('#slides li').animate({left:'+=50px'})
											 .animate({left:'-=50px'});
			}
		});
		
*/	
	var wrapper_width = $('#slider-wrapper').width();
	var content_width = $('#content').width();
	
	if(content_width > 800){	
		$('.tile').hover(
			function(){
				var tile = $(this);			
				//tile.find('> p').stop().fadeOut(function(){
						tile.find('.inner-content').stop(true).fadeTo(200, 1);
				//})
			},
			function(){
				var tile = $(this);
				tile.find('.inner-content').stop(true).fadeTo(200, 0);//(function(){
				//		tile.find('> p').fadeIn('fast');
				///})
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