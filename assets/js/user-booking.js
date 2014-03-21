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
		var table = $('table.footable.table.classes');
		var tbody = table.find('tbody');
		table.removeClass('hidden');
		var footable = table.data('footable');

		$.post(siteUrl + "/booking/search", $(this).serialize(), function( data ) {
			tbody.html(data);
			table.trigger('footable_redraw');
			table.trigger('footable_resize');
			
			table.footable().trigger('footable_redraw');
			$('html, body').animate({
				scrollTop: table.offset().top
			}, 2000);
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
		
	}).on('click', 'input.cancelbooking', function(e) {
		e.preventDefault();
		bootbox.confirm("Are you sure you wish to cancel this class?", function(result) {
			if(result){
				console.log($(this);
			}
		}); 
				
			});

//
//	 $('#courts').click();
//	 $('input[name="date"]').val('03/12/2014');
//	 $('input[name="starttime"]').val('5:00 PM');
//	 $('input[name="endtime"]').val('7:00 PM');
});

