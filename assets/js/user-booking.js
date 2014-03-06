$( document ).ready(function() {

	$('#starttime').timepicker('setTime', '');
	$('#endtime').timepicker('setTime', '');
	$('#date').datepicker();
	
	$('#tabs li').click(function(){
		if(!$(this).hasClass('active')){
			$('#tab-content .form-group.toggleInput').toggleClass('hidden');

			$('#tab-content .form-group.toggleInput select').each(function() {
				$(this).prop("disabled",!$(this).prop("disabled"))
			});
		}
		
		
	});
	
});