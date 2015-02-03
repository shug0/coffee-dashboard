<?php 

$the_title = 'Ajouter un utilisateur';

// ADMIN - LOGGED VERIFICATION 
/*
if (isset($_SESSION['session'])) {
	if (!$_SESSION['session']->check_logged()) {
		header('Location: index.php');      
	}
}
else {header('Location: index.php');}
*/

// Connection to the database
$db = new Database();

if ($db->isConnected) {
	$page_to_load = DIR_VIEW . 'user/newUser.php';
}
else {
	$page_to_load = 'default.php';
}

include( VIEW_HEADER );
include( $page_to_load );
include( VIEW_FOOTER );

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

						case 'badPassword':
				    		showMessage("Vous avez entrer un mauvais mot de passe");
				    		break;

				    	case "badPseudo":
				    		showMessage("Votre pseudo n'existe pas");
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
				    		showMessage("Il y à déjà un untilisateur avec ce pseudo");
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