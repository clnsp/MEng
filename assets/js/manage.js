$( document ).ready(function() {


	/* prevent forms submitting */
	$('form.prevent').submit(function(e) {
		e.preventDefault();
	});

	$('#page-body').on('click', '.minicolors-swatch-color', function(e) {
		e.stopImmediatePropagation(); //prevent clicking the row when selecting color swatch
	});
	
	var categoriesPanel, addClassTypePanel, manageClassTypesPanel, editClassTypeModal, addBlockClassesPanel, categories, classtypes;



	categoriesPanel = (function() {

		var categorylist 	= $("#class-categories-list");
		var currentColor 	= null;
		var addForm 		= $("#add-category-form");
		var removeForm 		= $('form#remove-category-form');
		var urlBase 		= "category/";


		addForm.submit(function(){ categoriesPanel.addCategory() });
		removeForm.submit(function(){ categoriesPanel.removeCategory() });
		
		/* Select anywhere along a checkbox-group row  */
		$('#manage-categories').on('blur', 'input.editable', function(e) {
			if($(this).val() != $(this).data('previous'))
				categoriesPanel.storename($(this).parent('.list-group-item').data('category_id'), this.value );
		});
		
		initColorPickers = function() {
			$('INPUT.minicolors').minicolors({
				hide: saveColor,
				show: storeColor,
			});
		},
		
		storeColor = function() {
			currentColor = this.value;
		},
		
		saveColor = function() {
			if(this.value != currentColor){
				$.post( urlBase + 'setColor', { category_id: $(this).data('category_id'), color: this.value })
				.done(function( result ) {
					alert(result);
				});
			}
		},
		
		resetAddForm = function() {
			addForm[0].reset();
		},
		
		addCategory = function() {
			$.ajax({
				url: urlBase + "addCategory/",
				type: "POST",
				data:  addForm.serialize(),
				success: function(result) {
					alert(result);
					categories.refresh();
					categoriesPanel.resetAddForm();
				},
				error: function(){
					alert('Error occurred');
				},
			});
			
		},
		removeCategory = function() {

			$.post( urlBase + "removeCategories/", removeForm.serialize())
			.done(function(result, textStatus, jqXHR) {
				if(jqXHR.status == 304){
					bootbox.dialog({
						message: "<p><b>Not all classes were removed. You cannot remove categories that are already assigned to class types.</b></p><p>You should reassign class types with this category or you can continue and assign the class types as uncategorised.</p>",
						title: "Class Type Category Conflict",
						buttons: {
							success: {
								label: "Cancel",
								className: "btn-default",
								callback: function() {
									bootbox.hideAll();
								}
							},
							danger: {
								label: "Uncategorise Classes",
								className: "btn-danger",
								callback: function() {
									this.forceRemoveCategories();
								}
							}
							
						}
					});	
				}else{
					alert(result);
					categories.refresh();
					resetAddForm();
				}
				
			})
			.fail(function(result) {
				alert("Error: " + result );
			});

		},

		forceRemoveCategories = function(){
			$.post( urlBase + "forceRemoveCategories/", removeForm.serialize())
			.done(function(result) {
				
				alert(result);
				classtypes.refresh();
				categories.refresh();

				
			})
			.fail(function(result) {
				alert("Error: " + result );
			});
		},

		storename = function(category_id, category){
			$.post( categoriesPanel.urlBase + 'setName', { category_id: category_id, category: category })
			.done(function( result ) { alert(result); })
			.fail(function( result ) { alert(result); });
		}
		

		return {
			initColorPickers: initColorPickers,
			urlBase : urlBase, 
			addCategory : addCategory,
			removeCategory : removeCategory,  
			addForm: addForm, 
			removeForm: removeForm,
			storename : storename,
			resetAddForm: resetAddForm,
			categorylist: categorylist
		};

	})();
	
	addClassTypePanel = (function() {
		//var $classTypeList = $( "#class-type-list" );
		var urlBase = "class_type/";
		var form = $('form#add-class-type-form');
		var categoryDropdown = form.find('select[name=category_id]');
		
		form.submit(function(){ addClassTypePanel.sendForm() });
		
		
		sendForm = function() {

			$.post(urlBase + 'addClassType/', form.serialize())
			.done(function( result ) { 
				alert(result); 
				addClassTypePanel.resetAddForm();
				classtypes.refresh();
			})
			.fail(function( result ) { alert(result); });			
		},

		
		resetAddForm = function () {
			form[0].reset();
		}

		
		return {
			sendForm: sendForm,
			form: form,
			categoryDropdown : categoryDropdown,
			resetAddForm: resetAddForm
		};

	})();
	

	editClassTypeModal = (function(){
		var modal =  $('#modal-edit-class-type');
		var form = modal.find('#edit-class-type-form');
		var removeSubmit = modal.find('#remove-submit');

		var class_type_id = form.find('input[name=class_type_id]');
		var class_type = form.find('input[name=class_type]');
		var class_description = form.find('textarea[name=class_description]');
		var category_id = form.find('select[name=category_id]');

		var urlBase = "class_type/";
		
		form.submit(function() { editClassTypeModal.sendForm() });
		removeSubmit.click(function() { editClassTypeModal.sendRemoveForm() });
		
		$('table#class-types-table tbody').on('click','tr',function(e){
			editClassTypeModal.setupModal($(this).data('class_type_id'), $(this).find('.class_type').html(), $(this).find('.class_description').html(), $(this).find('.category').data('category_id'));
		});


		setupModal = function (ci, ct, cd, catid) {				
			class_type_id.val(ci);
			class_type.val(ct);
			class_description.val(cd);
			modal.modal('show');
			category_id.html(categories.drop.html());
			category_id.val(catid);
		},

		tearDownModal = function() {
			class_type_id.val('');
			class_type.val('');
			class_description.html('');
		},

		sendForm = function (id) {
			
			$.post( urlBase + 'updateClassType/', form.serialize())
			.done(function( data ) {
				alert(data);
				modal.modal('hide');
				classtypes.refresh();
			});

		},

		sendRemoveForm = function (id) {
			
			$.post( urlBase + 'removeClassType/', form.serialize())
			.done(function( data ) {
				alert(data);
				modal.modal('hide');
				refresh();
			});

		}

		return{
			modal: modal,
			setupModal: setupModal,
			form: form,
			sendForm: sendForm,
			category_id: category_id,
			removeSubmit: removeSubmit,
			sendRemoveForm: sendRemoveForm

		};

	})();
	
	manageClassTypesPanel = (function() {
		var typeTable = $('table#class-types-table tbody'); 

		return {table: typeTable};
	})();


	
	addBlockClassesPanel = (function() {

		var form = $('#add-block-classes #add-block-classes-form');
		var classTypeDrop = form.find('select[name=class_type_id]');
		var roomDrop = form.find('select[name=room_id]');
		var urlBase = "class_type/";
		
		form.submit(function() { 
			if(datepicker.hasDates())
				addBlockClassesPanel.sendForm();
			else 
				alert("No dates selected");
			
			});

		sendForm = function () {
			
			 $.post( urlBase + 'addInstances/', form.serialize())
			 .done(function( data ) {
			 	alert(data);
			 });

		}

return {

	drop: classTypeDrop,
	form: form,
	roomDrop: roomDrop,
	sendForm: sendForm

};

})();

	rooms = (function() {

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
			addBlockClassesPanel.roomDrop.html(rdrop.html());
		}
		
		
				
		

		return {

			refresh: refresh

		};

	})();

classtypes = (function() {
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
				manageClassTypesPanel.table.html(cttable.html());
				addBlockClassesPanel.drop.html(ctdrop.html());
			}
			

	return {
		refresh: refresh,
	};

})();


