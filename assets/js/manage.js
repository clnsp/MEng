$( document ).ready(function() {

	var datepicker  = new function() {

		this.cal = $('#date-selector').multiDatesPicker({
			numberOfMonths: [2,2]
		});

		this.getDates = function() {
			return this.cal.multiDatesPicker('getDates');
		}

		this.hasDates = function() {
			return this.getDates().length != 0;
		}

		this.clear = function() {
			this.cal.multiDatesPicker('resetDates');
		}

		this.addDates = function(arr) {
			this.cal.multiDatesPicker('addDates', arr);
		}

		this.repeatDates = function(repeatType, stop) {
			if(stop != ''){
				var calDates = this.cal.multiDatesPicker('getDates');
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

				if(newDates.length > 0){
					this.cal.multiDatesPicker('addDates', newDates);
				}
			}
		}
	};

	var categoriesPanel = new function() {

		var categorylist 	= $("#class-categories-list");
		var container 	= $("#manage-categories");
		var currentColor 	= null;
		var addForm 		= $("#add-category-form");
		var removeForm 		= $('form#remove-category-form');
		var urlBase 		= siteUrl + "category/";


		addForm.submit(function(){ addCategory() });
		removeForm.submit(function(){ removeCategory() });

		/* Select anywhere along a checkbox-group row  */
		container
		.on('blur', 'input.editable', function(e) {
			if($(this).val() != $(this).data('previous'))
				storename($(this).siblings('[name="category_id[]"]').val(), this.value );
		}).on('click', '.toggle.on', function() {
			$(this).toggleClass('on off');
			categorylist.find('li:not(.selected)').each(function(){
				$(this).click();
			}) 	
		})

		.on('click', '.toggle.off', function() {
			$(this).toggleClass('on off');
			categorylist.find('li.selected').each(function(){
				$(this).click();
			}) 	
		});


		 storeColor = function() {
			currentColor = this.value;
		}

		 saveColor = function() {
			if(this.value != currentColor){
				$.post( urlBase + 'setColor', { category_id: $(this).data('category_id'), color: this.value })
				.done(function( result ) {
					alert(result);
				});
			}
		}

		var resetAddForm = function() {
			addForm[0].reset();
		}

		var addCategory = function() {
			$.ajax({
				url: urlBase + "addCategory/",
				type: "POST",
				data:  addForm.serialize(),
				success: function(result) {
					alert(result);
					categories.refresh();
					resetAddForm();
				},
				error: function(){
					alert('Error occurred');
				},
			});

		}

		var removeCategory = function() {
			if(removeForm.serialize()==""){
				alert("No categories selected");
				return;
			}
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
									forceRemoveCategories();
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

		}

		var forceRemoveCategories = function(){
			$.post( urlBase + "forceRemoveCategories/", removeForm.serialize())
			.done(function(result) {

				alert(result);
				classtypes.refresh();
				categories.refresh();


			})
			.fail(function(result) {
				alert("Error: " + result );
			});
		}

		var storename = function(category_id, category){
			$.post( urlBase + 'setName', { category_id: category_id, category: category })
			.done(function( result ) { alert(result); })
			.fail(function( result ) { alert(result); });
		}
	};

	var addClassTypePanel = new function() {
		var urlBase = siteUrl + "class_type/";
		var form = $('form#add-class-type-form');
		var categoryDropdown = form.find('select[name=category_id]');

		form.submit(function(){ 
			sendForm()
		});


		var sendForm = function() {

			$.post(urlBase + 'addClassType/', form.serialize())
			.done(function( result ) { 
				alert(result); 
				resetAddForm();
				classtypes.refresh();
			})
			.fail(function( result ) { alert(result); });			
		}


		var resetAddForm = function () {
			form[0].reset();
		}
	};
	
	
	var addBlockClassesPanel = new function() {
		var container = $('#add-block-classes');
		var urlBase = siteUrl + "class_type/";

		this.form = container.find('#add-block-classes-form');
		this.classTypeDrop = this.form.find('select[name=class_type_id]');
		this.roomDrop = this.form.find('select[name=room_id]');
		var until = this.form.find('input[name=until]');
		var repeat = this.form.find('select[name=repeat]');

		var resetbtn = this.form.find('button#clear-cal-btn');
		var repeatBtn = container.find('#apply-repeat-btn');
		var importBtn = container.find('#import-block-button');
		var formCopy = this.form;

		this.form.submit(function() { 
			if(datepicker.hasDates()){
				bootbox.confirm("<h4 class='modal-title'>Confirmation</h2><p>Are you sure you want to add new bookable classes? You will add classes for all the dates on the current calendar, please make sure to review these before saving."/*to the following dates:</p>" + datepicker.getDates().toString()*/, function(result) {
					if(result)
						sendForm();
				}); 
			}
			else 
				alert("No dates selected");

		});

		importBtn.click(function (event) {
			event.preventDefault();
			importDialog.show(true);
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

			var formSz = formCopy.serializeArray();
			var dates = datepicker.getDates();
			dates.forEach(function(date) {
				formSz.push({name: 'repeat_dates[]', value: date});
			});

			$.post( urlBase + 'addInstances/', formSz)
			.done(function( data ) {
				alert(data);
			});

		}
	};

	categories.refresh();
	classtypes.refresh();
	rooms.refresh();
	
});

/* Focus input when input addon is clicked */
$('.input-group-addon').click(function(){
	$(this).siblings('input').focus();
});

$('#apply-repeat-btn').tooltip();

$('#add-block-button').hover(function(){
	$('#apply-repeat-btn:not(.disabled)').tooltip('show');
});

$('#manage-categories').on('click', '.minicolors-swatch, .minicolors-panel', function(e) {
	e.stopImmediatePropagation();
	e.preventDefault();
});
