
var assignDivPanel, roomDivider, setupRoomPanel, manage_rooms, manage_sports;


roomDivider = function () {
    //assign _root and config private variables
    var _root = this;

    var rows = 2;
    var cols = 3;

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
    	rows += num;
    	this.regenerate();
    }

    this.updateCols = function(num){
    	cols += num;
    	this.regenerate();
    }

    this.create = function(){
    	var height = 100/rows;
    	var width = 100/cols;

		var box = $('<div class="box"></div>');//.width(width+'%');


		for (var r = 0; r < rows; r++) {
			var tr = $('<div class="tr">');//.height(height+'%');

			for (var c = 0; c < cols; c++) {
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





setupRoomPanel = (function() {

	var rdrop = $('#manage-divisible-room select[name=room_id]');

	$('#add-row').click(function(){ manage_rooms.updateRows(1) });
	$('#add-col').click(function(){ manage_rooms.updateCols(1) });
	$('#del-row').click(function(){ manage_rooms.updateRows(-1) });
	$('#del-col').click(function(){ manage_rooms.updateCols(-1) });

	return { 
		drop:rdrop
	};

})();


assignDivPanel = (function() {

	var ctdrop = $('#add-possible-sport-form select[name=class_type_id]');




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
		setupRoomPanel.drop.html(rooms.drop.html());
	})

	;

	classtypes.refresh();
	rooms.refresh();

	manage_rooms  = new roomDivider();
	manage_rooms.init($('#divisible-room'), false);
	
	manage_sports  = new roomDivider();
	manage_sports.init($('#add-sports-to-room'), true);

});

