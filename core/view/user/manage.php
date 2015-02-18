<section id='users' class='content'>

	<h2>Utilisateurs</h2>

	<ul>
		

	<?php 

		foreach ($users as $index => $user) {
			echo "<li>";

			echo "<img class='avatar' src='uploads/users/" . $user['ID'] . "/avatar.gif'>";
						
			echo "</li>";
		}

	 ?>


	</ul>

</section>