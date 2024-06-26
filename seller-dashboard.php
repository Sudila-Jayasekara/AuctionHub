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
	
		$first_name = $row['first_name']; 
		$last_name = $row['last_name']; 
		$email = $row['email'];
		$phone = $row['phone']; 
		$gender = $row['gender']; 
		$dob = $row['dob'];
		$address = $row['address']; 
		$password = $row['password']; 
	}
	if (isset($_SESSION['seller_id'])) {
		$sql = "SELECT * FROM seller WHERE seller_id = {$_SESSION['seller_id']}";
		$result = $con->query($sql);
		$row =$result->fetch_assoc();
	
		$store_name = $row['store_name']; 
		$store_description = $row['store_description']; 
		$store_address = $row['store_address'];
		
	}	


	if(isset($_POST['update'])){
		$first_name = $_POST['first_name']; 
		$last_name = $_POST['last_name']; 
		$email = $_POST['email'];
		$phone = $_POST['phone']; 
		$gender = $_POST['gender']; 
		$dob = $_POST['dob'];
		$address = $_POST['address']; 

		//checking required fields 
		$req_fields = array('first_name','last_name','email','phone','gender','dob','address');
		foreach ($req_fields as $fields) {
			if (empty(trim($_POST[$fields]))) {
				$errors[]= "$fields is required";
			}
		}

		//checking valid email
		if(!is_email($_POST['email'])){
			$errors[]= "email is not valid";
		}

		//check phone number
		if(strlen($phone)>10 || strlen($phone)<10){
			$errors[]= "Invalid phone number";
		}


		if(empty($errors)){
			//sanitizing inputs
			$first_name = $con->real_escape_string($_POST['first_name']); 
			$last_name = $con->real_escape_string($_POST['last_name']); 

			//$email = $con->real_escape_string($_POST['email']);
			$phone = $con->real_escape_string($_POST['phone']); 
			$gender = $con->real_escape_string($_POST['gender']); 
			$dob = $con->real_escape_string($_POST['dob']); 
			$address = $con->real_escape_string($_POST['address']); 

			
			//create database query
			//user index
			$sql = "UPDATE users SET
			first_name = '$first_name',
			last_name = '$last_name',
			email = '$email',
			dob = '$dob',
			gender = '$gender',
			phone = '$phone',
			address = '$address'
			WHERE user_id = '{$_SESSION['user_id']}'";
			$result = $con -> query($sql);

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
	<title>Seller Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?php require_once('inc/header.php')?>
	<div class="content">
		<div class="side-bar">
			<?php require_once('inc/seller-side-bar.php')?>
		</div>	
		<div class="top-bar">
			<h3><a href="index.php">AuctionHub</a></h3>
			<h3> > </h3>
			<h3><a href="Seller-dashboard.php">Seller Dashboard</a></h3>
		</div>
		<div class="container">
			<form class="register" action="seller-dashboard.php" method="post">
				<fieldset>
						<h2>Update details</h2>
						<div class="row">
							<div class="item left"><input type="text" name="first_name" value="<?php echo $first_name ?>"></div>
							<div class="item right"><input type="text" name="last_name" value="<?php echo $last_name ?>"></div>
						</div>
						<input type="text" name="email" value="<?php echo $email ?>">
						<div class="row">
							<div class="item left">
								<input type="text" name="phone" value="<?php echo $phone	 ?>">
							</div>
							<div class="item right">
								<select name="gender">
								<option value="gender" selected disabled>Select gender</option>
								<option value="male"  >Male</option>
								<option value="female" >Female</option>
								<option value="other">Other</option>
								</select>
							</div>
						</div>
						<div class="row-dob">
						<label for="dateInput">DOB:</label>
						<input type="date" name="dob" value="<?php echo $dob ?>">
						</div>	
						<textarea name="address"><?php echo $address ?></textarea>
						<input type="submit" name="update" value="update">
				</fieldset>
			</form>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>