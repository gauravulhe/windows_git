<?php 
	require_once('config/config.php');

	// if (isset($_POST)) {
	// 	$project_id = $_POST['project_id'];
	// 	$project_status = $_POST['project_status'];

	// 	echo $sql = "UPDATE module_workorder_maintenance_projects SET project_status = '$project_status' WHERE id = '$project_id'";		
	// 	$results= mysqli_query($conn, $sql);
	// }

	if (isset($_GET['pid'])) {
		$project_id = $_GET['pid'];
		$project_status = $_GET['status'];
		$table_name = $_GET['dbtbl'];
		if ($table_name == 'mp') {
			$sql = "UPDATE module_workorder_maintenance_projects SET project_status = '$project_status' WHERE id = '$project_id'";		
			$results= mysqli_query($conn, $sql);
			if ($results) {
				header('Location:dashboard.php');
			}
		}elseif ($table_name == 'pp') {
			$sql = "UPDATE module_workorder_property_owner_projects SET project_status = '$project_status' WHERE id = '$project_id'";		
			$results= mysqli_query($conn, $sql);
			if ($results) {
				header('Location:dashboard_property.php');
			}
		}		
	}

?>