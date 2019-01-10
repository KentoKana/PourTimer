<?php
include('database.php');
$sql = "select * from recipe";
$conn->query($sql);

// "<table>" .
// "<tr>" .
// "<th>Recipe Name</th>" .
// "</tr>"

if($conn_status = true){
	foreach ($conn->query($sql) as $row) {
		print "<td><a href='recipe-view.php?recipeId=$row[recipe_id]'>" . $row[recipe_name] . "</a></td>";
		// print "<td>" . $row[water_temp] . "</td>";
		// print "<br>" . $row[bean_amt] . "<br>";
		// print "<br>" . $row[grind_setting] . "<br>";
		// print "<br>" . $row[total_water_amt] . "<br>";
		// print "<br>" . $row[pour_points_water_amt] . "<br>";
		// print "<br>" . $row[pour_points_time] . "<br>";
		// print "<br>" . $row[notes] . "<br>";
	}

}





?>
