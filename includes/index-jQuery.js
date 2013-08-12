// jQuery code for index.php

$(document).ready(function(){
	$('.tile:odd').css({'background-color':'#3366ff', 'text-align':'center',
											 });
	$('.tile:even').css({'background-color':'#ff9900', 'text-align':'center',
											 });	
	$('.tile:eq(1), .tile:eq(4)').css({"width":"268px", "margin":"0px 1px"});
	$('.tile:eq(0), .tile:eq(2), .tile:eq(3),.tile:eq(5)').css("width","265px");
	$('.tile:gt(2)').css("margin-top","1px");
	
	/*$('.tile').hover(function(){
		var text_content = $(this).val();
		$(this).text('Test test').css("z-index","99")
					 .animate({width:"280",height:"170"},fast);
					 },function(){
						 $(this).text(text_content);
					 });
*/
	var i = 0;

//The slider provide a alider effect;
	$('#left-arrow').click(function(){
			if(i <= 0){
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
		
		
	$('.tile').hover(
		function(){
			var tile = $(this);
			//$(this).find('inner-content').slidedown('slow');
			tile.find('> p').stop().fadeOut(function(){
					tile.find('.inner-content').fadeIn('fast');
			//$(this).find('inner-content').slideUp('slow');
			})
		},
		function(){
			var tile = $(this);
			tile.find('.inner-content').stop().fadeOut(function(){
					tile.find('> p').fadeIn('fast');
			})
		});
			

											 

});