$(document).ready(function(){
	//Add focus effect when mouse clicks the input area.
	$(":input[type=text]").css({"font":"12px", "color":"#CCCCCC"});
	$(":input").focus(function(){
		$(this).addClass('focus');
		$(this).css({"font":"12px", "color":"#000000"});
	}).blur(function(){
		$(this).removeClass('focus');
		$(this).css({"font":"12px", "color":"#CCCCCC"});
	});
		
	
	// add divider to the nav-bar;
	var new_width = $("#nav-bar li").width() - 1;
	$("#nav-bar li:lt(3)").css({"border-right": "1px solid white",
														  "width": new_width});
	
	
	});