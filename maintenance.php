 <?php
	if(empty($_SESSION)) // if the session not yet started
	@session_start();
 	require_once('config/config.php');
	if (isset($_POST['submit'])) {
		//print_r($_POST);exit;
		$user_id = $_SESSION['uid'];
		$user_name = $_SESSION['uname'];
		$timestamp = strtotime(date('Y-m-d h:m:s'));
		$rows = $_POST;
		$order_date = $_POST['order_date'];
		$order_title = $_POST['order_title'];
		$order_no = $timestamp;

		if ($_POST['action_name'] == 'insert') {
			$assign_by_data = explode('-', $_POST['assign_by']);
			$assign_by = $assign_by_data[0];
			$assign_by_user_id = $assign_by_data[1];
		}elseif ($_POST['action_name'] == 'update') {
			$assign_by = $_POST['assign_by'];
		}

		$bill_to = $_POST['bill_to'];
		$association_name = ($_POST['association_name']) ? $_POST['association_name']: '';
		$owner_name = ($_POST['owner_name']) ? $_POST['owner_name'] : '';
		$other_details = ($_POST['other_details']) ? $_POST['other_details'] : '';
		$location = explode('-', $_POST['location']);
		$location = $location[0];
		$project_description = $_POST['project_description'];
		$start_date = $_POST['start_date'];
		$billing_type = $_POST['billing_type'];

		//print_r($_POST);exit;

		if (!empty($_SESSION['bill'])) {
			$emp_name = implode(',', $_SESSION['bill']['bill_emp_name']);
			$emp_date = implode(',', $_SESSION['bill']['bill_emp_date']);
			$emp_start = implode(',', $_SESSION['bill']['bill_emp_start']);
			$emp_end = implode(',', $_SESSION['bill']['bill_emp_end']);
			$emp_not_billed = implode(',', $_SESSION['bill']['bill_emp_not_billed']);
			$emp_hours = implode(',', $_SESSION['bill']['bill_emp_hours']);
			$emp_rate = implode(',', $_SESSION['bill']['bill_emp_rate']);

			$cont_name = implode(',', $_SESSION['bill']['bill_cont_name']);
			$cont_date = implode(',', $_SESSION['bill']['bill_cont_date']);
			$cont_start = implode(',', $_SESSION['bill']['bill_cont_start']);
			$cont_end = implode(',', $_SESSION['bill']['bill_cont_end']);
			$cont_not_billed = implode(',', $_SESSION['bill']['bill_cont_not_billed']);
			$cont_hours = implode(',', $_SESSION['bill']['bill_cont_hours']);
			$cont_rate = implode(',', $_SESSION['bill']['bill_cont_rate']);
		}elseif (empty($_SESSION['bill']) && !empty($_POST['emp_name']) && $_POST['emp_name'] == '' ||  !empty($_POST['cont_name']) && $_POST['cont_name'] == '') {
			$emp_name = '';
			$emp_date = '';
			$emp_start = 0;
			$emp_end = 0;
			$emp_not_billed = 0;
			$emp_hours = 0;
			$emp_rate = 0;

			$cont_name = '';
			$cont_date = '';
			$cont_start = 0;
			$cont_end = 0;
			$cont_not_billed = 0;
			$cont_hours = 0;
			$cont_rate = 0;
		}elseif (empty($_SESSION['bill']) && !empty($_POST['emp_name']) && $_POST['emp_name'] != '' && !empty($_POST['cont_name']) && $_POST['cont_name'] != '') {
			$emp_name = implode(',', $_POST['emp_name']);
			$emp_date = implode(',', $_POST['emp_date']);
			$emp_start = implode(',', $_POST['emp_start']);
			$emp_end = implode(',', $_POST['emp_end']);
			$emp_not_billed = implode(',', $_POST['emp_not_billed']);
			$emp_hours = implode(',', $_POST['emp_hours']);
			$emp_rate = implode(',', $_POST['emp_rate']);

			$cont_name = implode(',', $_POST['cont_name']);
			$cont_date = implode(',', $_POST['cont_date']);
			$cont_start = implode(',', $_POST['cont_start']);
			$cont_end = implode(',', $_POST['cont_end']);
			$cont_not_billed = implode(',', $_POST['cont_not_billed']);
			$cont_hours = implode(',', $_POST['cont_hours']);
			$cont_rate = implode(',', $_POST['cont_rate']);
		}elseif (empty($_SESSION['bill']) && !empty($_POST['emp_name']) && $_POST['emp_name'] != '' && empty($_POST['cont_name'])) {
			$emp_name = implode(',', $_POST['emp_name']);
			$emp_date = implode(',', $_POST['emp_date']);
			$emp_start = implode(',', $_POST['emp_start']);
			$emp_end = implode(',', $_POST['emp_end']);
			$emp_not_billed = implode(',', $_POST['emp_not_billed']);
			$emp_hours = implode(',', $_POST['emp_hours']);
			$emp_rate = implode(',', $_POST['emp_rate']);

			$cont_name = '';
			$cont_date = '';
			$cont_start = 0;
			$cont_end = 0;
			$cont_not_billed = 0;
			$cont_hours = 0;
			$cont_rate = 0;
		}elseif (empty($_SESSION['bill']) && empty($_POST['emp_name']) && !empty($_POST['cont_name']) && $_POST['cont_name'] != '') {
			$emp_name = '';
			$emp_date = '';
			$emp_start = 0;
			$emp_end = 0;
			$emp_not_billed = 0;
			$emp_hours = 0;
			$emp_rate = 0;

			$cont_name = implode(',', $_POST['cont_name']);
			$cont_date = implode(',', $_POST['cont_date']);
			$cont_start = implode(',', $_POST['cont_start']);
			$cont_end = implode(',', $_POST['cont_end']);
			$cont_not_billed = implode(',', $_POST['cont_not_billed']);
			$cont_hours = implode(',', $_POST['cont_hours']);
			$cont_rate = implode(',', $_POST['cont_rate']);
		}elseif (empty($_SESSION['bill']) && empty($_POST['emp_name']) || empty($_POST['cont_name'])) {
			$emp_name = '';
			$emp_date = '';
			$emp_start = 0;
			$emp_end = 0;
			$emp_not_billed = 0;
			$emp_hours = 0;
			$emp_rate = 0;

			$cont_name = '';
			$cont_date = '';
			$cont_start = 0;
			$cont_end = 0;
			$cont_not_billed = 0;
			$cont_hours = 0;
			$cont_rate = 0;
		}

		if (isset($_POST['mat_vendors'])) {
			$mat_vendors = implode(',', $_POST['mat_vendors']);
		}else{
			$mat_vendors = '';
		}

		if (isset($_POST['mat_desc'])) {
			$mat_desc = implode(',', $_POST['mat_desc']);
		}else{
			$mat_desc = '';
		}

		if (isset($_POST['mat_cost'])) {
			$mat_cost = implode(',', $_POST['mat_cost']);
		}else{
			$mat_cost = 0;
		}

		if (isset($_POST['bid_total'])) {
			$bid_total = $_POST['bid_total'];
		}else{
			$bid_total = 0;
		}

		if (isset($_POST['change_order_desc'])) {
			$change_order_desc = implode(',', $_POST['change_order_desc']);
		}else{
			$change_order_desc = '';
		}

		if (isset($_POST['change_order_cost'])) {
			$change_order_cost = implode(',', $_POST['change_order_cost']);
		}else{
			$change_order_cost = 0;
		}

		if (isset($_POST['progress_note'])) {
			$progress_note = ($_POST['progress_note'])?$_POST['progress_note']:'';
		}else{
			$progress_note = '';
		}

		$completion_date = ($_POST['completion_date'])?$_POST['completion_date']:'';
		$project_image1 = $timestamp."_".$_FILES['project_image1']['name'];
		$project_image1 = ($_FILES['project_image1']['name'])?$project_image1:'Chrysanthemum.jpg';
		$project_image2 = $timestamp."_".$_FILES['project_image2']['name'];
		$project_image2 = ($_FILES['project_image2']['name'])?$project_image2:'Chrysanthemum.jpg';

		if (isset($_POST['total_hours1']) && !isset($_POST['total_hours2'])) {
			$total_hours = ($_POST['total_hours1'])?$_POST['total_hours1']:0;
		}elseif (!isset($_POST['total_hours1']) && isset($_POST['total_hours2'])) {
			$total_hours = ($_POST['total_hours2'])?$_POST['total_hours2']:0;
		}else{
			$total_hours = 0;
		}

		if (isset($_POST['total_hours_cost_total1']) && !isset($_POST['total_hours_cost_total2'])) {
			$total_hours_cost_total = ($_POST['total_hours_cost_total1'])?$_POST['total_hours_cost_total1']:0;
		}elseif (!isset($_POST['total_hours_cost_total1']) && isset($_POST['total_hours_cost_total2'])) {
			$total_hours_cost_total = ($_POST['total_hours_cost_total2'])?$_POST['total_hours_cost_total2']:0;
		}else{
			$total_hours_cost_total = 0;
		}

		$created = date('Y-m-d h:m:s');
		$modified = date('Y-m-d h:m:s');

		if (!empty($_FILES["project_image1"]["name"])) {
			$target_dir = "images/uploads/maintenance/";
			$target_file1 = $target_dir . basename($timestamp."_".$_FILES["project_image1"]["name"]);
			$uploadOk = 1;
			$imageFileType1 = pathinfo($target_file1,PATHINFO_EXTENSION);

			// Check if image1 file is a actual image or fake image
			    $check1 = getimagesize($_FILES["project_image1"]["tmp_name"]);
			    if($check1 !== false) {
			        //echo "Project Image1 is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        $msg = "Project Image1 is not an image.";
			        $uploadOk = 0;
			    }


			// Check if file1 already exists
			if (file_exists($target_file1)) {
			    $msg = "Sorry, Project Image1 already exists.";
			    $uploadOk = 0;
			}

			// Check Project Image1 size
			if ($_FILES["project_image1"]["size"] > 500000) {
			    $msg = "Sorry, your Project Image1 is too large.";
			    $uploadOk = 0;
			}

			// Allow certain Project Image1 formats
			if($imageFileType1 != "jpg" && $imageFileType1 != "png" && $imageFileType1 != "jpeg"
			&& $imageFileType1 != "gif" ) {
			    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			move_uploaded_file($_FILES["project_image1"]["tmp_name"], $target_file1);

		}else{
			$uploadOk = 1;
		}

		if (!empty($_FILES["project_image2"]["name"])) {
			$target_dir = "images/uploads/maintenance/";
			$target_file2 = $target_dir . basename($timestamp."_".$_FILES["project_image2"]["name"]);
			$uploadOk = 1;
			$imageFileType2 = pathinfo($target_file2,PATHINFO_EXTENSION);

			// Check if image2 file is a actual image or fake image
			    $check1 = getimagesize($_FILES["project_image2"]["tmp_name"]);
			    if($check1 !== false) {
			        //$msg = "Project Image2 is an image - " . $check["mime"] . ".";
			        $uploadOk = 1;
			    } else {
			        $msg = "Project Image2 is not an image.";
			        $uploadOk = 0;
			    }

			// Check if file2 already exists
			if (file_exists($target_file2)) {
			    $msg = "Sorry, Project Image2 already exists.";
			    $uploadOk = 0;
			}

			// Check Project Image2 size
			if ($_FILES["project_image2"]["size"] > 500000) {
			    $msg = "Sorry, your Project Image2 is too large.";
			    $uploadOk = 0;
			}

			// Allow certain Project Image2 formats
			if($imageFileType2 != "jpg" && $imageFileType2 != "png" && $imageFileType2 != "jpeg"
			&& $imageFileType2 != "gif" ) {
			    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			    $uploadOk = 0;
			}
			move_uploaded_file($_FILES["project_image2"]["tmp_name"], $target_file2);
		}else{
			$uploadOk = 1;
		}

		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    $msg = "Sorry, your file was not uploaded. Please check file size or file extensions.";
		// if everything is ok, try to upload file
		} else {
			if ($_POST['action_name'] == 'insert') {
		        $msg = "The file ". basename( $_FILES["project_image1"]["name"]). " has been uploaded.";

		        $sql = "INSERT INTO module_workorder_maintenance_projects (user_id, order_date, order_title, order_no, assign_by, assign_by_user_id, bill_to, association_name, owner_name, other_details, location, project_image1, project_image2, project_description, start_date, billing_type, emp_name, emp_date, emp_start, emp_end, emp_not_billed, emp_hours, emp_rate, cont_name, cont_date, cont_start, cont_end, cont_not_billed, cont_hours, cont_rate, progress_note, completion_date, total_hours, total_hours_cost_total, mat_vendors, mat_desc, mat_cost, bid_total, change_order_desc, change_order_cost, created) VALUES ($user_id, '$order_date', '$order_title', '$order_no','$assign_by', '$assign_by_user_id', '$bill_to','$association_name','$owner_name','$other_details','$location', '$project_image1','$project_image2', '$project_description', '$start_date', '$billing_type', '$emp_name', '$emp_date', '$emp_start', '$emp_end', '$emp_not_billed', '$emp_hours', '$emp_rate', '$cont_name', '$cont_date', '$cont_start', '$cont_end', '$cont_not_billed', '$cont_hours', '$cont_rate', '$progress_note', '$completion_date', '$total_hours', '$total_hours_cost_total', '$mat_vendors', '$mat_desc', '$mat_cost', '$bid_total', '$change_order_desc', '$change_order_cost', '$created')";

 				if (mysqli_query($conn, $sql)) {
 					// unset or destroy bill data stored in session after insert
 					unset($_SESSION['bill']);
 					?>
				    <script type="text/javascript">
				    	alert("Record Saved successfully");
				    	window.location="dashboard.php";
				    </script>
				<?php } else {
				    $msg = "Failed";
				}
		}elseif ($_POST['action_name'] == 'update') {
			if (empty($_FILES["project_image1"]["name"]) || empty($_FILES["project_image2"]["name"])) {
				$project_image1 = $_POST['project_image1_old'];
				$project_image2 = $_POST['project_image2_old'];
			}else{
				$project_image1 = $timestamp."_".$_FILES["project_image1"]["name"];
				$project_image2 = $timestamp."_".$_FILES["project_image2"]["name"];
				if (!empty($project_image1)) {
					unlink("images/uploads/maintenance/".$_POST['project_image1_old']);
				}
				if (!empty($project_image2)) {
					unlink("images/uploads/maintenance/".$_POST['project_image2_old']);
				}
			}
			$id = $_POST['id'];
			$sql = "UPDATE module_workorder_maintenance_projects SET order_date = '$order_date', order_title = '$order_title', assign_by = '$assign_by', bill_to = '$bill_to', association_name = '$association_name', owner_name = '$owner_name', other_details = '$other_details', location = '$location', project_image1 = '$project_image1', project_image2 = '$project_image2', project_description = '$project_description', start_date = '$start_date', billing_type = '$billing_type', emp_name = '$emp_name', emp_date = '$emp_date', emp_start = '$emp_start', emp_end = '$emp_end', emp_not_billed = '$emp_not_billed', emp_hours = '$emp_hours', emp_rate = '$emp_rate', cont_name = '$cont_name', cont_date = '$cont_date', cont_start = '$cont_start', cont_end = '$cont_end', cont_not_billed = '$cont_not_billed', cont_hours = '$cont_hours', cont_rate = '$cont_rate', progress_note = '$progress_note', completion_date = '$completion_date', total_hours = '$total_hours', total_hours_cost_total = '$total_hours_cost_total', mat_vendors = '$mat_vendors', mat_desc = '$mat_desc', mat_cost = '$mat_cost', bid_total = '$bid_total', change_order_desc = '$change_order_desc', change_order_cost = '$change_order_cost', modified = '$modified' WHERE id = '$id'";
			if (mysqli_query($conn, $sql)) {
				if (!empty($progress_note)) {
					$progress_notes_sql = "INSERT INTO module_workorder_projects_progress_notes (project_id, progress_note, user_name, created, modified) VALUES ('$id', '$progress_note', '$user_name', '$created','$modified')";
					mysqli_query($conn, $progress_notes_sql);
				}

				unset($_SESSION['bill']);
				?>
				    <script type="text/javascript">
				    	alert("Record Updated successfully");
				    	window.location="dashboard.php";
				    </script>
				<?php
				} else {
				    $msg = "Failed";
				}
		    }
		}
	}elseif (isset($_GET['id'])) {
		$sql = "SELECT * FROM module_workorder_maintenance_projects WHERE id = '".$_GET['id']."'";
		$rows = mysqli_fetch_array(mysqli_query($conn, $sql));
	}
	//$conn->close();
