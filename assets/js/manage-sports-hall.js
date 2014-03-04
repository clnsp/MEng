
var assignDivPanel, roomDivider, divisibleRoomPanel, manage_rooms, manage_sports, roomDivider, sport_id_to_remove;


var placedSports = function () {
    //assign _root and config private variables
    var _root = this;
    directory = new Array();
    var used_keys = new Array();

    /* add a sport to the directory */
    this.addSport = function(class_type_id){
    	directory[class_type_id] = new Array();
    }
    
    /* is a sport in the directory */
    this.hasSport = function(class_type_id){
    	return (directory[class_type_id]);
    }

    /* remove divisions from sport */
    this.removeDivisions = function(room_id, class_type_id, sport_number){

        $.post( 'court/removeSportInstance/', { 
            room_id: room_id, 
            class_type_id: class_type_id,
            sport_number: sport_number
        })
        .done(function( result ) {
            delete directory[class_type_id][sport_number];
            used_keys.push(sport_number);

            notifyDivisionsChange();
        });
    }

    notifyDivisionsChange = function(){
        $.event.trigger({
            type: "divisionChanged",
            message: "Division Changed",
            time: new Date()
        }); 
    }


    /**
    * Assign divisions to a sport takes string and array
    */
    this.assignDivisons = function(sport_id, divs){
    	if(!sport_id){
    		alert('Please select a sport to assign');
    		return;
    	}

    	if(!this.hasSport(sport_id)){
    		this.addSport(sport_id);
    	}else{
    		if(compareDivs(directory[sport_id], divs)){
    			alert("Courts already added");
    			return;
    		}
    	}

        if(used_keys.length>0){
            directory[sport_id][used_keys.pop()] = divs;
        }else{
            var i = Object.keys(directory[sport_id]).length+1;
            while(directory[sport_id][i]){
                i++;
            }
            directory[sport_id][i] = divs;
            
        }

        notifyDivisionsChange();

    }

    compareDivs = function(directory, divs){
    	var found = false;
    	$.each(directory, function(index, value){
    		if($(value).not(divs).length == 0 && $(divs).not(value).length == 0)
    			found = true;
    	});
    	return found;
    }


    this.getDivisions = function(sport_id) {

    	var cont = $('<ul>');
    	if(directory[sport_id]){


    		$.each(Object.keys(directory[sport_id]), function(index, value) {

    			var li = $('<li class="list-group-item"></li>').html("Court ");
    			li.append($('<button class="remove-court-btn btn btn-xs pull-right btn-danger"><i class="glyphicon glyphicon-remove"></i></button>').attr('data-sport_id', value));
    			$.each(directory[sport_id][value], function(j, v) {
    				li.append(v + ", ");
    			});    
    			cont.append(li);  
    		}); 
    		return cont.html();
    	}
    	
    	return "No assigned courts";
    }
    
    getDir = function(json) {

    	directory = json;
    	
    	$.event.trigger({
    		type: "courtDirectoryRefreshed",
    		message: "Court directory refreshed",
    		time: new Date()
    	});
    }
    
    this.refresh = function(room_id) {
    	var $this = this;
        used_keys = new Array();
        $.getJSON('court/getCourtDirectory/'+room_id, function(json){
            getDir(json);
        });

    }
};


var ps = new placedSports();



roomDivider = function () {
    //assign _root and config private variables
    var _root = this;

    this.rows = 1;
    this.cols = 1;
    var min = 1;
    var max = 10;

    /*
        INITIALIZE
        */
        this.init = function(cont, clickable) {
        //some code
        this.container = $(cont).addClass('box-divider');

        if(clickable){
        	this.container.selectable({ 
        		filter: ".box",
        		stop: function( event, ui ) {
        			var floater = $('<div class="floater" style="width:100%;height:100%; background-color:red; opacity:0.5">');

        			var courts = new Array();
        			$(event.target).find('.box.ui-selected').each(function(){
        				courts.push(''+$(this).data('court_id'));
        			});

        			ps.assignDivisons(assignDivPanel.getSelectedSport(), courts);
        		}
        	});


        	this.container.on('click', '.box', function(e){
        		if(e.shiftKey)
        			$(this).toggleClass('multiselect').removeClass('selected');
        		else{

        			$(this).removeClass('multiselect').toggleClass('selected');
        		}

        	});
        }else{
        	this.container.addClass('no-click');
        }

        this.create();


    }

    this.updateRows = function(num){
    	var temp = this.rows;
    	temp += num;
    	if(temp >= min && temp <= max){
    		this.rows =temp;
    		this.regenerate();
    	}

    }

    this.updateCols = function(num){
    	var temp = this.cols;
    	temp += num;
    	if(temp >= min && temp <= max){
    		this.cols = temp;
    		this.regenerate();
    	}

    }

    this.create = function(){
    	var height = 100/this.rows;
    	var width = 100/this.cols;

		var box = $('<div class="box"></div>').height(height+'%').width(width+'%');//.width(width+'%');


		for (var r = 0; r < this.rows; r++) {
			//var tr = $('<div class="tr">');//.height(height+'%');

			for (var c = 0; c < this.cols; c++) {
				//tr.append(); 
				var court_id = c+(r*this.cols)+1;
				this.container.append(box.clone().addClass('r'+r+' c'+c).html(court_id).attr('data-court_id', court_id));
			}
		}
	}
	this.regenerate = function(){
		this.container.empty();
		this.create();
	}
};


