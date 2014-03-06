/**
 * Function that replaces and returns the element replacing
 * http://jquery.10927.n7.nabble.com/replaceWith-returns-the-replaced-element-tp79816p79823.html
 */
 $.fn.replaceWithAndReturnNew = function(htmls){
 	var replacer = $(htmls);
 	$(this).replaceWith(replacer);
 	return replacer;
 };


 $('#page-body')
 
 /* Select anywhere along a checkbox-group row  */
 .on('click', '.checkbox-group.list-group .list-group-item', function() {
 	$(this).find('input[type=checkbox]').trigger('click');

 })

 .on('click', '.dropdown-menu.multi-select li', function(e) {
 	e.preventDefault();
 	e.stopPropagation();
 	$(this).toggleClass('selected');
 })

 /* when checked add selected to the list item */
 .on('click', '.checkbox-group.list-group .list-group-item input[type=checkbox]', function() {
 	$(this).parent('.list-group-item').toggleClass('selected');
 })


 /* allow checkboxs to click itself inside a checkbox group */
 .on('click', '.checkbox-group.list-group .list-group-item input', function(e) {
 	e.stopImmediatePropagation();
 })

 /* change an editable span into an input box */
 .on('click', '.checkbox-group span.editable', function(e) {
 	var contents = $(this).html();
 	$(this).replaceWithAndReturnNew('<input class="form-control input-sm editable" data-previous="' + contents +'" type="text" value=\"' + contents + '" />').focus();
 	e.stopImmediatePropagation();
 })

 /* change an editable input box back into an span */
 .on('blur', '.checkbox-group input.editable', function(e) {
 	$(this).replaceWith(function () {
 		return '<span class="editable">' + $(this).val() + '</span>';
 	});
	 //	e.stopImmediatePropagation();
	});


 $('.time.timepicker').datetimepicker({	pickDate: false });


 $('.date.datepicker').datetimepicker({ pickTime:false });




/**
 * Custom Alert Box
 */
 window.old_alert = window.alert;

 window.alert = function(msg, fallback){
 	if(!msg){
 		return;
 	}
 	if(fallback){
 		old_alert(msg);
 		return;
 	}

 	bootbox.alert({message: msg, className: 'alert' });

 };

 jQuery.fn.exists = function(){return this.length>0;}

 $('INPUT.minicolors-inline').minicolors({ theme: 'bootstrap', control: 'wheel' });
 
 /* prevent forms submitting */
 $(document).on('submit', 'form.prevent', function(e) {
 	e.preventDefault();
 });

/**
 * Forces a reload of all stylesheets by appending a unique query string
 * to each stylesheet URL.
 * http://stackoverflow.com/a/2024618
 */
 function reloadStylesheets(classname) {

 	var queryString = '?reload=' + new Date().getTime();
 	$('link[rel="stylesheet"]').each(function () {
 		if($(this).is('.' + classname)){
 			this.href = this.href.replace(/\?.*|$/, queryString);
 		}
 	});
 }

// swapMode = function ($it) {
//    if ($it.html() != "Overview") {
//        $("label.editable").replaceWith(function () {
//            return "<input class=\"form-control input-sm editable\" id=\"" + $(this).attr('id') + "\" type=\"text\" value=\"" + $(this).html() + "\" />";
//        });
//        $it.html("Overview");
//    } else {
//        $("input[type=text].editable").replaceWith(function () {
//            return "<label class=\"editable\" id=\"" + $(this).attr('id') + "\">" + $(this).val() + "</label>";
//        });
//        $it.html("<i class=\"fa fa-pencil fa-fw\"></i> Edit</i>");
//    }
// },


