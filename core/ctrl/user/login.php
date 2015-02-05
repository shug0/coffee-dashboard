<?php 

$the_title = 'Login';
$simple_title =  strtolower($the_title);  
echo('<script>$("title").html("'. $the_title .'")</script>');
include( DIR_VIEW . 'user/login.php' );

?>

<script>

	jQuery(document).ready(function($) {

	// Centering all on the middle
	center('section#login');

	// Reset the style of button when click on input
	$("input").click(function() {
		$(".error").fadeOut('400');			
		$("#submit").removeClass('red');
		$('input#pseudo, input#password').removeClass('inputError');
	})	
	
	// When we click on "send button"
	$("#submit").click(function(e) {
		e.preventDefault()
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
						$(".error").html(message).fadeIn('400');
						$("#submit").addClass('red');
					}
            	switch (data) 
            	{
					// function for show Error message
					case 'Success':		
						changingPage();
			    		setTimeout(function(){
			    			  document.location.href="index.php";
			    		}, 1000);
			    		break;

			    	case "allEmpty":
			    		showMessage("Veuillez remplir les champs");
			    		$('input#pseudo, input#password').addClass('inputError');
			    		$(".error").addClass('md-error');
			    		break;

			    	case "pseudoEmpty":
			    		showMessage("Le champ pseudo n'est pas rempli");
			    		$('input#pseudo').addClass('inputError');
			    		$(".error").addClass('md-error');
			    		break;

			    	case "passwordEmpty":
			    		showMessage("Le champ mot de passe n'est pas rempli");
			    		$('input#password').addClass('inputError');	
			    		$(".error").addClass('md-error');
	    				break;
			    	default:
			    		showMessage("Le pseudo ou le mot de passe saisi est incorrect.");
			    		$(".error").addClass('md-error');
				    }
				},'text' // Type of "data" returned
			);}
		);
	});

</script>