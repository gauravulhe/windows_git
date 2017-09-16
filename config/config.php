<?php
	$servername = "localhost";
	
	$username = "root";
	$password = "";
	$dbname = "constructions";

	// $username = "iperfe54_gauravu";
	// $password = "gr@2025%1990";
	// $dbname = "iperfe54_constructions";

	// Create connection using mysql
	// mysql_connect($servername,$username,$password) or die(mysql_error());
	// mysql_select_db($dbname);

	// Create connection using mysqli
	$conn = mysqli_connect($servername,$username,$password,$dbname) or die("Some error occurred during connection " . mysqli_error($con));  


?>
