/*
 * Select anywhere along the member list row 
 */
 $('#page-body')
 	.on('click', '.checkbox-group.list-group .list-group-item', function() {
	 	$(this).find('input[type=checkbox]').trigger('click');
	 })
 
	 .on('click', '.checkbox-group.list-group .list-group-item input[type=checkbox]', function(e) {
		 	e.stopImmediatePropagation(); //allow checkbox to click itself.
		 
	 });