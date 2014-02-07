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