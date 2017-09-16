<?php 
	if(empty($_SESSION)) // if the session not yet started
	session_start();
	require_once('config/config.php');

	if (isset($_GET)) {
		$cont_name = $_GET['cont_name'];
		$cont_rate = number_format($_GET['cont_rate'], 2);
		$cont_email = $_GET['cont_email'];
		$created = date('Y-m-d h:m:s');

		$sqlCheck = "SELECT * FROM module_workorder_contractors WHERE cont_email = '$cont_email'";
		$result = mysqli_fetch_row(mysqli_query($conn, $sqlCheck));
		if (empty($result[4])) {

			$sql = mysqli_query($conn, "INSERT INTO module_workorder_contractors (cont_name, cont_rate, cont_email, created) values ('$cont_name', '$cont_rate', '$cont_email', '$created')");
		}
		$_SESSION['assgnd_cont_nm'] = $cont_name;
		$_SESSION['assgnd_cont_email'] = $cont_email;
		$_SESSION['assgnd_cont_rt'] = $cont_rate;

		echo '<div class="col-md-12"><div class="col-sm-3"><div class="form-group"><label for="cont1">Contractor Name:</label><input type="text" class="form-control" name="cont_name[]" readonly value="'.$cont_name.'"></div></div><div class="col-sm-3"><div class="form-group"><label for="dollor2">$</label><input type="text" class="form-control" name="cont_rate[]" readonly value="'.$cont_rate.'"></div></div><div class="col-sm-3"><div class="form-group"><label for="email2">Email</label><input type="text" class="form-control" name="cont_email[]" readonly value="'.$cont_email.'"></div></div></div>';
	}

?>