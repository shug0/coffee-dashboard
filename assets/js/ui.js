// Fennetre options utilisateurs 

jQuery(document).ready(function($) {
	
	var sidebar = $('#sidebar');

	$('.md-menu').click(function(event) {
		event.stopPropagation();
		sidebar.addClass('show');
	});


	$('#userInfo').click(function(event) {
		event.stopPropagation();
		$('.optionUser').addClass('show');
	});

	$('html').click(function(event) {

		if ($(document).width() < 500) {
			if(!$(event.target).closest('#sidebar').length) {
				sidebar.removeClass('show');
			};
		};

		if(!$(event.target).closest('.avatarZone').length) {
	    	$('.optionUser').removeClass('show');
		};
	});


});