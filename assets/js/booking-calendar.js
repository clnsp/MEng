function exists(variable){
	if(typeof variable == 'undefined'){
		return false;
	}
	return true;
}

var eventModal,eventTitle,eventTitle, eventdate1, eventdate2, eventSpacesMax, eventSpacesTaken, eventColor, eventLocation, eventMembers, eventid;

/*
 * Load the attendants of this event
 * @param bool
 */
 function load_event_attendants(past) {

 	$.getJSON('calendar/getClassAttendants/?class=' + eventid, function(data) {
 		eventMembers.empty();
 		eventSpacesTaken.text(data.length);

 		if(data.length>0){
 			$.each( data, function( key, mem ) {
 				disable_remove_button(false);
 				add_member_to_member_list(mem['member_id'], mem['username'], !past);
 				if(past){
 					disable_remove_button(true);

 				}
 			});
 		}else{
 			eventMembers.append('<li class="list-group-item"> No attendants</li>');
 			disable_remove_button(true);
 		}

 	});
 }


/**
 * Add member to the member list
 */
 function add_member_to_member_list(id, username, checkbox){
 	if(checkbox){
 		eventMembers.append('<a href="#" class="list-group-item"> <input name="member_id" value="'+ id +'" type="checkbox">' + username + '</a>');
 	}else{
 		eventMembers.append('<a href="#" class="list-group-item">' + username + '</a>');
 	}

 }

/**
 * Disable/Enable the remove member button
 */
 function disable_remove_button(disable){
 	eventModal.find('#event-remove-member-button').prop('disabled', disable);
 }

/**
 * Disable/Enable the cancel class button
 */
 function disable_cancel_class(disable){
 	eventModal.find('#event-cancel-class-btn').prop('disabled', disable);
 }

