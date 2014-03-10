var editClassTypeModal = (function(){
		var modal =  $('#modal-edit-class-type');
		var form = modal.find('#edit-class-type-form');
		var removeSubmit = modal.find('#remove-submit');

		var class_type_id = form.find('input[name=class_type_id]');
		var class_type = form.find('input[name=class_type]');
		var class_description = form.find('textarea[name=class_description]');
		var category_id = form.find('select[name=category_id]');

		var urlBase = "class_type/";
		
		form.submit(function() { sendForm() });
		removeSubmit.click(function() { 

			bootbox.dialog({
				message: "Removing class types will also remove any associated classes that have been added to the system under this class type. Are you sure you want to continue?",
				title: "Warning",
				buttons: {
					main: {
						label: "Cancel",
						className: "btn-default",
						callback: function() {}
					},

					danger: {
						label: "Confirm",
						className: "btn-danger",
						callback: function() {
							sendRemoveForm() 

						}
					}
					
					
				}
			});

		});
		
		$('table#class-types-table tbody').on('click','tr',function(e){
			$(this).find('.class_type').find("span").remove();
			setupModal($(this).data('class_type_id'), $(this).find('.class_type').html(), $(this).find('.class_description').html(), $(this).find('.category').data('category_id'));
		});


		var setupModal = function (ci, ct, cd, catid) {				
			class_type_id.val(ci);
			class_type.val(ct);
			class_description.val(cd);
			modal.modal('show');
			category_id.html(categories.getDropdown());
			category_id.val(catid);
		}

		var tearDownModal = function() {
			class_type_id.val('');
			class_type.val('');
			class_description.html('');
		}

		var sendForm = function (id) {
			
			$.post( urlBase + 'updateClassType/', form.serialize())
			.done(function( data ) {
				alert(data);
				modal.modal('hide');
				classtypes.refresh();
			});

		}

		sendRemoveForm = function (id) {
			
			$.post( urlBase + 'removeClassType/', form.serialize())
			.done(function( data ) {
				alert(data);
				modal.modal('hide');
				refresh();
			});

		}

		return{
	

		};

	})();