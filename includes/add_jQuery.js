// JQuery for add.php
$(document).ready(function(){
		//The page will show constituents forms based on how many c_number we select on the page.
		function displaycinfo(){
			var constituent = $('#cnumber');
			var cnum = constituent.val();
			var clist_rest = "<p>Constituents Name: <input type='text' name='cform[cname][]' size='15' maxlength='20'/></p> \
											<p>Constituent weight: <input type='text' name='cform[pweight][]' size='15' maxlength='20'/></p> \
											<p>Type: <input type='text' name='cform[Type][]' size='15' maxlength='20' /></p>\
											<p>classification: \
													<select name='cform[classification][]'> \
														<option value='Green'>Green</option> \
														<option value='Blue(paper)'>Blue(paper)</option> \
														<option value='Blue(container)'>Blue(container)</option> \
														<option value='Clear'>Clear</option> \
													</select> \
											 </p></div>";

			//Remove previously generated forms
			$("div[id^='clist']").remove();	
			for(var i = 0; i < cnum; i++)
			{
				
				$('#cnumber').after(			//HTML code for constituents info
			 "<div id='clist" + i + "'>" + clist_rest);
			};
		};						
		$('#cnumber').change(displaycinfo); //Change the number of forms.
		
		//When we click at the input area, those words will disapeear
		$("div[id='enterInfo'] :input").focus(function(){	
			var txt_value = $(this).val();
			if($(this).is(':empty')){
				$(this).val("");
			}
		});
		$("div[id='enterInfo'] :input").blur(function(){	
			var txt_value = $(this).val();
			if($(this).is(':not(:empty)')){
				$(this).val("Please enter");
			}
		});	

		
		$("#panel").hover(function(){
			$(this).stop(true)
						 .animate({height:"150"}, 600)
						 .animate({width:"300"}, 300);
			},function(){
			$(this).stop(true)
						 .animate({height:"32"}, 600)
						 .animate({width:"60"}, 300);
			});
						 
		//submit all the form data and do a POST

		/*function showValues() {
			var str = $('#form1').serialize();
			$('#resText').text( str );
			$('input, select, textarea').on( 'change', showValues );
    }
		showValues();*/
		
		/*$('#send').submit(function(event){
			event.preventDefault();
			var data = $('#form1').serialize()
			$.post('add.php', data);
		});*/

  
});
						 


	
