$( document ).ready(function() {

	$('#starttime').timepicker('setTime', '');
	$('#endtime').timepicker('setTime', '');
	$('#date').datepicker();

	/* responsive tables */
	$('.footable').footable();
	
	$('#tabs li').click(function(){
		if(!$(this).hasClass('active')){
			$('#tab-content .form-group.toggleInput').toggleClass('hidden');

			$('#tab-content .form-group.toggleInput select').each(function() {
				$(this).prop("disabled",!$(this).prop("disabled"))
			});

			$('form').toggleClass('sports prevent');
		}
	});

	$('#booking').on('submit', 'form.prevent.sports', function(e) {

		// $.ajax({
		// 	type:"POST",
		// 	url: "searchclass/fetchSportsClasses",
		// 	data:$(this).serialize(),
		// 	success: function (response){
		// 		console.log(parseJSON(response));
		// 	}
		// });

		$.post("searchclass/fetchSportsClasses", $(this).serialize(), function( data ) {
			alert(data);
			console.log($.parseJSON(data));
		});



	});
	
});