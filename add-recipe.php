<?php 
include('inc/database.php');
include('lib/Validation.php');
ini_set('display_errors',1);
error_reporting(E_ALL);

//REMEMBER TO TURN UNCOMMENT WHEN VALIDATION IS DONE.
require('lib/Recipe.php');

if(isset($_POST['submit_button']))
{
	$newRecipe = new Recipe(
		$_POST['recipe-name'], 
		$_POST['water-temp'], 
		$_POST['bean-amt'], 
		$_POST['grind-setting'], 
		$_POST['total-water-amt'], 
		$_POST['pour-point-time'], 
		$_POST['pour-point-amt']
	);

	$recipe_name = $newRecipe->getRecipeName();
	$water_temp = $newRecipe->getWaterTemp();
	$bean_amt = $newRecipe->getBeanAmt();
	$grind_setting = $newRecipe->getGrindSetting();
	$total_water_amt = $newRecipe->getTotalWaterAmt();
	$pour_points_time = $newRecipe->getPourPointsTime();
	$pour_points_water_amt = $newRecipe->getPourPointsWaterAmt();

	$newRecipe->setNotes($_POST['notes']);
	$notes = $newRecipe->getNotes();
}

?>

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
			<p><em>Please note: Any field marked with "<span class="required">*</span>" are required.</em></p>
			<?php
			//Display a dismissable alert box (Bootstrap) when form is successfully submitted for adding recipe.
			//https://getbootstrap.com/docs/4.0/components/alerts/
			if (isset($_REQUEST['insertStatus']) && $_REQUEST['insertStatus'] === 'success') :
				$newRecipeId = $_REQUEST['recipeId'];
				$newRecipeLink = "'recipe-view.php?recipeId=$newRecipeId'";
				?>
				<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>You've successfully added your recipe!</strong> Check it out <a href= <?= $newRecipeLink; ?> >here.</a>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php endif; 
			?>
			<!-- https://stackoverflow.com/questions/5666788/php-how-to-hide-display-chunks-of-html-->

			<div class="jumbotron">
				<!-- ................FORM START ........................-->
				<form action="add-recipe.php" method="POST">

					<!-- ................Recipe Name ........................-->
					<div>
						<label for="recipe-name"><span class="required">*</span>Recipe Name:</label>
					</div>
					<div class="val-message"id="recipe-name-validation">
						<?php
						if(isset($recipe_name) && Validator::validateEmptyInput($_POST['recipe-name']) === false)
						{
							$errorArr['recipe-name'] = 1;
						}
						?>
					</div>
					<input type="text" id="recipe-name" class="userInput" name="recipe-name" placeholder="e.g. Ultra Coffee" 
					<?php if(isset($recipe_name)): Validator::dispPostVal($recipe_name); endif?>>

					<!-- ................WATER TEMP ........................-->
					<div>
						<label for="water-temp"><span class="required">*</span>Water Temperature (&#8451;):</label>
					</div>
					<div class="val-message" id="water-temp-validation">
						<?php
						if(isset($water_temp) && Validator::validateIntInput($_POST['water-temp']) === false)
						{
							$errorArr['water-temp'] = 1;
						}

						?>
					</div>
					<input type="text" id="water-temp" name="water-temp" class="userInput int" placeholder="e.g. 93"
					<?php if(isset($water_temp)): Validator::dispPostVal($water_temp); endif?>>

					<!-- ................Bean Amount ........................-->
					<div>
						<label for="bean-amt"><span class="required">*</span>Bean Amount (g):</label>
					</div>
					<div class="val-message" id="bean-amt-validation">
						<?php
						if(isset($bean_amt) && Validator::validateIntInput($_POST['bean-amt']) === false)
						{
							$errorArr['bean-amt'] = 1;
						}
						?>	
					</div>
					<input type="text" id="bean-amt" class="userInput int" name="bean-amt" placeholder="e.g. 20" 
					<?php if(isset($bean_amt)): Validator::dispPostVal($bean_amt); endif?>>

					<!-- ................Grind Setting ........................-->
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
					<div class="val-message" id="grind-setting-validation">
						<?php
						//Need to create validator for drop down menu.
						?>
					</div>

					<!-- ................Total water amount ........................-->
					<div>
						<label for="total-water-amt"><span class="required">*</span>Total Water Amount (g): </label>
					</div>
					<div class="val-message" id="total-water-amt-validation">
						<?php
						if(isset($total_water_amt) && Validator::validateIntInput($_POST['total-water-amt']) === false)
						{
							$errorArr['total-water-amt'] = 1;
						}
						?>	
					</div>
					<input type="text" class="userInput int" id="total-water-amt" name="total-water-amt" placeholder="e.g. 300"
					<?php if(isset($total_water_amt)): Validator::dispPostVal($total_water_amt); endif?>>

					<!-- ................Pour Points........................-->					
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
								<th><label for="pour-point-time"><span class="required">*</span>Time (MM:SS):</label></th>
								<th><label for="pour-point-amt"><span class="required">*</span>Water Amount (g):</label></th>
								<tr>
									<td>1.</td>
									<td><input type="text" class="userInput" id="pour-point-time" name="pour-point-time[]" value="00:00"><div class='val-message'></div></td>
									<td><input type="text" class="userInput int" id="pour-point-amt" name="pour-point-amt[]" placeholder="e.g. 50"><div class='val-message'></div></td>
								</tr>
							</tbody>
						</table>
					</div>

					<!-- ................Notes ........................-->
					<div>
						<label for="notes">Notes:<span class='optional'>(optional)</span></label>
					</div>
					<textarea id='notes' name="notes" placeholder="e.g. Stir the grounds during bloom. Pour clockwise. Etc."></textarea>
					<div id="validationSummary" class="required">

					</div>

					<!-- <button type="button" id="submitButton" class='button' name="submit_button">Save Recipe</button>-->
					<button type="submit" id="submitButton" class='button' name="submit_button">Save Recipe</button>
					<?php if(isset($errorArr)): var_dump($errorArr); endif ?>



					<!-- ..........Bootstrap Modal ............-->
					<div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="confirmationModalTitle" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="confirmationModalTitle">Confirm Submission</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
									<div>
										Recipe Name: <span class="modal-body__data"></span>
									</div>
									<div>
										Water Temperature: <span class="modal-body__data"></span>
									</div>
									<div>
										Bean Amount: <span class="modal-body__data"></span>
									</div>
									<div>
										Grind Setting: <span class="modal-body__data"></span>
									</div>	
									<div>
										Total Water Amount: <span class="modal-body__data"></span>
									</div>
									<div>
										Pour Points: <span class="modal-body__data"></span>
									</div>
								</div>
								<div class="modal-footer">
									<button type="button" class="button btn-secondary" data-dismiss="modal">Cancel</button>
									<button type="submit" name="confirm_submission" class="button">Confirm and Submit</button>
								</div>
							</div>
						</div>
					</div>

				</form>

				<!-- Handle Form -->
				<!-- Will separate this logic in another file later-->
				<?php
				//Change this back to "confirm_submission" later;
				//If $errorArr array is empty, execute PDO methods.
				//https://stackoverflow.com/questions/2216052/how-to-check-whether-an-array-is-empty-using-php
				if(isset($_POST["submit_button"]) && empty($errorArr)){
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
					try {
						$insertStmt->execute();
						$insertedRecipe = $conn->lastInsertId();
                        //Get last id of the inserted data.
                        //https://www.w3schools.com/php/php_mysql_insert_lastid.asp
						header("Location: add-recipe.php?insertStatus=success&recipeId=$insertedRecipe");
                        //http://php.net/manual/en/function.header.php
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
<script src="js/jquery.js"></script>
</html>
