<?php 

$the_title = 'Ajouter un utilisateur';

if (isset($_SESSION['session'])) {
	if ($_SESSION['session']->check_logged()) {


	// Connection to the database
	$db = new Database();

	if ($db->isConnected) {
		include(DIR_VIEW . 'user/newUser.php');
	}

	?>

	<script>
		jQuery(document).ready(function($) {

			// Reset the style of button when click on input
			$("input").click(function() {
				$("#submit>.send").css("margin-top", "0");
				$("#submit").removeClass('alizarin');
			})	

			$("#submit").click(function(e) {
				$.post(
		            '<?php echo URL_WEB . "core/ctrl/user/user_actions.php" ?>',
					{
		            	pseudo: $('#pseudo').val(), 
		            	password: $('#password').val(), 
		            	action: "newUser" 
		            },
		            function(data){

		            	function showMessage(message) {
							$("#submit>.message").html(message);
							$("#submit").addClass('alizarin');
							$("#submit>.send").css("margin-top", "-50px");
						}

						console.log(data);

		            	switch(data) 
		            	{
						    case 'Success':
						        showMessage("L'utilisateur '" + $('#pseudo').val() + "' a bien été ajouté.");
						        $("#submit").removeClass('alizarin');
						    	break;

					    	case "allEmpty":
					    		showMessage("Veuillez remplir les champs");
					    		break;

					    	case "pseudoEmpty":
					    		showMessage("Le champ pseudo n'est pas rempli");
					    		break;

					    	case "passwordEmpty":
					    		showMessage("Le champ mot de passe n'est pas rempli");
					    		break;

					    	case "userAlreadyExist":
					    		showMessage("Il y à déjà un utilisateur avec ce pseudo");
					    		break;

						    case 'Error':
						        showMessage("L'utilisateur '" + $('#pseudo').val() + "' existe déjà.");					    	
						    	break;

					    	default:
					    		showMessage("Il y à une erreur, veuillez réessayer ultérieurement.");
						}	            
		             },'text' // Type of "data" returned
				);}
			);
		});
	</script>

	<?php 
	}
	else {header('Location: index.php');}
}
else {header('Location: index.php');}