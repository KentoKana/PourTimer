<?php 
class ValidateField {
	public $isEmpty = true;
	public $formValid = false;
	protected $errEmptyField = "*This field is required.";
	protected $errIntField = "*Please enter a valid number.";

	public function validateEmptyInput($input)
	{
		if(isset($_POST) && $input === "")
		{
			echo $this->errEmptyField;	
			$this->isEmpty = true;
		} 
		else 
		{
			return $this->isEmpty = false;
		}
	} 

	public function validateIntInput($input)
	{
		if(isset($_POST) && !$this->isEmpty && $input !== null && !filter_var($input, FILTER_VALIDATE_INT))
		{
			echo $this->errIntField;
		} 
		else 
		{
			return $this->formValid = true;
		} 
	} 

	public function displayPostedValue($input)
	{
		//If $this->formValid returns false at any given field, this function will return the user's input.
		if(isset($_POST) && !$this->formEmpty && !$this->formValid){
			echo "'$input'";
		}

	}


}
?>