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
		
		<script src="<?php echo URL_WEB . 'core/ctrl/dashboard/weather.js' ?>" type="text/javascript"></script>
		<script type="text/javascript">

			jQuery(document).ready(function($) {

				$('#content>div>ul').jAnim({"animation": "fading"});

				// ----------- GRIDSTER INIT ----------- \\
		        var gridster = $("#content > div > ul").gridster({
		          widget_base_dimensions: [100, 100],
		          widget_margins: [10, 10],
		          draggable: { handle: "header" }
		        }).data("gridster");

				var city = '<?php echo $city ?>';

				constructWeatherWidget(city, gridster, '<?php echo URL_WEB . "core/ctrl/dashboard/dashboard_actions.php" ?>');

			});


	    </script>

	<?php  }} // END SECURED AREA

?>