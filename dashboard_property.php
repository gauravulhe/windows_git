<?php 
	if(empty($_SESSION)) // if the session not yet started
	session_start();
 	require_once('config/config.php');
 // 	if(!isset($_SESSION['uid'])) { //if not yet logged in
	//    header("Location: logout.php");// send to login page
	//    exit;
	// }
	$sql = "SELECT * FROM module_workorder_property_owner_projects ORDER BY id DESC";
	$result = mysqli_query($conn, $sql);	
?>
<?php require_once('includes/header.php');	?>
			<fieldset>
				<legend>Project Tracking Board</legend>
				<div class="row">
					<div class="col-sm-3">
						<a href="property.php" class="btn btn-primary">Add Property Project</a>
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
							<h4>Property Owner Projects</h4>
						</div>
					</div>	
				</div>
				<div class="table-responsive">
					<table id="our_table" class="table table-bordered">
						<tr>
							<th>Project</th>
							<th>In Progress</th>
							<th>Final Inspection</th>
							<th>Completed</th>
						</tr>
						<?php 
						if (mysqli_num_rows($result) > 0) {
						    // output data of each row
						?>						
						<tr>
							<td>								
								<div class="main-event">
									<?php									
										$sql1 = "SELECT * FROM module_workorder_property_owner_projects WHERE project_status = 'project' ORDER BY id DESC";
										$result1 = mysqli_query($conn, $sql1);
									    // output data of each row
									    while($row1 = mysqli_fetch_array($result1)) {  ?>
										<div class="event" id="<?php echo $row1['id']; ?>">
											<ul class="event-ul">
												<li>
													<span>Approval Date:</span>
													<span><?php echo $row1['approval_date'];  ?></span>
												</li>
												<li>
													<span class="desc-label">Description:</span>
													<span class="desc-content">
														<?php echo $row1['project_description']; ?>
													</span>
												</li>
												<li>
													<span>Owner Name:</span>
													<span><?php echo $row1['owner_name']; ?></span>
												</li>
												<li>
													<span>Location:</span><span><?php echo $row1['location']; ?></span>
												</li>
												<li>		
													<a href="property.php?id=<?php echo $row1['id']; ?>">View & Edit</a> | 
													<a href="change_status.php?pid=<?php echo $row1['id']; ?>&status=in_progress&dbtbl=pp" onclick="return confirm('Do you want to change status');">Change Status</a>
												</li>
											</ul>
										</div>
									<?php } ?>
								</div>
							</td>
							<td>								
								<div class="main-event">
										<?php										
											$sql2 = "SELECT * FROM module_workorder_property_owner_projects WHERE project_status = 'in_progress' ORDER BY id DESC";
											$result2 = mysqli_query($conn, $sql2);
										    // output data of each row
										    while($row2 = mysqli_fetch_array($result2)) {  ?>
										<div class="event" id="<?php echo $row2['id']; ?>">
											<ul class="event-ul">
												<li>
													<span>Approval Date:</span>
														<span><?php echo $row2['approval_date']; ?></span>
												</li>
												<li>
													<span>Location:</span><span><?php echo $row2['location']; ?></span>
												</li>
												<li>
													<span class="desc-label">Description:</span>
													<span class="desc-content">
														<?php echo $row2['project_description']; ?>
													</span>
												</li>
												<li>
													<span>Owner Name:</span>
													<span><?php echo $row2['owner_name']; ?></span>
												</li>
												<li>		
													<a href="property.php?id=<?php echo $row2['id']; ?>">View & Edit</a> | 
													<a href="change_status.php?pid=<?php echo $row2['id']; ?>&status=final_inspection&dbtbl=pp" onclick="return confirm('Do you want to change status');">Change Status</a>
												</li>
											</ul>
										</div>
									<?php } ?>
								</div>
							</td>							
							<td>								
							<div class="main-event">
									<?php
										$sql3 = "SELECT * FROM module_workorder_property_owner_projects WHERE project_status = 'final_inspection' ORDER BY id DESC";
										$result3 = mysqli_query($conn, $sql3);
									    // output data of each row
									    while($row3 = mysqli_fetch_array($result3)) {  ?>
										<div class="event" id="<?php echo $row3['id']; ?>">
											<ul class="event-ul">
												<li>
													<span>Approval Date:</span>
													<span><?php echo $row3['approval_date']; ?></span>
												</li>
												<li>
													<span>Location:</span><span><?php echo $row3['location']; ?></span>
												</li>
												<li>
													<span class="desc-label">Description:</span>
													<span class="desc-content">
														<?php echo $row3['project_description']; ?>
													</span>
												</li>
												<li>
													<span>Owner Name:</span>
													<span><?php echo $row3['owner_name']; ?></span>
												</li>
												<li>		
													<a href="property.php?id=<?php echo $row3['id']; ?>">View & Edit</a> | 
													<a href="change_status.php?pid=<?php echo $row3['id']; ?>&status=completed&dbtbl=pp" onclick="return confirm('Do you want to change status');">Change Status</a>
												</li>
											</ul>
										</div>
									<?php } ?>
								</div>
							</td>
														
							<td>								
								<div class="main-event">
									<?php
										$sql4 = "SELECT * FROM module_workorder_property_owner_projects WHERE project_status = 'completed' ORDER BY id DESC";
										$result4 = mysqli_query($conn, $sql4);
									    // output data of each row
									    while($row4 = mysqli_fetch_array($result4)) {  ?>
										<div class="event" id="<?php echo $row4['id']; ?>">
											<ul class="event-ul">
												<li style="float:right; padding-bottom: 5px;">
													<img src="images/print.png" width="20px">
													<img src="images/save.png" width="20px">
													<img src="images/email.png" width="20px">
												</li>
												<li>
													<span>Approval Date:</span>
													<span><?php echo $row4['approval_date']; ?></span>
												</li>
												<li>
													<span>Location:</span><span><?php echo $row4['location']; ?></span>
												</li>
												<li>
													<span class="desc-label">Description:</span>
													<span class="desc-content">
														<?php echo $row4['project_description']; ?>
													</span>
												</li>
												<li>
													<span>Owner Name:</span>
													<span><?php echo $row4['owner_name']; ?></span>
												</li>
												<li style="float:right; padding-bottom: 5px;">
													<img src="images/delete.jpg" width="20px">
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