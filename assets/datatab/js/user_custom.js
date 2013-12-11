$.member = {utils:{}};
$.member.changes = false;

$.member.utils.CFirst = function(s){return s.substr(0,1).toUpperCase()+s.substr(1).toLowerCase();};


$("#member tbody").on( "click", "tr", function() {
  $.getJSON('user_access/get_user_details/?id=' + $(this).attr('id'), function(data) {
  if(data.length>0){
   $('.modal-title').html($.member.utils.CFirst(data[0].first_name) + " " + $.member.utils.CFirst(data[0].second_name)); 
   $('#fname').html($.member.utils.CFirst(data[0].first_name));
   $('#sname').html($.member.utils.CFirst(data[0].second_name));
   $('#hnumber').html($.member.utils.CFirst(data[0].home_number));
   $('#mnumber').html($.member.utils.CFirst(data[0].mobile_number));
   $('#twitter').html($.member.utils.CFirst(data[0].twitter));
	$('#myModal').modal('show');
	$.member.changes = false;
	}
	});
});

$("#views").on( "click", function() {
	if($(this).html() == "Edit View")
	{
		$("label.editable").replaceWith( function() {
        return "<input class=\"form-control editable\" id=\""+$(this).attr('id')+"\" type=\"text\" value=\"" + $( this ).html() + "\" />";});
		$(this).html("Overview");
	}
	else
	{
		$("input[type=text].editable").replaceWith( function() {
        return "<label class=\"editable\" id=\""+$(this).attr('id')+"\">" + $( this ).val() + "</label>";});
		$(this).html("Edit View");
	}
});

$('#myModal').on('hidden.bs.modal', function (e) {
		$("input[type=text].editable").replaceWith( function() {
        return "<label class=\"editable\" id=\""+$(this).attr('id')+"\">" + $( this ).val() + "</label>";});
		$("#views").html("Edit View");
});

$('#myModal').on('hide.bs.modal', function (e) {
if($.member.changes)
return window.confirm("Discard, Unsaved Changes?");
})

//http://stackoverflow.com/questions/11844256/alert-for-unsaved-changes-in-form
$('#myModal').on("change", ":input.editable",function(){ //trigers change in all input fields including text type
    $.member.changes = true;
});