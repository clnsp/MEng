$.member = {utils:{}};
$.member.changes = false;

// Upper Case First Letter
$.member.utils.CFirst = function(s){return s.substr(0,1).toUpperCase()+s.substr(1).toLowerCase();};
$.member.utils.customVal = function(v){if(v.is("input")){return v.val();}else{return v.html();}};

// Get User and Load Modal
$("#member tbody").on( "click", "tr", function() {
  $.getJSON('member/getUserDetails/?id=' + $(this).attr('id'), function(data) {
  if(data.length>0){
    $('.modal-title').html($.member.utils.CFirst(data[0].first_name) + " " + $.member.utils.CFirst(data[0].second_name));
	//HIDDEN FORM ELEMENT STORE ID -- TODO
    $.each( data[0], function( key, mem ) { $('#'+key).html($.member.utils.CFirst(mem)); });   
	$('#myModal').modal('show');
	$.member.changes = false;
	}
	});   
});

// Submit Changes
$('#save_changes').on("click", function(){
	if($.member.changes)
	{
		$query={};
		$.each($.member.changes, function(index,value) { $query[value] =$.member.utils.customVal($('#'+value)); });
		console.log($query);
		console.log(JSON.stringify($query));

		$.post('member/updateUserDetails',{ id: 1, changes: $query}, function(data) {
			alert(data);
			$.member.changes = false;
		});
		alert("submit");	
	}
});

// CLEAR DIV
// $('.sub-modal .modal-body').empty();

// Change View - Summary or Edit
$("#views").on( "click", function() {
	if($(this).html() != "Overview"){
		$("label.editable").replaceWith( function() {
        return "<input class=\"form-control input-sm editable\" id=\""+$(this).attr('id')+"\" type=\"text\" value=\"" + $( this ).html() + "\" />";});
		$(this).html("Overview");
	}else{
		$("input[type=text].editable").replaceWith( function() {
        return "<label class=\"editable\" id=\""+$(this).attr('id')+"\">" + $( this ).val() + "</label>";});
		$(this).html("<i class=\"fa fa-pencil fa-fw\"></i> Edit</i>");
	}
});

// Swap back to Summary Mode on Close
$('#myModal').on('hidden.bs.modal', function (e) {
		$("input[type=text].editable").replaceWith( function() {
        return "<label class=\"editable\" id=\""+$(this).attr('id')+"\">" + $( this ).val() + "</label>";});
		$("#views").html("Edit View");
});

// Discard Changes
$('#myModal').on('hide.bs.modal', function (e) { if($.member.changes) return window.confirm("Discard, Unsaved Changes?");});

// Notify of data edit
$('#myModal').on("change", ":input.editable",function(){
	if(!$.member.changes){$.member.changes= []; }
	$.member.changes.push($(this).attr('id'))
});


