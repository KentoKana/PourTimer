<?php 
class Validator {

	public static function validateEmptyInput($input)
	{
		if(isset($_POST) && $input === "")
		{
			echo "*This field is required.";
			return false;
		} 
	} 

	public static function validateIntInput($input)
	{
		if(isset($_POST) && $input === "")
		{
			echo "*This field is required.";
			return false;
		} 
		else 
		{
			if(isset($_POST) && $input !== null && !filter_var($input, FILTER_VALIDATE_INT))
			{
				echo "*Please enter a valid number.";
				return false;
			}
		}
	} 

	public static function dispPostVal($input)
	{
		if(isset($input))
		{
			echo "value='" . $input . "'";
		}
	}

}
?>