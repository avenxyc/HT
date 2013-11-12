$(document).ready(function(){
	/*Add focus effect when mouse clicks the input area.
	$(":input[type=text]").css({"color":"#CCCCCC"});
	$(":input[type=text]").focus(function(){
		$(this).addClass('focus');
		$(this).css({"color":"#000000"});
	}).blur(function(){
		$(this).removeClass('focus');
		$(this).css({"color":"#CCCCCC"});
	});
	*/	
	if($(window).width() > 799 ){
		 $("#mainHeader li:lt(3)").css({"border-right": "1px solid #999"});
	}


	$('a.login-window').click(function() {
			
							//Getting the variable's value from a link 
			var loginBox = $(this).attr('href');
	
			//Fade in the Popup
			$(loginBox).fadeIn(300);
			
			//Set the center alignment padding + border see css style
			var popMargTop = ($(loginBox).height() + 24) / 2; 
			var popMargLeft = ($(loginBox).width() + 24) / 2; 
			
			$(loginBox).css({ 
					'margin-top' : -popMargTop,
					'margin-left' : -popMargLeft
			});
			
			// Add the mask to body
			$('body').append('<div id="mask"></div>');
			$('#mask').fadeIn(300);
			
			return false;
	});
	
	// When clicking on the button close or the mask layer the popup closed
	$('a.close, #mask').on('click', function() { 
		$('#mask , .login-popup').fadeOut(300 , function() {
			$('#mask').remove();  
	}); 
	return false;
	});
	
	$("#kb-dropdown").hide();
	$("#kbclick").mouseover(function () {
		$("#kb-dropdown").slideDown('slow');
	});
	
	$("#drop-wrapper").mouseleave( function() {
		$("#kb-dropdown").slideUp('slow');
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


