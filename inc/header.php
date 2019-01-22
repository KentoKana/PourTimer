<nav>
	<div class="nav-wrap">
		<a href="index.php" class='nav-logo'>POUR TIMER</a>
		<ul class='nav-links'>
			<?php
			$navLinkArray = [
				"BROWSE RECIPES" => "browse-recipe.php",
				"TIMER" => "timer.php",
				"ADD RECIPE" => "add-recipe.php",
				"CONTACT US" => "contact.php",
				"CAREERS" => "careers.php"
			];
			function displayNav($array){
				foreach($array as $label=>$link)
				{
					echo "<li><a href='$link'> $label</a></li>";
				}
			}

			displayNav($navLinkArray);

			?>
		</ul>
	</div>
</nav>
<div class="nav-displacer">

</div>