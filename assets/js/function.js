// POSITION

// ADJUST HORIZONTAL & VERTICAL CENTER ♥

function center(selector) {

	$(window).resize(function(){
	    $(selector).css({
	        position:'absolute',
	        left: ($(window).width() - $(selector).outerWidth())/2,
	        top: ($(window).height() - $(selector).outerHeight())/3
	    });
	});

	$(window).resize();

};


// METEO


function getDate(timestamp) {
	var date = new Date(timestamp*1000);

	var joursRef = ["Dimanche", "Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
	var moisRef = ["Janvier", "Février", "Mars", "Juin", "Juillet", "Aout", "Septembre", "Octobre", "Novembre", "Décembre"];
	
	var jours = joursRef[date.getDay()];
	var mois = moisRef[date.getDay()];
	
	return(jours + " " + date.getDate() + " " + mois);

}

function getCelsius(kelvin) {
	var temp = kelvin;
	temp = temp - 273.15;
	temp = temp.toFixed(2);
	return temp; // + '°c';
}