
var assignDivPanel, roomDivider, divisibleRoomPanel, manage_rooms, manage_sports;


roomDivider = function () {
    //assign _root and config private variables
    var _root = this;

    this.rows = 2;
    this.cols = 2;

    /*
        INITIALIZE
        */
        this.init = function(cont, clickable) {
        //some code
        this.container = $(cont).addClass('box-divider');

        if(clickable){
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
    	this.rows += num;
    	this.regenerate();
    }

    this.updateCols = function(num){
    	this.cols += num;
    	this.regenerate();
    }

    this.create = function(){
    	var height = 100/this.rows;
    	var width = 100/this.cols;

		var box = $('<div class="box"></div>');//.width(width+'%');


		for (var r = 0; r < this.rows; r++) {
			var tr = $('<div class="tr">');//.height(height+'%');

			for (var c = 0; c < this.cols; c++) {
				tr.append(box.clone().addClass('r'+r + ' c'+c)); 

				this.container.append(tr);
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
			cols: manage_rooms.cols }).done(function( result ) { alert(result)});
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
		});
	});

	return { 
		drop:rdrop
	};

})();


assignDivPanel = (function() {

	var ctdrop = $('#add-possible-sport-form select[name=class_type_id]');

	manage_sports  = new roomDivider();
	manage_sports.init($('#add-sports-to-room'), true);

	return { 
		drop:ctdrop
	};

})();


$(function(){

	$(document)
	.on("classtypesRefreshed", function(){
		assignDivPanel.drop.html(classtypes.drop.html());
	})

	.on("roomsRefreshed", function(){
		divisibleRoomPanel.drop.html(rooms.drop.html());
	});

	classtypes.refresh();
	rooms.refresh();

	
});

