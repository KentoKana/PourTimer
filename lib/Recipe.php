<?php
class Recipe {
	protected $recipe_name;
	protected $water_temp;
	protected $bean_amt;
	protected $grind_setting;
	protected $total_water_amt;
	protected $pour_points_time;
	protected $pour_points_water_amt;
	protected $notes;


	public function __construct($recipe_name, $water_temp, $bean_amt, $grind_setting, $total_water_amt, $pour_points_time, $pour_points_water_amt)
	{
		$this->recipe_name = $recipe_name;
		$this->water_temp = $water_temp;
		$this->bean_amt = $bean_amt;
		$this->grind_setting = $grind_setting;
		$this->total_water_amt = $total_water_amt;
		$this->pour_points_time = $pour_points_time;
		$this->pour_points_water_amt = $pour_points_water_amt;
	} 

	public function getRecipeName() 
	{
		return filter_var($this->recipe_name, FILTER_SANITIZE_SPECIAL_CHARS);
	}
	public function setRecipeName($recipe_name)
	{
		$this->recipe_name = $recipe_name;
	}

	public function getWaterTemp()
	{
		return filter_var($this->water_temp, FILTER_SANITIZE_SPECIAL_CHARS);
	}
	public function setWaterTemp($water_temp)
	{
		$this->water_temp = $water_temp;
	}

	public function getBeanAmt()
	{
		return filter_var($this->bean_amt, FILTER_SANITIZE_SPECIAL_CHARS);
	}
	public function setBeanAmt($bean_amt)
	{
		$this->bean_amt = $bean_amt;
	}

	public function getGrindSetting()
	{
		return filter_var($this->grind_setting, FILTER_SANITIZE_SPECIAL_CHARS);
	}
	public function setGrindSetting($grind_setting)
	{
		$this->grind_setting = $grind_setting;
	}

	public function getTotalWaterAmt()
	{
		return filter_var($this->total_water_amt, FILTER_SANITIZE_SPECIAL_CHARS);
	}
	public function setTotalWaterAmt($total_water_amt)
	{
		$this->total_water_amt = $total_water_amt;
	}

	public function getPourPointsTime()
	{
		return filter_var(implode(', ', $this->pour_points_time), FILTER_SANITIZE_SPECIAL_CHARS);
	}
	public function setPourPointsTime($pour_points_time)
	{
		$this->pour_points_time = $pour_points_time;
	}

	public function getPourPointsWaterAmt()
	{
		//Concatinate all item in pour points time/pour points water amt to one string, then sanitize input;
		return filter_var(implode(', ', $this->pour_points_water_amt), FILTER_SANITIZE_SPECIAL_CHARS);
	}
	public function setPourPointsWaterAmt($pour_points_water_amt)
	{
		$this->pour_points_water_amt = $pour_points_water_amt;
	}

	public function getNotes()
	{
		if($this->notes === null ||$this->notes === "")
		{
			return "No notes specified.";
		}
		else 
		{
			return filter_var($this->notes, FILTER_SANITIZE_SPECIAL_CHARS);
		}
	}
	public function setNotes($notes)
	{
		$this->notes = $notes;
	}

	public function validateEmptyInput($input)
	{

	}
}

?>