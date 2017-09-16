<?php 
	require_once('config/config.php');

	if (isset($_GET['q'])) {
		$emp_name = $_GET['q'];
		$sql = "SELECT emp_email,emp_rate FROM module_workorder_employee WHERE emp_name LIKE '$emp_name%'";		
		$result = mysqli_query($conn, $sql);
		$results = mysqli_fetch_array($result);
		// print($results['emp_email']);
		// print($results['emp_rate']);
		print(json_encode(
			array(
				'emp_email' => $results['emp_email'],
				'emp_rate' => $results['emp_rate']
			)
		));
	}

?>