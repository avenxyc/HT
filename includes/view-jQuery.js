// View-jQuery

$(document).ready(function(){
	$('#region').change(function(){
		$.post("view-specific.php", { n_region: $('#region').val()}, function(data) {
			$(data).find('#region').val() = id;
 			 var new_a = $(data).find('#details').attr("a").val();
			// $("#details").load(new_a + "
			//alert(selected_region + "  " + new_a);
			alert(data.id.val());
});
	
	});

})