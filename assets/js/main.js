function center(selector) {

	$(window).resize(function(){
	    $(selector).css({
	        position:'absolute',
	        left: ($(window).width() - $(selector).outerWidth())/2,
	        top: ($(window).height() - $(selector).outerHeight())/3.2
	    });
	});

	$(window).resize();

}


jQuery(document).ready(function($) {
	
	showBox();

});


// ADJUST HORIZONTAL & VERTICAL CENTER ♥

