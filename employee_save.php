<?php 
	if(empty($_SESSION)) // if the session not yet started
	session_start();
	require_once('config/config.php');

	if (isset($_GET)) {
		$emp_name = $_GET['emp_name'];
		$emp_rate = number_format($_GET['emp_rate'], 2);
		$emp_email = $_GET['emp_email'];
		$created = date('Y-m-d h:m:s');

		$sqlCheck = "SELECT * FROM module_workorder_employee WHERE emp_email = '$emp_email'";
		$result = mysqli_fetch_row(mysqli_query($conn, $sqlCheck));
		if (empty($result[4])) {

			$sql = mysqli_query($conn, "INSERT INTO module_workorder_employee (emp_name, emp_rate, emp_email, created) values ('$emp_name', '$emp_rate', '$emp_email', '$created')");
		}

		$_SESSION['assgnd_emp_nm'] = $emp_name;
		$_SESSION['assgnd_emp_email'] = $emp_email;
		$_SESSION['assgnd_emp_rt'] = $emp_rate;

		echo $a = '<div class="col-md-12"><div class="col-sm-3"><div class="form-group"><label for="emp1">Employee Name:</label><input type="text" class="form-control" name="emp_name1[]" readonly value="'.$emp_name.'"></div></div><div class="col-sm-3"><div class="form-group"><label for="dollor1">$</label><input type="text" class="form-control" name="emp_rate1[]" readonly value="'.$emp_rate.'"></div></div><div class="col-sm-3"><div class="form-group"><label for="email1">Email</label><input type="text" class="form-control" name="emp_email1[]" readonly value="'.$emp_email.'"></div></div></div>';
	}

?>