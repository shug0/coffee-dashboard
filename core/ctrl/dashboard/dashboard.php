<?php  

	$the_title = 'Dashboard';
	$simple_title =  strtolower($the_title);  
	echo('<script>$("title").html("'. $the_title .'")</script>');
	
	if (isset($_SESSION['session'])) {	if ($_SESSION['session']->is_logged()) 	{
		
		include_once(DIR_VIEW . 'dashboard/dashboard.php');

		$db = new Database();
		$cityInDb = $db->getRow('SELECT option_value FROM options WHERE option_name="city"');

		if (empty($cityInDb)) {	$city = 'Paris'; }
		else { $city = $cityInDb['option_value']; };

		?>

		<script type="text/javascript">

			jQuery(document).ready(function($) {

				$('#content>div>ul').jAnim({"animation": "fading"});

				// ----------- GRIDSTER INIT ----------- \\
		        var gridster = $("#content > div > ul").gridster({
		          widget_base_dimensions: [100, 100],
		          widget_margins: [10, 10],
		          draggable: { handle: "header" }
		        }).data("gridster");


		        // ----------- INIT LISTENERS ----------- \\
				function listeners() {
					$('.optionCard').off().click(function(event) {
						event.stopPropagation();
					    $(this).parent().parent().addClass('flipped');
					});
					$('html').off().click(function(event) {
						if(!$(event.target).closest('.card').length) {
					    	$('.card').removeClass('flipped');
						};
					});
					$('#weather > figure.face.back > form > button').off().click(function(e) {
						e.preventDefault();
						new_ville_construct();
					});
				}

				function getWeatherDataFor(city, callback) 
				{
					$.post('http://api.openweathermap.org/data/2.5/weather?lang=fr&q=' + city,
						function(data, ajaxfinished) {
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
						'<?php echo URL_WEB . "core/ctrl/dashboard/dashboard_actions.php" ?>',
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


				function constructWeatherWidget() {
					var city = '<?php echo $city ?>';
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

				constructWeatherWidget();



			});


	    </script>

	<?php  }} // END SECURED AREA

?>