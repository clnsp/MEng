$( document ).ready(function() {

	$('#sportsdate').datepicker({ 
		maxDate: "+1w", //hardcoded
		minDate: 0
	});


	$('#tabs li').click(function(){
		if(!$(this).hasClass('active')){
			$('#tab-content .form-group.toggleInput').toggleClass('hidden');

			$('#tab-content .toggleInput >').each(function() {
				$(this).prop("disabled",!$(this).prop("disabled"))
			});
		}
	});

	
	$('#booking').on('submit', 'form.prevent.classes', function(e) {
		var table = $('table.footable.table.classes tbody');

		$.post(siteUrl + "/booking/search", $(this).serialize(), function( data ) {
			table.html(data);
			table.trigger('footable_redraw');
		});

	});
	
	$(document).on('click', 'button.booksport', function() {
		$.post(siteUrl +"/booking/bookSport", {
			class_type_id : $(this).data('class_type_id'),
			room_id: $(this).parent().siblings('.room').data('room_id'),
			class_start_date:  $(this).parent().siblings('.start').data('class_start_time')			
		}, function( data ) {
			alert(data);
		});
		
	});

//
//	 $('#courts').click();
//	 $('input[name="date"]').val('03/12/2014');
//	 $('input[name="starttime"]').val('5:00 PM');
//	 $('input[name="endtime"]').val('7:00 PM');
});

