
$('#page-body').on('click', 'i.catColor', function() {
	$('#mypick').bfhcolorpicker('toggle');
});

//$('INPUT.minicolors').minicolors(settings);


$( document ).ready(function() {

	var classcategories = (function() {

		var $categorylist = $( "#class-categories-list" );
		var $container = $( "<div class='container'></div>" );
		var $currentItem = null;
		var urlBase = "category/";

		var createContainer = function() {
			var $i = $( this );
			var $c = $container.clone().appendTo( $i );
			$i.data( "container", $c );
		},

		refresh = function() {
			clear();
			fetchCategories();
		},

		clear = function() {
			$categorylist.empty();
		},

		fetchCategories = function(){
			$.getJSON(urlBase + 'fetchAll', function(data) {

				if(data.length>0){
					$.each( data, function( key, cat ) {
						$categorylist.append(createListItem(cat['category_id'], cat['category'], cat['color']));
					});
				}

			});
		},

		createListItem = function(id, name, color){
			return $('<a href="#" class="list-group-item"><input name="category_id" value="'+ id + '" type="checkbox"><i class="glyphicon glyphicon-stop catColor square" style="color: '+ color +'"></i>'+ name +'</a>');
		},

		buildUrl = function() {
			return urlBase + $currentItem.attr( "id" );
		},

		showItem = function() {
			$currentItem = $( this );
			getContent( showContent );
		},

		showItemByIndex = function( idx ) {
			$.proxy( showItem, $items.get( idx ) );
		},

		getContent = function( callback ) {
			$currentItem.data( "container" ).load( buildUrl(), callback );
		},

		showContent = function() {
			$currentItem.data( "container" ).show();
			hideContent();
		},

		hideContent = function() {
			$currentItem.siblings().each(function() {
				$( this ).data( "container" ).hide();
			});
		};


		return {
			refresh: refresh
		};

	})();


});