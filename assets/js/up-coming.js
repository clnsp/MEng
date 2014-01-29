/*
MEng Computer Science 2014
Gym Booking System
*/

$.pageManager = (function () {

	resize = function(){
		if($('.list')[0] != undefined){
			$(".list").css('height',$(window).height() - $('.list').eq(0).offset().top);
			if($('.classes')[0] != undefined){
				// Get Max Height //http://stackoverflow.com/questions/6060992/element-with-the-max-height-from-a-set-of-elements
				$maxHeight = Math.max.apply(null, $(".classes").map(function () { return ($(this).offset().top-$(this).siblings(".panel-heading").eq(0).height()+30);}).get());
				$(".classes").css('max-height',$(window).height() - $maxHeight);
			}
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
		$(".classes td").on("dblclick", function(){attendee($(this).parent("tr"));});
		$(".list").on('selectstart', function (event) {event.preventDefault();});
		$(".dropdown-menu li").on('click',  function() { console.log($(this)); $('.'+$(this).attr('id')).toggle();});
	},

	resize();
	uiControls();
})();
