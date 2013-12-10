function CFirst(s){
return s.substr(0,1).toUpperCase()+s.substr(1).toLowerCase();
}

$("#member tbody").on( "click", "tr", function() {
  $.getJSON('user_access/get_user_details/?id=' + $(this).attr('id'), function(data) {
  if(data.length>0){
   $('.modal-title').html(CFirst(data[0].first_name) + " " + CFirst(data[0].second_name));  
	$('#myModal').modal('show');
	}
	});
});

$("#views").on( "click", function() {
	if($(this).html() == "Edit View")
	{
		$(".modal-body label").replaceWith( function() {
        return "<input class=\"form-control\" id=\""+$(this).attr('id')+"\" type=\"text\" value=\"" + $( this ).html() + "\" />";});
		$(this).html("Overview");
	}
	else
	{
		$(".modal-body input[type=text]").replaceWith( function() {
        return "<label class=\"editable\" id=\""+$(this).attr('id')+"\">" + $( this ).val() + "</label>";});
		$(this).html("Edit View");
	}
});