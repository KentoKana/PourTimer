<?php
include('inc/database.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pour-Timer | Browse Recipe</title>
	<link rel='stylesheet' href="stylesheet/css/browse-recipe.css">
	<?php include('inc/headEl.php')?>
</head>

<body>
	<!-- Header -->
	<?php include('inc/header.php')?>


	<!-- Main -->
	<main>
		<div class='section-wrap browse-recipe'>

			<div class="browse-recipe-wrap">
				<!-- Table to display recipe list -->
				<table>
					<tr>
						<th><h1>Recipe Name</h1></th>
					</tr>
						<?php

					//Select statement
						$sql = "select * from recipe";
					//Select query on PDO
						$conn->query($sql);

					//Loop thourgh database table and display the list of recipe names
					//Create a hyperlink to the individual recipe pages using the url query string to display individual recipe id.
						if($conn_status = true){
							foreach ($conn->query($sql) as $row) {
								print
								"<tr><td>" .
								"<a href='recipe-view.php?recipeId=$row[recipe_id]'>" .
								$row['recipe_name'] .
								"</a>" .
								"</td></tr>";
							}
						}
						?>
				</table>
			</div>
		</div>

	</main>

	<!-- Footer -->
	<?php include('inc/footer.php')?>
</body>
<script src="js/browse-recipe.js"></script>

</html>
