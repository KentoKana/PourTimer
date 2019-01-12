"use strict";
window.onload = function() {
	

//=======================Stopwatch logic===========================//


//Variable declarations=============================//

//Set time to 0 by default in a global var.
//Declare global variables 'interval' and 'offset'
//Interval will be passed the setInterval method. It has to be declared globally, as 
//it needs to be read by both start() and stop() functions.
//Offset variable will be passed Date.now().
//variable 'isOn' holds a boolean value, which indicates whether the stopwatch is on or off.
let time = 0;
let interval;
let offset;
var isOn = false;

//Functions=========================================//
//start():
//if the isOn is false, then run function.
//interval is passed the setInterval method, which runs the "printToDOM" function every 10 milliseconds.
//offset will be passed the UTC timestamp value when function runs.
//isOn is now "true" to indicate that the stopwatch is running.
function start() {
	if(!isOn){
		interval = setInterval(printToDOM, 10);
		offset = Date.now();
		isOn = true;
	}

};

//stop()
//if the isOn is true (ie if stopwatch is on): 
//clear the interval (pass the interval variable) to method.
//set isOn to false (ie to render the stopwatch to be "off");
function stop() {
	if(isOn){
		clearInterval(interval);
		isOn = false;
	}
};

//reset()
//When reset function is triggered, set the time variable to 0, so that when
//the stopwatch is started again, it starts from 0, and not from where it left off.
//Resets innerHTML of timer and message span.
function reset() {
	time = 0;
	timer.innerHTML='00 : 00 : 000';
};

//update()
//update function is passed in the setInterval method in the start() funciton.
//it updates the time variable by adding the returned value from changeInTime() function everytime the function is being called.
function update() {
	time += changeInTime();
	let formattedTime = timeFormatter(time);
	console.log(formattedTime.toString());

	return formattedTime;
}

//changeInTime()
//this function has a private variable 'now', which sets a new UTC time every 10 milliseconds.
//the private variable "timePassed" will hold the subtracted value of "now" and the the UTC time initially set by the offset variable defined
//inside the start() function.
//now - offset returns 10 milliseconds.
//offset is then set to the private variable 'now', to ensure that the now - offset always returns 10 milliseconds  
//everytime the function is being called.
//The function returns the value of timePassed.
function changeInTime() {
	let now = Date.now();
	let timePassed = now - offset;
	offset = now;
	return timePassed;
}

//timeFormatter()
//the function takes the parameter "timeInMilliSec", which is the value of the time variable. 
//pass the parameter inside the new Date object, and pass the respective methods to obtain the 
//values in minutes, seconds, and milliseconds. 
//toString() value is passed to the minutes, seconds, and milliseconds, so that you can view the
//length property of the string of 'time'.
//if the length of minutes is less than 2 (ie if its smaller than 2 digits), the function adds a '0' in front of minutes.
//Add the same logic to seconds and milliseconds.
//the function returns the concatnated value of minutes, seconds and milliseconds.

function timeFormatter(timeInMilliSec) {
	let time = new Date(timeInMilliSec);
	let minutes = time.getMinutes().toString();
	let seconds = time.getSeconds().toString();
	let milliseconds = time.getMilliseconds().toString();

	if(minutes.length <2){
		minutes = '0' + minutes;
	}

	if(seconds.length < 2){
		seconds = '0' + seconds;
	}

	while(milliseconds.length < 3){
		milliseconds = '0' + milliseconds;
	}

	return minutes + ' : ' + seconds + ' : ' + milliseconds;
};


//Logic for using the timer in the DOM//
const timer = document.getElementById('timer');
const toggleTimer = document.getElementById('toggle');
const resetTimer = document.getElementById('reset');

function toggleWatchStart() {
	if(!isOn){
		toggleTimer.innerHTML = 'Stop';
		start();
	} else if (isOn){
		toggleTimer.innerHTML = 'Start';
		stop();
	}
}


function printToDOM(){
	timer.innerHTML = update();
}


toggleTimer.onclick = toggleWatchStart;
resetTimer.onclick = reset;

//Detects spacebar key press to trigger start() or stop() function.
document.body.onkeydown = function(e){
	// e.preventDefault();
	if(e.keyCode === 32 && !isOn ){
		toggleTimer.innerHTML = 'Stop';
		start();
	} else if (e.keyCode === 32 && isOn){
		toggleTimer.innerHTML = 'Start';
		stop();
	} else if (e.keyCode === 16){
		toggleTimer.innerHTML = 'Start';
		stop();
		reset();
	}
}

}