window.onload = function () {

	//Adding/removing additional pour-points
	//Variables

	//Counter for keeping track of how many pour points were generated.
	let counter = 1;
	const addPourPointBtn = document.getElementById("addPourPoint");
	const removePourPointBtn = document.getElementById("removePourPoint")
	const pourPointDiv = document.getElementById("pour-point-div");

	//Event Listeners
	addPourPointBtn.addEventListener('click', addPourPointField);
	removePourPointBtn.addEventListener('click', removePourPointField);

	//Generate form elements
	function addPourPointField() {

		//create fields
		let timeField = "<input type='text' id='pour-point-time" + (counter +1) + "' name='pour-point-time[]'>";
		let amtField = "<input type='text' id='pour-point-amt" + (counter + 1) + "' name='pour-point-amt[]'>";

		//create labels for the fields
		let timeLbl = '<label for="pour-point-time' + (counter + 1) + '"> Time: </label> ';
		let amtLbl = '<label for="pour-point-amt' + (counter + 1) + '"> Water Amount: </label> ';


		//Prepends 'list number' in front of the forms.
		$('#pour-point-div').append("<div class='pourGroup'>" + (counter + 1) + ". " + timeLbl + timeField + " " + amtLbl + amtField + "<br>" + "</div>");

		return counter += 1;
	}

	const pourPoint = document.getElementsByClassName('pourGroup');
	console.log(pourPoint);


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


	//form validation
	const formHandler = document.forms;

	function validate(input, regex){
		var regEx = regex;
		var userInput = $(input).val();
		return regEx.test(userInput);
	}

	const userInput = document.getElementsByClassName('userInput');
	const valMessage = document.getElementsByClassName('val-message');

	var formValid = false;
	formHandler[0].onsubmit = function() {

		if(formValid === false){
			for(i=0;i<userInput.length;i++){
				if(userInput[i].value === "" || userInput[i].value === null){
					valMessage[i].innerHTML = "*You cannot leave this field blank.";
					formValid = false;
				} else {
					valMessage[i].innerHTML = "";
					formValid = true;
				}
			}
			
			return formValid;
		} 

		// if($('.userInput').val() === "" || $('.userInput').val === null){
		// 	$('.val-message').html("*You cannot leave this field blank."); 
		// 	return false;
		// } else {
		// 	$('.val-message').html(""); 

		// }
		// if($('#recipe-name').val() === "" || $('#recipe-name').val() === null ){
		// 	$('#recipe-name-validation').html("*You have to name your recipe."); 
		// 	return false;
		// }
		// if(isNaN($('water-temp').val())){
		// 	$('#water-temp-validation').html("*You ")
		// }

	}

}