divisibleRoomPanel = (function() {

	var rdrop = $('#manage-divisible-room select[name=room_id]');
	var urlBase = 'facilities/';
	var divisibleForm = $('#manage-divisible-room-form');

	divisibleForm.submit(function(){

        bootbox.confirm("Are you sure you wish to save this setup? <p>If sports have been assigned to divisions that don't exist in the new setupm, they will be removed.</p>", function(result) {
            if(result){
                $.post( urlBase + "saveDivisibleRoom", { 
                    room_id: rdrop.val(),
                    rows: manage_rooms.rows,
                    cols: manage_rooms.cols })
                .done(function( result ) {
                    alert(result);
                    if(assignDivPanel.getSelectedDivRoom() == rdrop.val()){
                        assignDivPanel.fetchDivisibleRoomSetup(rdrop.val());
                    }
                });            
            }
        }); 
        
    });

	manage_rooms  = new roomDivider();
	manage_rooms.init($('#divisible-room'), false);

	$('#add-row').click(function(){ manage_rooms.updateRows(1) });
	$('#add-col').click(function(){ manage_rooms.updateCols(1) });
	$('#del-row').click(function(){ manage_rooms.updateRows(-1) });
	$('#del-col').click(function(){ manage_rooms.updateCols(-1) });

	rdrop.change(function(){

		$.getJSON(urlBase + 'getDivisibleRoom/' + $(this).val(), function(data) {
			if(data.length>0){
				manage_rooms.cols = parseInt(data[0].cols);
				manage_rooms.rows = parseInt(data[0].rows);
			}else{
				manage_rooms.cols = 1;
				manage_rooms.rows = 1;
			}
			manage_rooms.regenerate();
			divisiblerooms.refresh();
		});

		// ps.refresh($(this).val());
        console.log($(this).val());
    });

	return { 
		drop:rdrop
	};

})();


assignDivPanel = (function() {
	var container = $('#possible-sports');
	var sportlist = $('#sports-list');
	var divdrop = $('#select-divisible-room select[name=room_id]');
	var urlBase = 'court/';
	var divisions = $('#sports-divisions');

    manage_sports  = new roomDivider();
    manage_sports.init($('#add-sports-to-room'), true);

    divisions.on('mouseenter', 'li.list-group-item', function(e){
        var si = $(this).find('button').data('sport_id');

        var courts = directory[getSelectedSport()][si];

        for (var key in courts) {
            $('#add-sports-to-room .box[data-court_id='+ courts[key] +']').addClass('hover');
        }

    }).on('mouseleave', 'li.list-group-item', function(e){
        $('#add-sports-to-room .box.hover').removeClass('hover');

    });

    sportlist.on('click', 'a.list-group-item', function(e){
      e.preventDefault();
      $(this).siblings('.active').removeClass('active');
      $(this).addClass('active');

      var sport = assignDivPanel.getSelectedSport();
      if(sport){
        divisions.html(ps.getDivisions(sport));
    }

});


    container.on('click', 'button.remove-court-btn', function(){
      sport_id_to_remove = $(this).data('sport_id');
      bootbox.confirm("Are you sure you want to remove this court assignment?", function(result) {
        if(result){
            ps.removeDivisions(getSelectedDivRoom(), assignDivPanel.getSelectedSport(), sport_id_to_remove);
        }
    }); 
  });

    container.find('#assign-sports-to-courts').click(function(){

      $.post( urlBase + "assignSports", { 
        data: directory,
        room_id: divdrop.val()
    })
      .done(function( result ) {
        alert(result);

    });
  });

    divdrop.change(function(){
        fetchDivisibleRoomSetup($(this).val());
    });


    fetchDivisibleRoomSetup = function(room_id){
       $.getJSON('facilities/getDivisibleRoom/' + room_id, function(data) {
        if(data.length>0){
            manage_sports.cols = parseInt(data[0].cols);
            manage_sports.rows = parseInt(data[0].rows);
        }else{
            alert('Error: room may not be divisivble please refresh.')
        }
        manage_sports.regenerate();
        ps.refresh(divdrop.val());
        divisions.html(ps.getDivisions(divdrop.val()));
    });

   }


   getSelectedSport = function(){
      return sportlist.find('.active').data('class_type_id');
  }

  getSelectedDivRoom = function(){
    return divdrop.val();
}


return { 
  drop:divdrop,
  list:sportlist,
  getSelectedSport: getSelectedSport,
  getSelectedDivRoom:getSelectedDivRoom,
  divisions: divisions,
  fetchDivisibleRoomSetup:fetchDivisibleRoomSetup
};

})();

