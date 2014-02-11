/* Theme page javascript */
$( document ).ready(function() {

	if($('#booking').is('.theme')){

		var	themeEditor = (function(){
			var container =  $('#theme-creator');
			var form = container.find('#theme-form');
			
			var urlBase = "theme/";

			form.submit(function() {
				storeToConfig();
				reloadStylesheets('bootstraptheme'); 
			});
			
			storeToConfig = function(){

				$.post( urlBase + 'saveTheme', $(form).serializeArray())
				.done(function( result ) {
					alert(result);
				});
			}

			return { 

			};

		})();

	}
});