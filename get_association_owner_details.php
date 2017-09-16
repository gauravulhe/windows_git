<?php 
	require_once('config/config.php');

	if (isset($_GET['q'])) {
		$subdivisions = explode('-', $_GET['q']);
		//print_r($subdivision_id);
		$property_id = $subdivisions[2];
		$subdivision_id = $subdivisions[1];
		$sql1 = "SELECT subdivision_id,title FROM subdivisions WHERE subdivision_id = '$subdivision_id'";		
		$result1 = mysqli_query($conn, $sql1);
		$results1 = mysqli_fetch_array($result1);

		$sql2 = "SELECT res.resident_id,res.user_id,res.is_primary_contact,
				user.user_id,user.name_first,user.name_last
				FROM residents AS res
				INNER JOIN users as user
				ON
				res.user_id = user.user_id
				WHERE property_id = $property_id AND is_primary_contact = 1";		
		$result2 = mysqli_query($conn, $sql2);
		$results2 = mysqli_fetch_array($result2);
		$full_name = $results2['name_first'].' '.$results2['name_last'];
		print_r(
			json_encode(
				array(
					'subdivision_id' => $results1['subdivision_id'],
					'title' => $results1['title'],
					'resident_id' => $results2['resident_id'],
					'res_user_id' => $results2['user_id'],
					'is_primary_contact' => $results2['is_primary_contact'],
					'property_id' => $property_id,
					'user_id' => $results2['user_id'],
					'name_first' => $results2['name_first'],
					'name_last' => $results2['name_last'],
					'full_name' => $full_name
				)
			)	
		);
	}

?>