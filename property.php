 <?php 

	if(empty($_SESSION)) // if the session not yet started

	@session_start();

 	require_once('config/config.php'); 

 	

	if (isset($_POST['submit'])) {

		$user_id = $_SESSION['uid'];

		$user_name = $_SESSION['uname'];

		$rows = $_POST;

		$timestamp = strtotime(date('Y-m-d h:m:s'));

		$approval_date = $_POST['approval_date'];

		$approval_expire_date = $_POST['approval_expire_date'];

		$owner_name = $_POST['owner_name'];

		$owner_phone = $_POST['owner_phone'];

		$owner_cell = $_POST['owner_cell'];

		$location = $_POST['location'];

		$project_note = $_POST['project_note'];

		$contractor_name = $_POST['contractor_name'];

		$contractor_phone = $_POST['contractor_phone'];

		$contractor_cell = $_POST['contractor_cell'];

		$project_description = $_POST['project_description'];

		$other_details = ($_POST['other_details']) ? $_POST['other_details']: '';

		$plans_submitted_date = ($_POST['plans_submitted_date']) ? $_POST['plans_submitted_date'] : '';

		$deposit_received_amt = ($_POST['deposit_received_amt']) ? $_POST['deposit_received_amt'] : '';

		$deposit_returned_date = ($_POST['deposit_returned_date']) ? $_POST['deposit_returned_date']: '';

		$deposit_not_returned_notes = ($_POST['deposit_not_returned_notes']) ? $_POST['deposit_not_returned_notes'] : '';

		$project_completed_date = $_POST['project_completed_date'];

		$project_image = $timestamp."_".$_FILES["project_image"]["name"];

		$project_image = ($_FILES['project_image']['name'])?$project_image:'Chrysanthemum.jpg';

		$created = date('Y-m-d h:m:s');

		$modified = date('Y-m-d h:m:s');



		if (!empty($_FILES["project_image"]["name"])) {

			$target_dir = "images/uploads/property/";

			$target_file = $target_dir . basename($timestamp."_".$_FILES["project_image"]["name"]);

			$uploadOk = 1;

			$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

			// Check if image file is a actual image or fake image



		    $check = getimagesize($_FILES["project_image"]["tmp_name"]);

		    if($check !== false) {

		        //echo "File is an image - " . $check["mime"] . ".";

		        $uploadOk = 1;

		    } else {

		        $msg = "File is not an image.";

		        $uploadOk = 0;

		    }



			// Check if file already exists

			if (file_exists($target_file)) {

			    $msg = "Sorry, file already exists.";

			    $uploadOk = 0;

			}

			// Check file size

			if ($_FILES["project_image"]["size"] > 500000) {

			    $msg = "Sorry, your file is too large.";

			    $uploadOk = 0;

			}

			// Allow certain file formats

			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"

			&& $imageFileType != "gif" ) {

			    $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";

			    $uploadOk = 0;

			}

			move_uploaded_file($_FILES["project_image"]["tmp_name"], $target_file);

		}else{

			$target_file = "Chrysanthemum.jpg";

			$uploadOk = 1;

		}

			// Check if $uploadOk is set to 0 by an error

			if ($uploadOk == 0) {

			    $msg = "Sorry, your file was not uploaded.";

			// if everything is ok, try to upload file

			} else {

				if ($_POST['action_name'] == 'insert') {

				        $sql = "INSERT INTO module_workorder_property_owner_projects (user_id, approval_date, approval_expire_date, owner_name, owner_phone, owner_cell, location, project_note, contractor_name, contractor_phone, contractor_cell, project_description, other_details, plans_submitted_date, deposit_received_amt, deposit_returned_date, deposit_not_returned_notes, project_completed_date, project_image, created) VALUES ($user_id, '$approval_date','$approval_expire_date','$owner_name','$owner_phone','$owner_cell','$location','$project_note','$contractor_name','$contractor_phone','$contractor_cell','$project_description','$other_details','$plans_submitted_date','$deposit_received_amt','$deposit_returned_date','$deposit_not_returned_notes','$project_completed_date','$project_image', '$created')";



						if (mysqli_query($conn, $sql)) { ?>

						    <script type="text/javascript">

						    	alert("New Record Saved successfully");

						    	window.location="dashboard_property.php";

						    </script>

					<?php	} else {

						    $msg = "Failed";

						}

				}elseif ($_POST['action_name'] == 'update') {

					if (empty($_FILES["project_image"]["name"])) {

						$project_image = $_POST['project_image_old'];

					}else{

						$project_image = $timestamp."_".$_FILES["project_image"]["name"];

						unlink("images/uploads/property/".$_POST['project_image_old']);

						move_uploaded_file($_FILES["project_image"]["tmp_name"], $target_file);

					}

					$id = $_POST['id'];

					$sql = "UPDATE module_workorder_property_owner_projects SET approval_date = '$approval_date', approval_expire_date = '$approval_expire_date', owner_name = '$owner_name', owner_phone = '$owner_phone', owner_cell = '$owner_cell', location = '$location', project_note = '$project_note', contractor_name = '$contractor_name', contractor_phone = '$contractor_phone', contractor_cell = '$contractor_cell', project_description = '$project_description', other_details = '$other_details', plans_submitted_date = '$plans_submitted_date', deposit_received_amt = '$deposit_received_amt', deposit_returned_date = '$deposit_returned_date', deposit_not_returned_notes = '$deposit_not_returned_notes', project_completed_date = '$project_completed_date', project_image = '$project_image', modified = '$modified' WHERE id = '$id'";

					if (mysqli_query($conn, $sql)) { ?>

						    <script type="text/javascript">

						    	alert("Record Saved successfully");

						    	window.location="dashboard_property.php";

						    </script>

					<?php	} else {

						    $msg = "Failed";

						}

				    } 

			}

	}elseif (isset($_GET['id'])) {

		$sql = "SELECT * FROM module_workorder_property_owner_projects WHERE id = '".$_GET['id']."'";

		$rows = mysqli_fetch_array(mysqli_query($conn, $sql));

	}

	//$conn->close();

