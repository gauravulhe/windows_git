<?php 

	if(empty($_SESSION)) // if the session not yet started

	session_start();

	require_once('config/config.php');



	if (isset($_GET)) {

		$cont_name = $_GET['cont_name'];

		$cont_rate = number_format($_GET['cont_rate'], 2);

		$cont_email = $_GET['cont_email'];

		$created = date('Y-m-d h:m:s');



		$_SESSION['assgnd_cont_nm'] = $cont_name;

		$_SESSION['assgnd_cont_email'] = $cont_email;

		$_SESSION['assgnd_cont_rt'] = $cont_rate;



		echo '<div class="col-sm-2"><div class="form-group"><label for="cont_name">Contractor Name</label><input id="cont_name2" type="text"  name="cont_name[]"  readonly value="'.$cont_name.'" class="form-control" /></div></div><div class="col-sm-2"><div class="form-group"><label for="contdatepicker">Date</label><input id="" type="date"  name="cont_date[]" value="'.date('d-m-Y').'" class="form-control" /></div></div><div class="col-sm-1"><div class="form-group"><label for="hrcontstart">Start</label><input type="time" id="hrcontstart" name="cont_start[]" value="00:00:00" placeholder="hrs:mins" pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" class="form-control inputs duration t1 time hrs"></div></div><div class="col-sm-1"><div class="form-group"><label for="hrcontend">End</label><input type="time" id="hremp1end" name="cont_end[]" value="23:59:59" placeholder="hrs:mins" pattern="^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$" class="form-control inputs duration t1 time hrs"></div></div><div class="col-sm-2"><div class="form-group"><label for="hrnotbilled">Not Billed</label><input id="hrnotbilled" type="text"  name="cont_not_billed[]" value="0" class="form-control"/></div></div><div class="col-sm-1"><div class="form-group"><label for="conthours">Hours</label><input id="conthours" type="text"  name="cont_hours[]" value="0" class="form-control"  onblur="CalTotalHours(this)"/></div></div><div class="col-sm-1"><div class="form-group"><label for="hremp1hours">Rates $$</label><input id="hremp1hours" type="text"  name="cont_rate[]" readonly value="'.$cont_rate.'" class="form-control" onblur="CalTotalHoursCost(this)"/></div></div>';

	}



?>