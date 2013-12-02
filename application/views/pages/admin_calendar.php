
<div class="navbar">

	<div class="col-xs-3 pull-right input-group input-group-sm">
		<span class="input-group-addon"><span class="glyphicon glyphicon-search"></span></span>
		<input type="text" class="form-control" placeholder="Search calendar...">
	</div>
	<ul id="bookingCalTabs" class="nav nav-tabs">
		<li><a class="active" href="#allrooms" data-toggle="tab">All Rooms</a></li>
		<li><a data-toggle="tab" href="#sportshall">Sports Hall</a></li>
		<li><a href="#activitiesroom" data-toggle="tab">Activities Room</a></li>
		<li><a href="#royalcollegegym" data-toggle="tab">Royal College Gym</a></li>
	</ul>

</div>

<div id='calendar' class="clearfix"></div>

</div>
<div class="tab-pane" id="sportshall">
</div>

<div class="tab-pane" id="activitiesroom">
</div>

<div class="tab-pane" id="royalcollegegym">
</div>
</div>

<div class="clearfix"></div>

<script>

$(document).ready(function() {
	var date = new Date();
	var d = date.getDate();
	var m = date.getMonth();
	var y = date.getFullYear();
	//alert('' + new Date(y, m, 1));

	$('#calendar').fullCalendar({
		header: {
			left: 'prev,next today',
			center: 'title',
			right: 'month,basicWeek,basicDay'
		},

		editable: true,
		
		eventClick: function() {
			alert('an event has been clicked!');
		},

		eventSources: [

        // your event source
        {
            url: 'https://devweb2013.cis.strath.ac.uk/~xvb09137/MEngBranchAW/index.php/caljson',
            startParam: 'start',
            endParam: 'end', // use the `url` property
        }

        // any other sources...

        ],

        viewDestroy: function() {

        }


		/*
		events: [
		{
			title: 'All Day Event',
			start: new Date(y, m, 1)
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
			allDay: false
		},
		{
			title: 'Lunch',
			start: new Date(y, m, d, 12, 0),
			end: new Date(y, m, d, 14, 0),
			allDay: false
		},
		{
			title: 'Birthday Party',
			start: new Date(y, m, d+1, 19, 0),
			end: new Date(y, m, d+1, 22, 30),
			allDay: false
		},
		{
			title: 'Click for Google',
			start: new Date(y, m, 28),
			end: new Date(y, m, 29),
			url: 'http://google.com/'
		}
		]*/
	});

});

</script>