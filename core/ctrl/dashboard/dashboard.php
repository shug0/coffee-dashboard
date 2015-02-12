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

	        var city = 'Vancouver'; //$('input[name="ville"]').val();

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
					};	
				});
				


			};	


			function initWeatherWidget(weather, forecast) {

				var start = '<li id="weather">',
					FRONTstart = "<figure class='front><header></header>",
					icon = "<div class='half'><img src='assets/modules/weather/" + weather.weather[0].icon + ".svg'></div>",
					temp = "<div class='half temp'>" + Math.round(getCelsius(weather.main.temp)) + "°</div>",
					descriptionNice = weather.weather[0].description.charAt(0).toUpperCase() + weather.weather[0].description.substring(1).toLowerCase(),
					description = "<div class='full description'>" + descriptionNice + "</div>",
					ville = "<div class='full description'>" + weather.name + "</div>",
					FRONTend = "</figure>",
					BACKstart = "<figure class='back'>",
					BACKend = "</figure>",
					end = "</li>";

	        	gridster.add_widget(start+FRONTstart+icon+temp+description+ville+FRONTend+end, 3, 3);

			}



	    });

	    </script>

			


	<?php  }} // END SECURED AREA


?>