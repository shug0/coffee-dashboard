<?php 

$the_title = 'Login';
$simple_title =  strtolower($the_title);  
$page_to_load = DIR_VIEW . 'user/login.php';

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
	
	// When we click on "send button"
	$("#submit").click(function(e) {
		$.post(
			// Path for the PHP script to execute with ajax
			'<?php echo URL_WEB . "core/ctrl/user/user_actions.php" ?>',
			{
            	// Get the content of the input
            	pseudo: $('#pseudo').val(), 
            	password: $('#password').val(), 
            	action: 'login'
            },
            // Get the result of the PHP script
            function(data){
            	// Switch 
					function showMessage(message) {
						$("#submit>.message").html(message);
						$("#submit").addClass('alizarin');
						$("#submit>.send").css("margin-top", "-50px");
					}

            	switch (data) 
            	{
					// function for show Error message
					case 'Success':		
						showMessage("Vous avez été connecté avec succès !")		    
			    		$("#submit").removeClass('alizarin'); // Let the green stay
			    		// Redirect to homepage
			    		setTimeout(function(){
			    			  document.location.href="index.php";
			    		}, 1000);
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

			    	default:
			    		showMessage("Il y à une erreur, veuillez réessayer ultérieurement.");
				    }
				},'text' // Type of "data" returned
			);}
		);
	});

</script>