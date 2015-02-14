var source_ajax;

// ----------- INIT LISTENERS ----------- \\
function listeners() {
	$('.optionCard').off().click(function(event) {
		event.stopPropagation();
	    $(this).parent().parent().addClass('flipped');
	});
	$('html').click(function(event) {
		if(!$(event.target).closest('.card').length) {
	    	$('.card').removeClass('flipped');
		};
	});
	$('#weather > figure.face.back > form > button').off().click(function(e) {
		e.preventDefault();
		new_ville_construct();
	});
}

function constructWeatherWidget(city, gridster, ajaxSrc) {

	source_ajax = ajaxSrc;

	getWeatherDataFor(city, function(result){
		gridster.add_widget('<li class="jAnim-fading card" id="weather">'+result+'</li>', 3, 3);
		listeners();

		gridster.add_widget('<li class="jAnim-fading card" style="background:white"><header></header>Hello you</li>',1,1);
		gridster.add_widget('<li class="jAnim-fading card" style="background:white"><header></header>Hello you</li>',1,2);
		gridster.add_widget('<li class="jAnim-fading card" style="background:white"><header></header>Hello you</li>',2,2);
		gridster.add_widget('<li class="jAnim-fading card" style="background:white"><header></header>Hello you</li>',1,1);
		gridster.add_widget('<li class="jAnim-fading card" style="background:white"><header></header>Hello you</li>',2,2);
		gridster.add_widget('<li class="jAnim-fading card" style="background:white"><header></header>Hello you</li>',1,2);

	});					
}


function getWeatherDataFor(city, callback) 
{
	$.post('http://api.openweathermap.org/data/2.5/weather?lang=fr&q=' + city,
		function(data) {
			var weather = data;
			if (weather.cod!=='404') {
				var start = '',
				FRONTstart = "<figure class='face front'><header></header>",
				icon = "<div class='half'><img class='weatherIcon' src='assets/modules/weather/" + weather.weather[0].icon + ".svg'></div>",
				temp = "<div class='half temp'>" + Math.round(getCelsius(weather.main.temp)) + "°</div>",
				descriptionNice = weather.weather[0].description.charAt(0).toUpperCase() + weather.weather[0].description.substring(1).toLowerCase(),
				ville = "<div class='full city'>" + weather.name + "</div>",
				description = "<div class='full description'>" + descriptionNice + "</div>",
				option = "<i class='optionCard md-more-horiz'></i>", FRONTend = "</figure>",
				BACKstart = "<figure class='face back'><header></header>",
				label = "<form><label for='city'>Ville :</label>",
				input = "<input id='city' name='city'/>",
				message = "<p id='messageOptionVille'></p>",
				submit = "<button type='submit' class='blue'>Valider</button></form>"
				BACKend = "</figure>", end = "";

				var result = start+FRONTstart+icon+temp+ville+description+option+FRONTend+BACKstart+label+input+message+submit+BACKend+end;
				callback(result);
			}
			else {
				getWeatherDataFor('Paris', callback);
			}
		}
	);
}


function new_ville_construct() 
{
	var city = $('#weather>figure.face.back>form>input').val();
	$.post(
		source_ajax,
		{
        	city: $('#city').val(), 
        	action: 'city'
        },
        function(data){
        	switch (data) {
		    	case 'empty':
	 				$('#messageOptionVille').html('Veuillez entrer la ville').css('opacity', '1');
	 				$('#city').addClass('inputError');
		    	break;

		    	case 'sameCity':		
	 				$('#messageOptionVille').html('La ville entré est déjà celle active').css('opacity', '1');
		    	break;
		    	
		    	case 'sucess':		
					getWeatherDataFor($('#city').val(), function(result) {
						$('#weather').html(result);
		 				setTimeout(function() {
	 						$('#weather').removeClass('flipped');
						}, 200);
						listeners();
					});
		    	break;

		    	case 'badDatabase':
		    		$('#messageOptionVille').html('Erreur de connexion au serveur').fadeIn();
				break;
		    	
		    	default:  alert('Erreur inconnu');
			}
		}
	);
}	