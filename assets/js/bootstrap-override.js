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

 window.alert = function(message, fallback){
 	if(fallback){
 		old_alert(message);
 		return;
 	}

 	bootbox.alert(message, null);

 };

 jQuery.fn.exists = function(){return this.length>0;}

 $('INPUT.minicolors-inline').minicolors({ theme: 'bootstrap', control: 'wheel' });
 
 /* prevent forms submitting */
 $('form.prevent').submit(function(e) {
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


var classtypes = (function() {
	var cttable = $('<tbody></tbody>');
	var ctdrop = $('<select></select>');

	var urlBase = "class_type/";

	ctcreateRow = function (type) {
		return($('<tr data-class_type_id="' + type['class_type_id'] + '"></tr>')
			.append('<td class="class_type">'+type['class_type'] + '</td>')
			.append('<td class="class_description">' + type['class_description'] +'</td>')
			.append('<td data-category_id='+ type['category_id'] +' class="category">' + type['category'] +'</td>') 
			);			
	},

	ctcreateOption = function (type) {
		return($('<option></option>').val(type['class_type_id']).append(type['class_type']));		

	},


	refresh = function () {		
		$.getJSON(urlBase + 'getClassTypes', function(data) {

			ctclear();
			if(data.length>0){
				$.each( data, function( key, type ) {
					cttable.append(ctcreateRow(type));
					ctdrop.append(ctcreateOption(type));
				});

			}
			ctupdate();

		});
	},

	ctclear = function() {
		cttable.empty();
		ctdrop.html('');
	},


	ctupdate = function () {
		$.event.trigger({
			type: "classtypesRefreshed",
			message: "Hello World!",
			time: new Date()
		});
	}


	return {
		refresh: refresh,
		drop: ctdrop,
		table: cttable
	};

})();


var rooms = (function() {

	var urlBase = "room/";
	var rdrop = $('<select></select>')

	rcreateOption = function (room) {
		return($('<option></option>').val(room['room_id']).append(room['room']));
	},


	refresh = function () {		
		$.getJSON(urlBase + 'getRoomIDs', function(data) {

			rclear();
			if(data.length>0){
				$.each( data, function( key, room ) {
					rdrop.append(rcreateOption(room));
				});

			}
			rupdate();

		});
	},

	rclear = function() {
		rdrop.html('');
	},


	rupdate = function () {
		$.event.trigger({
			type: "roomsRefreshed",
			message: "Hello World!",
			time: new Date()
		});	}





		return {

			refresh: refresh

		};

	})();

	var categories = (function() {
		var urlBase 		= "category/";
		var catList = $('<ul></ul>');
		var catDrop = $('<select></select>');

		refresh = function () {
			$.getJSON(urlBase + 'fetchAll', function(data) {

				catList.empty();
				if(data.length>0){
					$.each( data, function( key, cat ) {
						catList.append(createListItem(cat['category_id'], cat['category'], cat['color']));
						catDrop.append(createOption(cat));
					});

				}

				update();

			});

		},

		createOption = function (type) {
			return($('<option></option>').val(type['category_id'])
				.append(type['category']));			
		},

		createListItem = function(id, name, color){
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
		},

		clear = function() {
			categoriesPanel.categorylist.empty();
			addClassTypePanel.categoryDropdown.html('');
		},

		update = function() {
			$.event.trigger({
				type: "categoriesRefreshed",
				message: "Hello World!",
				time: new Date()
			});
		}

		return { 
			refresh: refresh,
			list: catList,
			drop: catDrop
		};

	})();