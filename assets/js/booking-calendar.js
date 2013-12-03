
$(document).ready(function() {

	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},

		allDayDefault: false,
		selectHelper: true, 
		editable: true,
		/*	lazyFetching: true, //caches data*/
		editable: false,
		

		eventClick: function(calEvent, jsEvent, view) {
			var eventModal = $('#eventModal');

			eventModal.find('#event-title').text(calEvent.title);
			eventModal.find('#event-date').text(calEvent.start +' ' + calEvent.end);

			//alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
			//alert('View: ' + view.name);

			eventModal.modal('show')
		},

		eventSources: [
		{
			url: 'https://devweb2013.cis.strath.ac.uk/~xvb09137/MEngBranchAW/index.php/caljson',
			startParam: 'start',
			endParam: 'end',

		data: function() { // a function that returns an object
			return {
				room: $('#bookingCalTabs .active a').attr('href'),	};
			},


			error: function() {
				if(!$('#calendar-error').length){
					$('#calendar').prepend('<div id="calendar-error" class="alert alert-danger text-center">There was an error loading the calendar</div>');

				}
			},
		}
		],

		loading: function(b) {
			if (b) 
				$('#loading-indicator').toggleClass('hidden');
			else 
				$('#loading-indicator').toggleClass('hidden');
		},

	});

});




$('#bookingCalTabs a').each(function(){	

	var $this = $(this);
	$this.click(function (e) {
		e.preventDefault();
		$this.tab('show');
		$('#calendar').fullCalendar( 'refetchEvents' );

	});

});

