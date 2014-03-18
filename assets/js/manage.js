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
		var currentColor 	= null;
		var addForm 		= $("#add-category-form");
		var removeForm 		= $('form#remove-category-form');
		var urlBase 		= siteUrl + "category/";


		addForm.submit(function(){ addCategory() });
		removeForm.submit(function(){ removeCategory() });

		/* Select anywhere along a checkbox-group row  */
		$('#manage-categories').on('blur', 'input.editable', function(e) {
			if($(this).val() != $(this).data('previous'))
				storename($(this).parent('.list-group-item').data('category_id'), this.value );
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

		resetAddForm = function() {
			addForm[0].reset();
		}

		addCategory = function() {
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
		}

		storename = function(category_id, category){
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


		sendForm = function() {

			$.post(urlBase + 'addClassType/', form.serialize())
			.done(function( result ) { 
				alert(result); 
				resetAddForm();
				classtypes.refresh();
			})
			.fail(function( result ) { alert(result); });			
		}


		resetAddForm = function () {
			form[0].reset();
		}
	};

	var importDialog = new function(){
		var modal = $('#modal-manage-blocks');	
		var urlBase = siteUrl + ('class_type/');

		var table = modal.find('tbody');
		var tableBuffer = $('<tbody>');
		var button = $('<button>').html('Select').addClass("configure-block-btn btn btn-primary");
		var $this = $this;

		modal.on('click', '.configure-block-btn', function(){
			$row = $(this).parents('tr');
			$row.find()
			addBlockClassesPanel.classTypeDrop.val($row.find('[data-class_type_id]').data('class_type_id'));
			addBlockClassesPanel.roomDrop.val($row.find('[data-room_id]').data('room_id'));
			addBlockClassesPanel.form.find('input[name=class_start_time]').val($row.find('[data-class_start_time]').data('class_start_time'));
			addBlockClassesPanel.form.find('input[name=class_start_time]').val($row.find('[data-class_end_time]').data('class_end_time'));
			addBlockClassesPanel.form.find('[type=submit]').attr('class', 'btn btn-warning').html('Save Changes');
			fetchBlockDates($(this).data('block_booking_id'));

			modal.modal('hide');
		});

		var fetchBlockDates = function(bid){
			$.getJSON(urlBase + 'getBlockBookingDates/' + bid , function(data) {
				datepicker.clear();
				console.log(data);
				var arr = new Array();
				
				for (var key in data) {
					arr.push(new Date(data[key]['class_start_date']));
				}

				datepicker.addDates(arr);
			});

			return 
		}

		var createRow = function (block) {
			var tr = $('<tr>');
			tr.append($('<td>').attr('data-room_id', block['room_id']).append(block['room']));
			tr.append($('<td>').attr('data-class_type_id', block['class_type_id']).append(block['class_type']));
			tr.append($('<td>').attr('data-class_start_time', block['class_start_time']).append(block['class_start_time']));
			tr.append($('<td>').attr('data-class_end_time', block['class_end_time']).append(block['class_end_time']));
			tr.append($('<td>').append(button.clone().attr('data-block_booking_id', block['block_booking_id'])));
			return tr;
		}

		this.show = function (show) {
			modal.modal('show');

			$.getJSON(urlBase + 'getBlockBookingInformation', function(data) {

				clear();
				if(data.length>0){
					$.each( data, function(key, block) {
						tableBuffer.append(createRow(block));
					});

				}
				update();

			});
		}


		var update = function(){
			table.html(tableBuffer.html());
		}

		var clear = function(){
			tableBuffer.html('');
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
				bootbox.confirm("<h4 class='modal-title'>Confirmation</h2><p>Are you sure you want to add new bookable classes? You will add classes to the following dates:</p>" + datepicker.getDates().toString(), function(result) {
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

		sendForm = function () {

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

$('#page-body').on('click', '.minicolors-swatch-color', function(e) {
	e.stopImmediatePropagation();
});
