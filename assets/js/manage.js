$( document ).ready(function() {

	var categories = (function() {

		var $categorylist = $( "#class-categories-list" );
		var $container = $( "<div class='container'></div>" );
		var $currentColor = null;
		var urlBase = "category/";

		var createContainer = function() {
			var $i = $( this );
			var $c = $container.clone().appendTo( $i );
			$i.data( "container", $c );
		},

		refresh = function() {
			$.getJSON(urlBase + 'fetchAll', function(data) {
				var $tempList = $('<ul></ul>');
				if(data.length>0){
					$.each( data, function( key, cat ) {
						$tempList.append(createListItem(cat['category_id'], cat['category'], cat['color']));	
					});
					
				}
				$categorylist.html($tempList.html());
				initColorPickers();
			});
		},

		clear = function() {
			$categorylist.empty();
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
		}

		return {
			refresh: refresh,
			initColorPickers: initColorPickers,
			urlBase : urlBase, 
		};

	})();
	
	categories.initColorPickers();
	
	$('INPUT.minicolors-inline').minicolors({
		theme: 'bootstrap',
		control: 'wheel',
	});
	
	
	 $('form#add-category-form').submit(function(e){
	  e.preventDefault();
	  var postdata = $(this).serialize();
	  
	  $.ajax({
	    url: "category/addCategory/",
	    type: "POST",
	    data:  postdata,
	    success: function() {
	    	categories.refresh();
	   },
	   error: function(){
	     alert('Error occurred');
	   },
	 });
	
	
	});
	
	
	$('form#remove-category-form').submit(function(e){
	  e.preventDefault();
	  var postdata = $(this).serialize();
	  
	  
	  $.ajax({
	    url: "category/removeCategories/",
	    type: "POST",
	    data:  postdata,
	    success: function() {
	    	categories.refresh();
	   },
	   error: function(){
	     alert('Error occurred');
	   },
	 });
	
	
	});



$('#page-body').on('click', '.minicolors-swatch-color', function(e) {
	e.stopImmediatePropagation(); //prevent clicking the row when selecting color swatch
});


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