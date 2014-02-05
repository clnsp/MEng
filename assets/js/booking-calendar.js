function exists(variable){
	if(typeof variable == 'undefined' || variable == null){
		return false;
	}
	return true;
}

var eventModal, eventTitle, eventdate1, eventdate2, eventSpacesMax, eventSpacesTaken, eventColor, eventLocation, eventMembers, eventid;
var activeEvent, addGuestModal;

/*
 * Load the attendants of this event
 * @param bool
 */
 function load_event_attendants(disabled) {

 	$.getJSON('calendar/getClassAttendants/?class=' + eventid, function(data) {
 		eventMembers.empty();
 		eventSpacesTaken.text(data.length);

 		if(data.length>0){
 			$.each( data, function( key, mem ) {
 				disable_remove_button(false);
 				add_member_to_member_list(mem['member_id'], mem['username'], !disabled);
 				if(disabled){
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
 		eventMembers.append('<li class="list-group-item"> <input name="member_id" value="'+ id +'" type="checkbox">' + username + '</li>');
 	}else{
 		eventMembers.append('<li class="list-group-item">' + username + '</li>');
 	}

 }

/**
 * Disable/Enable the remove member button
 */
 function disable_remove_button(disable){
 	eventModal.find('#event-remove-member-button').prop('disabled', disable);
 }

/**
 * Render the cancel class button
 */
 function render_cancel_button(cancelled){
 	cancel = eventModal.find('#event-cancel-class-btn');
 	reopen = eventModal.find('#event-uncancel-class-btn');

 	if(cancelled){
 		reopen.removeClass('hidden');
 		cancel.addClass('hidden').prop('disabled', true);
 	}else{
 		cancel.removeClass('hidden');
 		reopen.addClass('hidden').prop('disabled', true);
 	}

 }
 
 /**
  * Disable/Enable the cancel/reopen button
  */
  function disable_cancel_button(past){
  	var cancel, reopen;
  	eventModal.find('.open-Model-button').each(function(){
  		$(this).prop('disabled', past);
  	});

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
    addGuestModal = $('#addGuestModal');
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
		right: 'month,agendaWeek,agendaDay',
	},

	firstDay: 1, //makes first day monday
	firstHour: new Date().getUTCHours() - 5, //makes the first hour in view 5 hours ago


	/* cal col headings */
	columnFormat: {
    month: 'dddd', 
    week: 'ddd d', 
    day: '' 
  },

  titleFormat: {
    	month: 'MMMM yyyy',                             // September 2009
    	week: "MMM d[ yyyy]{ -[ MMM] d, yyyy}", // Sep 7 - 13 2009
    	day: 'dddd d MMMM yyyy'                  // Tuesday, Sep 8, 2009
    },


    defaultView: 'agendaWeek',
    allDayDefault: false,
    selectHelper: true, 
    /*	lazyFetching: true, //caches data*/
    editable: false,

    eventClick: function(calEvent, jsEvent, view) {
    	activeEvent = calEvent;
    	eventid = calEvent.class_id;
    	render_title(calEvent.title);
    	render_cancelled_banner(calEvent.cancelled);
    	render_cancel_button(calEvent.cancelled);
    	disable_cancel_button(calEvent.past);
    	render_date(calEvent.start, calEvent.end, calEvent.allDay);
    	render_attendance_numbers(calEvent.attending, calEvent.max_attendance);
    	render_color(calEvent.color);
    	render_room(calEvent.room_id, calEvent.room);
    	load_event_attendants(calEvent.past || calEvent.cancelled);
    	disable_add_member(calEvent.past || calEvent.cancelled);

    	/*setup form*/
    	eventModal.modal('show');
    },

    eventRender: function(event, element, view) {

    	if(event.end <  new Date()){
    		event.past = true;
    		element.css('opacity', '0.35');
    	}
    	else{
    		event.past = false;
    	}
    	event.cancelled = event.cancelled == true;

    	if(event.cancelled){
    		element.addClass('cancelled');
    	}

		//fetch the currently selected category ids
		var categories = [];
		$('#category-dropdown li.selected a').each(function(){
			var $this = $(this);
			categories.push($this.data('category-id') + "");
		});
		
		if($.inArray(event.category_id, categories) == -1)
			element.addClass('hidden');
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

			},
      windowResize: function(view) {
        resizeCalendar();
      }

    });



$('#calendar .fc-header .fc-header-center').after($('#category-dropdown').remove());
$('#calendar .fc-header .fc-header-center').before($('#rooms-dropdown').remove());

/**
 * Render the room
 */
 function render_room(room_id, room) {
 	if(exists(room_id)){
 		eventLocation.html('<a href="room/' + room_id + '">' + room + '</a>');
 	}else{
 		eventLocation.text(calEvent.room);
 	}
 }

/**
 * Render the category color
 */
 function render_color(color) {
 	eventColor.css( "color", color );
 }
 
/**
 * Render the date of the event
 */
 function render_date(start, end, allDay) {
 	var s_date, e_date, s_time, e_time;

 	if(exists(start)){
 		s_date = $.fullCalendar.formatDate(start, "dddd d MMMM yyyy");
 		s_time = $.fullCalendar.formatDate(start, "HH:mm");
 	}

 	if(exists(end)){
 		e_date = $.fullCalendar.formatDate(end, "dddd d MMMM yyyy");
 		e_time = $.fullCalendar.formatDate(end, "HH:mm");
 	}

 	/*all day no time*/
 	if(exists(allDay) && allDay){
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
 }


 /**
 * Render the title
 */
 function render_title(title) {
 	eventTitle.text(title); 
 }
 
 /**
 * Add a cancelled banner
 */
 function render_cancelled_banner(render) {
 	var banner = eventModal.find('#cancelled-banner');
 	if(render){
 		banner.removeClass('hidden');
 	}else{
 		banner.addClass('hidden');

 	}
 }
 
 /**
 * Render the attendance numbers
 */
 function render_attendance_numbers(attending, max_attendance) {
 	if(exists(max_attendance)){
 		eventSpacesMax.text(max_attendance);
 	}

 	if(exists(attending)){
 		eventSpacesTaken.text(attending);
 	}

 }
 
 /*
  * Tear down the modal properties
  */
  $('#eventModal').on('hidden.bs.modal', teardown_modal);
  
  
   /* 
    *Fetch room associated calendar view
    */
    $('#bookingCalTabs').on('click', 'li', function(e){
      e.preventDefault();

      $(this).siblings('.active').each(function(key, val){
        $(val).removeClass('active');
      });

      $(this).addClass('active');
      $('#calendar').fullCalendar( 'refetchEvents' );

    });


  /**
   * Cleanup the modal attributes
   */
   function teardown_modal() {
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
  	activeEvent = null;
  }

    /**
   * Cleanup the modal attributes
   */
   function teardown_add_guest_modal() {
    addGuestModal.find('#addGuestForm')[0].reset();

  }


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
  		url: "calendar/cancelClass/" + activeEvent.cancelled,
  		type: "POST",
  		data: { 'class_booking_id':eventid, 'cancel_message':msg },
  		success: function() {
  			alert('message sent, class cancelled');
  			$('input#cancelMessage').val('');
  			$('#calendar').fullCalendar( 'refetchEvents' );

  		},
  		error: function(){
  			alert("Cancel class error");

  		},
  	});

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
 	$(ul).addClass('list-group dropdown-menu popover bottom')
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
 		.append($("<a data-toggle='modal' data-target='#addGuestModal' class='btn btn-default'>").text( item.label ) )
 		.appendTo( ul );
 	}
 	return $( "<li>" )
  .attr('data-toggle', 'tooltip')
  .attr( "data-value", item.value )
  .attr('data-title', item.email)
  .attr('title', item.email)
  .addClass('list-group-item')
  .append( $( "<a>" ).text( item.label ) )
  .appendTo( ul )
  .tooltip({
    'placement': 'left',
    'container': eventModal
  })
};


eventModal.on("click", ".open-Model-button", function () {
  var title = $(this).data('title');
  $("#cancelClassModal .modal-title").text(title);
});


 /* 
 * Control the multiselect dropdown list
 */
 $('.dropdown-menu.multi-select li').click(function(e){	
 	e.preventDefault();
 	e.stopPropagation();
 	$(this).toggleClass('selected');
 	
 });
 
 /* Full Calendar refresh*/
 $('#category-dropdown .dropdown-menu.multi-select li').click(function () {
 	$('#calendar').fullCalendar('rerenderEvents');
 });


 $('form#addGuestForm').submit(function(e){
  e.preventDefault();
  var postdata = $(this).serialize() + '';
  $.ajax({
    url: "calendar/addGuestToClass/" + eventid,
    type: "POST",
    data:  postdata,
    success: function() {
     load_event_attendants(false);
     addGuestModal.modal('hide');
     teardown_add_guest_modal();
   },
   error: function(){
     alert('Error occurred');
   },
 });


});

resizeCalendar();
function resizeCalendar(){
  $('#calendar').fullCalendar('option', 'height', $(window).height() - 70);
}


});
