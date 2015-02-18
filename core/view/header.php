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

		<i class='md-menu'></i>
		<aside id='sidebar'>
			<h1><img src="assets/img/logo_white_sidebar.png" alt=""></h1>
			<nav>
				<ul>
					<a href="?p=dashboard"><li class="md-dashboard"><span>Tableau de bord</span></li></a>
					<a href="?p=users"><li class="md-people"><span>Utilisateurs</span></li></a>
					<a href="?p=settings"><li class="md-settings"><span>Paramètres</span></li></a>
				</ul>
			</nav>

			<div id="userInfo">
				<h3><p><?php echo $_SESSION['user']['user_firstname'] . "</p><p>" . $_SESSION['user']['user_lastname']; ?></p></h3>
				<img id='avatar' class='face front' src="uploads/users/<?php echo $_SESSION['user']['ID'] ?>/avatar.gif" alt="">
				<ul class="optionUser">
					<a href="core/ctrl/user/logout.php"><li class="md-user">Déconnexion</li></a>
				</ul>
			</div>

		</aside>



	<?php endif ?>

	<main>
