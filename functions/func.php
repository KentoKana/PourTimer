<?php 

function dropDownMenu($array){
	foreach($array as $option){
		$items .= "<option value='$option'> $option </option>";
	}
	return $items;
}

function displayNav($array){
	$navLink = "";
	foreach($array as $label=>$link)
	{
		$navLink .= "<li><a href='$link'> $label</a></li>";
	}
	return $navLink;
}
?>