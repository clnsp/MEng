$( document ).ready(function() {

	if($('#booking').is('.manage')){



		$('#page-body').on('click', '.minicolors-swatch-color', function(e) {
		e.stopImmediatePropagation(); //prevent clicking the row when selecting color swatch
	});
		
		var categoriesPanel, addClassTypePanel, manageClassTypesPanel, datepicker;



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
	



	
	manageClassTypesPanel = (function() {
		var typeTable = $('table#class-types-table tbody'); 

		return {table: typeTable};
	})();


	
	var addBlockClassesPanel = (function() {
		var container = $('#add-block-classes');
		var form = container.find('#add-block-classes-form');
		var classTypeDrop = form.find('select[name=class_type_id]');
		var roomDrop = form.find('select[name=room_id]');
		var urlBase = "class_type/";

		var until = form.find('input[name=until]');
		var repeat = form.find('select[name=repeat]');

		var resetbtn = form.find('button#clear-cal-btn');
		var repeatBtn = container.find('#apply-repeat-btn');

		form.submit(function() { 
			if(datepicker.hasDates()){
				bootbox.confirm("<h4 class='modal-title'>Confirmation</h2><p>Are you sure you want to add new bookable classes? You will add classes to the following dates:</p>" + datepicker.getDates().toString(), function(result) {
					if(result)
						sendForm();
				}); 
			}
			else 
				alert("No dates selected");
			
		});

		repeatBtn.click(function(){
			datepicker.repeatDates(repeat.val(), until.val());
		});

		resetbtn.click(function(){
			datepicker.cal.multiDatesPicker('resetDates');
		});

		repeat.change(function() {
			if($(this).val() == '0'){
				until.prop( "disabled", true );
				resetbtn.addClass('disabled');
				repeatBtn.addClass('disabled');
			}
			else{
				until.prop( "disabled", false );
				resetbtn.removeClass('disabled');
				repeatBtn.removeClass('disabled');

			}
		});

		var sendForm = function () {

			var formSz = form.serializeArray();
			var dates = datepicker.getDates();
			dates.forEach(function(date) {
				formSz.push({name: 'repeat_dates[]', value: date});
			});

			$.post( urlBase + 'addInstances/', formSz)
			.done(function( data ) {
				alert(data);
			});

		}

		return {};

	})();


	datepicker = (function() {

		var cal = $('#date-selector').multiDatesPicker({numberOfMonths: [2,2]});

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
		}



		return { 
			cal:cal,
			hasDates: hasDates,
			repeatDates: repeatDates,
			getDates : getDates,
		};

	})();


	categories.refresh();
	classtypes.refresh();
	rooms.refresh();

	
}
});