<?php

 require_once('config/config.php'); 

$searchTerm = $_GET['term'];

$select =mysqli_query($conn, "SELECT owner_phone FROM module_workorder_property_owner_projects WHERE owner_phone LIKE '%".$searchTerm."%'");
while ($row=mysqli_fetch_array($select)) 
{
 $data[] = $row['owner_phone'];
}
//return json data
echo json_encode($data);
?>