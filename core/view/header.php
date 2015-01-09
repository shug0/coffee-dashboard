<?php header("Access-Control-Allow-Origin: *"); ?>

<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title><?php if(isset($the_title)) { echo $the_title . ' | Coffee Dashboard'; }else{ echo"Coffee Dashboard";} ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL_WEB ?>assets/css/main.min.css">
</head>
<body>
<i class="md-local-florist"></i>
	<nav>
		<ul>
			<li><a href="?p=0">Home</a></li>

			<?php if (isset($_SESSION['session']) and isset($_SESSION['pseudo']) and isset($_SESSION['hash'])): ?>
				<li><a href="?p=1">Admin</a></li>
	    		<li><a href='?p=99'>Logout</a></li>
			<?php else: ?>
    			<li><a href="?p=2">Login</a></li>
			<?php endif ?>

		</ul>
	</nav>



