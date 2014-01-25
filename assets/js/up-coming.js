/*
MEng Computer Science 2014
Gym Booking System
*/

$.pageManager = (function () {

	resize = function(){
	
	// Get Max Height
	//http://stackoverflow.com/questions/6060992/element-with-the-max-height-from-a-set-of-elements
	var maxHeight = Math.max.apply(null, $(".classes").map(function () { return $(this).height();}).get());
	
	if($(window).height()>maxHeight + $('#footer').height() + 10)
	{
	
	
	}
	else
	{
	
	}
	$(".list").css('height',$(window).height() - $('.list').eq(0).offset().top);
	$(".classes").css('max-height',$(window).height() - $('.list').eq(0).offset().top-10);
	},

	remove = function(){
	
	
	},
	
	retreive = function(){
	
	
	},
	
	attendee = function ($row){
	
	
	},
	
	uiControls = function() {
		$( window ).on("resize", function() {resize()});
		$(".list tr").on("dblclick", function(){attendee($(this));});
	},

	resize();
	uiControls();
})();