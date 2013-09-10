$(document).ready(function(){
	//Add focus effect when mouse clicks the input area.
	$(":input[type=text]").css({"font":"12px", "color":"#CCCCCC"});
	$(":input[type=text]").focus(function(){
		$(this).addClass('focus');
		$(this).css({"font":"12px", "color":"#000000"});
	}).blur(function(){
		$(this).removeClass('focus');
		$(this).css({"font":"12px", "color":"#CCCCCC"});
	});
		
	

	});
	
	
$(window).resize(function(){
	// add divider to the nav-bar;
	if($(window).width() > 799 ){
		 $("#mainHeader li:lt(3)").css({"border-right": "1px solid #999"});
	}else {
		$("#mainHeader li:lt(3)").css({"border-right": "none"})
	};
})
	