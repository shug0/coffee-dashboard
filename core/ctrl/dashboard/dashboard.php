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

	        var city = 'Bordeaux'; //$('input[name="ville"]').val();
	        var meteo;
			if (city) {
				meteo = $.post('http://api.openweathermap.org/data/2.5/weather?q=' + city,
				function(data, textStatus) {
					if (textStatus == 'success') {
						//console.log(data);
					};
				});
			};	
			console.log(meteo);

	        gridster.add_widget("<li>" + meteo + "</li>", 1, 3);


	    });

	    </script>

			


	<?php  }} // END SECURED AREA


?>