$( document ).ready(function() {

	$('#starttime').timepicker('setTime', '');
	$('#endtime').timepicker('setTime', '');

	$('#date').datepicker({
		minDate: 0
	});

	$('#sportsdate').datepicker({ 
		maxDate: "+1w", //hardcoded
		minDate: 0
	});

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
		var table = $('table.footable.table tbody');

		$.post("searchclass/fetchSportsClasses", $(this).serialize(), function( data ) {
			table.html('');
			alert(data);
			var json = $.parseJSON(data);
			
			var book = $('<button class="btn btn-primary">Book</button>');

			for (var key in json) {
				var tr = $('<tr>');
				var obj = json[key];
				
				for (var prop in obj) {
					tr.append('<td clas="' + prop +'">' + obj[prop] + '</td>');
				}
				tr.append($(book).clone());
				table.append(tr).trigger('footable_redraw');
			}


		});




	});


	// $('#courts').click();
	// $('input[name="date"]').val('03/12/2014');
	// $('input[name="starttime"]').val('5:00 PM');
	// $('input[name="endtime"]').val('7:00 PM');
});

