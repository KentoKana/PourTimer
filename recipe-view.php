<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pour Timer | Recipe</title>
	<link rel='stylesheet' href="stylesheet/css/recipe-view.css">
	<?php include('inc/headEl.php')?>
</head>

<body>
	<!-- Header -->
	<?php include('inc/header.php')?>

	<!-- Main -->
	<main>
		<div class='section-wrap recipe-view'>
			<div class="recipe-col">
				<div class="recipe-col-wrap">

					<table>

						<!-- PHP BLOCK for displaying data for a single recipe -->
						<?php
						include('inc/database.php');

			// URL query string for rceipe Id.
						$recipeId = $_GET['recipeId'];
			//Select Query
						$sql = "select * from recipe where recipe_id=$recipeId";
			//Query method on PDO
						$conn->query($sql);

						function incCounter($counter){
							$counter += 1;
							return $counter;
						}
						if($conn_status = true){
							$counter = 1;
							foreach ($conn->query($sql) as $row) {
								print "<h1>" . $row[recipe_name] . "</h1>" . "<br>";
								print "<tr><td>Water Temp: </td>" . "<td> $row[water_temp] </td></tr>";
								print "<tr><td>Bean Amt: </td>" . "<td> $row[bean_amt] </td></tr>";
								print "<tr><td>Grind Setting: </td>" . "<td> $row[grind_setting] </td></tr>";
								print "<tr><td>Total Water Amt: </td>" . "<td> $row[total_water_amt] </td></tr>";
								echo 
								"<tr><td>Pour Points: </td>" . 

								//prepends list number for each pour-point.
								"<td><ol><li>" . str_replace(", ", "<li>", $row[pour_points_time] . "</li>") . "</li></ol></td>" . 
								"<td>" . str_replace(", ", "<br>", $row[pour_points_water_amt]) . "</td>" . 
								"</tr>";
								print "<tr><td>Notes: </td>" . "<td colspan='2'> $row[notes] </td></tr>";

								$counter++;
							}

						}

						$newstr = str_replace($order, $replace, $str);

						?>
					</table>
				</div>
			</div>
			<div class="timer-col">
				<div class="timer-col-wrap">
					<h2 id="timer">00 : 00 : 000</h2>
					<div class="timer-buttons">
						<button id="toggle">Start</button>
						<button id="reset">Reset</button>
					</div>
				</div>
			</div>
		</div>
	</main>

	<!-- Footer -->
	<?php include('inc/footer.php')?>
</body>
<script src="js/stopwatch.js"></script>

</html>