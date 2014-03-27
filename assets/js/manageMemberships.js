manageMemberships = (function(){

membership = (function() {
	
	onSubmit = function (){
	//GET DATES
	console.log(datepicker.getDates());
// GET NAME
	console.log($('#MembershipName').val());
// GET OPTIONS
	console.log($('#MemberTypes option:selected'));
// SEND TO SERVER
	

	},

	$('#create').on('click', function(){onSubmit();});

})();



// CALANDER
datepicker = (function() {

	var cal;

	draw = function() {
		cal = $('#date-selector').multiDatesPicker({numberOfMonths: 2,maxPicks: 2});
	},

	getDates = function() {
		return cal.multiDatesPicker('getDates');
	},

	hasDates = function() {
		return getDates().length != 0;
	},

	repeatDates = function(repeatType, stop) {
		if(stop != ''){
			var calDates = cal.multiDatesPicker('getDates');
			var newDates = new Array();
			var stopDate = Date.parse(stop);

			calDates.forEach(function(entry) {
				var day = Date.parse(entry);
				while(Date.compare(day, stopDate) != 1){

					newDates.push(day.clone());

					if(repeatType == 'days')
						day.add(1).days();

					else if (repeatType == 'weeks')
						day.add(1).weeks();

					else if (repeatType == 'months')
						day.add(1).months();

					else if (repeatType == 'years')
						day.add(1).years();
				}
			});

			if(newDates.length > 0)
				cal.multiDatesPicker('addDates', newDates);
		}
	},

	alternate = function(){
		if(cal.multiDatesPicker('isDisabled')){
			options('enable');
		}else {	
			options('disable');
		}
	},

	options = function(o){
		cal.datepicker(o);
	}

	return { 
		draw: draw,
		cal:cal, 
		options: options,
		hasDates: hasDates,
		repeatDates: repeatDates,
		getDates : getDates,
		alternate: alternate,
	};
})();
datepicker.draw();
})();
