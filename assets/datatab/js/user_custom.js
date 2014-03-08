	if($('#booking').is('.users')){
		$('#member').dataTable( {
			"sDom": "<'row'<'col-md-6'l><'col-md-6'f>r>t<'row'<'col-md-6'i><'col-md-6'p>>"
		} );

		$.member = (function(){
			$member=false;
			$modal="MemberDetails";
			$subModal ="#SubMemberDetails";
			/*Controllers*/
			$baseUrl ={member:'member/'};
			/*Functions*/
			$functionUrl={getUser:'getUserDetails/',updateUser:'updateUserDetails',contactUser:'contactUser',deleteUser:'deleteUser',userMembership:'getMembershipOptions',getAttendance:'getAttendance/', getBookings:'getBookings/'};
			$warnClass={text:{e:"text-danger",s:"text-success",w:"text-warning"},form:{e:"has-error",s:"has-success",w:"has-warning"}};
			
			var footer = '<button class="btn btn-sm" data-dismiss="submodal" aria-hidden="true">Cancel</button><button id="submitState" class="btn btn-sm btn-danger submit" data-dismiss="submodal">Submit</button>';
			
	// Load Member to Modal
	load = function ($id){ 		
		if(!$member || $member.id!=$id){
			$.getJSON($baseUrl.member+$functionUrl.getUser+'?id=' + $id, function (data) {
				if (data.length > 0) {
					$member = data[0];
					$('.modal-title').html(cFirst($member.first_name) + " " + cFirst($member.second_name));
					$.each($member, function (key, mem) { $('#' + key).html(cFirst(mem)); });
					if($member.comms_preference == 3){$(".sms , .tweet").show();}else if($member.comms_preference == 2){$(".sms").show();$(".tweet").hide();}else {$(".sms ,.tweet").hide();}
					if($member.activated == 1 && $member.banned == 0){$(".mem-status").html('<span class="text-success">Active</span>');}else if ($member.activated == 0){$(".mem-status").html('<span class="text-warning" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Email not Verified">Pending</span>'); $('.mem-status span').tooltip();} 
					else{$('.mem-status').html('<span class="text-danger" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="'+$member.ban_reason+'">Blocked</span>');$('.mem-status span').tooltip();}
					
					
					$('#membership_type').removeClass('text-warning text-danger text-success');
					$('#membership_type').attr({'data-toggle':'tooltip','data-placement':'bottom'});
					if($member.end_date == "0000-00-00"){$('#membership_type').addClass('text-warning'); $('#membership_type').attr('data-original-title', '');}else{var ex = new Date($member.end_date); if(ex<Date.now()){$('#membership_type').addClass('text-danger'); $('#membership_type').attr('data-original-title','Expired on: ' + formatedDate(ex));}else{$('#membership_type').addClass('text-success'); $('#membership_type').attr('data-original-title', 'Valid until:  '+ formatedDate(ex));} $('#membership_type').tooltip();}

		//TO MOVE
		$('#memType').html(cFirst($member.type));
		$('#memShipType').html(cFirst($member.membership_type));

			//memFrom
			//memTo

		//END TO MOVE

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

	formatedDate = function (d){
		if(isNaN(d.getDate())){return "N/A";}
		else{return d.getDate() + "/" + (d.getMonth() + 1) + "/" + d.getFullYear();}},
	
	// Add Form Error
	addFormError = function (element,type,message) {
		$(element).parent('.form-group').addClass(type);
		$(element).siblings('.help-block').children('#warning-message').html(message);
	},
	
	// Remove Form Error
	removeFormError = function (element,type) {
		$(element).parent('.form-group').removeClass(type);
		$(element).siblings('.help-block').children('#warning-message').html("");
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
				$.post($baseUrl.member+$functionUrl.updateUser, { id: $member.id, changes: $query }, function (data) {
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
		var $selector = $("#contact");
		var $message = $('#message');
		var body = '<h3>Contact:</h3><form class="form-horizontal"><div class="form-group"><label class="control-label" for="inputEmail">Message: </label><textarea id="message" class="form-control" rows="3"></textarea><span class="help-block">Length: <span id="length">0</span> Characters <span class="pull-right" id="warning-message"></span></span></div></form>';
		var footer = '<button class="btn btn-sm" data-dismiss="submodal" aria-hidden="true">Cancel</button><button class="btn btn-sm btn-danger submit" data-dismiss="submodal">Submit</button>';
		
		// Create UI
		generateUI = function () {
			// Display Contact
			$($subModal + " .modal-content").children('.modal-body').html(body);
			$($subModal + " .modal-content").children('.modal-footer').html(footer);
			// Listener
			console.log("TEST");
			$message = $('#message'); // Point to New Element
			
			$($subModal + " .submit").on( "click", function() {sendMessage(); });
			$($subModal + " .modal-content").on('keyup keydown', $message, function () {
			$('#length').html($message.val().length);
			});
		},
		// SEND MESSAGE
		sendMessage = function () {  
			$.post($baseUrl.member+$functionUrl.contactUser, { id: $member.id, message: $message.val() }, function (data) {        });
		},
		// Start Point
		$selector.on("click", function () { generateUI(); });
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
				$.post($baseUrl.member+'updateUserDetails', { id: $member.id, changes: $statusChange }, function (data) {
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
			//$('#full-name').parent('.form-group').removeClass('has-error has-warning'); 
			//$('#full-name').parent('.form-group').addClass('has-success'); 
			removeFormError('#full-name',$warnClass.form.e+' ' +$warnClass.form.w);
			addFormError('#full-name',$warnClass.form.s,"");
		}
		else if(temp == $member.fullname.substring(temp.length))
		{
			//$('#full-name').parent('.form-group').removeClass('has-error has-success');
			//$('#full-name').parent('.form-group').addClass('has-warning');
			removeFormError('#full-name',$warnClass.form.e+' ' +$warnClass.form.s);
			addFormError('#full-name',$warnClass.form.w,"");
		}
		else if(!$('#delete_reason').attr('disabled'))
		{
			$('#delete_reason').attr("disabled", "disabled");
			$('#delete_reason').val("N/A: Please confirm the complete members name");
			$('#full-name').parent('.form-group').removeClass('has-success has-warning');
			$('#full-name').parent('.form-group').addClass('has-error'); 
			removeFormError('#full-name',$warnClass.form.s+' ' +$warnClass.form.w);
			addFormError('#full-name',$warnClass.form.e,"");
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
			$.post($baseUrl.member+$functionUrl.deleteUser, { id: $member.id, reason: $('#delete_reason').val() }, function (data) {
				$('#member').dataTable().fnDeleteRow(document.getElementById($member.id));
			});
		}
	},
	
	$('.delete').on("click", function () { loadDelete(); });
})();

	// UPDATING A MEMBERS MEMBERSHIP
	updateMembershipMod = (function () { 
		
		var membershipbody = '<h3>Update Membership:</h3><div class="row"><div class="panel panel-primary col-lg-6" style="padding:0px;"><div class="panel-heading"><h3 class="panel-title views">Change Membership</h3></div><div class="panel-body"><span>Current Membership: <span class="pull-right"><span id="memType">N/A</span> <span id="memShipType">N/A</span></span></span><br/><div class="row"><div class="col-md-4">Validity:</div><div class="col-md-8 text-right">From: <strong id="dateStart">01/02/03</strong> To: <strong id="dateEnd">06/07/08</strong></div></div><form role="form"><div class="form-group"><label for="memberships">Avaliable Membership Types:</label><select id="membershipSelect"class="form-control"></select></div></div></div><div class="panel panel-primary col-lg-6" style="padding:0px;"><div class="panel-heading"><h3 class="panel-title views">Custom Membership </h3></div> <div class="panel-body"><div id="date-selector"></div></div></div>';
		
		loadMembership = function(){
			$($subModal + " .modal-content").children('.modal-body').html(membershipbody);
			$($subModal + " .modal-content").children('.modal-footer').html(footer);
			getPossibleType();
			datepicker.draw();
			datepicker.options('disable');
		},
		
		getPossibleType = function () {
			$.getJSON($baseUrl.member+$functionUrl.userMembership, {id: $member.id}, function (data){
				$('#memType').html(cFirst($member.type));
				$('#memShipType').html(cFirst($member.membership_type));
				
				// PASS TO SERVER ??
				$('#dateStart').html(formatedDate(new Date($member.start_date)));
				$('#dateEnd').html(formatedDate(new Date($member.end_date)));				
				
				$('#membershipSelect').empty();
				for(var i=0;i<data.length;i++) {
					var option = $('<option/>'); 								
					option.attr({ 'value': data[i].id }).text(cFirst(data[i].membership_type));
					option.attr('data-toggle','tooltip');
					option.attr('data-placement','left');
					option.attr('data-original-title','Valid until: ' + formatedDate(new Date(data[i].end_date)));
					option.tooltip();
					$('#membershipSelect').append(option);
				}
					var option = $('<option/>'); 								
					option.attr({ 'value': -1}).text("Custom Membership"); // Custom Membership Option
					option.attr('data-toggle','tooltip');
					option.attr('data-placement','left');
					option.attr('data-original-title','Create Custom membership (Provide Start/End Dates)');
					option.tooltip();
				$('#membershipSelect').tooltip();
				$('#membershipSelect').append(option);
			});
			$('#membershipSelect').on('change', function() {
				if($( "#membershipSelect option:selected" ).val() == -1){datepicker.options("enable");}
				else{datepicker.options("disable");}
			});
			
		},

		getBookings = function () {
			$.get($baseUrl.member+$functionUrl.getBookings,{id:$member.id},function (data){
				
				$('#accordion').html(data);
			});	
		},
		
		
		updateMembershipType = function () {

		},	
		
		$('.membership').on("click", function () { loadMembership(); });
		$('#attendance').on("click", function () { getBookings(); });
	})();
	
	datepicker = (function() {

		var cal;

		draw = function() {
			cal = $('#date-selector').multiDatesPicker({numberOfMonths: 2,maxPicks: 2});
		},
		
		getDates = function() {
			return cal.multiDatesPicker('getDates');
		},

		hasDates = function() {
			return getDates().length != 0;
		},

		repeatDates = function(repeatType, stop) {
			if(stop != ''){
				var calDates = cal.multiDatesPicker('getDates');
				var newDates = new Array();
				var stopDate = Date.parse(stop);

				calDates.forEach(function(entry) {
					var day = Date.parse(entry);
					while(Date.compare(day, stopDate) != 1){

						newDates.push(day.clone());

						if(repeatType == 'days')
							day.add(1).days();

						else if (repeatType == 'weeks')
							day.add(1).weeks();

						else if (repeatType == 'months')
							day.add(1).months();

						else if (repeatType == 'years')
							day.add(1).years();
					}
				});

				if(newDates.length > 0)
					cal.multiDatesPicker('addDates', newDates);
			}
		},
		
		alternate = function(){
			if(cal.multiDatesPicker('isDisabled')){
				options('enable');
			}else {	
				options('disable');
			}
		},
		
		options = function(o){
			cal.datepicker(o);
		}
		
		return { 
			draw: draw,
			cal:cal, 
			options: options,
			hasDates: hasDates,
			repeatDates: repeatDates,
			getDates : getDates,
			alternate: alternate,
		};

	})();
	
	
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
}
