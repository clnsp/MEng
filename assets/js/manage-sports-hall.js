
var assignDivPanel, roomDivider, divisibleRoomPanel, manage_rooms, manage_sports, roomDivider, placedSports;


placedSports = function () {
    //assign _root and config private variables
    var _root = this;
    this.directory = new Array();

    /* add a sport to the directory */
    this.addSport = function(sport_id){
    	this.directory[sport_id] = new Array();
    }

    /**
    * Assign divisions to a sport takes string and array
    */
    this.assignDivisons = function(sport_id, divs){
    	if(!sport_id){
    		alert('Please select a sport to assign');
    		return;
    	}

    	if(!this.directory[sport_id]){
    		this.addSport(sport_id);
    	}else{
    		if(compareDivs(this.directory[sport_id], divs)){
    			alert("Courts already added");
    			return;
    		}
    	}

    	this.directory[sport_id].push(divs);


    	$.event.trigger({
    		type: "divisionAdded",
    		message: "Hello World!",
    		time: new Date()
    	});	

    	
    }

    compareDivs = function(directory, divs){
    	var found = false;
    	$.each(directory, function(index, value){
    		if($(value).not(divs).length == 0 && $(divs).not(value).length == 0)
    			found = true;
    	});
    	return found;
    }


    this.getDivisions = function(sport_id) {
    	var cont = $('<ul>');
    	$.each(this.directory[sport_id], function(index, value) {

    		var li = $('<li></li>').html("Court");
    		$.each(value, function(j, v) {
    			li.append(v + ", ");
    		});    
    		cont.append(li);  
    	}); 

    	return cont.html();

    }
};


var ps = new placedSports();


roomDivider = function () {
    //assign _root and config private variables
    var _root = this;

    this.rows = 2;
    this.cols = 2;
    var min = 1;
    var max = 10;

    /*
        INITIALIZE
        */
        this.init = function(cont, clickable) {
        //some code
        this.container = $(cont).addClass('box-divider');

        if(clickable){
        	this.container.selectable({ 
        		filter: ".box",
        		stop: function( event, ui ) {
        			var floater = $('<div class="floater" style="width:100%;height:100%; background-color:red; opacity:0.5">');

        			var courts = new Array();
        			$(event.target).find('.box.ui-selected').each(function(){
        				courts.push($(this).data('court_id'));
        			});

        			ps.assignDivisons(assignDivPanel.getSelectedSport(), courts);
        		}
        	});


        	this.container.on('click', '.box', function(e){
        		if(e.shiftKey)
        			$(this).toggleClass('multiselect').removeClass('selected');
        		else{

        			$(this).removeClass('multiselect').toggleClass('selected');
        		}

        	});
        }else{
        	this.container.addClass('no-click');
        }

        this.create();


    }

    this.updateRows = function(num){
    	var temp = this.rows;
    	temp += num;
    	if(temp >= min && temp <= max){
    		this.rows =temp;
    		this.regenerate();
    	}

    }

    this.updateCols = function(num){
    	var temp = this.cols;
    	temp += num;
    	if(temp >= min && temp <= max){
    		this.cols = temp;
    		this.regenerate();
    	}

    }

    this.create = function(){
    	var height = 100/this.rows;
    	var width = 100/this.cols;

		var box = $('<div class="box"></div>').height(height+'%').width(width+'%');//.width(width+'%');


		for (var r = 0; r < this.rows; r++) {
			//var tr = $('<div class="tr">');//.height(height+'%');

			for (var c = 0; c < this.cols; c++) {
				//tr.append(); 
				var court_id = c+(r*this.cols)+1;
				this.container.append(box.clone().addClass('r'+r+' c'+c).html(court_id).attr('data-court_id', court_id));
			}
		}
	}
	this.regenerate = function(){
		this.container.empty();
		this.create();
	}
};


divisibleRoomPanel = (function() {

	var rdrop = $('#manage-divisible-room select[name=room_id]');
	var urlBase = 'facilities/';
	var divisibleForm = $('#manage-divisible-room-form');

	divisibleForm.submit(function(){

		$.post( urlBase + "saveDivisibleRoom", { 
			room_id: rdrop.val(),
			rows: manage_rooms.rows,
			cols: manage_rooms.cols })
		.done(function( result ) {
			alert(result);
			divisiblerooms.refresh();
		});
	});

	manage_rooms  = new roomDivider();
	manage_rooms.init($('#divisible-room'), false);

	$('#add-row').click(function(){ manage_rooms.updateRows(1) });
	$('#add-col').click(function(){ manage_rooms.updateCols(1) });
	$('#del-row').click(function(){ manage_rooms.updateRows(-1) });
	$('#del-col').click(function(){ manage_rooms.updateCols(-1) });

	rdrop.change(function(){

		$.getJSON(urlBase + 'getDivisibleRoom/' + $(this).val(), function(data) {
			if(data.length>0){
				manage_rooms.cols = parseInt(data[0].cols);
				manage_rooms.rows = parseInt(data[0].rows);
			}else{
				manage_rooms.cols = 1;
				manage_rooms.rows = 1;
			}
			manage_rooms.regenerate();
			divisiblerooms.refresh();
		});
	});

	return { 
		drop:rdrop
	};

})();


assignDivPanel = (function() {
	var container = $('#possible-sports');
	var sportlist = $('#sports-list');
	var divdrop = $('#select-divisible-room select[name=room_id]');
	var urlBase = 'facilities/';
	var divisions = $('#sports-divisions');
	
	sportlist.on('click', 'a.list-group-item', function(e){
		e.preventDefault();
		$(this).siblings('.active').removeClass('active');
		$(this).addClass('active');
	});


	
	divdrop.change(function(){

		$.getJSON(urlBase + 'getDivisibleRoom/' + $(this).val(), function(data) {
			if(data.length>0){
				manage_sports.cols = parseInt(data[0].cols);
				manage_sports.rows = parseInt(data[0].rows);
			}else{
				alert('Error: room may not be divisivble please refresh.')
			}
			manage_sports.regenerate();
		});
	});
	

	manage_sports  = new roomDivider();
	manage_sports.init($('#add-sports-to-room'), true);


	getSelectedSport = function(){
		return sportlist.find('.active').data('class_type_id');
	}



	return { 
		drop:divdrop,
		list:sportlist,
		getSelectedSport: getSelectedSport,
		divisions: divisions
	};

})();


$(function(){

	$(document)
	.on("classtypesRefreshed", function(){
		assignDivPanel.list.html(classtypes.list.html());
	})

	.on("roomsRefreshed", function(){
		divisibleRoomPanel.drop.html(rooms.drop.html());
	})

	.on("divisibleroomsRefreshed", function(){
		assignDivPanel.drop.html(divisiblerooms.drop.html());
	})

	.on("divisionAdded", function(){
		var sport = assignDivPanel.getSelectedSport();
		if(sport){
			assignDivPanel.divisions.html(ps.getDivisions(sport));

		}
	});

	classtypes.refresh();
	rooms.refresh();
	divisiblerooms.refresh();

	
});

