// JQuery for add.php
$(document).ready(function(){
		//The page will show constituents forms based on how many c_number we select on the page.
		function displaycinfo(){
			var constituent = $('#cnumber');
			var cnum = constituent.val();
			var clist_rest = "<label>Constituents Name: </label><input type='text' name='cform[cname][]' size='15' maxlength='20'/> <br /> \
											<label>Constituent weight:</label> <input type='text' name='cform[pweight][]' size='15' maxlength='20'/>g <br />\
											<label>Type:</label> <input type='text' name='cform[Type][]' size='15' maxlength='20' /></p>\
											<label>classification:</label> \
													<select name='cform[classification][]'> \
														<option value='Green Cart'>Green Cart</option> \
														<option value='Blue Bag #1: Paper'>Blue Bag #1: Paper</option> \
														<option value='Blue Bag #2: Recyclables'>Blue Bag #2: Recyclables</option> \
														<option value='Clear Garbage Bag'>Clear Garbage Bag</option> \
													</select><br /> \
											 </div>";

			//Remove previously generated forms
			$("div[id^='clist']").remove();	
			for(var i = 0; i < cnum; i++)
			{
				
				$('#cnumber').after(			//HTML code for constituents info
			 "<br /><div id='clist" + i + "'>" + clist_rest);
			};
		};						
		$('#cnumber').change(displaycinfo); //Change the number of forms.
		
		//When we click at the input area, those words will disapeear
		/*$("div[id='enterInfo'] :input").focus(function(){	
			var txt_value = $(this).val();
			if(txt_value){
				$(this).val("");
			}
		});
		$("div[id='enterInfo'] :input").blur(function(){	
			var txt_value = $(this).val();
			if(!txt_value){
				$(this).val("Can not be blank").css("color","rgba(255,0,0,1)");
			}else{
				$(this).css("color","rgba(0,0,0,1)");
			}
		});	*/
		
		//Change the measurement of the item
		function measurement(){
			var wv = $('#wORv').val();
			if( wv == 'Weight'){
				$('#gORl').text('g');
			}else{
				$('#gORl').text('L');
			}
		}
		$('#wORv').change(measurement); 
		
  
});
						 


	
