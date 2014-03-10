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
		var class_type_id = $(this).find('select.sports[name=class_type_id]').val();

		$.post("searchclass/fetchSportsClasses", $(this).serialize(), function( data ) {
			table.html('');
			alert(data);
			var json = $.parseJSON(data);
			
			var book = $('<button class="booksport btn btn-primary">Book</button>');

			for (var key in json) {
				var tr = $('<tr>');
				var obj = json[key];
				
				
				tr.append($('<td class="start">' + obj['start'] + '</td>').attr('data-class_start_time', obj['date'] + obj['start']));
				tr.append('<td class="duration">' + obj['duration'] + '</td>');
				tr.append($('<td class="room">' + obj['room'] + '</td>').attr('data-room_id', obj['room_id']));
				tr.append('<td class="available">' + obj['available'] + '</td>');
				
				tr.append($('<td>').append($(book).clone().attr('data-class_type_id', class_type_id)));
				table.append(tr).trigger('footable_redraw');
			}

		});

	});
	
	$(document).on('click', 'button.booksport', function() {
		$.post("userbook/bookSport", {
			class_type_id : $(this).data('class_type_id'),
			room_id: $(this).parent().siblings('.room').data('room_id'),
			class_start_date:  $(this).parent().siblings('.start').data('class_start_time')			
		}, function( data ) {
			alert(data);
		});
		
	}),


	 $('#courts').click();
	 $('input[name="date"]').val('03/12/2014');
	 $('input[name="starttime"]').val('5:00 PM');
	 $('input[name="endtime"]').val('7:00 PM');
});

