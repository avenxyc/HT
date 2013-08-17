// View-jQuery

$(document).ready(function(){
	$('#region').change(function(){
		$region = $('#region').val();
		$.post("view.php", { id: $region }, function(data) {
 			 alert("Response from server: " + data);
});
	
	});

})