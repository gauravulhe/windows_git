<?php 
	if(empty($_SESSION)) // if the session not yet started
	session_start();
	require_once('config/config.php');

	if (isset($_GET)) {
		$_SESSION['bill']['bill_emp_name'] = isset($_GET['emp_name'])?$_GET['emp_name']:'';
		$_SESSION['bill']['bill_emp_date'] = isset($_GET['emp_date'])?$_GET['emp_date']:'';
		$_SESSION['bill']['bill_emp_start'] = isset($_GET['emp_start'])?$_GET['emp_start']:'';
		$_SESSION['bill']['bill_emp_end'] = isset($_GET['emp_end'])?$_GET['emp_end']:'';
		$_SESSION['bill']['bill_emp_not_billed'] = isset($_GET['emp_not_billed'])?$_GET['emp_not_billed']:'';
		$_SESSION['bill']['bill_emp_hours'] = isset($_GET['emp_hours'])?$_GET['emp_hours']:'';
		$_SESSION['bill']['bill_emp_rate'] = isset($_GET['emp_rate'])?$_GET['emp_rate']:'';
		$_SESSION['bill']['bill_cont_name'] = isset($_GET['cont_name'])?$_GET['cont_name']:'';
		$_SESSION['bill']['bill_cont_date'] = isset($_GET['cont_date'])?$_GET['cont_date']:'';
		$_SESSION['bill']['bill_cont_start'] = isset($_GET['cont_start'])?$_GET['cont_start']:'';
		$_SESSION['bill']['bill_cont_end'] = isset($_GET['cont_end'])?$_GET['cont_end']:'';
		$_SESSION['bill']['bill_cont_not_billed'] = isset($_GET['cont_not_billed'])?$_GET['cont_not_billed']:'';
		$_SESSION['bill']['bill_cont_hours'] = isset($_GET['cont_hours'])?$_GET['cont_hours']:'';
		$_SESSION['bill']['bill_cont_rate'] = isset($_GET['cont_rate'])?$_GET['cont_rate']:'';

		$emp_hours = isset($_GET['emp_hours'])?$_GET['emp_hours']:'';
		$emp_rate = isset($_GET['emp_rate'])?$_GET['emp_rate']:'';
		$cont_hours = isset($_GET['cont_hours'])?$_GET['cont_hours']:'';
		$cont_rate = isset($_GET['cont_rate'])?$_GET['cont_rate']:'';

		$CalTotalHours = 0;
		$CalTotalRates = 0;
		if(!empty($emp_hours)){
			foreach ($emp_hours as $key => $value) {
				$CalTotalHours = $CalTotalHours + $value;
			}
		}
		if(!empty($cont_hours)){
			foreach ($cont_hours as $key => $value) {
				$CalTotalHours = $CalTotalHours + $value;
			}
		}
		if(!empty($emp_rate)){
			foreach ($emp_rate as $key => $value) {
				$CalTotalRates = $CalTotalRates + $value;
			}
		}
		if(!empty($cont_rate)){
			foreach ($cont_rate as $key => $value) {
				$CalTotalRates = $CalTotalRates + $value;
			}
		}

		$CalTotalHoursCosts = $CalTotalHours * $CalTotalRates;
		//print_r($CalTotalHoursCosts);
		echo '<input type="hidden" id="total_hours1" name="total_hours1" class="form-control" value="';
				if(isset($rows['total_hours'])){echo $rows['total_hours'];}else{echo $CalTotalHours;}
		echo '" >';
		echo '<input type="hidden" id="rate_total" name="rate_total" class="form-control" value="';
				if(isset($rows['rate_total'])){echo $rows['rate_total'];}else{echo $CalTotalRates;}
		echo '" >';
		echo '<input type="hidden" id="total_hours_cost_total1" name="total_hours_cost_total1" class="form-control" value="';
				if(isset($rows['total_hours_cost_total'])){echo $rows['total_hours_cost_total'];}else{echo $CalTotalHoursCosts;}
		echo '" >';
		echo 	'<div class="row">
					<div class="col-sm-4">
						<div class="form-group">
							<label>Total Hours :</label>
							'.$CalTotalHours.' Hours 
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Total Rates :</label>
							$ '.$CalTotalRates.' ( Rates $$ )
						</div>
					</div>
					<div class="col-sm-4">
						<div class="form-group">
							<label>Total Hourly Costs :</label>
							$ '.$CalTotalHoursCosts.' ( Hours * Rates )
						</div>
					</div>
				</div>';
	}

?>