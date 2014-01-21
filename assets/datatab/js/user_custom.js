$.member = { utils: {} };
// Upper Case First Letter
$.member.utils.CFirst = function (s) { if (s != null) { return s.substr(0, 1).toUpperCase() + s.substr(1).toLowerCase(); } else { return s; } };
// Get value from either label or input
$.member.utils.customVal = function (v) { if (v.is("input")) { return v.val(); } else { return v.html(); } };

$.member.utils.EditModule = (function () {

    var $changes = false
	var modal = "MemberDetails";
	var $member = false;
	var accountBody = '<div class="row"><div class="col-sm-6"><span>Status: <strong class="mem-status"><span class="text-success">Active</span></strong></span></div><div class="col-sm-6"><form class="form-horizontal"><div id="mem-options" class="form-group pull-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Change Status"><div id="status-choice" class="btn-group" data-toggle="buttons"><label class="btn btn-success btn-xs" id="active-btn"><input type="radio" name="options"> Active</label><label class="btn btn-warning btn-xs" id="pending-label"><input type="radio" name="options" id="pending-btn"> Pending</label><label class="btn btn-danger btn-xs" id="banned-btn"><input type="radio" name="options"> Banned</label></div></div></div></div><form class="form-horizontal"><div class="form-group"><label class="control-label" for="banReason">Reason for Blocking: </label><textarea id="bad_reason" class="form-control" rows="3" disabled>N/A: Account is still Active</textarea></div></form>';
    var footer = '<button class="btn btn-sm" data-dismiss="submodal" aria-hidden="true">Cancel</button><button class="btn btn-sm btn-danger submit" data-dismiss="submodal">Submit</button>';
    var $display = $("#mySubModal .modal-content");
		
	// Load Member
    load = function ($id) {
		if(!$member || $member.id!=$id){
        $.getJSON('member/getUserDetails/?id=' + $id, function (data) {
            if (data.length > 0) {
				$member = data[0];
                $('.modal-title').html($.member.utils.CFirst($member.first_name) + " " + $.member.utils.CFirst($member.second_name));
                $.each($member, function (key, mem) { $('#' + key).html($.member.utils.CFirst(mem)); });
				if($member.comms_preference == 3){$(".sms , .tweet").show();}else if($member.comms_preference == 2){$(".sms").show();$(".tweet").hide();}else {$(".sms ,.tweet").hide();}
				if($member.activated == 1 && $member.banned == 0){$(".mem-status").html('<span class="text-success">Active</span>');}else if ($member.activated == 0){$(".mem-status").html('<span class="text-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email not Verified">Pending</span>'); $('.mem-status span').tooltip();} 
				else{$('.mem-status').html('<span class="text-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="'+$member.ban_reason+'">Blocked</span>');$('.mem-status span').tooltip();}
                $changes = false;
				
            } else {
                alert("Member No Longer Exist");
            }
        });
		}
		$('#'+modal).modal('show');
    },

	submit = function () {
	    if ($changes) {
	        $query = {};
			$id = $('#id').val();
	        $.each($changes, function (index, value) { $query[value] = $.member.utils.customVal($('#' + value)); });
	        $.post('member/updateUserDetails', { id: $id, changes: $query }, function (data) {
				console.log(data);
	            if (data == "4:Success") {
					$changes = false;
					// Local Changes ??
	                if ("first_name" in $query || "second_name" in $query) { $('.modal-title').html($.member.utils.CFirst($.member.utils.customVal($('#first_name'))) + " " + $.member.utils.CFirst($.member.utils.customVal($('#second_name')))); }
					//console.log($query);					
					$.each($query,function( index,val ) {$('#'+$id).children('.'+index).html(val);});
					swapMode();
				}
	        });
	    }
	},

	swapMode = function ($it) {
	    if ($it.html() != "Overview") {
	        $("label.editable").replaceWith(function () {
	            return "<input class=\"form-control input-sm editable\" id=\"" + $(this).attr('id') + "\" type=\"text\" value=\"" + $(this).html() + "\" />";
	        });
	        $it.html("Overview");
	    } else {
	        $("input[type=text].editable").replaceWith(function () {
	            return "<label class=\"editable\" id=\"" + $(this).attr('id') + "\">" + $(this).val() + "</label>";
	        });
	        $it.html("<i class=\"fa fa-pencil fa-fw\"></i> Edit</i>");
	    }
	},

	recordChanges = function ($id) {
	    if (!$changes) { $changes = []; }
	    $changes.push($id);
	},
	
	loadStatusEditor = function()
	{
	    $display.children('.modal-body').html(accountBody);
        $display.children('.modal-footer').html(footer);
        // Listener
        $message = $('#message'); // Point to New Element
		
		if($member.activated == 1 && $member.banned == 0){$(".mem-status").html('<span class="text-success">Active</span>'); $('#pending-label').hide();$('#banned-btn').toggleClass('btn-danger').toggleClass('btn-default'); $('#active-btn').button('toggle'); $('#active-btn').attr("disabled", "disabled"); $('#mem-options').tooltip();}else if ($member.activated == 0){$(".mem-status").html('<span class="text-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email not Verified">Pending</span>'); $('.mem-status span').tooltip(); $('#pending-label').show();$('#banned-btn').toggleClass('btn-danger').toggleClass('btn-default'); $('#active-btn').toggleClass('btn-success').toggleClass('btn-default'); $('#bad_reason').val('N/A: Account currently pending users email being verified'); $('#pending-label').button('toggle'); $('#active-btn').attr("disabled", "disabled"); $('#banned-btn').attr("disabled", "disabled");} 
		else{$('.mem-status').html('<span class="text-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="'+$member.ban_reason+'">Blocked</span>');$('.mem-status span').tooltip(); $('#pending-label').hide(); $('#bad_reason').val($member.ban_reason); $('#active-btn').toggleClass('btn-success').toggleClass('btn-default');$('#banned-btn').button('toggle'); $('#banned-btn').attr("disabled", "disabled"); $('#mem-options').tooltip();}
		$('#status-choice').on('click',function (){ 
		
		
		});
	},

    uiConnections = function () {
        // Get User and Load Modal
        $("#member tbody").on("click", "tr", function () { load($(this).attr('id')); });

        // Submit Changes
        $('#save_changes').on("click", function () { submit(); });

        // Change View - Summary or Edit
        $("#views").on("click", function () { swapMode($(this)); });

        // Swap back to Summary Mode on Close
        $('#'+modal).on('hidden.bs.modal', function (e) {
            $("input[type=text].editable").replaceWith(function () {
                return "<label class=\"editable\" id=\"" + $(this).attr('id') + "\">" + $(this).val() + "</label>";
            });
            $("#views").html("<i class=\"fa fa-pencil fa-fw\"></i> Edit</i>");
        });

        // Notify of data edit
        $('#'+modal).on("change", ":input.editable", function () { 
			recordChanges($(this).attr('id')); 
			
		// UPDATE DATA IDENTICAL FIELD
		});
		
		// Status
		$('.status').on("click", function () { loadStatusEditor(); });

        // Discard Changes
        $('#'+modal).on('hide.bs.modal', function (e) { if ($.member.changes) return window.confirm("Discard, Unsaved Changes?"); });
    },		
	this.uiConnections();
})();

