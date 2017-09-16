 <?php

	if(empty($_SESSION)) // if the session not yet started

	@session_start();

 	require_once('config/config.php');

		

	if (isset($_GET['proj_id'])) {

		$project_id = $_GET['proj_id'];

	 	$sql = "SELECT * FROM module_workorder_maintenance_projects WHERE id = $project_id";

		$rows = mysqli_fetch_array(mysqli_query($conn, $sql));

		//print_r($rows);

		$user_id = $rows['user_id'];

		$order_title = $rows['order_title'];

		$order_no = $rows['order_no'];

		$location = $rows['location'];

		$assign_by_user_id = $rows['assign_by_user_id'];



		$userEmail = mysqli_fetch_array(mysqli_query($conn, "SELECT email_address FROM user_emails WHERE user_id = $user_id"));

		$user_email = $userEmail['email_address'];



		$assignByUserEmail = mysqli_fetch_array(mysqli_query($conn, "SELECT DISTINCT email_address FROM user_emails WHERE user_id = $assign_by_user_id"));

		$assign_by_user_email = $assignByUserEmail['email_address'];

	}

?>

<?php require_once('includes/header.php'); ?>

	<fieldset>

		<legend>Maintenance Project <?php if(isset($_GET['typ']) && $_GET['typ'] == 'rprt'){ echo 'Report'; }else{ echo 'Invoice'; } ?> Print</legend>

		<form class="form" name="maintenance_progress_notes" method="POST" action="" enctype="multipart/form-data">

			<input type="hidden" name="order_title" value="<?php echo $order_title; ?>">

			<input type="hidden" name="order_no" value="<?php echo $order_no; ?>">

			<input type="hidden" name="location" value="<?php echo $location; ?>">

			<div class="row">

				<div class="col-xs-12">

						<div class="form-group">

							<label for="orderhash">Project Report Details : </label><br>

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Order Date</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['order_date']; ?>

								</div>

							</div>

							<div class="col-xs-12">						

								<div class="col-xs-3">

									<label for="orderhash">Order Title</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['order_title']; ?>

								</div>

							</div>

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Order No. #</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['order_no']; ?>

								</div>

							</div>

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Assign By</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['assign_by']; ?>

								</div>

							</div>

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Location</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['location']; ?>

								</div>

							</div>

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Bill To</label>

								</div>

								<div class="col-xs-9">

									: <?php 	

											if ($rows['bill_to'] == 'Association') {											

												echo $rows['bill_to'].' - '.$rows['association_name']; 

											}elseif ($rows['bill_to'] == 'Owner') {										

												echo $rows['bill_to'].' - '.$rows['owner_name'];

											}elseif ($rows['bill_to'] == 'Other') {										

												echo $rows['bill_to'].' - '.$rows['other_details'];

											}

										?>

								</div>

							</div>

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Description</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['project_description']; ?>

								</div>

							</div>

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Start Date</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['start_date']; ?>

								</div>

							</div>

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Billing Type</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['billing_type']; ?>

								</div>

							</div>

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Completion Date</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['completion_date']; ?>

								</div>

							</div>
							<?php if(isset($_GET['typ']) && $_GET['typ'] == 'rprt') { ?>
							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Progress Notes</label>

								</div>

								<div class="col-xs-9">

									: 	<?php

											$progress_notes = mysqli_query($conn, "SELECT * FROM module_workorder_projects_progress_notes WHERE project_id = $project_id ORDER BY id DESC"); 

											while ($progressNotes = mysqli_fetch_array($progress_notes)) { ?>

											<?php echo $progressNotes['created'].' : '.$progressNotes['user_name'].' : '.$progressNotes['progress_note'].'<br>';  ?>

										<?php	} ?><br>

								</div>

							</div>
							<?php } ?>
							<div class="col-xs-12">
									<label for="orderhash">Billing Details</label>								
									<?php 
										$emp_name = explode(',', $rows['emp_name']);
										$emp_date = explode(',', $rows['emp_date']);
										$emp_start = explode(',', $rows['emp_start']);
										$emp_end = explode(',', $rows['emp_end']);
										$emp_not_billed = explode(',', $rows['emp_not_billed']);
										$emp_hours = explode(',', $rows['emp_hours']);
										$emp_rate = explode(',', $rows['emp_rate']);
										$result = count($emp_name); 
											if (!empty($emp_name[0])) {
										?>
									 	: <p>Employees</p>
										<table cellpadding="10px" border="1" width="100%">
											<tr>
												<th>Name</th>
												<th>Date</th>
												<th>Start</th>
												<th>End</th>
												<th>Not Billed</th>
												<th>Hours</th>
												<th>Rate</th>
											</tr>
											<?php 												
												for ($i=0; $i < $result; $i++) {
											?>
											<tr>
												<td><?php echo $emp_name[$i]; ?></td>
												<td><?php echo date('d-m-Y', strtotime($emp_date[$i])); ?></td>
												<td><?php echo $emp_start[$i]; ?></td>
												<td><?php echo $emp_end[$i]; ?></td>
												<td><?php echo $emp_not_billed[$i]; ?></td>
												<td><?php echo $emp_hours[$i]; ?></td>
												<td><?php echo $emp_rate[$i]; ?></td>
											</tr>
										</table>
									<?php } }else{ echo "Not Applicable"; } ?>
									<br>
									<p>Contractors</p>
									<?php 
										$cont_name = explode(',', $rows['cont_name']);
										$cont_date = explode(',', $rows['cont_date']);
										$cont_start = explode(',', $rows['cont_start']);
										$cont_end = explode(',', $rows['cont_end']);
										$cont_not_billed = explode(',', $rows['cont_not_billed']);
										$cont_hours = explode(',', $rows['cont_hours']);
										$cont_rate = explode(',', $rows['cont_rate']);
										$result = count($cont_name);
											if (!empty($cont_name[0])) {
									?>
										<table cellpadding="10px" border="1" width="100%">
											<tr>
												<th>Name</th>
												<th>Date</th>
												<th>Start</th>
												<th>End</th>
												<th>Not Billed</th>
												<th>Hours</th>
												<th>Rate</th>
											</tr>
											<?php 	
												for ($i=0; $i < $result; $i++) { 
											?>
											<tr>
												<td><?php echo $cont_name[$i]; ?></td>
												<td><?php echo $cont_date[$i]; ?></td>
												<td><?php echo $cont_start[$i]; ?></td>
												<td><?php echo $cont_end[$i]; ?></td>
												<td><?php echo $cont_not_billed[$i]; ?></td>
												<td><?php echo $cont_hours[$i]; ?></td>
												<td><?php echo $cont_rate[$i]; ?></td>
											</tr>
										</table>
									<?php } }else{ echo "Not Applicable"; } ?>
									<br><br>
							</div>

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Total Hours</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['total_hours']; ?>

								</div>

							</div>	

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Total Cost</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['total_hours_cost_total']; ?> ( Hours * Rates)

								</div>

							</div>	

							<div class="col-xs-12">

								<div class="col-xs-3">

									<label for="orderhash">Bid Total</label>

								</div>

								<div class="col-xs-9">

									: <?php echo $rows['bid_total']; ?><br><br>

								</div>

							</div>

							<div class="col-xs-12">
									<label for="orderhash">Material Details</label>
									 	:
									 	<?php 
												$mat_vendors = explode(',', $rows['mat_vendors']);
												$mat_desc = explode(',', $rows['mat_desc']);
												$mat_cost = explode(',', $rows['mat_cost']);
												$result = count($mat_vendors);
												if (!empty($mat_vendors[0])) {

										 ?>
										<table cellpadding="10px" border="1" width="100%">
											<tr>
												<th>Vendor</th>
												<th>Description</th>
												<th>Cost</th>
											</tr>
											<?php 
													for ($i=0; $i < $result; $i++) { 
											?>
											<tr>
												<td><?php echo $mat_vendors[$i]; ?></td>
												<td><?php echo $mat_desc[$i]; ?></td>
												<td><?php echo $mat_cost[$i]; ?></td>
											</tr>
										</table>
										<?php } }else{ echo "Not Applicable"; } ?>
									<br><br>
							</div>	
							<div class="col-xs-12">
									<label for="orderhash">Change Orders</label>
									 	:
									 	<?php 
												$change_order_desc = explode(',', $rows['change_order_desc']);
												$change_order_cost = explode(',', $rows['change_order_cost']);
												$result = count($change_order_desc);
												if (!empty($change_order_desc[0])) {

										 ?>
										<table cellpadding="10px" border="1" width="100%">
											<tr>
												<th>Description</th>
												<th>Cost</th>
											</tr>
											<?php 
													for ($i=0; $i < $result; $i++) { 
											?>
											<tr>
												<td><?php echo $change_order_desc[$i]; ?></td>
												<td><?php echo $change_order_cost[$i]; ?></td>
											</tr>
										</table>
										<?php } }else{ echo "Not Applicable"; } ?>
									<br><br>
							</div>

						</div>

						<div class="form-group">

							<input type="button" name="print"  id="print-button" value="Print Report" class="btn btn-primary">

						</div>

				</div>

			</div>

		</form>

	</fieldset>