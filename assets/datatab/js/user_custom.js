$.member = (function(){
	$member=false;
	$modal="MemberDetails";
	$subModal ="#SubMemberDetails";
	var footer = '<button class="btn btn-sm" data-dismiss="submodal" aria-hidden="true">Cancel</button><button id="submitState" class="btn btn-sm btn-danger submit" data-dismiss="submodal">Submit</button>';
	
	// Load Member to Modal
	load = function ($id){ 		
	if(!$member || $member.id!=$id){
        $.getJSON('member/getUserDetails/?id=' + $id, function (data) {
            if (data.length > 0) {
				$member = data[0];
                $('.modal-title').html(cFirst($member.first_name) + " " + cFirst($member.second_name));
                $.each($member, function (key, mem) { $('#' + key).html(cFirst(mem)); });
				if($member.comms_preference == 3){$(".sms , .tweet").show();}else if($member.comms_preference == 2){$(".sms").show();$(".tweet").hide();}else {$(".sms ,.tweet").hide();}
				if($member.activated == 1 && $member.banned == 0){$(".mem-status").html('<span class="text-success">Active</span>');}else if ($member.activated == 0){$(".mem-status").html('<span class="text-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email not Verified">Pending</span>'); $('.mem-status span').tooltip();} 
				else{$('.mem-status').html('<span class="text-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="'+$member.ban_reason+'">Blocked</span>');$('.mem-status span').tooltip();}
                $changes = false;
				$('#'+$modal).modal('show'); // only show are parsing complete
            } else { alert("Member No Longer Exist"); }
        });
		} else { $('#'+$modal).modal('show'); } // Data already stored
    },
	
	// Swap Modes
	swapMode = function () {
		if ($(".editable").is("label")) {
			$("label.editable").replaceWith(function () {
				return "<input class=\"form-control input-sm editable\" id=\"" + $(this).attr('id') + "\" type=\"text\" value=\"" + $(this).html() + "\" />";
			});
		} else { 
			$("input[type=text].editable").replaceWith(function () {
				return "<label class=\"editable\" id=\"" + $(this).attr('id') + "\">" + $(this).val() + "</label>";
			});
		}
	},
	
	// Capitalize First Letter
	cFirst = function (s) {
		 if (s != null) { return s.substr(0, 1).toUpperCase() + s.substr(1).toLowerCase(); } else { return s; } 
	},
	
	// Get Value from Input or Label
	getVal = function (v) {
		if (v.is("input")) { return v.val(); } else { return v.html(); }
	},
	
	// Add Form Error
	addError = function (element,type,message) {
		element.parent('.form-group').addClass(type);
		element.siblings('.help-block').children('#warning-message').html(message);
	},
	
	// Remove Form Error
	removeError = function (element,type,message) {
		element.parent('.form-group').removeClass(type);
		element.siblings('.help-block').children('#warning-message').html("");
	},	
	
	/*
		Internal Modules
	*/
	
	// EDITING A MEMBERS DETAILS
	editMemberMod = (function () {
		$changes = false;
		// Submit Changes
		submit = function () {
			if ($changes) {
				$query = {};
				$id = $('#id').val();
				$.each($changes, function (index, value) { $query[value] = getVal($('#' + value)); });
				$.post('member/updateUserDetails', { id: $member.id, changes: $query }, function (data) {
					if (data == "4:Success") {
						$changes = false;
						// Local Changes ??
						if ("first_name" in $query || "second_name" in $query) { $('.modal-title').html(cFirst(getVal($('#first_name'))) + " " + cFirst(getVal($('#second_name')))); }					
						$.each($query,function( index,val ) {$('#'+$member.id).children('.'+index).html(val);});
						swapMode();
					}
				});
			}
		},
		recordChanges = function ($id) {
			if (!$changes) { $changes = []; }
			$changes.push($id);
		},		
		// Discard Changes
		$('#'+$modal).on('hide.bs.modal', function (e) { if ($changes){ return window.confirm("Discard, Unsaved Changes?");} });		
	})();	

	// member status 		$statusChange = false;
	
	// CONTACTING A MEMBER
	contactMemberMod = (function () {
		var $selector = $(".message");
		var $message = $('#message');
		var body = '<h3>Contact:</h3><form class="form-horizontal"><div class="form-group"><label class="control-label" for="inputEmail">Message: </label><textarea id="message" class="form-control" rows="3"></textarea><span class="help-block">Length: <span id="length">0</span> Characters <span class="pull-right" id="warning-message"></span></span></div></form>';
		var footer = '<button class="btn btn-sm" data-dismiss="submodal" aria-hidden="true">Cancel</button><button class="btn btn-sm btn-danger submit" data-dismiss="submodal">Submit</button>';
		var type = "email";
		
		// Create UI
		generateUI = function (temp) {
			// Display Contact
			$($subModal + " .modal-content").children('.modal-body').html(body);
			$($subModal + " .modal-content").children('.modal-footer').html(footer);
			// Listener
			$message = $('#message'); // Point to New Element
			
			type = temp;
			$($subModal + " .submit").on( "click", function() {send(); });
			if (type == 'tweet') { $("#message").attr('maxlength', 140) }
			$($subModal + " .modal-content").on('keyup keydown', $message, function () {
				$('#length').html($message.val().length);
				if (type == 'tweet') { twitter(); } else if (type == 'sms') { sms(); } else { email(); }
			});
		},

		// TWITTER
		twitter = function () {
			if ($message.val().length > 139) {
				addFormError('has-error', 'Message has reached it\'s maximum length');
			}
			else if ($message.parent('.form-group').hasClass('has-error')) {
				removeFormErorr('has-error');
			}
		},
		// SMS
		sms = function () {
			if ($message.val().length > 130) {
				addFormError('has-warning', ' Warning: ' + (Math.round($message.val().length / 130) + 1) + ' Messages in Length');
			}
			else if ($message.parent('.form-group').hasClass('has-warning')) {
				removeFormErorr('has-warning');
			}
		},
		// EMAIL
		email = function () {
		   // Validation -- Max Length
		},
		// SEND MESSAGE
		send = function () {
			 $.post('member/contactUser', { id: $member.id, service: type, message: $message.val() }, function (data) {        });
		},
		// Start Point
		$selector.on("click", function () { generateUI($(this).attr('id')); });
	})(),

	// Block / Ban
	BlockMemberMod = (function () {




	})(),
	
	// Update Members Status
	updateStatusMod = (function () {
			var accountBody = '<div class="row"><div class="col-sm-6"><span>Status: <strong class="mem-status"><span class="text-success">Active</span></strong></span></div><div class="col-sm-6"><form class="form-horizontal"><div id="mem-options"  style="padding-right: 12px;" class="form-group pull-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Change Status"><div id="status-choice" class="btn-group" data-toggle="buttons"><label class="btn btn-success btn-xs" id="active-btn"><input type="radio" name="options"> Active</label><label class="btn btn-warning btn-xs" id="pending-label"><input type="radio" name="options" id="pending-btn"> Pending</label><label class="btn btn-danger btn-xs" id="banned-btn"><input type="radio" name="options"> Banned</label></div></div></div></div><form class="form-horizontal"><div class="form-group"><label class="control-label" for="banReason">Reason for Blocking: </label><textarea id="bad_reason" class="form-control" rows="3" disabled>N/A: Account is still Active</textarea></div></form>';

		loadStatusEditor = function()
		{
			$statusChange = false;
		    $($subModal + " .modal-content").children('.modal-body').html(accountBody);
			$($subModal + " .modal-content").children('.modal-footer').html(footer);
			// Listener
			$message = $('#message'); // Point to New Element
			if($member.activated == 1 && $member.banned == 0){$(".mem-status").html('<span class="text-success">Active</span>'); $('#pending-label').hide();$('#banned-btn').toggleClass('btn-danger').toggleClass('btn-default'); $('#active-btn').button('toggle'); $('#active-btn').attr("disabled", "disabled"); $('#mem-options').tooltip();}else if ($member.activated == 0){$(".mem-status").html('<span class="text-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email not Verified">Pending</span>'); $('.mem-status span').tooltip(); $('#pending-label').show();$('#banned-btn').toggleClass('btn-danger').toggleClass('btn-default'); $('#active-btn').toggleClass('btn-success').toggleClass('btn-default'); $('#bad_reason').val('N/A: Account currently pending users email being verified'); $('#pending-label').button('toggle'); $('#active-btn').attr("disabled", "disabled"); $('#banned-btn').attr("disabled", "disabled");} 
			else{$('.mem-status').html('<span class="text-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="'+$member.ban_reason+'">Blocked</span>');$('.mem-status span').tooltip(); $('#pending-label').hide(); $('#bad_reason').val($member.ban_reason); $('#active-btn').toggleClass('btn-success').toggleClass('btn-default');$('#banned-btn').button('toggle'); $('#banned-btn').attr("disabled", "disabled"); $('#mem-options').tooltip();}
			$('#banned-btn, #active-btn').on('click',function (){ statusAlter($(this));});
			$('#submitState').on('click',function() {saveAlteredStatus();} );
		},
		
		statusAlter = function(btn)
		{
			if (!$statusChange) { $statusChange = {}; }
			$('#banned-btn').toggleClass('btn-danger').toggleClass('btn-default');
			$('#active-btn').toggleClass('btn-success').toggleClass('btn-default');
			if(btn.attr('id') == "active-btn")
			{
				$('#active-btn').button('toggle'); 
				$('#active-btn').attr("disabled", "disabled");
				$('#banned-btn').removeAttr("disabled");
				$('#bad_reason').attr("disabled", "disabled");
				if($member.banned==0){$('#bad_reason').val('N/A: Account is still Active'); $statusChange = {};}
				else{$('#bad_reason').val('N/A: This account will be un-blocked'); $statusChange['banned'] = 0;}
			}
			else if(btn.attr('id') == "banned-btn")
			{
				$('#banned-btn').button('toggle'); 
				$('#banned-btn').attr("disabled", "disabled");
				$('#active-btn').removeAttr("disabled");
				if($member.banned==0){$('#bad_reason').val(""); $('#bad_reason').removeAttr("disabled"); $statusChange['banned'] = 1;}
				else{$('#bad_reason').val($member.ban_reason); $statusChange = {};}
			}
		},

		saveAlteredStatus = function()
		{
			if($statusChange && $statusChange != {})
			{
				if($statusChange['banned'] == 1) {$statusChange['ban_reason'] = $('#bad_reason').val();} else {$statusChange['ban_reason'] = "";}
				$.post('member/updateUserDetails', { id: $member.id, changes: $statusChange }, function (data) {
			    if (data == "4:Success") {
						$member.banned = $statusChange['banned'];
						$member.ban_reason = $statusChange['ban_reason'];
						if($member.activated == 1 && $member.banned == 0){$(".mem-status").html('<span class="text-success">Active</span>'); $('#'+$member.id).children('.status').html('Active');}else if ($member.activated == 0){$(".mem-status").html('<span class="text-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email not Verified">Pending</span>'); $('.mem-status span').tooltip();} 
						else{$('.mem-status').html('<span class="text-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="'+$member.ban_reason+'">Blocked</span>');$('.mem-status span').tooltip(); $('#'+$member.id).children('.status').html('Blocked');}				
					}
			});
			}
			$statusChange = false;
		}
		$('.status').on("click", function () { loadStatusEditor(); });
	})(),
		
	// DELETING A MEMBER
	DeleteMemberMod = (function () {
	    var deleteBody = '<div class="row"><div class="col-sm-12"><span>Delete: <strong id="mem-name">Default</strong></span></div></div><form class="form-horizontal"><div class="form-group"><label class="control-label" for="banReason">Members Full Name: </label><input type="email" class="form-control dcap third" id="full-name" placeholder="{Firstname} {Secondname}"></div><div class="form-group"><label class="control-label" for="banReason">Reason for Deleting: </label><textarea id="delete_reason" class="form-control" rows="3" disabled>N/A: Please confirm the complete members name</textarea></div></form>';

	loadDelete = function(){
		$($subModal + " .modal-content").children('.modal-body').html(deleteBody);
		$($subModal + " .modal-content").children('.modal-footer').html(footer);
		$member.fullname = (($member.first_name.toLowerCase().trim()) + " " + ($member.second_name.toLowerCase().trim())).trim();		
		$('#mem-name').html(cFirst($member.first_name) + " " + cFirst($member.second_name));
		$('#full-name').on('keyup keydown', function () { validate($(this)); });
		// http://stackoverflow.com/questions/1226574/disable-copy-paste-into-html-form-using-javascript
		$('input.dcap').bind('copy paste', function (e) { e.preventDefault(); });
		$($subModal + " .submit").on( "click", function() {send(); });
	},
	
	validate = function($name) {
	
		var temp = $name.val().toLowerCase().trim();
		if(temp == $member.fullname)
		{
			$('#delete_reason').removeAttr("disabled");
			$('#delete_reason').val("");
			$('#full-name').parent('.form-group').removeClass('has-error has-warning');
			$('#full-name').parent('.form-group').addClass('has-success');
			
		}
		else if(temp == $member.fullname.substring(temp.length))
		{
			$('#full-name').parent('.form-group').removeClass('has-error has-success');
			$('#full-name').parent('.form-group').addClass('has-warning');
		}
		else if(!$('#delete_reason').attr('disabled'))
		{
			$('#delete_reason').attr("disabled", "disabled");
			$('#delete_reason').val("N/A: Please confirm the complete members name");
			$('#full-name').parent('.form-group').removeClass('has-success has-warning');
			$('#full-name').parent('.form-group').addClass('has-error');
		}
		else
		{
			console.log("TEST");

		}
	},

	send = function(){
		var temp = $('#full-name').val().toLowerCase().trim();
		if(temp == $member.fullname && $('#delete_reason').val() != "")
		{
			$.post('member/deleteUser', { id: $member.id, reason: $('#delete_reason').val() }, function (data) {
				$('#member').dataTable().fnDeleteRow(document.getElementById($member.id));
			});
		}
	},
	
	$('.delete').on("click", function () { loadDelete(); });
	})();
	
	/*
	// UPDATING A MEMBERS MEMBERSHIP
	updateMembershipMod = (function () {
	
	
	})();
	*/
	
	// USER INTERFACE CONNECTIONS
	
	uiConnections = function () {
		// Get User and Load Modal
		$("#member tbody").on("click", "tr", function () { load($(this).attr('id')); });

		// Submit Changes
		$('#save_changes').on("click", function () { submit(); });

		// Change View - Summary or Edit
		$(".views").on("click", function () { swapMode(); });

		// Swap back to Summary Mode on Close
		$('#'+$modal).on('hidden.bs.modal', function (e) {
			$("input[type=text].editable").replaceWith(function () {
				return "<label class=\"editable\" id=\"" + $(this).attr('id') + "\">" + $(this).val() + "</label>";
			});
			$('#mySubModal').hide();
		});
		// Notify of data edit
		$('#'+$modal).on("change", ":input.editable", function () { recordChanges($(this).attr('id')); 
		});
		
	},		
	
	this.uiConnections();

})();
