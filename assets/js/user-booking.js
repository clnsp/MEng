$( document ).ready(function() {

	$('#sportsdate').datepicker({ 
		maxDate: "+1w", //hardcoded
		minDate: 0
	});
	
	var UserBooking = new function() {
		var table, tbody, $this, form;
		
		$('#booking').on('submit', form, function(e) {
			performSearch($('html').hasClass('mobile'));
		});
		
		$('#tabs li').click(function(){
				if(!$(this).hasClass('active')){
					$('#tab-content .form-group.toggleInput').toggleClass('hidden');
		
					$('#tab-content .toggleInput >').each(function() {
						$(this).prop("disabled",!$(this).prop("disabled"))
					});
				}
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
					var $this = this;
					bootbox.cancelbookingbtn = $this;
					bootbox.confirm("Are you sure you wish to cancel this class?", function(result, $this) {
						if(result){
							bootbox.cancelbookingbtn.form.submit();
						}else{
							bootbox.cancelbookingbtn = "";
						}
					}); 
			
				});
			
		
		performSearch = function(scrollto) {
		
			//var footable = table.data('footable');
	
			$.post(siteUrl + "/booking/search", form.serialize(), function( data ) {
				tbody.html(data);
			//	table.trigger('footable_redraw');
				
				table.trigger('footable_redraw');
								table.trigger('footable_resize');

				if(scrollto){
					$('html, body').animate({
						scrollTop: table.offset().top
					}, 2000);
				}
			});
			
		}
		
		var init = function() {
			form = $('form.prevent.classes');
			table = $('table.footable.table.classes');
			tbody = table.find('tbody');
			performSearch(false);
		}
		
		
		init();
		
	};
		

//
//	 $('#courts').click();
//	 $('input[name="date"]').val('03/12/2014');
//	 $('input[name="starttime"]').val('5:00 PM');
//	 $('input[name="endtime"]').val('7:00 PM');
});

