// jQuery code for index.php

$(document).ready(function(){
	$('.tiles :odd').css({'background-color':'#3366ff', 'text-align':'center',
											 });
	$('.tiles :even').css({'background-color':'#ff9900', 'text-align':'center',
											 });	
	$('#tile_1, #tile_4').css({"width":"268px", "margin":"0px 1px"});
	$('#tile_0,#tile_2, #tile_3,#tile_5').css("width","265px");
	$('#tile_2~div').css("margin-top","1px");
	
	$('.tiles > div').hover(function(){
		var text_content = $(this).val();
		$(this).text('Test test').css("z-index","99")
					 .animate({width:"280px",height:"170px"},fast);
					 },function(){
						 $(this).text(text_content);
					 });
											 

});