<?php include('inc/database.php')?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Pour Timer | Add Recipe</title>
	<link rel='stylesheet' href="stylesheet/css/add-recipe.css">
	<script src="js/jquery.js"></script>
	<?php include('inc/headEl.php')?>
</head>

<body>
	<!-- Header -->
	<?php include('inc/header.php')?>

	<!-- Main -->
	<main>
		<div class='section-wrap add-recipe'>
			<h1>Add Recipe</h1>
			<p><em>Please note: Any field marked with "<span class="required">*</span>" are required.</em></p>
			<div class="jumbotron">
				<form action="add-recipe.php" method="POST">
					<div>
						<label for="recipe-name"><span class="required">*</span>Recipe Name:</label>
					</div>
					<input type="text" id="recipe-name" class="userInput" name="recipe-name" placeholder="e.g. Ultra Coffee">
					<div class="val-message"id="recipe-name-validation"></div>
					<div>
						<label for="water-temp"><span class="required">*</span>Water Temperature:</label>
					</div>
					<input type="text" id="water-temp" name="water-temp" class="userInput int">
					<div class="val-message" id="water-temp-validation"></div>

					<div>
						<label for="bean-amt"><span class="required">*</span>Bean Amount:</label>
					</div>
					<input type="text" id="bean-amt" class="userInput int" name="bean-amt">
					<div class="val-message" id="bean-amt-validation"></div>

					<div>
						<label for="grind-setting"><span class="required">*</span>Grind Setting:</label>
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
						<label for="total-water-amt"><span class="required">*</span>Total Water Amount:</label>
					</div>
					<input type="text" class="userInput int" id="total-water-amt" name="total-water-amt">
					<div class="val-message" id="total-water-amt-validation"></div>

					<!-- Pour Points -->
					<div>
						<label>Pour Points:</label>
						<div class="button-wrap">
							<button type="button" class="button" id="addPourPoint">Add</button>
							<button type="button" class="button" id="removePourPoint">Remove</button>
						</div>
					</div>
					<div id="pourGroupTableDiv" class="pourGroup">
						<table>
							<tbody id="pour-point-div">
								<th></th>
								<th><label for="pour-point-time"><span class="required">*</span>Time:</label></th>
								<th><label for="pour-point-amt"><span class="required">*</span>Water Amount:</label></th>
								<tr>
									<td>1.</td>
									<td><input type="text" class="userInput" id="pour-point-time" name="pour-point-time[]" placeholder='MM:SS'><div class='val-message'></div></td>
									<td><input type="text" class="userInput int" id="pour-point-amt" name="pour-point-amt[]"><div class='val-message'></div></td>
								</tr>
							</tbody>

						</table>
					</div>

					<div>
						<label for="notes">Notes:<span class='optional'>(optional)</span></label>
					</div>
					<textarea id='notes' name="notes" placeholder="eg. Stir the grounds during bloom. Pour clockwise. Etc."></textarea>
					<button type="button" id="submitButton" class='button' name="submit_button">Save Recipe</button>

					<!-- Bootstrap Modal -->
					<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="confirmationModalTitle">Submission Confirmation</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									...
								</div>
								<div class="modal-footer">
									<button type="button" class="button btn-secondary" data-dismiss="modal">Close</button>
									<button type="submit" name="confirm_submission" class="button">Save Recipe</button>
								</div>
							</div>
						</div>
					</div>

				</form>

			<!-- Handle Form -->
			<!-- Will separate this logic in another file later-->
			<?php

			if(isset($_POST["confirm_submission"])){


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
	</div>
</main>

<!-- Footer -->
<?php include('inc/footer.php')?>
</body>
<script src="js/add-recipe.js"></script>
<!-- Bootstrap dependencies -->
<!-- https://getbootstrap.com/docs/4.2/getting-started/introduction/ -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
</html>
