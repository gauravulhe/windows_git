<?php

 require_once('config/config.php');

$searchTerm = $_GET['term'];

//$select =mysqli_query($conn, "SELECT owner_name FROM module_workorder_property_owner_projects WHERE owner_name LIKE '%".$searchTerm."%'");
$select = mysqli_query($conn, "SELECT user_id,name_first,name_last FROM users WHERE name_first LIKE '".$searchTerm."%' LIMIT 0,10");
while ($row=mysqli_fetch_array($select))
{
 $data[] = $row['name_first'].' '.$row['name_last'];
}
//return json data
echo json_encode($data);
?>
