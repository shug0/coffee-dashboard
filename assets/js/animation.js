// PAGE

function changingPage() {
  $('main').css('opacity', '0');
}

function enterPage() {
  $('main').css('opacity', '1');

	if ($(document).width() > 500) {
  		$('#sidebar').addClass('show');
	}

}


// GRIDSTER


