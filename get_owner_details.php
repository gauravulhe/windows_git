<?php 
	require_once('config/config.php');

	if (isset($_GET['q'])) {
		$owner_name = $_GET['q'];
		$sql = "SELECT owner_phone,owner_cell FROM module_workorder_property_owner_projects WHERE owner_name = '$owner_name'";		
		$result = mysqli_query($conn, $sql);
		$results = mysqli_fetch_array($result);
		// print($results['owner_phone']);
		// print($results['owner_cell']);
		print(json_encode(
			array(
				'owner_phone' => $results['owner_phone'],
				'owner_cell' => $results['owner_cell']
			)
		));
	}

?>