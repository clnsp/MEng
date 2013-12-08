function exists(variable){
	if(typeof variable == 'undefined'){
		return false;
	}
	return true;
}

var eventModal,eventTitle,eventTitle, eventdate1, eventdate2, eventSpacesMax, eventSpacesTaken, eventColor, eventLocation, eventMembers, eventid;


function load_event_attendants() {

$.getJSON('users_fetch/get_class_attendants/?class=' + eventid, function(data) {
	eventMembers.empty();
	eventSpacesTaken.text(data.length);
	$.each( data, function( key, mem ) {
	    eventMembers.append('<li class="list-group-item"> <input name="member_id" value="'+mem['member_id']+'" type="checkbox">'+mem['username']+'</li>');
	    
	    
	  });
});
}

$(document).ready(function() {
/*	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();*/

	/* Find Modal Editable Areas */
	
	eventModal = $('#eventModal');
	eventTitle = eventModal.find('#event-title');
	eventdate1 = eventModal.find('#event-date-1');
	eventdate2 = eventModal.find('#event-date-2');
	eventSpacesMax = eventModal.find('#event-spaces-max');
	eventSpacesTaken = eventModal.find('#event-spaces-taken');
	eventColor = eventModal.find('#eventColor');
	eventLocation = eventModal.find('#event-location');
	eventMembers = eventModal.find('#event-member-list .list-group');
//	var eventDescription =eventModal.find('#event-description');



	$('#calendar').fullCalendar({

		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,agendaWeek,agendaDay'
		},

		allDayDefault: false,
		selectHelper: true, 
		/*	lazyFetching: true, //caches data*/
		editable: false,
/*
		events: [
		{
			title: 'All Day Event',
			start: new Date(y, m, 1),
			allDay: true
		},
		{
			title: 'Long Event',
			start: new Date(y, m, d-5),
			end: new Date(y, m, d-2)
		},
		{
			id: 999,
			title: 'Repeating Event',
			start: new Date(y, m, d-3, 16, 0),
			allDay: false
		},
		{
			id: 999,
			title: 'Repeating Event',
			start: new Date(y, m, d+4, 16, 0),
			allDay: false
		},
		{
			title: 'Meeting',
			start: new Date(y, m, d, 10, 30),
			allDay: false,
			max_attendance: 10,
			attending: 5,
		},
		{
			title: 'Lunch',
			start: new Date(y, m, d, 12, 0),
			end: new Date(y, m, d, 14, 0),
			allDay: false,
			color: '#f00',
			room: 'Sports hall',
			room_id: '1',
			description: 'Lunch for two ',
		},
		{
			title: 'Birthday Party',
			start: new Date(y, m, d+1, 19, 0),
			end: new Date(y, m, d+1, 22, 30),
			allDay: false,
			max_attendance: 30,
			attending: 15,
			color:'#ff0'
		},
		{
			title: 'Click for Google',
			start: new Date(y, m, 28),
			end: new Date(y, m, 29),
			url: 'http://google.com/'
		}
		],*/

		eventClick: function(calEvent, jsEvent, view) {
			eventid = calEvent.class_id;

			/*title*/
			eventTitle.text(calEvent.title);

			
			/*date time*/
			var s_date, e_date, s_time, e_time;

			if(exists(calEvent.start)){
				//s_date = calEvent.start.toDateString('dddd, d MMM yyyy');
				//s_time = calEvent.start.toTimeString('HH:mm');
				s_date = $.fullCalendar.formatDate(calEvent.start, "dddd, d MMMM yyyy");
				s_time = $.fullCalendar.formatDate(calEvent.start, "HH:mm");
			}

			if(exists(calEvent.end)){
				e_date = $.fullCalendar.formatDate(calEvent.end, "dddd, d MMMM yyyy");
				e_time = $.fullCalendar.formatDate(calEvent.end, "HH:mm");
			}

			/*all day no time*/
			if(exists(calEvent.allDay) && calEvent.allDay){
				eventdate1.text(s_date);
				eventdate2.text("All Day Event");
			}else{
				/* within one dat*/
				if(s_date == e_date){
					eventdate1.text(s_date);
					eventdate2.text(s_time + ' to ' + e_time);
				}
				/*split over multiple days*/
				else{
					eventdate1.text(s_time + ' ' + s_date + ' to');
					eventdate2.text(e_time + ' ' + e_date);
				}
			}


			/*max_attendance*/
			if(exists(calEvent.max_attendance)){
				eventSpacesMax.text(calEvent.max_attendance);
			}

			/*attending*/
			if(exists(calEvent.attending)){
				eventSpacesTaken.text(calEvent.attending);
			}

			/*color*/
			if(exists(calEvent.color)){
				eventColor.css( "color", calEvent.color );
			}

			/*room*/
			if(exists(calEvent.room)){
				if(exists(calEvent.room_id)){
					eventLocation.html('<a href="room/' + calEvent.room_id + '">' + calEvent.room + '</a>');
				}else{
					eventLocation.text(calEvent.room);
				}

			}

			/*if(exists(calEvent.description)){
				eventDescription.text(calEvent.description);
			}*/
			
			/*load members*/
			load_event_attendants();
			
			/*setup form*/

			eventModal.modal('show');
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




$('#eventModal').on('hidden.bs.modal', function () {

	eventTitle.text('[Title]');
	eventdate1.text('[Date]'); 
	eventdate2.text('[Date]'); 
	eventSpacesMax.text('[0]'); 
	eventSpacesTaken.text('[0]'); 
	eventColor.css('color', '#000'); 
	eventLocation.text('[RoomName]'); 
	eventid = "";
//	eventDescription.text('[Descripttion]');
	eventMembers.html('');
})


$('#bookingCalTabs a').each(function(){	

	var $this = $(this);
	$this.click(function (e) {
		e.preventDefault();
		$this.tab('show');
		$('#calendar').fullCalendar( 'refetchEvents' );

	});

});

/* Autocomplete */
  $("#search-users").autocomplete({
    source: "users_fetch/get_users" // path to the get_birds method
  });
  
  /* Add member to event */
  $('#event-add-member-form').submit(function(e){	
  	e.preventDefault();
  	var mid = $(this).find('input[name="member_name"]').val();
  	
  	$.post( "booking/add_member", { 'member_id': mid, 'class_booking_id':eventid  }, function() {
  	  load_event_attendants();
  	  
  	  });
  	
  	
  		
  });

/* Remove member from event */
$('#event-remove-member-form').submit(function(e){	
	e.preventDefault();
	var mid = $(this).find('input[name="member_id"]:checked').val();
	
	$.post( "booking/remove_member", { 'member_id': mid, 'class_booking_id':eventid  },
	function() {
	  load_event_attendants();
	  
	  } );
		
});


});


