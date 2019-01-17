<?php 
class Validator {
	// public $isEmpty = true;
	// public $formValid = false;

	public static function validateEmptyInput($input)
	{
		if(isset($_POST) && $input === "")
		{
			echo "*This field is required.";
			return false;
		} 
		else 
		{
			return true;
		}

	} 

	public static function validateIntInput($input)
	{
		if(isset($_POST) && $input === "")
		{
			echo "*This field is required.";
			return true;
		} 
		else 
		{
			if(isset($_POST) && $input !== null && !filter_var($input, FILTER_VALIDATE_INT))
			{
				echo "*Please enter a valid number.";
				return false;
			}
			else 
			{
				return true;
			} 
		}
	} 

	public function displayPostedValue($input)
	{
		//If $this->formValid returns false at any given field, this function will return the user's input.
		if(isset($_POST) && !$this->formValid)
		{
			echo "'$input'";
		} 
		else 
		{
			echo "";
		}
	}
}
?>