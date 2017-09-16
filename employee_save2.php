<?php 

	if(empty($_SESSION)) // if the session not yet started

	session_start();

	require_once('config/config.php');



	if (isset($_GET)) {

		$emp_name = $_GET['emp_name'];

		$emp_rate = number_format($_GET['emp_rate'], 2);

		$emp_email = $_GET['emp_email'];

		$created = date('Y-m-d h:m:s');



		$_SESSION['assgnd_emp_nm'] = $emp_name;

		$_SESSION['assgnd_emp_email'] = $emp_email;

		$_SESSION['assgnd_emp_rt'] = $emp_rate;

		

		echo '<div class="col-sm-2"><div class="form-group"><label for="emp_name">Employee Name</label><input id="emp_name2" type="text"  name="emp_name[]" readonly value="'.$emp_name.'" class="form-control" /></div></div><div class="col-sm-2"><div class="form-group"><label for="empdatepicker">Date</label><input id="billingdatepicker" type="date"  name="emp_date[]" value="'.date('d-m-Y').'" class="form-control form-control__small datepicker hasDatepicker" /></div></div><div class="col-sm-1"><div class="form-group"><label for="hremp1start">Start</label><input type="time" id="hremp1start" name="emp_start[]" value="00:00:00" placeholder="hrs:mins" pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" class="form-control inputs duration t1 time hrs"></div></div><div class="col-sm-1"><div class="form-group"><label for="hremp1end">End</label><input type="time" id="hremp1end" name="emp_end[]" value="23:59:59" placeholder="hrs:mins" pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" class="form-control inputs duration t1 time hrs"></div></div><div class="col-sm-2"><div class="form-group"><label for="hremp1notbilled">Not Billed</label><input id="hremp1notbilled" type="text"  name="emp_not_billed[]" value="0" class="form-control"/></div></div><div class="col-sm-1"><div class="form-group"><label for="hremp1hours">Hours</label><input id="hremp1hours" type="text"  name="emp_hours[]" value="0" class="form-control" onblur="CalTotalHours(this)"/></div></div><div class="col-sm-1"><div class="form-group"><label for="hremp1hours">Rates $$</label><input id="hremp1hours" type="text"  name="emp_rate[]" readonly value="'.$emp_rate.'" class="form-control" onblur="CalTotalHoursCost(this)"/></div></div>';

	}



?>