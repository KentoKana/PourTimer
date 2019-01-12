window.onload = function () {

	//Adding/removing additional pour-points
	//Variables

	//Counter for keeping track of how many pour points were generated.
	let counter = 1;
	const addPourPointBtn = document.getElementById("addPourPoint");
	const removePourPointBtn = document.getElementById("removePourPoint")
	const pourPointDiv = document.getElementById("pour-point-div");
	const pourPoint = document.getElementsByClassName('pourGroup');


	//Event Listeners
	addPourPointBtn.addEventListener('click', addPourPointField);
	removePourPointBtn.addEventListener('click', removePourPointField);

	//Generate form elements
	function addPourPointField() {

		//create fields
		let timeField = "<input type='text' class='userInput' id='pour-point-time" + (counter +1) + "' name='pour-point-time[]'><div class='val-message'></div>";
		let amtField = "<input type='text' class='userInput int'id='pour-point-amt" + (counter + 1) + "' name='pour-point-amt[]'><div class='val-message'></div>";

		//Adds field to the table in add-recipe.php.
		//Prepends 'list number' in front of the forms.
		//Inititally, the fields were added using innerHTML, but this caused an issue where the texts of the existing fields would reset, 
		//every time a new field was added.
		$('#pour-point-div').append(
			"<tr class='pourGroup'><td>" 
			+ (counter + 1) 
			+ ". </td><td>" 
			+ timeField 
			+ "</td><td> " 
			+ amtField 
			+ "</td></tr>");

		return counter += 1;
	}

	function removePourPointField() {
		console.log(pourPoint);
		if(counter > 1){
			//removes the last child of the pourPointDiv.
			pourPointDiv.removeChild(pourPoint[pourPoint.length-1]);
			counter -= 1;			
		} 
		return counter;
	}


	//Form Validation
	const formHandler = document.forms;
	const userInput = document.getElementsByClassName('userInput');

	let formValidity = false;
	formHandler[0].submit_button.onclick = function() {
		for(i=0;i<userInput.length;i++){
			if($('.userInput').eq(i).val() === "" || $('.userInput').eq(i).val() === null){
				$('.userInput').eq(i).addClass('empty');
			} else {
				$('.userInput').eq(i).removeClass('empty');
			}
			if($('.userInput').eq(i).hasClass('empty')){
				$('.val-message').eq(i).html('*This field is required.')
				formValidity = false;
			} else if($('.userInput').eq(i).hasClass('int') && isNaN($('.userInput').eq(i).val())){
				$('.userInput').eq(i).addClass('invalidField');
				$('.val-message').eq(i).html('*Please enter a valid number.');
				formValidity = false;
			} 
			else { 
				$('.userInput').eq(i).removeClass('invalidField');
				$('.val-message').eq(i).html('');
			}

			//If the form is valid, it opens up a bootstrap modal.
			//When the modal opens up, you can click "save recipe" to submit form.
			if(!$('.userInput').hasClass('invalidField') && !$('.userInput').hasClass('empty')){
				formValidity = true;
				$('#submitButton').attr('data-toggle', 'modal');
				$('#submitButton').attr('data-target', '#confirmationModal');
			} else {
				$("#submitButton").removeAttr("data-toggle");
				$("#submitButton").removeAttr("data-target");
			}
		}
	}

}