categories = (function() {
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
				return $('<li class="list-group-item"></li>').attr('data-category_id', id)
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
			categoriesPanel.categorylist.html(catList.html());
			categoriesPanel.initColorPickers();
			addClassTypePanel.categoryDropdown.html(catDrop.html());
		}

		return { 
			refresh: refresh,
			list: catList,
			drop: catDrop
		};

	})();
	
	var datepicker = (function() {
	
		var cal = $('#date-selector').multiDatesPicker();
		var until = $('#add-block-classes input[name=until]');
		var repeat = $('#add-block-classes select[name=repeat]');
		
		hasDates = function() {
			return cal.multiDatesPicker('getDates') == [];
		},
		
		repeatDates = function() {
			if(until.val() != ''){
				var calDates = cal.multiDatesPicker('getDates');
				var newDates = new Array();
				var stopDate = Date.parse(until.val());
				
				calDates.forEach(function(entry) {
					var day = Date.parse(entry);
					while(day < stopDate){
						day = day.add(7).days();
					    newDates.push(day.clone());
				    }
				});
				
				cal.multiDatesPicker('addDates', newDates);
			}
		}

		return { 
			cal:cal,
			hasDates: hasDates,
			repeat: repeat,
			until: until,
			repeatDates: repeatDates
		};

	})();
	
	
categories.refresh();
classtypes.refresh();
rooms.refresh();

$('INPUT.minicolors-inline').minicolors({ theme: 'bootstrap', control: 'wheel' });

/*  */
datepicker.repeat.change(function() {
	if($(this).val() == '0')
		datepicker.until.prop( "disabled", true );
	else{
		datepicker.until.prop( "disabled", false );
		repeatDates();
	}
	
	
});

datepicker.cal.multiDatesPicker('addDates', new Array(new Date()));
datepicker.cal.on('click', 'tr', function() {
	alert('update');
});




});