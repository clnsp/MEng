/*
 * Select anywhere along the member list row 
 */
 $('#page-body').on('click', '.checkbox-group.list-group a', function() {
 	$(this).find('input[type=checkbox]').trigger('click');
 });