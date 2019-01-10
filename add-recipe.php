<?php include('inc/database.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pour Timer | Add Recipe</title>
	<link rel='stylesheet' href="stylesheet/css/add-recipe.css">
	<?php include('inc/headEl.php')?>
</head>

<body>
	<!-- Header -->
	<?php include('inc/header.php')?>

	<!-- Main -->
	<main>
		<div class='section-wrap add-recipe'>
			<h1>Add Recipe</h1>
			<form action="add-recipe.php" method="POST">
				<div>
					<label for="recipe-name">Recipe Name:</label>
				</div>
				<input type="text" id="recipe-name" class="userInput" name="recipe-name">
				<div class="val-message"id="recipe-name-validation"></div>
				<div>
					<label for="water-temp">Water Temperature:</label>
				</div>
				<input type="text" id="water-temp" name="water-temp" class="userInput int">
				<div class="val-message" id="water-temp-validation"></div>

				<div>
					<label for="bean-amt">Bean Amount:</label>
				</div>
				<input type="text" id="bean-amt" class="userInput int" name="bean-amt">
				<div class="val-message" id="bean-amt-validation"></div>

				<div>
					<label for="grind-setting">Grind Setting:</label>
				</div>
				<select id="grind-setting" class="userInput"  name="grind-setting">
					<option value="-1" selected disabled>Select Grind Setting:</option>
					<option value="Turkish Coffee (Extra-Fine)">Turkish Coffee (Extra-Fine)</option>
					<option value="Espresso (Fine)">Espresso (Fine)</option>
					<option value="Filter (Medium)">Filter (Medium)</option>
					<option value="French Press (Coarse)">French Press (Coarse)</option>
				</select>				
				<div class="val-message" id="grind-setting-validation"></div>

				<div>
					<label for="total-water-amt">Total Water Amount:</label>
				</div>
				<input type="text" class="userInput int" id="total-water-amt" name="total-water-amt">
				<div class="val-message" id="total-water-amt-validation"></div>


				<!-- Pour Points -->
				<div>
					<label>Pour Points:</label>
					<div class="button-wrap">
						<span class="button" id="addPourPoint">+</span>
						<span class="button" id="removePourPoint">-</span>
					</div>
				</div>
				<div id="pour-point-div">

					1.
					<label for="pour-point-time">Time:</label>
					<input type="text" class="userInput" id="pour-point-time" name="pour-point-time[]">
					<div class="val-message" id="pour-point-time-validation"></div>

					<label for="pour-point-amt">Water Amount:</label>
					<input type="text" class="userInput int" id="pour-point-amt" name="pour-point-amt[]">
					<div class="val-message" id="pour-point-amt-validation"></div>


				</div>

				<div>
					<label for="notes">Notes:</label>
				</div>
				<textarea id='notes' name="notes"></textarea>
				<input type="submit" name="submit_button">

			</form>

			<!-- Handle Form -->
			<?php

			if(isset($_POST["submit_button"])){


			//DB insert statement
				$insertStmt = $conn->prepare("INSERT INTO recipe VALUES (DEFAULT, :recipe_name, :water_temp, :bean_amt, :grind_setting, :total_water_amt, :pour_points_water_amt, :pour_points_time, :notes)");

			//Bind parameters to variables
				$insertStmt->bindParam(':recipe_name', $recipe_name);
				$insertStmt->bindParam(':water_temp', $water_temp);
				$insertStmt->bindParam(':bean_amt', $bean_amt);
				$insertStmt->bindParam(':grind_setting', $grind_setting);
				$insertStmt->bindParam(':total_water_amt', $total_water_amt);
				$insertStmt->bindParam(':pour_points_water_amt', $pour_points_water_amt);
				$insertStmt->bindParam(':pour_points_time', $pour_points_time);
				$insertStmt->bindParam(':notes', $notes);

			//Sanitize user input
				filter_var($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

				$recipe_name = filter_var($_POST['recipe-name'], FILTER_SANITIZE_SPECIAL_CHARS);
				$water_temp = filter_var($_POST['water-temp'], FILTER_SANITIZE_SPECIAL_CHARS);
				$bean_amt = filter_var($_POST['bean-amt'], FILTER_SANITIZE_SPECIAL_CHARS);
				$grind_setting = filter_var($_POST['grind-setting'], FILTER_SANITIZE_SPECIAL_CHARS);
				$total_water_amt = filter_var($_POST['total-water-amt'], FILTER_SANITIZE_SPECIAL_CHARS);
				$notes = filter_var($_POST['notes'], FILTER_SANITIZE_SPECIAL_CHARS);

			//Concatinate all item in pour points time/pour points water amt to one string, then sanitize input;
				$pour_points_time_raw =  implode(", ",$_POST['pour-point-time']);
				$pour_points_time = filter_var($pour_points_time_raw, FILTER_SANITIZE_SPECIAL_CHARS);

				$pour_points_water_amt_raw =  implode(", ",$_POST['pour-point-amt']);
				$pour_points_water_amt = filter_var($pour_points_water_amt_raw, FILTER_SANITIZE_SPECIAL_CHARS);

				try {

					$insertStmt->execute();

				} catch(PDOException $e) {

					echo 'PDOException: ' . $e->getMessage();

				}
			}

			?>
		</div>



	</main>

	<!-- Footer -->
	<?php include('inc/footer.php')?>
</body>
<script src="js/add-recipe.js"></script>
<script src="js/jquery.js"></script>
</html>

