var temp;

function update(user_id, new_type_id)
{
	var changes = {};
	changes['id'] = user_id;
	changes['member_type_id'] = new_type_id;

  	$.post(
  	      "member/updateUserDetails"
  	    , { 'changes[]' : changes }
  	    );
}

function memberToAdmin()
{
	var values = $("select[name='new_members[]'] option:selected");
	for (var i = 0; i < values.length; i++) {
		temp = $('#new_members option[value=' + values[i].value +']').remove();
		$('#new_admins').append(temp);

		var changes = {};
		changes['member_type_id'] = '7';

  		$.post(
  	      	siteUrl + "member/updateUserDetails"
  	    	, { 'id' : values[i].value,
  	    		'changes' : changes
  	    	  }
  	    );
	}

}

function adminToMember()
{
	var values = $("select[name='new_admins[]'] option:selected");
	for (var i = 0; i < values.length; i++) {
		temp = $('#new_admins option[value=' + values[i].value +']').remove();
		$('#new_members').append(temp);

		var changes = {};
		changes['member_type_id'] = '2';

  		$.post(
  	      	siteUrl + "member/updateUserDetails"
  	    	, { 'id' : values[i].value,
  	    		'changes' : changes
  	    	  }
  	    );
	}
}

function adminToSuper()
{
	var values = $("select[name='new_admins[]'] option:selected");
	for (var i = 0; i < values.length; i++) {
		temp = $('#new_admins option[value=' + values[i].value +']').remove();
		$('#new_supers').append(temp);
		var changes = {};
		changes['member_type_id'] = '8';

  		$.post(
  	      	siteUrl + "member/updateUserDetails"
  	    	, { 'id' : values[i].value,
  	    		'changes' : changes
  	    	  }
  	    );
	}
}

function superToAdmin()
{
	var values = $("select[name='new_supers[]'] option:selected");
	for (var i = 0; i < values.length; i++) {
		temp = $('#new_supers option[value=' + values[i].value +']').remove();
		$('#new_admins').append(temp);
		var changes = {};
		changes['member_type_id'] = '7';

  		$.post(
  	      	siteUrl + "member/updateUserDetails"
  	    	, { 'id' : values[i].value,
  	    		'changes' : changes
  	    	  }
  	    );
	}	
}