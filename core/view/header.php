<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <title><?php if(isset($the_title)) { echo $the_title . ' | Coffee Dashboard'; }else{ echo"Coffee Dashboard";} ?> </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?php echo URL_WEB ?>assets/css/main.min.css">
    <script src="<?php echo URL_WEB ?>assets/js/min/main.min.js"></script>
</head>
<body id ="<?php if(isset($simple_title)) { echo $simple_title; }; ?>">

	<?php if (isset($_SESSION['session'])): ?>

		<aside>
			<h1><img src="assets/img/logo_white_sidebar.png" alt=""></h1>
			<nav>
				<ul>
					<li class="md-dashboard"><a href="?p=dashboard">Tableau de bord</a></li>
					<li class="md-people"><a href="?p=users">Utilisateurs</a></li>
					<li class="md-settings"><a href="?p=settings">Paramètres</a></li>
				</ul>
			</nav>
		</aside>

	<?php endif ?>

	<main>