$.member.utils.ContactModule = (function () {

    var $selector = $(".message");
    var $display = $("#mySubModal .modal-content");
    var $message = $('#message');
    var body = '<h3>Contact:</h3><form class="form-horizontal"><div class="form-group"><label class="control-label" for="inputEmail">Message: </label><textarea id="message" class="form-control" rows="3"></textarea><span class="help-block">Length: <span id="length">0</span> Characters <span class="pull-right" id="warning-message"></span></span></div></form>';
    var footer = '<button class="btn btn-sm" data-dismiss="submodal" aria-hidden="true">Cancel</button><button class="btn btn-sm btn-danger submit" data-dismiss="submodal">Submit</button>';
    var type = "email";

    // Listen For Contact
    uiConnection = function () {
        $selector.on("click", function () { generateUI($(this).attr('id')); });
    },
    // Create UI
    generateUI = function (temp) {
        // Display Contact
        $display.children('.modal-body').html(body);
        $display.children('.modal-footer').html(footer);
        // Listener
        $message = $('#message'); // Point to New Element
		
		type = temp
		$("#mySubModal .submit").on( "click", function() {send(); });
        if (type == 'tweet') { $("#message").attr('maxlength', 140) }
        $display.on('keyup keydown', $message, function () {
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
		 $.post('member/contactUser', { id: $('#id').val(), service: type, message: $message.val() }, function (data) {        });
    },
    // ERROR 
    addFormError = function (type, message) {
        $message.parent('.form-group').addClass(type);
        $message.siblings('.help-block').children('#warning-message').html(message);
    },
    removeFormErorr = function (type) {
        $message.parent('.form-group').removeClass(type);
        $message.siblings('.help-block').children('#warning-message').html("");
    },
    // Start Point
    uiConnection();
})();

// TODO
$.member.utils.MembershipModule = (function () {
	var body = '<h3>Membership:</h3><form class="form-horizontal"><div class="form-group"><label class="control-label" for="inputEmail">Message: </label><textarea id="message" class="form-control" rows="3"></textarea><span class="help-block">Length: <span id="length">0</span> Characters <span class="pull-right" id="warning-message"></span></span></div></form>';
    var footer = '<button class="btn btn-sm" data-dismiss="submodal" aria-hidden="true">Cancel</button><button class="btn btn-sm btn-danger submit" data-dismiss="submodal">Submit</button>';

})();