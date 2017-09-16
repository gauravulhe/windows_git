<?php
	if(empty($_SESSION)) // if the session not yet started
	@session_start();
 	require_once('config/config.php');
	
	if (isset($_POST['submit'])) {
		$order_title = $_POST['order_title'];
		$order_no = $_POST['order_no'];
		$location = $_POST['location'];
		$user_email = trim($_POST['user_email']);
		$assigned_user_email = trim($_POST['assigned_user_email']);
		$other_email = trim($_POST['other_email']);
		$progress_notes = $_POST['progress_notes'];
		$to = trim($user_email.','.$assigned_user_email.','.$other_email);
		//$to = "gauravulhe8@gmail.com";
		$subject = "Project Progress Notes Details";

		$message = "
		<html>
			<head>
				<title>Project Progress Notes Details</title>
			</head>
			<body>
				<p>Project Progress Notes Details Are Given Below !</p>
				<table>
					<tr>
						<td><b>Order Title</b></td>
						<td> : </td>
						<td><a href='#'>".$order_title."</a></td>
					</tr>
					<tr>
						<td><b>Order No</b></td>
						<td> : </td>
						<td>".$order_no."</td>
					</tr>
					<tr>
						<td><b>Location</b></td>
						<td> : </td>
						<td>".$location."</td>
					</tr>
					<tr>
						<td valign='top'><b>Progress Notes</b></td>
						<td valign='top'> : </td>
						<td>".$progress_notes."</td>
					</tr>
				</table>
			</body>
		</html>
		";

		// Always set content-type when sending HTML email
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		// More headers
		$headers .= 'From: <gauravulhe24@gmail.com>' . "\r\n";
		//$headers .= 'Cc: myboss@example.com' . "\r\n";

		//mail($to,$subject,$message,$headers);
		if (mail($to,$subject,$message,$headers)) { ?>
			<script type="text/javascript">
				alert("Email Has Been Sent Successfully.");
				window.close();
			</script>		
		<?php }else{ ?>
			<script type="text/javascript">
				alert("Failed To Send Email. Please Try Again.");
				window.close();
			</script>		
		<?php } 
	}


	if (isset($_GET['proj_id'])) {
		$project_id = $_GET['proj_id'];
		$projectData = mysqli_fetch_array(mysqli_query($conn, "SELECT user_id,order_title,order_no,assign_by_user_id,location FROM module_workorder_maintenance_projects WHERE id = $project_id"));
		$user_id = $projectData['user_id'];
		$order_title = $projectData['order_title'];
		$order_no = $projectData['order_no'];
		$location = $projectData['location'];
		$assign_by_user_id = $projectData['assign_by_user_id'];

		$userEmail = mysqli_fetch_array(mysqli_query($conn, "SELECT email_address FROM user_emails WHERE user_id = $user_id"));
		$user_email = $userEmail['email_address'];

		$assignByUserEmail = mysqli_fetch_array(mysqli_query($conn, "SELECT DISTINCT email_address FROM user_emails WHERE user_id = $assign_by_user_id"));
		$assign_by_user_email = $assignByUserEmail['email_address'];
	}
?>
<?php require_once('includes/header.php'); ?>
	<fieldset>
		<legend>Send Progress Notes Email</legend>
		<form class="form" name="maintenance_progress_notes" method="POST" action="" enctype="multipart/form-data">
			<input type="hidden" name="order_title" value="<?php echo $order_title; ?>">
			<input type="hidden" name="order_no" value="<?php echo $order_no; ?>">
			<input type="hidden" name="location" value="<?php echo $location; ?>">
			<div class="row">
				<div class="col-sm-6">
					<div class="form-group">
					    <label for="orderdate">User Email</label>
					    <input type="text"  name="user_email" class="form-control" id="user_email" required="required" value="<?php echo $user_email; ?>"/>
					</div>
					<div class="form-group">
						<label for="orderhash">Assigned User Email</label>
					    <input type="text"  name="assigned_user_email" class="form-control" id="assigned_user_email" required="required" value="<?php echo $assign_by_user_email; ?>"/>
					</div>
					<div class="form-group">
						<label for="orderhash">Other Users Email ( Add ',' To Seprate Multiple Users)</label>
					    <input type="text"  name="other_email" class="form-control" id="other_email"/>
					</div>
					<div class="form-group">
						<label for="orderhash">Progress Notes</label><br>
						<textarea name="progress_notes" class="form-control" rows="10">
							<?php
								$progress_notes = mysqli_query($conn, "SELECT * FROM module_workorder_projects_progress_notes WHERE project_id = $project_id ORDER BY id DESC"); 
								while ($progressNotes = mysqli_fetch_array($progress_notes)) { ?>
								<?php echo $progressNotes['created'].' : '.$progressNotes['user_name'].' : '.$progressNotes['progress_note'].'<br>';  ?>

							<?php	} ?>
						</textarea>
					</div>
					<div class="form-group">
						<input type="submit" name="submit" value="Send Email" class="btn btn-primary">
					</div>
				</div>
			</div>
		</form>
	</fieldset>