/**
 * Disable/Enable the add member functionality
 */
 function disable_add_member(disable){
 	eventModal.find('input#search-users').prop('disabled', disable);
 	eventModal.find('button#btn-add-member').prop('disabled', disable);
 }
 /*
  * Show an error message for dialog
  */
  function show_error(msg){
  	eventError.removeClass('hidden');
  	eventError.find('#msg-body').text(msg);
  }


  $(document).ready(function() {

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
  	eventError = eventModal.find('#event-warning');
//	var eventDescription =eventModal.find('#event-description');


/* Handler for the event button */
eventError.find('button.close').click(function(e){
	e.preventDefault();
	e.stopImmediatePropagation();
	this.parentElement.className = 'hidden alert alert-warning fade in';
});

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

	eventClick: function(calEvent, jsEvent, view) {
		eventid = calEvent.class_id;

		/*title*/
		eventTitle.text(calEvent.title);

		/*date time*/
		var s_date, e_date, s_time, e_time;

		if(exists(calEvent.start)){
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
			/* within one day */
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

		/*load members*/
		load_event_attendants(calEvent.past);

		disable_add_member(calEvent.past);

		disable_cancel_class(calEvent.past);
		
		/*setup form*/
		eventModal.modal('show');
	},

	eventRender: function(event, element,view) {
		console.log('');
		if(event.end <  new Date()){
			event.past = true;
			element.css('opacity', '0.5');
		}
		else{
			event.past = false;
		}
	},

	eventSources: [
	{
		url: 'calendar',
		startParam: 'start',
		endParam: 'end',
			//fetch room
			data: function() { // a function that returns an object
				return {
					room: $('#bookingCalTabs .active a').attr('href'),	};
				},
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
			dayClick: function(date, allDay, jsEvent, view) {

				view.calendar.gotoDate(date);
				if(view.name == 'month'){	
					view.calendar.changeView('agendaWeek');
				}else if(view.name == 'agendaWeek'){
					view.calendar.changeView('agendaDay');
				}

			}

		});



 /*
  * Tear down the modal properties
  */
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
});


 /* 
  *Fetch room associated calendar view
  */
  $('#bookingCalTabs a').each(function(){	

  	var $this = $(this);
  	$this.click(function (e) {
  		e.preventDefault();
  		$this.tab('show');
  		$('#calendar').fullCalendar( 'refetchEvents' );

  	});

  });

  /* 
  * Control the dropdown list for categories
  */
  $('#category-dropdown .dropdown-menu li').click(function(e){	
  	e.preventDefault();
  	$(this).toggleClass('selected');
  });


/* 
 * Add member to event 
 */
 $('#event-add-member-form').submit(function(e){	
 	e.preventDefault();
 	var memberinputbox = $(this).find('input#search-users');
 	var mid = memberinputbox.attr('data-member-id');
 	if(mid != ''){
 		$.ajax({
 			url: "calendar/addMember",
 			type: "POST",
 			data: { 'member_id': mid, 'class_booking_id':eventid  },
 			success: function() {
 				memberinputbox.attr('data-member-id', '').val('');
 				load_event_attendants();

 			},
 			error: function(){
 				show_error('User already exists');
 				memberinputbox.attr('data-member-id', '').val('');


 			},
 		});
 	}else{
 		show_error('No user selected');
 	}

 });
 
 /*
  * Confirm cancel button
  */
  
  $('#confirmCancelBtn').click(function(e){
  
  	var msg = $('input#cancelMessage').val();
  
 	 $.ajax({
   			url: "calendar/cancelClass",
   			type: "POST",
   			data: { 'class_booking_id':eventid, 'cancel_message':msg },
   			success: function() {
	   			alert('message sent, class cancelled');
  
   			},
   			error: function(){
   				alert("Cancel class error");
  
   			},
   		});
  
   	});

/*
 * Select anywhere along the member list row 
 */
 eventMembers.on('click', 'a', function() {
 	$(this).find('input[type=checkbox]').trigger('click');
 });


/*
 * Remove member from event
 */
 $('#event-remove-member-form').submit(function(e){	
 	e.preventDefault();
 	var mids = $(this).find('input:checked').map(function(){
 		return $(this).val();
 	}).toArray();;

 	if(mids.length > 0){
 		$.ajax({
 			url: "calendar/removeMember",
 			type: "POST",
 			data: { 'member_id': mids, 'class_booking_id':eventid  },
 			success: function() {
 				load_event_attendants();
 			},
 			error: function(){
 				show_error('an error occured');
 			},
 		});
 	};
 });

/* 
 * Autocomplete  
 **************************************************************
 */
 var noResultsLabel = "No members found Add guest?";

 var autocomplete = $("#search-users").autocomplete({
 	source: "calendar/getUsers",
 	minLength: 3, 
 	select: function (event, ui) {
 		if(ui.item.label == noResultsLabel){
 			//$('#addGuestModal').modal('show');
 		}else{
 			this.setAttribute("data-member-id",ui.item.user_id);

 		}
 	},

 	response: function(event, ui) {
 		if (!ui.content.length) {
 			var noResult = { value:"",label:noResultsLabel };
 			ui.content.push(noResult);
 		}
 	}
 });

 /*override the autocomp dropdown results display*/
 $.ui.autocomplete.prototype._renderMenu = function( ul, items ) {
 	var that = this;
 	$(ul).addClass('list-group popover bottom')
 	.append(' <div class="arrow"></div>');    


 	$.each( items, function( index, item ) {
 		that._renderItemData( ul, item );
 	});

 };

 /*override individual items in the list*/
 $.ui.autocomplete.prototype._renderItem = function(ul, item) {
 	if(item.label == noResultsLabel){
 		return 	$( "<li>" )
 		.attr( "data-value", item.value )
 		.addClass('list-group-item')
 		.append( $( "<a data-toggle='modal' data-target='#addGuestModal' class='btn btn-default'>" ).text( item.label ) )
 		.appendTo( ul );
 	}
 	return $( "<li>" )
 	.attr( "data-value", item.value )
 	.addClass('list-group-item')
 	.append( $( "<a>" ).text( item.label ) )
 	.appendTo( ul );
 };






});


