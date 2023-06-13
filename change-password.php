<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 

	$errors = array();
	if (isset($_SESSION['user_id'])) {
		$sql = "SELECT * FROM users WHERE user_id = {$_SESSION['user_id']}";
		$result = $con->query($sql);
		$row =$result->fetch_assoc();
	
		$oldPasswordDB = $row['password']; 
	}


	if(isset($_POST['update'])){
		$password = $_POST['password']; 
		$password2 = $_POST['password2']; 

		$currentPassword = $_POST['currentPassword'];
		$currentPassword = sha1($currentPassword);

		//checking required fields 
		$req_fields = array('currentPassword','password','password2');
		foreach ($req_fields as $fields) {
			if (empty(trim($_POST[$fields]))) {
				$errors[]= "$fields is required";
			}
		}

		//check current password 
		if($currentPassword!==$oldPasswordDB){
			$errors[] = "Wrong Old Password";
		}

		//check both password same or not
		if($password!==$password2){
			$errors[] = "Password not match";
		}

		if(empty($errors)){
			//sanitizing inputs
			$password = $con->real_escape_string($_POST['password']); 
			$hashed_password = sha1($password);
			
			//create database query
			//user index
			$sql = "UPDATE users SET
			password = '$hashed_password'
			WHERE user_id = '{$_SESSION['user_id']}'";
			$result = $con -> query($sql);
			header('Location:logout.php');
		}else{
			echo "<script>alert('{$errors[0]}')</script>";
			// foreach ($errors as $e ) {
			// 	echo "<script>alert('$e')</script>";
			// }
			echo "<script>history.back()</script>";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Change Password</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?php require_once('inc/header.php')?>
	<div class="content">
		<div class="side-bar">
			<?php 
				if($_SESSION['is_admin']==1 && $_SESSION['is_seller']==1 && $_SESSION['is_bidder']==1){
					require_once('inc/admin-side-bar.php');
				}else if($_SESSION['is_seller']==1 && $_SESSION['is_bidder']==1){
					require_once('inc/seller-side-bar.php');
				}else if($_SESSION['is_bidder']==1){
					require_once('inc/bidder-side-bar.php');
				}
			?>
		</div>

		<div class="top-bar">
			<h3><a href="index.php">AuctionHub</a></h3>
			<h3> > </h3>
			<?php 
				if($_SESSION['is_admin']==1 && $_SESSION['is_seller']==1 && $_SESSION['is_bidder']==1){
					echo "<h3><a href='admin-dashboard.php'>Admin Dashboard</a></h3>";
				}else if($_SESSION['is_seller']==1 && $_SESSION['is_bidder']==1){
					echo "<h3><a href='seller-dashboard.php'>Seller Dashboard</a></h3>";
				}else if($_SESSION['is_bidder']==1){
					echo "<h3><a href='bidder-dashboard.php'>Bidder Dashboard</a></h3>";
				}
			?>
			<h3> > </h3>
			<h3><a href="change-password.php">Change Password</a></h3>
		</div>
		<div class="container">
			<form class="register" action="change-password.php" method="post">
				<fieldset>
						<h2>Update details</h2>
						<input type="text" name="currentPassword" placeholder="Current Password">
						<input type="text" name="password" placeholder="New Password">
						<input type="text" name="password2" placeholder="Re-Enter New Password">
						<input type="submit" name="update" value="update">
				</fieldset>
			</form>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>