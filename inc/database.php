<?php
$servername = "localhost";
$username = "root";
$password = "root";

try {
	$conn = new PDO("mysql:host=$servername;dbname=pour_over_db", $username, $password);
    // set the PDO error mode to exception
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$conn_status = true;
}
catch(PDOException $e)
{
	echo "Connection failed: " . $e->getMessage();
}
?>