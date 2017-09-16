<?php
	if(empty($_SESSION)) // if the session not yet started
	session_start();
 	require_once('config/config.php');
 	// echo $_SESSION['uid'];
 	// echo $_SESSION['uname'];
 // 	if(!isset($_SESSION['uid'])) { //if not yet logged in
	//    header("Location: logout.php");// send to login page
	//    exit;
	// }
	$sql = "SELECT * FROM module_workorder_maintenance_projects ORDER BY id DESC";
	$result = mysqli_query($conn, $sql);

?>
<?php require_once('includes/header.php');	?>
			<fieldset>
				<legend>Maintenance Board</legend>
				<div class="row">
					<div class="col-sm-3">
						<a href="maintenance.php" class="btn btn-primary">Add Maintenance Project</a>
					</div>
					<div class="col-sm-3">
						<a href="dashboard.php" class="btn btn-primary">Maintenance Board</a>
					</div>
					<div class="col-sm-3">
						<a href="dashboard_property.php" class="btn btn-primary">Project Tracking Board</a>
					</div>
					<div class="col-sm-3">
						<a href="../index.php" class="btn btn-primary">Back To Site</a>
					</div>
					<!-- <div class="col-sm-3">
						<a href="logout.php" class="btn btn-primary">Logout</a>
					</div> -->
				</div>
				<hr>
				<div class="row">
					<div class="col-sm-12">
						<div class="form-group">
							<h4>Maintenance Projects</h4>
						</div>
					</div>
				</div>
				<div class="table-responsive">
					<table id="our_table" class="table table-bordered">
						<tr>
							<th>Assigned</th>
							<th>In Progress</th>
							<th>Completed</th>
							<th>Invoiced</th>
						</tr>
						<?php
						if (mysqli_num_rows($result) > 0) {
						    // output data of each row
						?>
						<tr>
							<td>
								<div class="main-event">
									<?php
										$sql1 = "SELECT * FROM module_workorder_maintenance_projects WHERE project_status = 'assigned' ORDER BY id DESC";
										$result1 = mysqli_query($conn, $sql1);
									    // output data of each row
									    while($row1 = mysqli_fetch_array($result1)) {  ?>
										<div class="event" id="<?php echo $row1['id']; ?>" draggable="true">
											<input type="hidden" name="project_status" id="project_status" value="in_progress">
											<input type="hidden" name="project_id" id="project_id" value="<?php echo $row1['id']; ?>">
												<ul class="event-ul">
													<li>
														<span>Order Date:</span>
														<span><?php echo $row1['order_date']; ?></span>
													</li>
													<li>
														<span>Order Title:</span>
														<span><?php echo $row1['order_title']; ?></span>
													</li>
													<li>
														<span>Order No:</span>
														<span><?php echo $row1['order_no']; ?></span>
													</li>
													<li>
														<span class="desc-label">Description:</span>
														<span class="desc-content">
															<?php echo $row1['project_description']; ?>
														</span>
													</li>
													<li>
														<span>Assigned By:</span>
														<span><?php echo $row1['assign_by']; ?></span>
													</li>
													<li>
														<span>Location:</span><span><?php echo $row1['location']; ?></span>
													</li>
													<li>
														<a href="maintenance.php?id=<?php echo $row1['id']; ?>">View & Edit</a> |
														<a href="change_status.php?pid=<?php echo $row1['id']; ?>&status=in_progress&dbtbl=mp" onclick="return confirm('Do you want to change status');">Change Status</a>
													</li>
												</ul>
										</div>
									<?php } ?>
								</div>
							</td>
							<td>
								<div class="main-event">
										<?php
										$sql2 = "SELECT * FROM module_workorder_maintenance_projects WHERE project_status = 'in_progress' ORDER BY id DESC";
										$result2 = mysqli_query($conn, $sql2);
									    // output data of each row
									    while($row2 = mysqli_fetch_array($result2)) {  ?>
										<div class="event" id="<?php echo $row2['id']; ?>" draggable="true">
											<input type="hidden" name="project_status" id="project_status" value="completed">
											<input type="hidden" name="project_id" id="project_id" value="<?php echo $row2['id']; ?>">
												<ul class="event-ul">
													<li>
														<span>Order Date:</span>
														<span><?php echo $row2['order_date']; ?></span>
													</li>
													<li>
														<span>Order Title:</span>
														<span><?php echo $row2['order_title']; ?></span>
													</li>
													<li>
														<span>Order No:</span>
														<span><?php echo $row2['order_no']; ?></span>
													</li>
													<li>
														<span class="desc-label">Description:</span>
														<span class="desc-content">
															<?php echo $row2['project_description']; ?>
														</span>
													</li>
													<li>
														<span>Assigned By:</span>
														<span><?php echo $row2['assign_by']; ?></span>
													</li>
													<li>
														<span>Location:</span><span><?php echo $row2['location']; ?></span>
													</li>
													<li>
														<a href="maintenance.php?id=<?php echo $row2['id']; ?>">View & Edit</a> |
														<a href="change_status.php?pid=<?php echo $row2['id']; ?>&status=completed&dbtbl=mp" onclick="return confirm('Do you want to change status');">Change Status</a>
													</li>
												</ul>
										</div>
									<?php } ?>
								</div>
							</td>
							<td>
								<div class="main-event">
										<?php
										$sql3 = "SELECT * FROM module_workorder_maintenance_projects WHERE project_status = 'completed' ORDER BY id DESC";
										$result3 = mysqli_query($conn, $sql3);
									    // output data of each row
									    while($row3 = mysqli_fetch_array($result3)) {  ?>
										<div class="event" id="<?php echo $row3['id']; ?>" draggable="true">
											<input type="hidden" name="project_status" id="project_status" value="invoiced">
											<input type="hidden" name="project_id" id="project_id" value="<?php echo $row3['id']; ?>">
												<ul class="event-ul">
													<li>
														<span>Order Date:</span>
														<span><?php echo $row3['order_date']; ?></span>
													</li>
													<li>
														<span>Order Title:</span>
														<span><?php echo $row3['order_title']; ?></span>
													</li>
													<li>
														<span>Order No:</span>
														<span><?php echo $row3['order_no']; ?></span>
													</li>
													<li>
														<span class="desc-label">Description:</span>
														<span class="desc-content">
															<?php echo $row3['project_description']; ?>
														</span>
													</li>
													<li>
														<span>Assigned By:</span>
														<span><?php echo $row3['assign_by']; ?></span>
													</li>
													<li>
														<span>Location:</span><span><?php echo $row3['location']; ?></span>
													</li>
													<li>
														<a href="maintenance.php?id=<?php echo $row3['id']; ?>">View & Edit</a> |
														<a href="change_status.php?pid=<?php echo $row3['id']; ?>&status=invoiced&dbtbl=mp" onclick="return confirm('Do you want to change status');">Change Status</a>
													</li>
												</ul>
										</div>
									<?php } ?>
								</div>
							</td>

							<td>
								<div class="main-event">
										<?php
										$sql4 = "SELECT * FROM module_workorder_maintenance_projects WHERE project_status = 'invoiced' ORDER BY id DESC";
										$result4 = mysqli_query($conn, $sql4);
									    // output data of each row
									    while($row4 = mysqli_fetch_array($result4)) {  ?>
										<div class="event" id="<?php echo $row4['id']; ?>">
											<input type="hidden" name="project_status" id="project_status" value="">
											<input type="hidden" name="project_id" id="project_id" value="<?php echo $row4['id']; ?>">
												<ul class="event-ul">
													<li>
														<span class="dash-inv-menu">
															<a target="popup" onclick="window.open('', 'popup', 'width=580,height=360,scrollbars=no, toolbar=no,status=no,resizable=yes,menubar=no,location=no,directories=no,top=10,left=10')" href="maintenance_proj_report_print.php?proj_id=<?php echo $row4['id']; ?>&typ=invcd">
																<img src="images/print.png" width="20px">
															</a>
															<img src="images/save.png" width="20px">
															<a target="popup" onclick="window.open('', 'popup', 'width=580,height=360,scrollbars=no, toolbar=no,status=no,resizable=yes,menubar=no,location=no,directories=no,top=10,left=10')" href="maintenance_proj_report.php?proj_id=<?php echo $row4['id']; ?>&typ=invcd">
																<img src="images/email.png" width="20px">
															</a>
														</span>
													</li>
													<li>
														<span>Order Date:</span>
														<span><?php echo $row4['order_date']; ?>
														</span>
													</li>
													<li>
														<span>Order Title:</span>
														<span><?php echo $row4['order_title']; ?></span>
													</li>
													<li>
														<span>Order No:</span>
														<span><?php echo $row4['order_no']; ?></span>
													</li>
													<li>
														<span class="desc-label">Description:</span>
														<span class="desc-content">
															<?php echo $row4['project_description']; ?>
														</span>
													</li>
													<li>
														<span>Assigned By:</span>
														<span><?php echo $row4['assign_by']; ?></span>
													</li>
													<li>
														<span>Location:</span><span><?php echo $row4['location']; ?></span>
													</li>
													<li>
														<span class="dash-inv-menu">
															<img src="images/delete.jpg" width="20px">
														</span>
													</li>
												</ul>
										</div>
									<?php } ?>
								</div>
							</td>
						</tr>
						<?php
						} else { ?>
						<tr>
							<td colspan="4"><span style="color:red;">No Records Found.</span></td>
						</tr>
					<?php	} ?>
					</table>
				</div>
			</fieldset>
<?php require_once('includes/footer.php'); ?>
