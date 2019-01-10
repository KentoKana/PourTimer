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

		//create labels for the fields, with unique id.
		// let timeLbl = '<label for="pour-point-time' + (counter + 1) + '"> Time: </label> ';
		// let amtLbl = '<div><label for="pour-point-amt' + (counter + 1) + '"> Water Amount: </label> ';

		//Adds field to the table in add-recipe.php.
		//Prepends 'list number' in front of the forms.
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
		} else {
			console.log("reached the end of list");
		}
		return counter;
	}


	//Form Validation
	const formHandler = document.forms;
	const userInput = document.getElementsByClassName('userInput');

	let formValidity = false;
	formHandler[0].onsubmit = function() {
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

			if(!$('.userInput').hasClass('invalidField') && !$('.userInput').hasClass('empty')){
				formValidity = true;
			}
		}
		console.log(formValidity);
		return formValidity;
	}

}