$(document).ready(function(){

	$(":input").focus(function(){
		$(this).addClass('focus');
	}).blur(function(){
		$(this).removeClass('focus');
	});
	
	
	$(":input[type=text]").css({"font":"12px", "color":"#CCCCCC"});
	// add diveider to the nav-bar;
	var new_width = $("#nav-bar li").width() - 1;
	$("#nav-bar li:lt(3)").css({"border-right": "1px solid white",
														  "width": new_width});
	
	
	});