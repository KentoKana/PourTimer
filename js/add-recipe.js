window.onload = function () {

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


}