
var assignDivPanel, roomDivider;

roomDivider = (function(){
	var container;

	var rows = 2;
	var cols = 3;

	init = function(cont){
		this.container = $(cont).addClass('box-divider');
		this.container.on('click', '.box', function(e){
			if(e.shiftKey)
				$(this).toggleClass('multiselect').removeClass('selected');
			else{

				$(this).removeClass('multiselect').toggleClass('selected');
			}

		});

		create();
	},

	create = function(){
		var height = 100/rows;
		var width = 100/cols;

		var box = $('<div class="box"></div>');//.width(width+'%');


		for (var r = 0; r < rows; r++) {
			var tr = $('<div class="tr">');//.height(height+'%');

			for (var c = 0; c < cols; c++) {
				tr.append(box.clone().addClass('r'+r + ' c'+c)); 

				roomDivider.container.append(tr);
			}
		}
	},
	regenerate = function(){
		roomDivider.container.empty();
		create();
	},

	updateRows = function(num){
		rows += num;
		regenerate();
	},
	updateCols = function(num){
		cols += num;
		regenerate();
	}

	return { 
		init: init,
		updateRows: updateRows,
		updateCols: updateCols
	};


})();

assignDivPanel = (function() {

	var ctdrop = $('#add-possible-sport-form select[name=class_type_id]');

	$('#add-row').click(function(){ roomDivider.updateRows(1) });
	$('#add-col').click(function(){ roomDivider.updateCols(1) });
	$('#del-row').click(function(){ roomDivider.updateRows(-1) });
	$('#del-col').click(function(){ roomDivider.updateCols(-1) });

	return { 
		drop:ctdrop
	};

})();

$(function(){

	$(document)
	.on("classtypesRefreshed", function(){
		assignDivPanel.drop.html(classtypes.drop.html());
	});

	classtypes.refresh();
	roomDivider.init($('#divisible-room'));


});