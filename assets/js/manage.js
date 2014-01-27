$( document ).ready(function() {


	/* prevent forms submitting */
	$('form.prevent').submit(function(e) {
		e.preventDefault();
	});

	$('#page-body').on('click', '.minicolors-swatch-color', function(e) {
		e.stopImmediatePropagation(); //prevent clicking the row when selecting color swatch
	});
	
	var categories, addclasstypes, manageclasstypes;

	categories = (function() {

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
						manageclasstypes.category_id.append(createOption(cat));
					});
					
				}
				
				$categorylist.html($tempList.html());
				initColorPickers();
			});
		},

		clear = function() {
			$categorylist.empty();
			manageclasstypes.category_id.html('');
		},

		createOption = function (type) {
			return($('<option value"' + type['class_category_id'] + '"></option>')
				.append(type['category']));			
		},

		createListItem = function(id, name, color){
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
				.append(name);
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
				  .done(function( data ) {
				    alert("Name set");
				  });
			 }
		},
		
		resetAddForm = function() {
			//todo
		},
		
		addCategory = function() {
			$.ajax({
			   url: urlBase + "addCategory/",
			   type: "POST",
			   data:  addForm.serialize(),
			   success: function() {
			   	categories.refresh();
			   	resetAddForm();
			  },
			  error: function(){
			    alert('Error occurred');
			  },
			});
			
		},
		removeCategory = function() {
		
			$.post( urlBase + "removeCategories/",
					removeForm.serialize(), 
					function(result) {
					  alert(result);
					  categories.refresh();
					  resetAddForm();
					})
				  .fail(function(result) {
				    alert("Error: " + result );
				  });

		}
		

		return {
			refresh: refresh,
			initColorPickers: initColorPickers,
			urlBase : urlBase, 
			addCategory : addCategory,
			removeCategory : removeCategory,  
			addForm: addForm, 
			removeForm: removeForm
		};

	})();
	
	addclasstypes = (function() {
		//var $classTypeList = $( "#class-type-list" );
		var urlBase = "class_type/";
		var form = $('form#add-class-type-form'); 
		
		addNewClassType = function() {
			  $.ajax({
			    url: urlBase + "addClassType/",
			    type: "POST",
			    data:  form.serialize(),
			    success: function() {
			    	//categories.refresh();
			    	  alert('Success');
			    	  resetAddForm();
			    	  
			   },
			   error: function(){
			     alert('Error occurred');
			   },
			 });
			
		},
		
		resetAddForm = function () {
			//todo
		}
	
		
		return {
			addNewClassType: addNewClassType,
			form: form
		};

	})();
	
	
	var manageclasstypes = (function() {
		var modal =  $('#modal-edit-class-type');
		var form = modal.find('#edit-class-type-form');
		
		var class_type_id = form.find('input[name=class_type_id]');
		var class_type = form.find('input[name=class_type]');
		var class_description = form.find('textarea[name=class_description]');
		var category_id = form.find('select[name=category_id]');
		
		var typeTable = $('table#class-types-table tbody'); 
			
		var urlBase = "class_type/";
			
		setupModal = function (ci, ct, cd) {				
			class_type_id.val(ci);
			class_type.val(ct);
			class_description.html(cd);
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
			 
		},
		
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
			modal: modal,
			setupModal: setupModal,
			form: form,
			sendForm: sendForm,
			category_id: category_id,
			
		};

	})();
	
	categories.initColorPickers();
	
	$('INPUT.minicolors-inline').minicolors({
		theme: 'bootstrap',
		control: 'wheel',
	});
	
	
	 categories.addForm.submit(function(){ categories.addCategory() });
	
	
	categories.removeForm.submit(function(){ categories.removeCategory() });
	

	addclasstypes.form.submit(function(){ addclasstypes.addNewClassType() });
	
	$('table#class-types-table tbody').on('click','tr',function(e){
		manageclasstypes.setupModal($(this).data('class_type_id'), $(this).find('.class_type').html(), $(this).find('.class_description').html());
		
		manageclasstypes.modal.modal('show');
	});
	
	manageclasstypes.form.submit(function() { manageclasstypes.sendForm() });

	 $('#manage-categories')

 	/* Select anywhere along a checkbox-group row  */
 	.on('blur', 'input.editable', function(e) {
	 	if($(this).val() != $(this).data('previous')){
	 	
	 		$.post( categories.urlBase + 'setName', { category_id: $(this).parent('.list-group-item').data('category_id'), category: this.value })
	 		  .done(function( data ) {
	 		    alert("Color saved");
	 		  }); 		
	 	}
	 });



});