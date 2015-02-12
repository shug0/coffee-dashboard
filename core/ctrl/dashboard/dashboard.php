<?php  

	$the_title = 'Dashboard';
	$simple_title =  strtolower($the_title);  
	echo('<script>$("title").html("'. $the_title .'")</script>');


	if (isset($_SESSION['session'])) {	if ($_SESSION['session']->is_logged()) 	{
		
		include_once(DIR_VIEW . 'dashboard/dashboard.php'); ?>

		<script type="text/javascript">

		$(function(){


			// GRIDSTER INIT
	        var gridster = $(".gridster ul").gridster({
	          widget_base_dimensions: [100, 100],
	          widget_margins: [10, 10],
	          draggable: {
	            handle: "header"
	          }
	        }).data("gridster");


	        // METEO

	        var city = 'Tokyo'; //$('input[name="ville"]').val();

			if (city) {

				$.when
				( 
					$.ajax( 'http://api.openweathermap.org/data/2.5/weather?lang=fr&q=' + city ), 
					$.ajax( 'http://api.openweathermap.org/data/2.5/forecast?lang=fr&q=' + city ) 
				).done(function( dataWeather, dataForecast ) {
					if (dataWeather[1]=='success' & dataForecast[1]=='success') {
						initWeatherWidget(
							dataWeather[2].responseJSON,
							dataForecast[2].responseJSON
						);	
						console.log(dataWeather[2].responseJSON);
						console.log(dataForecast[2].responseJSON);
					};	
				});
				


			};	


			function initWeatherWidget(weather, forecast) {

				var start = '<li class="card" id="weather">',
					FRONTstart = "<figure class='face front'><header></header>",
					icon = "<div class='half'><img class='weatherIcon' src='assets/modules/weather/" + weather.weather[0].icon + ".svg'></div>",
					temp = "<div class='half temp'>" + Math.round(getCelsius(weather.main.temp)) + "°</div>",
					descriptionNice = weather.weather[0].description.charAt(0).toUpperCase() + weather.weather[0].description.substring(1).toLowerCase(),
					ville = "<div class='full city'>" + weather.name + "</div>",
					description = "<div class='full description'>" + descriptionNice + "</div>",
					option = "<i class='md-more-horiz'></i>",
					FRONTend = "</figure>",

					BACKstart = "<figure class='face back'><header></header>",
					label = "<form><label for='city'>Ville :</label>",
					input = "<input id='city' name='city'/>",
					submit = "<button type='submit' class='blue'>Valider</button></form>"
					BACKend = "</figure>",

					end = "</li>";

	        	gridster.add_widget(
	        		start+
	        		FRONTstart+icon+temp+ville+description+option+FRONTend+
	        		BACKstart+label+input+submit+BACKend+
	        		+end
	        		, 
	        		3, 4
	        	);





				$('html').click(function(event) {
					if(!$(event.target).closest('.card').length) {
				    	$('.card').removeClass('flipped');
					};
				});

				$('#weather > figure.face.front > i').click(function(event) {
					event.stopPropagation();
				    $(this).parent().parent().addClass('flipped');
				});


				$('#weather > figure.face.back > form > button').click(function(e) {

					e.preventDefault();
					var city = $('#weather>figure.face.back>form>input').val();

					$.post(
					'<?php echo URL_WEB . "core/ctrl/dashboard/dashboard_actions.php" ?>',
					{
		            	city: $('#city').val(), 
		            	action: 'city'
		            },
		            function(data){
		            	switch (data) 
		            	{
							case 'Success':		
					    		alert('Good');
					    	break;

					    	case 'empty':
					    		alert('Champ vide')
					    	break;

					    	case 'badDatabase':
					    		alert('Erreur inconnu');
							break;
					    	
					    	default:
					    		alert('Erreur yolo');
						    }
						},'text' 
					);

				});
			}
	    });


	    </script>

			


	<?php  }} // END SECURED AREA


?>