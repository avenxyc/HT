// Search-Ajax.js
$(document).ready(function(){
	
	$('#submit').click(function(){
		var class_val = $('#class').val();
		var region_val = $('#region').val();
		var keyword = $('#keyword').val();
		
		$.ajax({
				type: 'GET',
				url: 'query.php',
				data: {cv: class_val, rv: region_val, kw: keyword},
				success: function(data, textStatus){
					$('#result').html(data);
				}
				
		});
		
	});
		

});