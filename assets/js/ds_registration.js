/* Basic Registration Form Functionality */
register = (function(){
	/*Form Elements*/
	var $e1 = $('#first_name');
	var $e2 = $('#second_name');
	/*Store User Names*/
	var fname = $e1.val();
	var sname = $e2.val();

	/*When Radio Clicked*/
	toggle = function(s){
		if(s.val() >2 && ($e1.prop('readonly') || $e2.prop('readonly'))){
			$e1.val('').prop('readonly','');
			$e2.val('').prop('readonly','');
		}else if(s.val()<=2){
			$e1.val(fname).prop('readonly','readonly');
			$e2.val(sname).prop('readonly','readonly');
		}
	},
	/* Event Listener */
	$("input[name='member_type']").change(function(){
		toggle($(this));
	});
})();
