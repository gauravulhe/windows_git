<?php
	if(empty($_SESSION)) // if the session not yet started
	@session_start();
 	require_once('config/config.php');
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
	//$to = $user_email.','.$assign_by_user_email;
	$to = "gauravulhe8@gmail.com";
	$subject = "Project Details";

	$message = "
	<html>
	<head>
	<title>Project Details</title>
	</head>
	<body>
	<p>Project Details Are Given Below !</p>
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
			alert("Alert Email Has Been Sent Successfully.");
			window.close();
		</script>		
	<?php }else{ ?>
		<script type="text/javascript">
			alert("Failed To Send Alert Email. Please Try Again.");
			window.close();
		</script>		
	<?php }
?>
<!-- <script type="text/javascript">
	// Your application has indicated there's an error
    window.setTimeout(function(){

        // Move to a new location or you can do something else
        window.location.href = "maintenance.php";

    }, 5000);
</script> -->