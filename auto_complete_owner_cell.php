<?php

 require_once('config/config.php'); 

$searchTerm = $_GET['term'];

$select =mysqli_query($conn, "SELECT owner_cell FROM module_workorder_property_owner_projects WHERE owner_cell LIKE '%".$searchTerm."%'");
while ($row=mysqli_fetch_array($select)) 
{
 $data[] = $row['owner_cell'];
}
//return json data
echo json_encode($data);
?>