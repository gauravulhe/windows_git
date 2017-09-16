<?php 
	require_once('config/config.php');

	if (isset($_GET['q'])) {
		$cont_name = $_GET['q'];
		$sql = "SELECT cont_email,cont_rate FROM module_workorder_contractors WHERE cont_name LIKE '$cont_name%'";		
		$result = mysqli_query($conn, $sql);
		$results = mysqli_fetch_array($result);
		// print($results['cont_email']);
		print(json_encode(
			array(
				'cont_email' => $results['cont_email'],
				'cont_rate' => $results['cont_rate']
			)
		));
	}

?>