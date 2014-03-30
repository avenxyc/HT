/*
 *Author: Yichuan Xu
 *File name: my-jQuery.js
 *Purpose: Manipulate the web layout
*/
$(document).ready(function(){
	
	if($(window).width() > 700 ){
		 $p_width = $("#products.parent-nav").width();
		 $k_width = $("#kb.parent-nav").width();
		 $("#products ul").width($p_width);
		 $("#products ul li").width($p_width);
		 $("#kb ul").width($k_width);
		 $("#kb ul li").width($k_width);
		 
		 
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
	
	// Dropdown menu to enable
	$('nav li').hover(
			function () {
					$('ul', this).stop().slideDown(100);
			},
			function () {
					$('ul', this).stop().slideUp(100);
			}
	);
	
	
});
	
	
$(window).resize(function(){
	// add divider to the nav-bar;
	if($(window).width() > 700 ){
		 $("#mainHeader li:lt(3)").css({"border-right": "1px solid #999"});
	}else {
		$("#mainHeader li:lt(3)").css({"border-right": "none"})
	};
})


