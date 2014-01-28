$( document ).ready(function() {


	/* prevent forms submitting */
	$('form.prevent').submit(function(e) {
		e.preventDefault();
	});

	$('#page-body').on('click', '.minicolors-swatch-color', function(e) {
		e.stopImmediatePropagation(); //prevent clicking the row when selecting color swatch
	});
	
	var categoriesPanel, addClassTypePanel, manageClassTypesPanel, editClassTypeModal;

	categoriesPanel = (function() {

		var $categorylist 	= $("#class-categories-list");
		var $currentColor 	= null;
		var addForm 		= $("#add-category-form");
		var removeForm 		= $('form#remove-category-form');
		var urlBase 		= "category/";

		refresh = function() {

			$.getJSON(urlBase + 'fetchAll', function(data) {
				var $tempList = $('<ul></ul>');
				clear();
				if(data.length>0){
					$.each( data, function( key, cat ) {
						$tempList.append(createListItem(cat['category_id'], cat['category'], cat['color']));
						addClassTypePanel.categoryDropdown.append(createOption(cat));
					});
					
				}
				
				$categorylist.html($tempList.html());
				initColorPickers();
			});
		},

		clear = function() {
			$categorylist.empty();
			addClassTypePanel.categoryDropdown.html('');
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
					})
					.data('category_id', id))		
				.append('<span class="editable">' + name + '</span>');
			}else{
				return null;
			}
		},
		
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
					categoriesPanel.refresh();
					categoriesPanel.resetAddForm();
				},
				error: function(){
					alert('Error occurred');
				},
			});
			
		},
		removeCategory = function() {

			$.post( urlBase + "removeCategories/", removeForm.serialize())
			.done(function(result) {
				alert('Success: ' + result);
				categoriesPanel.refresh();
				resetAddForm();
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
			refresh: refresh,
			initColorPickers: initColorPickers,
			urlBase : urlBase, 
			addCategory : addCategory,
			removeCategory : removeCategory,  
			addForm: addForm, 
			removeForm: removeForm,
			storename : storename,
			resetAddForm: resetAddForm,
		};

	})();
	
	addClassTypePanel = (function() {
		//var $classTypeList = $( "#class-type-list" );
		var urlBase = "class_type/";
		var form = $('form#add-class-type-form');
		var categoryDropdown = form.find('select[name=category_id]');
		
		sendForm = function() {

			$.post(urlBase + 'addClassType/', form.serialize())
			.done(function( result ) { 
				alert(result); 
				addClassTypePanel.resetAddForm();
				manageClassTypesPanel.refresh();
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
	

	var editClassTypeModal = (function(){
		var modal =  $('#modal-edit-class-type');
		var form = modal.find('#edit-class-type-form');

		var class_type_id = form.find('input[name=class_type_id]');
		var class_type = form.find('input[name=class_type]');
		var class_description = form.find('textarea[name=class_description]');
		var category_id = form.find('select[name=category_id]');

		var urlBase = "class_type/";


		setupModal = function (ci, ct, cd, catid) {				
			class_type_id.val(ci);
			class_type.val(ct);
			class_description.html(cd);
			modal.modal('show');
			category_id.html(addClassTypePanel.categoryDropdown.html());
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
				alert("Changed class type");
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

		};

	})();
	
	var manageClassTypesPanel = (function() {
		var typeTable = $('table#class-types-table tbody'); 
		var urlBase = "class_type/";

		createRow = function (type) {
			return($('<tr data-class_type_id="' + type['class_type_id'] + '"></tr>')
				.append('<td class="class_type">'+type['class_type'] + '</td>')
				.append('<td class="class_description">' + type['class_description'] +'</td>')
				.append('<td data-category_id='+ type['category_id'] +' class="category">' + type['category'] +'</td>') 
				);			
		},



		refresh = function () {
			typeTable.empty();

			$.getJSON(urlBase + 'getClassTypes', function(data) {
				var $tempList = $('<tbody></tbody>');
				if(data.length>0){
					$.each( data, function( key, type ) {
						$tempList.append(createRow(type));

					});

				}
				typeTable.html($tempList.html());

			});
		}

		return {

			refresh: refresh,

		};

	})();

	categoriesPanel.refresh();
	manageClassTypesPanel.refresh();

	$('INPUT.minicolors-inline').minicolors({
		theme: 'bootstrap',
		control: 'wheel',
	});


	categoriesPanel.addForm.submit(function(){ categoriesPanel.addCategory() });


	categoriesPanel.removeForm.submit(function(){ categoriesPanel.removeCategory() });


	addClassTypePanel.form.submit(function(){addClassTypePanel.sendForm()});

	$('table#class-types-table tbody').on('click','tr',function(e){
		editClassTypeModal.setupModal($(this).data('class_type_id'), $(this).find('.class_type').html(), $(this).find('.class_description').html(), $(this).find('.category').data('category_id'));
	});

	editClassTypeModal.form.submit(function() { editClassTypeModal.sendForm() });

	$('#manage-categories')

	/* Select anywhere along a checkbox-group row  */
	.on('blur', 'input.editable', function(e) {
		if($(this).val() != $(this).data('previous')){
			categoriesPanel.storename($(this).parent('.list-group-item').data('category_id'), this.value );
		}
	});



});