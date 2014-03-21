/*
MEng Computer Science 2014
Gym Booking System
*/

$.pageManager = (function () {
	
	var reading = !1, chars = [], timeout = 300;

	$.weekdays={0: "Sunday", 1: "Monday", 2: "Tuesday", 3: "Wednesday", 4: "Thursday", 5: "Friday", 6: "Saturday"};
	$.months={0: "January", 1: "February", 2: "March", 3: "April", 4: "May", 5: "June", 6: "July", 7: "August", 8: "September", 9: "October", 10: "November", 11: "December"};

	resize = function(){
		if($('.list')[0] != undefined){
			$(".list").css('height',$(window).height() - $('.list').eq(0).offset().top);
			if($('.classes')[0] != undefined){
				// Get Max Height //http://stackoverflow.com/questions/6060992/element-with-the-max-height-from-a-set-of-elements
				$maxHeight = Math.max.apply(null, $(".classes").map(function () { return ($(this).offset().top-$(this).siblings(".panel-heading").eq(0).height()+50);}).get());
				$(".classes").css('max-height',$(window).height() - $maxHeight);
			}
		}
	},
	
	retreive = function(){ $.get('index.php/updateClasses' , function(data){
	 $(".row.list").html(data); $('tr').tooltip();});$(".classes td").on("dblclick", function(){attendee($(this).parent("tr"));});
	},
	
	nextHour = function(){
		newTime();
		setTimer(0);
		console.log("HOUR");
	},

	nextReg = function(){
		var now = new Date();
		var minutes = now.getMinutes();
		
		if(!((minutes > 21 && minutes < 39) || (minutes < 9 || minutes > 51)))
		{
			console.log("UPDATE");
			retreive();
		}
		setTimer(2);
	},
	
	newTime = function(){
		var d = new Date();
		$time = d.getHours();
		$time = $time+":00 - " + ($time+1)%24 + ":00"; // 01 instead of 1 -- todo
		$(".current-time").html($time);
		if(d.getHours() == 0) { $(".current-date").html($.weekdays[d.getDay()] + ", " + suffix(d.getDate()) + " " + $.months[d.getMonth()]);}
	},
	
	suffix = function(i) {
		var j = i % 10;
		if (j == 1 && i != 11) { return i + "st"; }
		if (j == 2 && i != 12) { return i + "nd"; }
		if (j == 3 && i != 13) { return i + "rd"; }
		return i + "th";
	},
	
	attendee = function ($row) {

		if($row.hasClass('success')){$attend=0;} else{$attend=1;}
		$.post('index.php/member/updateAttendance', { pid:$row.attr('id'),cid: $row.closest("div.panel").attr('id'), at: $attend}, function (data) {
			$row.toggleClass('success');
		});	
	},
	
	setTimer = function(i){
		//http://www.angelsystems.net/Beyond/Wizard/InfoTech/Quest.aspx?wizMode=View&FileID=27&FileTitle=Refresh+A+Page+Every+30+Minutes+On+Hour+Or+Half+An+Hour&FileCategory=JavaScript&HwizMode=SEARCH&wizCategoryID=204&wizKeywords=0&iCurrentListPage=1
		var now = new Date();
		var minutes = now.getMinutes();
		var seconds = now.getSeconds();
		if(i==0){
		setTimeout('nextHour()',(((60 - (minutes % 60) - ((seconds>0)?1:0)) * 60) + (60 - seconds)) * 1000); // Every Hour
		}else{
		setTimeout('nextReg()',(((10 - (minutes % 10) - ((seconds>0)?1:0)) * 60) + (60 - seconds)) * 1000); // Every 10 Min
		}var reading = !1, chars = [], timeout = 300;
	},
	
	uiControls = function() {
		$( window ).on("resize", function() {resize()});
		$(".classes td").on("dblclick", function(){attendee($(this).parent("tr"));});
		$(".list").on('selectstart', function (event) {event.preventDefault();});
		$(".dropdown-menu li").on('click',  function() {
			$('.'+$(this).attr('id')).toggleClass('hidden');
			$('.'+$(this).attr('id')).children('.row').toggleClass('visible-print').toggleClass('hidden-print');
			$('.'+$(this).attr('id')).children('.panel').toggleClass('hidden-print')
		});
		setTimer(0);
		setTimer(2);
		$('tr').tooltip();
	},

	eanCalcCsum = function(a) {
	  var b = 0, c = 1;
	  for (pos = a.length - 2;0 <= pos;pos--) {
	    b += parseInt(a.charAt(pos)) * (1 + 2 * (c++ % 2));
	  }
	  return(10 - b % 10) % 10;
},

eanValid = function(a) {
  return eanCalcCsum(a) == parseInt(a.charAt(a.length - 1));
},

checkBC = function() {
  var a = chars.join("");
  eanValid(a) ? (console.log("EAN CSUM PASS: " + a), a = parseInt(a.substring(0, 7), 10), attendee($("#" + a).eq(0))) : console.log("EAN CSUM FAIL: " + a + ":" + eanCalcCsum(a));
},

	resize();
	uiControls();


document.onkeypress = function(a) {
  a = a || window.event;
  a = a.keyCode || a.which;
  var b = String.fromCharCode(a);
  48 <= a && 57 >= a && chars.push(b);
  !0 == reading ? 8 == chars.length && (checkBC(), chars = [], reading = !1) : setTimeout(function() {
    chars = [];
    reading = !1;
  }, timeout);
  reading = !0;
};
})();
