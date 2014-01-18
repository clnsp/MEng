$.member = { utils: {} };

// Upper Case First Letter
$.member.utils.CFirst = function (s) { if (s != null) { return s.substr(0, 1).toUpperCase() + s.substr(1).toLowerCase(); } else { return s; } };
// Get value from either label or input
$.member.utils.customVal = function (v) { if (v.is("input")) { return v.val(); } else { return v.html(); } };

$.member.utils.EditModule = (function () {

    var $changes = false
	var modal = "MemberDetails";
    load = function ($id) {
        $.getJSON('member/getUserDetails/?id=' + $id, function (data) {
            if (data.length > 0) {
                $('.modal-title').html($.member.utils.CFirst(data[0].first_name) + " " + $.member.utils.CFirst(data[0].second_name));
                $('#id').val($id);
                console.log($(this).attr('id'));
                $.each(data[0], function (key, mem) { $('#' + key).html($.member.utils.CFirst(mem)); });
                $('#'+modal).modal('show');
				if(data[0].comms_preference == 3){$(".sms , .tweet").show();}else if(data[0].comms_preference == 2){$(".sms").show();$(".tweet").hide();}else {$(".sms ,.tweet").hide();}				
                $changes = false;
            } else {
                alert("Member No Longer Exist");
            }
        });
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
	}

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
        $('#'+modal).on("change", ":input.editable", function () { recordChanges($(this).attr('id')); });

        // Discard Changes
        $('#'+modal).on('hide.bs.modal', function (e) { if ($.member.changes) return window.confirm("Discard, Unsaved Changes?"); });
    }

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
    generateUI = function (type) {
        // Display Contact
        $display.children('.modal-body').html(body);
        $display.children('.modal-footer').html(footer);
        // Listener
        $message = $('#message'); // Point to New Element
		
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
    this.uiConnection();
})();