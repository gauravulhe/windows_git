<?php

 require_once('config/config.php'); 

$searchTerm = $_GET['term'];

$select =mysqli_query($conn, "SELECT location FROM module_workorder_maintenance_projects WHERE location LIKE '%".$searchTerm."%'");
while ($row=mysqli_fetch_array($select)) 
{
 $data[] = $row['location'];
}
//return json data
echo json_encode($data);
?>