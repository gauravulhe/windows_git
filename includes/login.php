<?php 
	
	if(empty($_SESSION)) // if the session not yet started
	session_start();
	require_once('../config/config.php');
	if (isset($_POST['submit'])) {
		$uname = $_POST['username'];
		$pass = $_POST['password'];

		$sql = "SELECT * FROM users WHERE username = '".$uname."' AND password = '".$pass."'";
		$result = mysqli_query($conn, $sql);
		$rows = mysqli_fetch_array($result);
		//print_r($rows);echo $rows['user_id'];
		if (!empty($rows['user_id'])) {
			$_SESSION['uid'] = $rows['user_id'];
			$_SESSION['uname'] = $rows['name_first'].' '.$rows['name_last'];
			header("Location:../dashboard.php");
		}else{
			echo "Invalid Username Or Password. Try Again.";
		}
	}
?>