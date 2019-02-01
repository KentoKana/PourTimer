<?
//Reference functions from func.php
include('functions/func.php');
?>

<nav>
	<div class="nav-wrap">
		<a href="index.php" class='nav-logo'>POUR TIMER</a>
		<ul class='nav-links'>
			<?php
			// require('functions/functions.php')
			$navLinkArray = [
				"BROWSE RECIPES" => "browse-recipe.php",
				"TIMER" => "timer.php",
				"ADD RECIPE" => "add-recipe.php",
				"CONTACT US" => "contact.php",
				"CAREERS" => "careers.php"
			];

			echo displayNav($navLinkArray);

			?>
		</ul>
	</div>
</nav>
<div class="nav-displacer">

</div>