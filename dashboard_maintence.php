<?php 
	if(empty($_SESSION)) // if the session not yet started
	session_start();
 	require_once('config/config.php');
 // 	if(!isset($_SESSION['uid'])) { //if not yet logged in
	//    header("Location: logout.php");// send to login page
	//    exit;
	// }
	$sql = "SELECT * FROM module_workorder_maintenance_projects ORDER BY id DESC";
	$result = mysqli_query($conn, $sql);
	
?>
<?php require_once('includes/header.php');	?>
			<fieldset>
				<legend>Status Board</legend>
				<div class="row">						
					<div class="col-sm-2">
						<div class="form-group">
							<a href="logout.php" class="btn btn-primary">Logout</a>
						</div>
					</div>	
					<div class="col-sm-3">
						<a href="../index.php" class="btn btn-primary">Back To Site</a>
					</div>			
					<div class="col-sm-2"></div>
				</div>
				<div class="row">
					<?php require_once('includes/menus.php'); ?>
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
									    while($row = mysqli_fetch_array($result1)) {  ?>
										<div class="event" id="<?php echo $row['id']; ?>" draggable="true">	
											<a href="maintenance.php?id=<?php echo $row['id']; ?>">
												<ul class="event-ul">
													<li>
														<span>Order Date:</span>
														<span><?php echo $row['order_date']; ?></span>
													</li>
													<li>
														<span>Order Title:</span>
														<span><?php echo $row['order_title']; ?></span>
													</li>
													<li>
														<span>Order No:</span>
														<span><?php echo $row['order_no']; ?></span>
													</li>
													<li>
														<span class="desc-label">Description:</span>
														<span class="desc-content">
															<?php echo $row['project_description']; ?>
														</span>
													</li>
													<li>
														<span>Assigned By:</span>
														<span><?php echo $row['assign_by']; ?></span>
													</li>
													<li>
														<span>Location:</span><span><?php echo $row['location']; ?></span>
													</li>
												</ul>
											</a>
										</div>
									<?php } ?>
								</div>
							</td>
							<td>								
								<div class="main-event">
										<?php
										$sql1 = "SELECT * FROM module_workorder_maintenance_projects WHERE project_status = 'in_progress' ORDER BY id DESC";
										$result1 = mysqli_query($conn, $sql1);
									    // output data of each row
									    while($row = mysqli_fetch_array($result1)) {  ?>
										<div class="event" id="<?php echo $row['id']; ?>" draggable="true">		
											<a href="maintenance.php?id=<?php echo $row['id']?>">
												<ul class="event-ul">
													<li>
														<span>Order Date:</span>
														<span><?php echo $row['order_date']; ?></span>
													</li>
													<li>
														<span>Order Title:</span>
														<span><?php echo $row['order_title']; ?></span>
													</li>
													<li>
														<span>Order No:</span>
														<span><?php echo $row['order_no']; ?></span>
													</li>
													<li>
														<span class="desc-label">Description:</span>
														<span class="desc-content">
															<?php echo $row['project_description']; ?>
														</span>
													</li>
													<li>
														<span>Assigned By:</span>
														<span><?php echo $row['assign_by']; ?></span>
													</li>
													<li>
														<span>Location:</span><span><?php echo $row['location']; ?></span>
													</li>
												</ul>
											</a>
										</div>
									<?php } ?>
								</div>
							</td>							
							<td>								
								<div class="main-event">
										<?php
										$sql1 = "SELECT * FROM module_workorder_maintenance_projects WHERE project_status = 'completed' ORDER BY id DESC";
										$result1 = mysqli_query($conn, $sql1);
									    // output data of each row
									    while($row = mysqli_fetch_array($result1)) {  ?>
										<div class="event" id="<?php echo $row['id']; ?>" draggable="true">		
											<a href="maintenance.php?id=<?php echo $row['id']?>">
												<ul class="event-ul">
													<li>
														<span>Order Date:</span>
														<span><?php echo $row['order_date']; ?></span>
													</li>
													<li>
														<span>Order Title:</span>
														<span><?php echo $row['order_title']; ?></span>
													</li>
													<li>
														<span>Order No:</span>
														<span><?php echo $row['order_no']; ?></span>
													</li>
													<li>
														<span class="desc-label">Description:</span>
														<span class="desc-content">
															<?php echo $row['project_description']; ?>
														</span>
													</li>
													<li>
														<span>Assigned By:</span>
														<span><?php echo $row['assign_by']; ?></span>
													</li>
													<li>
														<span>Location:</span><span><?php echo $row['location']; ?></span>
													</li>
												</ul>
											</a>
										</div>
									<?php } ?>
								</div>
							</td>
														
							<td>								
								<div class="main-event">
										<?php
										$sql1 = "SELECT * FROM module_workorder_maintenance_projects WHERE project_status = 'invoiced' ORDER BY id DESC";
										$result1 = mysqli_query($conn, $sql1);
									    // output data of each row
									    while($row = mysqli_fetch_array($result1)) {  ?>
										<div class="event" id="<?php echo $row['id']; ?>">		
											<a href="maintenance.php?id=<?php echo $row['id']?>">
												<ul class="event-ul">
													<li>
														<span>Order Date:</span>
														<span><?php echo $row['order_date']; ?></span>
													</li>
													<li>
														<span>Order Title:</span>
														<span><?php echo $row['order_title']; ?></span>
													</li>
													<li>
														<span>Order No:</span>
														<span><?php echo $row['order_no']; ?></span>
													</li>
													<li>
														<span class="desc-label">Description:</span>
														<span class="desc-content">
															<?php echo $row['project_description']; ?>
														</span>
													</li>
													<li>
														<span>Assigned By:</span>
														<span><?php echo $row['assign_by']; ?></span>
													</li>
													<li>
														<span>Location:</span><span><?php echo $row['location']; ?></span>
													</li>
												</ul>
											</a>
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