var ClassTypes = function() {
	var table, drop, list, urlBase, sportsdrop, sportslist;
	
	var init = function() {
	 table = $('<tbody></tbody>');
	 drop = $('<select></select>');
	 sportsdrop = $('<select></select>');
	 list = $('<ul></ul>');
	 sportslist = $('<ul></ul>');
	 urlBase = "class_type/";
	}

	var createListItem = function(type){
		return $('<a href="#" data-class_type_id="' + type['class_type_id'] + '" class="list-group-item">' + type['class_type'] + '</a>');
	}

	var createRow = function (type) {
		return($('<tr data-class_type_id="' + type['class_type_id'] + '"></tr>')
			.append('<td class="class_type">'+type['class_type'] + '</td>')
			.append('<td class="class_description">' + type['class_description'] +'</td>')
			.append('<td data-category_id='+ type['category_id'] +' class="category">' + type['category'] +'</td>') 
			);			
	}

	var createOption = function (type) {
		return($('<option></option>').val(type['class_type_id']).append(type['class_type']));		

	}


	this.refresh = function () {		
		$.getJSON(urlBase + 'getClassTypes', function(data) {

			clear();
			if(data.length>0){
				$.each( data, function( key, type ) {
					table.append(createRow(type));
					
					if(type['is_sport'] == 1){
						sportsdrop.append(createOption(type));
						sportslist.append(createListItem(type));
					}else{
						drop.append(createOption(type));
						list.append(createListItem(type));
					}
				});

			}
			update();

		});
	}

	var clear = function() {
		table.empty();
		drop.html('');
		sportsdrop.html('');
	}
	


	var update = function () {
		$.event.trigger({
			type: "classtypesRefreshed",
			message: "Hello World!",
			time: new Date()
		});
		
		$('[type=dropdown].sportsclasstype').html(sportsdrop.html());
		$('[type=dropdown].classtype').html(drop.html());
		$('table.classtype tbody').html(table.html());
		$('ul.classtype').html(list.html());
		$('ul.sportsclasstype').html(sportslist.html());
		
	}

	init();


};

var classtypes = new ClassTypes();



var Categories = function() {
	var $this, urlBase, list, drop;
	
	
	var init = function() {
	
		 $this = this;
		 urlBase 		= "category/";
		 hiya 		= "category/";
		 list = $('<ul></ul>');
		 drop = $('<select></select>');
	}


	this.refresh = function () {
		$.getJSON(urlBase + 'fetchAll', function(data) {

			clear();
			if(data.length>0){
				$.each( data, function( key, cat ) {
					setupCategories(cat);
			
				});
			}
			update();
		});

	}
	
	var setupCategories = function(cat) {
		list.append(createListItem(cat['category_id'], cat['category'], cat['color']));
		drop.append(createOption(cat));
	
	}

	var initColors = function() {
		$('INPUT.minicolors').minicolors({
			hide: saveColor,
			show: storeColor,
		});
	}
	
	var update = function() {
		$.event.trigger({
			type: "categoriesRefreshed",
			message: "Hello World!",
			time: new Date()
		});
		
		$('ul.categories').html(list.html());
		$('[type=dropdown].categories').html(drop.html());
		initColors();
	}
	
	var createOption = function (type) {
		return($('<option></option>').val(type['category_id'])
			.append(type['category']));			
	} 
	
	this.getDropdown = function() {
		return drop.html();
	}
	
	var createListItem = function(id, name, color){
		if(id != 1){
			return $('<li class="list-group-item"></li>')
			.append($('<input class="pull-right" name="category_id[]" value="'+ id + '" type="checkbox">'))
			.append($('<input>')
				.attr({
					type: 'hidden',
					class: 'minicolors',
					value: color,
					size: 7,
					'data-category_id': id
				}))

			.append('<span class="editable">' + name + '</span>');
		}else{
			return null;
		}
	}

	var clear = function() {
		list.empty();
		drop.html('');
	}
	
	init();

};

var categories = new Categories();




var Rooms = function() {

	var urlBase, drop;
	
	var init = function() {
		urlBase = "room/";
		drop = $('<select></select>');
	}

	var createOption = function (room) {
		return($('<option></option>').val(room['room_id']).append(room['room']));
	}


	 this.refresh = function () {		
		$.getJSON(urlBase + 'getRoomIDs', function(data) {

			clear();
			if(data.length>0){
				$.each( data, function( key, room ) {
					drop.append(createOption(room));
				});

			}
			update();

		});
	}

	var clear = function() {
		drop.html('');
	}


	var update = function () {
		$.event.trigger({
			type: "roomsRefreshed",
			message: "Hello World!",
			time: new Date()
		});
		
		$('[type=dropdown].rooms').html(drop.html());
	}
	
	init();

};
var rooms = new Rooms();



var DivisibleRooms = function() {

	var drop, urlBase;
	
	var init = function() {
		 drop = $('<select></select>');
		 urlBase = 'facilities/';
	}


	this.refresh = function () {
		$.getJSON(urlBase + 'getDivisibleRooms', function(data) {

			drop.empty();
			if(data.length>0){
				$.each( data, function( key, cat ) {
					drop.append(createOption(cat));
				});

			}

			update();

		});

	},

	createOption = function (type) {
		return($('<option></option>').val(type['room_id'])
			.append(type['room']));			
	},


	update = function() {
		$.event.trigger({
			type: "divisibleroomsRefreshed",
			time: new Date()
		});
		
		$('[type=dropdown].divisiblerooms').html('<option value="" disabled selected>Select a room</option>' + drop.html());
	}
	
	init();
	
};

var divisiblerooms = new DivisibleRooms();


