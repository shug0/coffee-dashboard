// PAGE

function changingPage() {
  $('main').css('opacity', '0');
}

function enterPage() {
  $('main').css('opacity', '1');
}


// GRIDSTER

function initFlipCard() {
	$('.optionCard').click(function(event) {
		event.stopPropagation();
	    $(this).parent().parent().addClass('flipped');
	});

	$('html').click(function(event) {
		if(!$(event.target).closest('.card').length) {
	    	$('.card').removeClass('flipped');
		};
	});
}

