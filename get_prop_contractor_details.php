<?php 
	require_once('config/config.php');

	if (isset($_GET['q'])) {
		$contractor_name = $_GET['q'];
		$sql = "SELECT contractor_phone,contractor_cell FROM module_workorder_property_owner_projects WHERE contractor_name = '$contractor_name'";		
		$result = mysqli_query($conn, $sql);
		$results = mysqli_fetch_array($result);
		// print($results['contractor_phone']);
		// print($results['contractor_cell']);
		print(json_encode(
			array(
				'contractor_phone' => $results['contractor_phone'],
				'contractor_cell' => $results['contractor_cell']
			)
		));
	}

?>