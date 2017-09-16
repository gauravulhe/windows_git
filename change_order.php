<?php 
	if(empty($_SESSION)) // if the session not yet started
	session_start();
	require_once('config/config.php');

	if (isset($_GET)) {
		$_SESSION['change_order_desc'] = isset($_GET['deschangeorder'])?$_GET['deschangeorder']:'';
		$_SESSION['change_order_cost'] = isset($_GET['changeordercost'])?$_GET['changeordercost']:'';

		if ($_SESSION['change_order_desc'] != '') {

		echo 	'<div class="col-sm-7">
					<div class="form-group">
						<input id="deschangeorder" type="text" readonly name="change_order_desc[]" class="form-control" value="'.$_SESSION['change_order_desc'].'"/>
					</div>
				</div>
				<div class="col-sm-3">
					<div class="form-group">
						<input id="changeordercost" type="text" readonly name="change_order_cost[]" class="form-control" value="'.$_SESSION['change_order_cost'].'"/>
					</div>
				</div>';
		}
	}

?>