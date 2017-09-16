<?php 
	require_once('config/config.php');

	if (isset($_GET['q'])) {
		$emp_name = $_GET['q'];
		$sql = "SELECT emp_email FROM module_workorder_employee WHERE emp_name LIKE '$emp_name%'";		
		$result = mysqli_query($conn, $sql);
		$results = mysqli_fetch_array($result);
		print($results['emp_email']);
	}

?>