var Restrictions = function() {
    var baseUrl, limits, blocks, restrictions, del;

    var init = function(){
        baseUrl = 'court/';
        limits = $('<tbody>');
        blocks = $('<tbody>');
        delLimit = $('<td><button class="deleteLimit btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></button></td>');
        delBlock = $('<td ><button class="deleteBlock btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></button></td>');
    };

    init();

    this.refresh = function(room_id){
        $.getJSON('court/getRestrictions/' + room_id, function(json){
            restrictions = json;
            update();
        });
    }

    var createLimitRow = function(limit){
        var sport = $('<td>').attr('data-sport_id', limit.sport_id).html(limit.class_type);
        var lim = $('<td>').html(limit.limit);

        return $('<tr>').append(sport, lim, delLimit.clone());

    }

    var createBlockRow = function(block){
        var blocked = $('<td>').attr('data-sport_to_block_id', block.sport_to_block_id).html(block.sport_to_block);
        var occurred = $('<td>').attr('data-occurring_sport_id', block.occurring_sport_id).html(block.occurring_sport);
        
        return $('<tr>').append(blocked, occurred, delBlock.clone());
    }

    var update = function(){

        blocks.html('');
        limits.html('');

        for(var limit in restrictions.limits){
            limits.append(createLimitRow(restrictions.limits[limit]));
        }

        $('.restriction.limits tbody').html(limits.html());

        for(var block in restrictions.blocks){
            blocks.append(createBlockRow(restrictions.blocks[block]));
        }

        $('.restriction.blocks tbody').html(blocks.html());
    }

};


var manageRestrictionsPanel = (function() {
	var container = $('#manage-restrictions');
    var  limitForm = container.find('#form-limit-restriction');
    var  blockForm = container.find('#form-block-restriction');   
    var  drop = container.find('select[type=dropdown].divisiblerooms');
    var  baseUrl = 'court/';
    var restrictions = new Restrictions();

    $('#submit-limit').click(function(){
        $.post( baseUrl + 'addLimitRestriction/', limitForm.serialize() + '&' +  jQuery.param({room_id: drop.val()}))
        .done(function( result ) {
            alert(result);
            restrictions.refresh(drop.val());
        });
    });

    $('#submit-block').click(function(){
        $.post( baseUrl + 'addBlockRestriction/', blockForm.serialize() + '&' +  jQuery.param({room_id: drop.val()}))
        .done(function( result ) {
            alert(result);
            restrictions.refresh(drop.val());
        });
    });


    container.on('click', 'button.deleteBlock', function () {
        var tr = $(this).parents('tr:first');
        
        $.post(baseUrl + 'removeBlockRestriction', { 
            room_id: drop.val(), 
            sport_to_block_id: tr.find("[data-sport_to_block_id]").data('sport_to_block_id'),
            occurring_sport_id: tr.find("[data-occurring_sport_id]").data('occurring_sport_id')
        })
        .done(function( result ) {
            alert(result);
            restrictions.refresh(drop.val());
        });

    });

    container.on('click', 'button.deleteLimit', function () {
        var tr = $(this).parents('tr:first');
        
        $.post(baseUrl + 'removeLimitRestriction', { 
            room_id: drop.val(), 
            sport_id: tr.find("[data-sport_id]").data('sport_id'),
        })
        .done(function( result ) {
            alert(result);
            restrictions.refresh(drop.val());
        });

    });

    drop.change(function(){
        restrictions.refresh($(this).val());
    });

    return { 

    };

})();



$(function(){

    $(document)

    .on("divisionChanged, courtDirectoryRefreshed", function(){
      var sport = assignDivPanel.getSelectedSport();
      if(sport){
        assignDivPanel.divisions.html(ps.getDivisions(sport));
    }
})

    ;

    classtypes.refresh();
    rooms.refresh();
    divisiblerooms.refresh();


});