?>
<?php require_once('includes/header.php'); ?>
				<fieldset>
					<legend>Maintenance Project</legend>
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
						<div class="col-sm-3">
							<div class="form-group">
								<h4><?php if (isset($msg)) { echo $msg; } ?></h4>
							</div>
						</div>
					</div>
					<hr>
					<form class="form" name="maintenance" method="POST" action="" enctype="multipart/form-data">
					<?php if (isset($_GET['id'])) { ?>
					<input type="hidden" name="action_name" value="update">
					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
					<?php }else{ ?>
					<input type="hidden" name="action_name" value="insert">
					<?php } ?>
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
							    <label for="orderdate">Order Date</label>
							    <input type="text"  name="order_date" class="form-control form-control__small datepicker" id="orderdate"  value="<?php echo isset($rows['order_date']) ? $rows['order_date'] : date('Y-m-d'); ?>" required="required" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
							</div>
							<div class="form-group">
								<label for="orderhash">Order Title</label>
							    <input type="text"  name="order_title" class="form-control" id="orderhash"  value="<?php echo isset($rows['order_title']) ? $rows['order_title'] : ''; ?>" required="required" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
							</div>
							<?php
								if (isset($_GET['id'])) { ?>
								<div class="form-group">
									<label for="orderhash">Order No. #</label>
								    <input type="text"  name="order_no" class="form-control" id="orderhash"  readonly value="<?php echo isset($rows['order_no']) ? $rows['order_no'] : ''; ?>" required="required" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
								</div>
							<?php } ?>
							<div class="form-group">
								<label for="assignby">Assign By</label>
							    <!-- <input type="text"  name="assign_by" class="form-control" id="assignby"  value="<?php echo isset($rows['assign_by']) ? $rows['assign_by'] : ''; ?>"/> -->
							    <select id="new-item" class="form-control" name="assign_by"  required="required">
							    <option value="<?php echo isset($rows['assign_by']) ? $rows['assign_by'] : ''; ?>"><?php echo isset($rows['assign_by']) ? $rows['assign_by'] : '-- Select --'; ?></option>
								    <?php
								    	$sql1 = mysqli_query($conn, "select * from users");
								    	while ($data = mysqli_fetch_array($sql1)) { ?>
										<option value="<?php echo $data['name_first']." ".$data['name_last']."-".$data['user_id']; ?>"><?php echo $data['name_first']."  ".$data['name_last']; ?></option>
								    <?php } ?>
								</select>
							</div>
							<div class="form-group">
								<label for="location">Location</label>
							    <select id="location" class="form-control" name="location"  required="required" onchange="GetAssociationOwner(this)">
							    <option value="<?php echo isset($rows['location']) ? $rows['location'] : ''; ?>"><?php echo isset($rows['location']) ? $rows['location'] : '-- Select --'; ?></option>
								    <?php
								    	$sql1 = mysqli_query($conn, "select * from properties");
								    	while ($data = mysqli_fetch_array($sql1)) { ?>
										<option value="<?php echo $data['street_1'].'-'.$data['subdivision_id'].'-'.$data['property_id']; ?>"><?php echo $data['street_1']; ?></option>
								    <?php } ?>
								</select>
							</div>
							<div class="radiosection">
								<h5 class="">Bill To</h5>
								<div class="radio association">
								    <label class="">
								      <input name="bill_to" type="radio" value="Association"
								      	<?php
								      		if (isset($rows['bill_to'])) {
								      			if ($rows['bill_to'] == 'Association') {
								      				echo 'checked="checked"';
								      			}else{
								      				echo '';
								      			}
								      		}
								      	?>>Association
								    </label>
								    <div id="associationinputsection">
								    	<input type="text"  id="association_name" name="association_name" class="form-control" value="<?php echo isset($rows['association_name']) ? $rows['association_name'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
								    </div>
							    </div>
							    <div class="radio owner">
								    <label class="">
								      <input name="bill_to" type="radio" value="Owner"
								      	<?php
								      		if (isset($rows['bill_to'])) {
								      			if ($rows['bill_to'] == 'Owner') {
								      				echo 'checked="checked"';
								      			}else{
								      				echo '';
								      			}
								      		}
								      	?>>Owner
								    </label>
								    <div id="ownerinputsection">
								    	<input type="text"  id="owner_name" name="owner_name" readonly class="form-control" value="<?php echo isset($rows['owner_name']) ? $rows['owner_name'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
								    </div>
							    </div>
							    <div class="radio other">
								    <label class="">
								      <input name="bill_to" type="radio" value="Other"
								      	<?php
								      		if (isset($rows['bill_to'])) {
								      			if ($rows['bill_to'] == 'Other') {
								      				echo 'checked="checked"';
								      			}else{
								      				echo '';
								      			}
								      		}
								      	?>>Other
								    </label>
								    <div id="otherinputsection">
								    	<input type="text"  name="other_details" class="form-control" value="<?php echo isset($rows['other_details']) ? $rows['other_details'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
								    </div>
							    </div>
							</div>
							<div class="form-group">
								<label for="description">Description</label>
							    <textarea class="form-control" id="project_description" name="project_description"  required="required"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>><?php echo isset($rows['project_description']) ? $rows['project_description'] : ''; ?></textarea>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="row">
								<div class="col-sm-6">
									<?php if (!isset($rows['project_image1'])) { ?>
										<img class="img-responsive" alt="Chrysanthemum" src="images/Chrysanthemum.jpg" />
									<?php }else{ ?>
									<img class="img-responsive" alt="Chrysanthemum" src="images/uploads/maintenance/<?php echo $rows['project_image1']; ?>" width="300px"/>
									<?php } ?>
									<label class="btn btn-primary">
										<input type="hidden" name="project_image1_old" value="<?php echo isset($rows['project_image1'])?$rows['project_image1']:''; ?>">
										<input type="file" name="project_image1" <?php //echo empty($_GET['id']) ? 'required' : '' ?>>
										Select File
									</label>
								</div>
								<div class="col-sm-6">
									<?php if (!isset($rows['project_image2'])) { ?>
										<img class="img-responsive" alt="Chrysanthemum" src="images/Chrysanthemum.jpg" />
									<?php }else{ ?>
									<img class="img-responsive" alt="Chrysanthemum" src="images/uploads/maintenance/<?php echo $rows['project_image2']; ?>" width="300px"/>
									<?php } ?>
									<label class="btn btn-primary">
										<input type="hidden" name="project_image2_old" value="<?php echo isset($rows['project_image2'])?$rows['project_image2']:''; ?>">
										<input type="file" name="project_image2" <?php //echo empty($_GET['id']) ? 'required' : '' ?>>
										Select File
									</label>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-12">
									<p><b>Image Size : </b> Should be less than 500KB.<br>
									<b>Extensions : </b> Only JPG, JPEG & PNG files are allowed.</p>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label for="startdatepicker">Start Date</label>
									    <input id="startdatepicker" type="text"  name="start_date" class="form-control form-control__small datepicker"  value="<?php echo isset($rows['start_date']) ? $rows['start_date'] : ''; ?>" required="required" />
									</div>
								</div>

								<div class="clearfix col-sm-12 sectionhide" id="assignsectionhide">
									<div class="row">
										<label class="col-sm-12">Assigned To:</label>

										<form name="employee" id="employee_entry" action="javascript:" method="GET">
											<div class="col-sm-3">
												<div class="form-group">
													<label for="emp1">Employee Name:</label>
													<input id="emp_name1" type="text"  name="emp_name" class="form-control"  onblur="getEmailIdEmp()"/>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label for="dollor1">$ Hourly Rate</label>
													<input id="emp_rate" type="number"  name="emp_rate" class="form-control" placeholder="000.00"  />
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label for="email1">Email</label>
													<input name="emp_email" id="emp_email1" type="email" class="form-control" />
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="label-visihide">Add Button</label>
													<input type="button" name="submit_employee" id="submit_employee" value="Save" class="btn btn-primary">
												</div>
											</div>
										</form>

										<div class="row emp_data">
										</div>

										<form name="cont" id="cont_entry" action="javascript:" method="GET">
											<div class="col-sm-3">
												<div class="form-group">
													<label for="cont1">Contractor Name:</label>
													<input id="cont_name1" type="text"  name="cont_name" class="form-control"  onblur="getEmailIdCont()"/>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label for="dollor2">$ Hourly Rate</label>
													<input id="cont_rate" type="number"  name="cont_rate" class="form-control"  placeholder="000.00"/>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label for="email2">Email</label>
													<input name="cont_email" id="cont_email1" type="email" class="form-control"/>
												</div>
											</div>
											<div class="col-sm-3">
												<div class="form-group">
													<label class="label-visihide">Add Button</label>
													<input type="button" name="submit_cont" id="submit_cont" value="Save" class="btn btn-primary">
												</div>
											</div>
										</form>
										<div class="row cont_data">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">
							<div class="row">
								<label class="col-sm-12">Billing Type:</label>
								<div class="col-sm-4">
									<div class="radio hourly">
									    <label class="">
										<?php if (isset($rows['billing_type']) && $rows['billing_type'] == 'Hourly') { ?>
									      <input name="billing_type" type="radio" value="Hourly"
								      	<?php
								      		if (isset($rows['billing_type'])) {
								      			if ($rows['billing_type'] == 'Hourly') {
								      				echo 'checked="checked"';
								      			}else{
								      				echo '';
								      			}
								      		}
								      	?>>Hourly
									    <?php }elseif (!isset($rows['billing_type'])){ ?>
									    <input name="billing_type" type="radio" value="Hourly">Hourly
									    <?php } ?>
									    </label>
								    </div>
								</div>
								<div class="col-sm-4">
									<div class="radio hourlymaterial">
									    <label class="">
										<?php if (isset($rows['billing_type']) && $rows['billing_type'] == 'Hourly + Materials') { ?>
									      <input name="billing_type" type="radio" value="Hourly + Materials"
								      	<?php
								      		if (isset($rows['billing_type'])) {
								      			if ($rows['billing_type'] == 'Hourly + Materials') {
								      				echo 'checked="checked"';
								      			}else{
								      				echo '';
								      			}
								      		}
								      	?>>Hourly + Materials
									    <?php }elseif (!isset($rows['billing_type'])){ ?>
									    <input name="billing_type" type="radio" value="Hourly + Materials">Hourly + Materials
									    <?php } ?>
									    </label>
								    </div>
								</div>
								<div class="col-sm-4">
									<div class="radio bigmaterialchannel">
									    <label class="">
										<?php if (isset($rows['billing_type']) && $rows['billing_type'] == 'Bid Project + Materials + Changes') { ?>
									      <input name="billing_type" type="radio" value="Bid Project + Materials + Changes"
								      	<?php
								      		if (isset($rows['billing_type'])) {
								      			if ($rows['billing_type'] == 'Bid Project + Materials + Changes') {
								      				echo 'checked="checked"';
								      			}else{
								      				echo '';
								      			}
								      		}
								      	?>>Bid Project + Materials + Changes
									    <?php }elseif (!isset($rows['billing_type'])){ ?>
									    <input name="billing_type" type="radio" value="Bid Project + Materials + Changes">Bid Project + Materials + Changes
									    <?php } ?>
									    </label>
								    </div>
								</div>
								<div class="<?php if(isset($rows['billing_type']) && $rows['billing_type'] == 'Hourly'){ echo 'clearfix col-sm-12'; }else{ echo 'clearfix col-sm-12 sectionhide'; }  ?>" id="hourlysectionhide">

										<form name="bill_emp1" id="bill_emp1" action="bill_emp1.php">

										<?php
											if(isset($rows['id']) && $rows['billing_type'] == 'Hourly'){
												$emp_name = explode(',', $rows['emp_name']);
												$emp_date = explode(',', $rows['emp_date']);
												$emp_start = explode(',', $rows['emp_start']);
												$emp_end = explode(',', $rows['emp_end']);
												$emp_not_billed = explode(',', $rows['emp_not_billed']);
												$emp_hours = explode(',', $rows['emp_hours']);
												$emp_rate = explode(',', $rows['emp_rate']);
												$result = count($emp_name);
												for ($i=0; $i < $result; $i++) {
													if (!empty($emp_name[$i])) {
										?>
									<div class="row">
										<div class="col-sm-2">
											<div class="form-group">
												<label for="emp_name">Employee Name</label>
							    				<input id="emp_name2" type="text"  name="emp_name[]" class="form-control" value="<?php echo $emp_name[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="empdatepicker">Date</label>
							    				<input id="" type="date"  name="emp_date[]" class="form-control" value="<?php echo $emp_date[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hremp1start">Start</label>
												<input id="hremp1start" type="text"  name="emp_start[]" class="form-control" value="<?php echo $emp_start[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hremp1end">End</label>
												<input id="hremp1end" type="text"  name="emp_end[]" class="form-control" value="<?php echo $emp_end[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="hremp1notbilled">Not Billed</label>
												<input id="hremp1notbilled" type="text"  name="emp_not_billed[]" class="form-control" value="<?php echo $emp_not_billed[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hremp1hours">Hours</label>
												<input id="hremp1hours" type="text"  name="emp_hours[]" class="form-control" onblur="CalTotalHours(this)" value="<?php echo $emp_hours[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hremp1hours">Rate $</label>
												<input id="hremp1hours" type="text"  name="emp_rate[]" class="form-control" onblur="CalTotalHoursCost(this)" value="<?php echo $emp_rate[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="matcost">Action</label>
												<p><span class="remove"><i class="glyphicon glyphicon-remove" style="color:red;padding:10px;"></i></span></p>
											</div>
										</div>
									</div>
										<?php } } } ?>
									<div class="row" id="emp1_details">

									</div>
									<div id="bill_emp1_details">

									</div>
										<?php
											if(isset($rows['id']) && $rows['billing_type'] == 'Hourly'){
												$cont_name = explode(',', $rows['cont_name']);
												$cont_date = explode(',', $rows['cont_date']);
												$cont_start = explode(',', $rows['cont_start']);
												$cont_end = explode(',', $rows['cont_end']);
												$cont_not_billed = explode(',', $rows['cont_not_billed']);
												$cont_hours = explode(',', $rows['cont_hours']);
												$cont_rate = explode(',', $rows['cont_rate']);
												$result = count($cont_name);
												for ($i=0; $i < $result; $i++) {
													if (!empty($cont_name[$i])) {
										?>
									<div class="row">
										<div class="col-sm-2">
											<div class="form-group">
												<label for="cont_name">Contractor Name</label>
							    				<input id="cont_name2" type="text"  name="cont_name[]" class="form-control" value="<?php echo $cont_name[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="contdatepicker">Date</label>
							    				<input id="" type="date"  name="cont_date[]" class="form-control" value="<?php echo $cont_date[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hrcontstart">Start</label>
												<input id="hrcontstart" type="text"  name="cont_start[]" class="form-control" value="<?php echo $cont_start[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hrcontend">End</label>
												<input id="hrcontend" type="text"  name="cont_end[]" class="form-control" value="<?php echo $cont_end[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="hrnotbilled">Not Billed</label>
												<input id="hrnotbilled" type="text"  name="cont_not_billed[]" class="form-control" value="<?php echo $cont_not_billed[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="conthours">Hours</label>
												<input id="conthours" type="text"  name="cont_hours[]" class="form-control"  onblur="CalTotalHours(this)" value="<?php echo $cont_hours[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hremp1hours">Rate $</label>
												<input id="hremp1hours" type="text"  name="cont_rate[]" class="form-control" onblur="CalTotalHoursCost(this)" value="<?php echo $cont_rate[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="matcost">Action</label>
												<p><span class="remove"><i class="glyphicon glyphicon-remove" style="color:red;padding:10px;"></i></span></p>
											</div>
										</div>
									</div>
										<?php } } } ?>
										<div class="row" id="cont1_details">

										</div>
									<div class="row">
											<!-- <?php if(!isset($rows['id'])){  ?>
											<div class="col-sm-2">
												<div class="form-group">
													<input type="submit" name="submit_bill_employee1" id="submit_bill_employee1" value="Calculate Hours & Rates" class="btn btn-primary">
												</div>
											</div>
											<?php }elseif(isset($rows['id']) && $rows['billing_type'] == 'Hourly'){ ?>
											<div class="col-sm-12">
												<div class="form-group">
													<label for="totalHours">Total Hours</label>
													<input type="text" name="total_hours1" value="<?php echo $rows['total_hours']; ?>">
													<label for="totalHoursCost">Total Hours Cost</label>
													<input type="text" name="total_hours_cost_total1" value="<?php echo $rows['total_hours_cost_total']; ?>">
												</div>
											</div>
											<?php } ?> -->
											<div class="col-sm-2">
												<div class="form-group">
													<input type="submit" name="submit_bill_employee1" id="submit_bill_employee1" value="Calculate Hours & Rates" class="btn btn-primary" required>

												</div>
											</div>
									</div>

										</form>

									<div id="totalHoursCosts"></div>

								</div>
								<div class="<?php if(isset($rows['billing_type']) && $rows['billing_type'] == 'Hourly + Materials'){ echo 'clearfix col-sm-12'; }else{ echo 'clearfix col-sm-12 sectionhide'; }  ?>" id="hourlymaterialsectionhide">

										<form name="bill_emp2" id="bill_emp2" action="bill_emp1.php">

										<?php
											if(isset($rows['id']) && $rows['billing_type'] == 'Hourly + Materials'){
												$emp_name = explode(',', $rows['emp_name']);
												$emp_date = explode(',', $rows['emp_date']);
												$emp_start = explode(',', $rows['emp_start']);
												$emp_end = explode(',', $rows['emp_end']);
												$emp_not_billed = explode(',', $rows['emp_not_billed']);
												$emp_hours = explode(',', $rows['emp_hours']);
												$emp_rate = explode(',', $rows['emp_rate']);
												$result = count($emp_name);
												for ($i=0; $i < $result; $i++) {
													if (!empty($emp_name[$i])) {
										?>
									<div class="row">
										<div class="col-sm-2">
											<div class="form-group">
												<label for="emp_name">Employee Name</label>
							    				<input id="emp_name3" type="text"  name="emp_name[]" class="form-control" value="<?php echo $emp_name[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?> />
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="empdatepicker">Date</label>
							    				<input id="" type="date"  name="emp_date[]" class="form-control"  value="<?php echo $emp_date[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hremp1start">Start</label>
												<input id="hremp1start" type="text"  name="emp_start[]" class="form-control" value="<?php echo $emp_start[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hremp1end">End</label>
												<input id="hremp1end" type="text"  name="emp_end[]" class="form-control" value="<?php echo $emp_end[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="hremp1notbilled">Not Billed</label>
												<input id="hremp1notbilled" type="text"  name="emp_not_billed[]" class="form-control" value="<?php echo $emp_not_billed[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hremp1hours">Hours</label>
												<input id="hremp1hours" type="text"  name="emp_hours[]" class="form-control"  onblur="CalTotalHours(this)" value="<?php echo $emp_hours[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hremp1hours">Rate $</label>
												<input id="hremp1hours" type="text"  name="emp_rate[]" class="form-control"  onblur="CalTotalHoursCost(this)" value="<?php echo $emp_rate[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="matcost">Action</label>
												<p><span class="remove"><i class="glyphicon glyphicon-remove" style="color:red;padding:10px;"></i></span></p>
											</div>
										</div>
									</div>
										<?php } } } ?>
										<div id="emp2_details">

										</div>
										<?php
											if(isset($rows['id']) && $rows['billing_type'] == 'Hourly + Materials'){
												$cont_name = explode(',', $rows['cont_name']);
												$cont_date = explode(',', $rows['cont_date']);
												$cont_start = explode(',', $rows['cont_start']);
												$cont_end = explode(',', $rows['cont_end']);
												$cont_not_billed = explode(',', $rows['cont_not_billed']);
												$cont_hours = explode(',', $rows['cont_hours']);
												$cont_rate = explode(',', $rows['cont_rate']);
												$result = count($cont_name);
												for ($i=0; $i < $result; $i++) {
													if (!empty($cont_name[$i])) {
										?>
									<div class="row">
										<div class="col-sm-2">
											<div class="form-group">
												<label for="cont_name">Contractor Name</label>
							    				<input id="cont_name3" type="text"  name="cont_name[]" class="form-control"  value="<?php echo $cont_name[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="contdatepicker">Date</label>
							    				<input id="" type="date"  name="cont_date[]" class="form-control"  value="<?php echo $cont_date[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hrcontstart">Start</label>
												<input id="hrcontstart" type="text"  name="cont_start[]" class="form-control" value="<?php echo $cont_start[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hrcontend">End</label>
												<input id="hrcontend" type="text"  name="cont_end[]" class="form-control" value="<?php echo $cont_end[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="hrnotbilled">Not Billed</label>
												<input id="hrnotbilled" type="text"  name="cont_not_billed[]" class="form-control" value="<?php echo $cont_not_billed[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="conthours">Hours</label>
												<input id="conthours" type="text"  name="cont_hours[]" class="form-control"  onblur="CalTotalHours(this)" value="<?php echo $cont_hours[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-1">
											<div class="form-group">
												<label for="hremp1hours">Rate $</label>
												<input id="hremp1hours" type="text"  name="cont_rate[]" class="form-control" onblur="CalTotalHoursCost(this)" value="<?php echo $cont_rate[$i]; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
											</div>
										</div>
										<div class="col-sm-2">
											<div class="form-group">
												<label for="matcost">Action</label>
												<p><span class="remove"><i class="glyphicon glyphicon-remove" style="color:red;padding:10px;"></i></span></p>
											</div>
										</div>
									</div>
										<?php } } } ?>
										<div class="row" id="cont2_details">

										</div>
										<div class="row">
											<!-- <?php if(!isset($rows['id'])){  ?>
											<div class="col-sm-2">
												<div class="form-group">
													<input type="submit" name="submit_bill_employee1" id="submit_bill_employee1" value="Calculate Hours & Rates" class="btn btn-primary">
												</div>
											</div>
											<?php }elseif(isset($rows['id']) && $rows['billing_type'] == 'Hourly + Materials'){ ?>
											<div class="col-sm-12">
												<div class="form-group">
													<label for="totalHours">Total Hours</label>
													<input type="text" name="total_hours2" value="<?php echo $rows['total_hours']; ?>" required>
													<label for="totalHoursCost">Total Hours Cost $</label>
													<input type="text" name="total_hours_cost_total2" value="<?php echo $rows['total_hours_cost_total']; ?>" required>
												</div>
											</div>
											<?php } ?> -->
											<div class="col-sm-2">
												<div class="form-group">
													<input type="submit" name="submit_bill_employee1" id="submit_bill_employee1" value="Calculate Hours & Rates" class="btn btn-primary" required>
												</div>
											</div>
										</div>

											</form>


									<div id="totalHoursCosts2"></div>


									<div class="row">
										<div class="col-sm-12">
											<form name="materials" id="materials_form" action="javascript:" method="GET">
												<div class="row">
													<label class="col-sm-12">Materials:</label>
													<div class="col-sm-3">
														<div class="form-group">
															<label for="vendors">Vendors</label>
															<input id="vendors" type="text"  name="mat_vendors[]" class="form-control" value=""/>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<label for="matdescription">Description</label>
															<input id="matdescription" type="text"  name="mat_desc[]" class="form-control" value=""/>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<label for="matcost">Cost</label>
															<input id="matcost" type="text"  name="mat_cost[]" class="form-control" value="" onblur="changeNumberFormat(this)"/>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
															<label for="matcost">Action</label>
															<input type="submit" name="materials" id="materials" value="Add" class="btn btn-primary">
														</div>
													</div>
												</div>
											</form>
											<div id="materials-data"></div>
											<?php
													if(isset($rows['id'])){
														$mat_vendors = explode(',', $rows['mat_vendors']);
														$mat_desc = explode(',', $rows['mat_desc']);
														$mat_cost = explode(',', $rows['mat_cost']);
														$result = count($mat_vendors);
														for ($i=0; $i < $result; $i++) {
															if (!empty($mat_vendors[$i])) {
												?>
												<div class="row">
													<div class="col-sm-3">
														<div class="form-group">
															<input id="vendors" type="text"  name="mat_vendors[]" class="form-control" value="<?php echo $mat_vendors[$i]; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
														</div>
													</div>
													<div class="col-sm-4">
														<div class="form-group">
															<input id="matdescription" type="text"  name="mat_desc[]" class="form-control" value="<?php echo $mat_desc[$i]; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
														</div>
													</div>
													<div class="col-sm-3">
														<div class="form-group">
															<input id="matcost" type="text"  name="mat_cost[]" class="form-control" value="<?php echo $mat_cost[$i]; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
														</div>
													</div>
													<div class="col-sm-2">
														<div class="form-group">
															<p><span class="remove"><i class="glyphicon glyphicon-remove" style="color:red;padding:10px;"></i></span></p>
														</div>
													</div>
												</div>
												<?php } } } ?>

										</div>
									</div>
								</div>
								<div class="<?php if(isset($rows['billing_type']) && $rows['billing_type'] == 'Bid Project + Materials + Changes'){ echo 'clearfix col-sm-12'; }else{ echo 'clearfix col-sm-12 sectionhide'; }  ?>" id="bigmaterialchannelsectionhide">
									<div class="row">
										<div class="col-sm-12">
											<div class="row">
												<label class="col-sm-12">Bid Project:</label>
												<div class="col-sm-6">
													<div class="form-group">
														<label for="estitotal">Estimate Total</label>
														<input id="estitotal" type="text"  name="bid_total" class="form-control form-control__small" placeholder="$" value="<?php echo isset($rows['bid_total']) ? $rows['bid_total'] : ''; ?>" onblur="changeNumberFormat(this)" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
													</div>
												</div>
											</div>

											<div class="row">
											<form name="change_order" id="change_order_form" action="javascript:" method="GET">
												<label class="col-sm-12">Change Orders:</label>
												<div class="col-sm-7">
													<div class="form-group">
														<label for="deschangeorder">Description of Change Orders</label>
														<input id="deschangeorder" type="text"  name="change_order_desc[]" class="form-control" value=""/>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<label for="changeordercost">Cost</label>
														<input id="changeordercost" type="text"  name="change_order_cost[]" class="form-control" value="" onblur="changeNumberFormat(this)" maxlength="7" />
													</div>
												</div>
												<div class="col-sm-2">
													<div class="form-group">
														<label class="label-visihide">Add Button</label>
														<input type="submit" name="change_order" id="change_order" value="Add" class="btn btn-primary">
													</div>
												</div>
											</form>
											<div id="change_order_data"></div>
											</div>

											<?php
												if(isset($rows['id'])){
													$change_order_desc = explode(',', $rows['change_order_desc']);
													$change_order_cost = explode(',', $rows['change_order_cost']);
													$result = count($change_order_desc);
													for ($i=0; $i < $result; $i++) {
														if (!empty($change_order_desc[$i])) {
											?>
											<div class="row">
												<div class="col-sm-7">
													<div class="form-group">
														<input id="deschangeorder" type="text"  name="change_order_desc[]" class="form-control" value="<?php echo $change_order_desc[$i]; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
													</div>
												</div>
												<div class="col-sm-3">
													<div class="form-group">
														<input id="changeordercost" type="text"  name="change_order_cost[]" class="form-control" value="<?php echo $change_order_cost[$i]; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>
													</div>
												</div>
											</div>
											<?php } } } ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-sm-12">

							<div class="form-group">
								<label for="completiondatepicker">Completion Date</label>
								<input id="completiondatepicker" type="text"  name="completion_date" class="form-control form-control__small datepicker"  value="<?php echo isset($rows['completion_date']) ? $rows['completion_date'] : ''; ?>"/>
							</div>
							<?php if (isset($rows['id'])): ?>
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group">
										<input type="submit" name="submit" value="Update Changes" class="btn btn-primary">
									</div>
								</div>
								<div class="col-sm-3">
									<div class="form-group">
										<a href="send_alert_email.php?proj_id=<?php echo $rows['id']; ?>" target="_blank" class="btn btn-primary">Send Alert Email</a>
									</div>
								</div>
							</div>
							<?php endif ?>
							<?php if (isset($rows['id'])): ?>
							<div class="form-group">
								<label for="progressnote">Progress Notes</label>
									<?php
										$project_id = $rows['id'];
										$progress_notes = mysqli_query($conn, "SELECT * FROM module_workorder_projects_progress_notes WHERE project_id = $project_id ORDER BY id DESC LIMIT 0, 5");
										while ($progressNotes = mysqli_fetch_array($progress_notes)) { ?>
										<p><?php echo $progressNotes['created'].' : '.$progressNotes['user_name'].' : <b>'.$progressNotes['progress_note'].'</b>';  ?></p>
									<?php	} ?>
								<textarea id="progressnote" class="form-control" name="progress_note"></textarea>
							</div>
							<?php endif ?>
						</div>
						<?php if (isset($rows['id'])): ?>
						<div class="col-sm-3">
							<div class="form-group">
								<!-- <a href="send_email_notes.php?proj_id=<?php echo $rows['id']; ?>" target="_blank" class="btn btn-primary">Email Notes</a> -->
								<a target="popup" onclick="window.open('', 'popup', 'width=580,height=360,scrollbars=no, toolbar=no,status=no,resizable=yes,menubar=no,location=no,directories=no,top=10,left=10')" href="send_email_notes.php?proj_id=<?php echo $rows['id']; ?>" class="btn btn-primary">Email Notes</a>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<!-- <button class="btn btn-primary">Email Report</button> -->
								<a target="popup" onclick="window.open('', 'popup', 'width=580,height=360,scrollbars=no, toolbar=no,status=no,resizable=yes,menubar=no,location=no,directories=no,top=10,left=10')" href="maintenance_proj_report.php?proj_id=<?php echo $rows['id']; ?>&typ=rprt" class="btn btn-primary">Email Report</a>
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								<!-- <button class="btn btn-primary">Print Report</button> -->
								<a target="popup" onclick="window.open('', 'popup', 'width=580,height=360,scrollbars=no, toolbar=no,status=no,resizable=yes,menubar=no,location=no,directories=no,top=10,left=10')" href="maintenance_proj_report_print.php?proj_id=<?php echo $rows['id']; ?>&typ=rprt" class="btn btn-primary">Print Report</a>
							</div>
						</div>
						<?php else: ?>
						<div class="col-sm-3">
							<div class="form-group sectionhide" id="save-assign-show">
								<input type="submit" name="submit" value="Save & Assign" class="btn btn-primary">
							</div>
							<div class="form-group" id="save-assign-hide">
								<input type="button" name="check" value="Save & Assign" class="btn btn-primary" onclick="showAlert()">
							</div>
						</div>
						<?php endif ?>
					</div>
					</form>
				</fieldset>


<?php require_once('includes/footer.php'); ?>
