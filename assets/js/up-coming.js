/*
MEng Computer Science 2014
Gym Booking System
*/

$.pageManager = (function () {

	resize = function(){
		// Get Max Height
		//http://stackoverflow.com/questions/6060992/element-with-the-max-height-from-a-set-of-elements
		//var maxHeight = Math.max.apply(null, $(".classes").map(function () { return $(this).height();}).get());

		if($('.list')[0] != undefined){
			$(".list").css('height',$(window).height() - $('.list').eq(0).offset().top);
			$(".classes").css('max-height',$(window).height() - $('.classes').eq(0).offset().top-$(".classes").siblings(".panel-heading").eq(0).height()+20);
		}
	},

	remove = function(){
	
	
	},
	
	retreive = function(){
	
	
	},
	
	attendee = function ($row){
		$row.toggleClass('success');
	
	},
	
	uiControls = function() {
		$( window ).on("resize", function() {resize()});
		$(".classes tr").on("dblclick", function(){attendee($(this));});
		$(".list").on('selectstart', function (event) {event.preventDefault();});
		$(".dropdown-menu li").on('click',  function() { $('.'+$(this).attr('id')).toggle();});
	},

	resize();
	uiControls();
})();