?> 	

<?php require_once('includes/header.php'); ?>

				<fieldset>

					<legend>Property Owner Contstruction Project</legend>

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

						<div class="col-sm-3">

							<div class="form-group">

								<h4><?php if (isset($msg)) { echo $msg; } ?></h4>

							</div>

						</div>

					</div>

					<hr>

					<form class="form" name="property" method="POST" action="" enctype="multipart/form-data">

					<?php if (isset($_GET['id'])) { ?>

					<input type="hidden" name="action_name" value="update">	

					<input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">

					<?php }else{ ?>

					<input type="hidden" name="action_name" value="insert">			

					<?php } ?>	

					<div class="row">

						<div class="col-sm-8">					

							<div class="row">

								<div class="col-md-4">

									<div class="form-group">

										<label for="ownername">Owner Name</label>

									    <input type="text"  name="owner_name" class="form-control" id="ownername"  required="required" value="<?php echo isset($rows['owner_name']) ? $rows['owner_name'] : ''; ?>" onblur="getOwnerDetails()" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

									</div>

								</div>

								<div class="col-md-4">

									<div class="form-group">

										<label for="phone">Phone</label>

									    <input type="text"  name="owner_phone" id="owner_phone"  class="form-control" id="phone"  required="required" value="<?php echo isset($rows['owner_phone']) ? $rows['owner_phone'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

									</div>

								</div>

								<div class="col-md-4">

									<div class="form-group">

										<label for="cell">Cell</label>

									    <input type="text"  name="owner_cell" id="owner_cell"  class="form-control" id="cell"  required="required" value="<?php echo isset($rows['owner_cell']) ? $rows['owner_cell'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

									</div>

								</div>

							</div>

							<div class="form-group">

								<label for="location">Location</label>

							    <!-- <input type="text"  name="location"  class="form-control" id="location"  required="required" value="<?php echo isset($rows['location']) ? $rows['location'] : ''; ?>"/> -->



							    <select id="location" class="form-control" name="location"  required="required">

							    <option value="<?php echo isset($rows['location']) ? $rows['location'] : ''; ?>"><?php echo isset($rows['location']) ? $rows['location'] : '-- Select --'; ?></option>

								    <?php 

								    	$sql1 = mysqli_query($conn, "select * from user_addresses");

								    	while ($data = mysqli_fetch_array($sql1)) { ?>

										<option value="<?php echo $data['street_1'].', '.$data['city_town']; ?>"><?php echo $data['street_1'].', '.$data['city_town']; ?></option>			

								    <?php } ?>

								</select>





							</div>

							<div class="row">

								<div class="col-md-4">

									<div class="form-group">

									    <label for="approvaldate">Approval Date</label>

									    <input type="text"  name="approval_date" class="form-control form-control__small datepicker" id="approvaldate" required="required" value="<?php echo isset($rows['approval_date']) ? $rows['approval_date'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

									</div>

								</div>

								<div class="col-md-4">

									<div class="form-group">

									    <label for="approvalexpiredate">Approval Expire Date</label>

									    <input type="text"  name="approval_expire_date"  class="form-control form-control__small datepicker" id="approvalexpiredate" required="required" value="<?php echo isset($rows['approval_expire_date']) ? $rows['approval_expire_date'] : ''; ?>"  <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

									</div>

								</div>

							</div>	

							<div class="form-group">

								<label for="projectnote">Project Note</label>

							    <textarea class="form-control" id="projectnote" name="project_note" required="required"><?php echo isset($rows['project_note']) ? $rows['project_note'] : ''; ?></textarea>

							</div>

						</div>

						<div class="col-sm-4">

							<?php if (empty($_GET['id'])) { ?>

								<img class="img-responsive" alt="Chrysanthemum" src="images/Chrysanthemum.jpg" />

							<?php }else{ ?>

							<img class="img-responsive" alt="Chrysanthemum" src="images/uploads/property/<?php echo $rows['project_image']; ?>" />

							<?php } ?>

							<label class="btn btn-primary">

								<input type="hidden" name="project_image_old" value="<?php echo isset($rows['project_image'])?$rows['project_image']:''; ?>">

								<input type="file" name="project_image" <?php //echo empty($_GET['id']) ? 'required' : '' ?>>

								Select File

							</label>



						<div class="row">

							<div class="col-sm-12">

								<p><b>Image Size : </b> Should be less than 500KB.<br> 

								<b>Extensions : </b> Only JPG, JPEG & PNG allowed.</p>

							</div>

						</div>

						</div>

						<div class="col-sm-12">

							<div class="row">

								<div class="col-sm-4">

									<div class="form-group">

									    <label for="contractor">Contractor</label>

									    <input type="text"  name="contractor_name"  class="form-control" id="contractor" required="required" value="<?php echo isset($rows['contractor_name']) ? $rows['contractor_name'] : ''; ?>"  onblur="getPropertyContractorDetails()" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

									</div>

								</div>

								<div class="col-sm-4">

									<div class="form-group">

									    <label for="contractorphone">Phone</label>

									    <input type="text"  name="contractor_phone" id="contractor_phone"  class="form-control" id="contractorphone" required="required" value="<?php echo isset($rows['contractor_phone']) ? $rows['contractor_phone'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

									</div>

								</div>

								<div class="col-sm-4">

									<div class="form-group">

									    <label for="contractorcell">Cell</label>

									    <input type="text"  name="contractor_cell" id="contractor_cell"  class="form-control" id="contractorcell" required="required" value="<?php echo isset($rows['contractor_cell']) ? $rows['contractor_cell'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

									</div>

								</div>

							</div>

						</div>

					</div>

					<div class="row">

						<label class="col-sm-12">Project Description:</label>

						<div class="col-sm-3">

							<div class="radio">

							    <label class="">

							      <input name="project_description" type="radio" value="New Construction" 

							      	<?php 

							      		if (isset($rows['project_description'])) {

							      			if ($rows['project_description'] == 'New Construction') {

							      				echo 'checked="checked"';

							      			}else{

							      				echo '';

							      			}

							      		}

							      	?>>New Construction

							    </label>

						    </div>

						</div>

						<div class="col-sm-3">

							<div class="radio">

							    <label class="">

							      <input name="project_description" type="radio" value="Remodal" 

							      <?php 

							      		if (isset($rows['project_description'])) {

							      			if ($rows['project_description'] == 'Remodal') {

							      				echo 'checked="checked"';

							      			}else{

							      				echo '';

							      			}

							      		}

							      	?>>Remodal

							    </label>

						    </div>

						</div>

						<div class="col-sm-3">

							<div class="radio">

							    <label class="">

							      <input name="project_description" type="radio" value="Maintenance" 

							      <?php 

							      		if (isset($rows['project_description'])) {

							      			if ($rows['project_description'] == 'Maintenance') {

							      				echo 'checked="checked"';

							      			}else{

							      				echo '';

							      			}

							      		}

							      	?>>Maintenance

							    </label>

						    </div>

						</div>

						<div class="col-sm-3">

							<div class="radio other">

							    <label class="">

							      <input name="project_description" type="radio" value="Other" 

							      <?php 

							      		if (isset($rows['project_description'])) {

							      			if ($rows['project_description'] == 'Other') {

							      				echo 'checked="checked"';

							      			}else{

							      				echo '';

							      			}

							      		}

							      	?>>Other

							    </label>

							    <div id="other">

							    	<input type="text"  name="other_details"  class="form-control" value="<?php echo isset($rows['other_details']) ? $rows['other_details'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

							    </div>

						    </div>

						</div>

						<div class="col-sm-12">

							<div class="row">

								<div class="col-sm-3">

									<div class="radio plans-submitted">

									    <label class="">

									      <input name="project_description" type="radio" value="Plans Submitted" 

									      <?php 

									      		if (isset($rows['project_description'])) {

									      			if ($rows['project_description'] == 'Plans Submitted') {

									      				echo 'checked="checked"';

									      			}else{

									      				echo '';

									      			}

									      		}

									      	?>>Plans Submitted

									    </label>

									    <div id="plans-submitted">

									    	<div class="form-group">

												<label for="plans-submitted-field">Date</label>

												<input id="plans-submitted-field" type="text"  name="plans_submitted_date"  class="form-control form-control__small datepicker" value="<?php echo isset($rows['plans_submitted_date']) ? $rows['plans_submitted_date'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

											</div>

									    </div>

								    </div>

								</div>

								<div class="col-sm-3">

									<div class="radio plans-not-required">

									    <label class="">

									      <input name="project_description" type="radio" value="Plans Not Required" 

									      <?php 

									      		if (isset($rows['project_description'])) {

									      			if ($rows['project_description'] == 'Plans Not Required') {

									      				echo 'checked="checked"';

									      			}else{

									      				echo '';

									      			}

									      		}

									      	?>>Plans Not Required

									    </label>

								    </div>

								</div>

								<div class="col-sm-3">

									<div class="radio notice-not-required">

									    <label class="">

									      <input name="project_description" type="radio" value="Notice Not Required"  

									      <?php 

									      		if (isset($rows['project_description'])) {

									      			if ($rows['project_description'] == 'Notice Not Required') {

									      				echo 'checked="checked"';

									      			}else{

									      				echo '';

									      			}

									      		}

									      	?>>Notice Not Required

									    </label>

								    </div>

								</div>

							</div>

							<div class="row">

								<div class="col-sm-3">

									<div class="radio cdr">

									    <label class="">

									      <input name="project_description" type="radio" value="Completion Deposit Received:" 

									      <?php 

									      		if (isset($rows['project_description'])) {

									      			if ($rows['project_description'] == 'Completion Deposit Received:') {

									      				echo 'checked="checked"';

									      			}else{

									      				echo '';

									      			}

									      		}

									      	?>>Completion Deposit Received:

									    </label>

									    <div id="cdr">

									    	<div class="form-group">

												<label for="cdr-field">$</label>

												<input id="cdr-field" type="text"  name="deposit_received_amt"  class="form-control form-control__small" value="<?php echo isset($rows['deposit_received_amt']) ? $rows['deposit_received_amt'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

											</div>

									    </div>

								    </div>

								</div>

								<div class="col-sm-3">

									<div class="radio cdnr">

									    <label class="">

									      <input name="project_description" type="radio" value="Completion Deposit Not Received:" 

									      <?php 

									      		if (isset($rows['project_description'])) {

									      			if ($rows['project_description'] == 'Completion Deposit Not Received:') {

									      				echo 'checked="checked"';

									      			}else{

									      				echo '';

									      			}

									      		}

									      	?>>Completion Deposit Not Received:

									    </label>

								    </div>

								</div>

								<div class="clearfix col-sm-12 sectionhide" id="completion-section">

									<div class="row">

										<div class="col-sm-3">

											<div class="radio comp-dep-retrn">

											    <label class="">

											      <input name="project_description" type="radio" value="Completion Deposit Returned:" 

											      <?php 

											      		if (isset($rows['project_description'])) {

											      			if ($rows['project_description'] == 'Completion Deposit Returned:') {

											      				echo 'checked="checked"';

											      			}else{

											      				echo '';

											      			}

											      		}

											      	?>>Completion Deposit Returned:

											    </label>

											    <div id="comp-dep-retrn">

											    	<div class="form-group">

														<label for="comp-dep-retrn-field">Date</label>

														<input id="comp-dep-retrn-field" type="text"  name="deposit_returned_date"  class="form-control form-control__small datepicker" value="<?php echo isset($rows['deposit_returned_date']) ? $rows['deposit_returned_date'] : ''; ?>" <?php echo isset($rows['id']) ? 'readonly' : ''; ?>/>

													</div>

											    </div>

										    </div>

										</div>

										<div class="col-sm-3">

											<div class="radio comp-depnot-retrn">

											    <label class="">

											      <input name="project_description" type="radio" value="Completion Deposit Not Returned:" 

											      <?php 

											      		if (isset($rows['project_description'])) {

											      			if ($rows['project_description'] == 'Completion Deposit Not Returned:') {

											      				echo 'checked="checked"';

											      			}else{

											      				echo '';

											      			}

											      		}

											      	?>>Completion Deposit Not Returned:

											    </label>

											    <div id="comp-depnot-retrn">

											    	<div class="form-group">

														<label for="comp-depnot-retrn-field">Notes</label>

														<textarea id="comp-depnot-retrn-field" class="form-control form-control__small" name="deposit_not_returned_notes"></textarea>

													</div>

											    </div>

										    </div>

										</div>

									</div>

								</div>

							</div>

						</div>

						<div class="col-sm-12">

							<label for="finalinspectioncompleted">Final Inspection Completed:</label>

							<div class="form-group">

								<label for="ficdate">Date</label>

								<input id="ficdate" type="text"  name="project_completed_date"  class="form-control form-control__small datepicker" required="required" value="<?php echo isset($rows['project_completed_date']) ? $rows['project_completed_date'] : ''; ?>"/>

							</div>

						</div>

						<?php if (isset($rows['id'])): ?>

						<div class="col-sm-3">

							<div class="form-group">

								<input type="submit" name="submit" value="Update Changes" class="btn btn-primary">

							</div>

						</div>

						<div class="col-sm-3">

							<div class="form-group">

								<button class="btn btn-primary">Track Project</button>

							</div>

						</div>

						<div class="col-sm-3">

							<div class="form-group">

								<button class="btn btn-primary">Email Report</button>

							</div>

						</div>

						<div class="col-sm-3">

							<div class="form-group">

								<button class="btn btn-primary">Print Report</button>

							</div>

						</div>	

						<?php else: ?>						

						<div class="col-sm-3">

							<div class="form-group">

								<input type="submit" name="submit" value="Save" class="btn btn-primary">

							</div>

						</div>						

						<?php endif ?>

					</div>

					</form>

				</fieldset>

<?php require_once('includes/footer.php'); ?>