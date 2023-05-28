<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php 
	$errors = array();
	$first_name = ''; 
	$last_name = ''; 
	$email = '';
	$phone_number = ''; 
	$gender = ''; 
	$dob = ''; 
	$address = ''; 
	$password = ''; 
	$password2 = ''; 
	$privacy_checkbox = '';

	if (isset($_POST['register'])) {
		$first_name = $_POST['first_name']; 
		$last_name = $_POST['last_name']; 
		$email = $_POST['email'];
		$phone_number = $_POST['phone_number']; 
		$gender = $_POST['gender']; 
		$dob = $_POST['dob']; 
		$address = $_POST['address']; 
		$password = $_POST['password']; 
		$password2 = $_POST['password2']; 

		//checking required fields 
		$req_fields = array('first_name','last_name','email','phone_number','gender','dob','address','password','password2','privacy_checkbox');
		foreach ($req_fields as $fields) {
			if (empty(trim($_POST[$fields]))) {
				$errors[]= "$fields is required";
			}
		}

		//checking valid email
		if(!is_email($_POST['email'])){
			$errors[]= "email is not valid";
		}

		//checking email already exists on database
		$email = $con->real_escape_string($_POST['email']);  //sanitizing email 
		$sql = "SELECT * FROM user WHERE email = '{$email}' LIMIT 1";
		$result = $con->query($sql);
		if($result){
			if($result->num_rows == 1){
				$errors[]=  "Email Address already exists";
			}
		}
		//check phone number
		if(strlen($phone_number)>10 || strlen($phone_number)<10){
			$errors[]= "Invalid phone number";
		}

		//check both password same or not
		if($password!==$password2){
			$errors[] = "Password not match";
		}

		if(empty($errors)){
			//generate age
			$currentDate = date("Y-m-d");
			$currentTime = date("Y-m-d H:i:s");
			$dateDiff = date_diff(date_create($dob), date_create($currentDate));
			$age = $dateDiff->y;

			//sanitizing inputs
			$first_name = $con->real_escape_string($_POST['first_name']); 
			$last_name = $con->real_escape_string($_POST['last_name']); 

			//$email = $con->real_escape_string($_POST['email']);
			$phone_number = $con->real_escape_string($_POST['phone_number']); 
			$gender = $con->real_escape_string($_POST['gender']); 
			$dob = $con->real_escape_string($_POST['dob']); 
			$address = $con->real_escape_string($_POST['address']); 
			$password = $con->real_escape_string($_POST['password']); 
			$hashed_password = sha1($password);

			//create database query
			$sql = "INSERT INTO user(first_name,last_name,email,dob,age,gender,phone_number,address,hashed_password,is_bidder,registration_date)
					VALUES('{$first_name}','{$last_name}','{$email}','{$dob}','{$age}','{$gender}','{$phone_number}','{$address}','{$hashed_password}',1,'{$currentTime}')";
			$result = $con -> query($sql);
		}else {
			echo "<script>alert('{$errors[0]}')</script>";
			echo "<script>history.back()</script>";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register Page</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<?php require 'inc/header.php'; ?>
</head>
<body>
		<form class="register" action="register.php" method="post">
			<fieldset>
					<h2>Register to AuctionHub</h2>
					<div class="row">
						<div class="item left"><input type="text" name="first_name" placeholder="First Name"></div>
						<div class="item right"><input type="text" name="last_name" placeholder="Last Name"></div>
					</div>
					<input type="text" name="email" placeholder="Email Address">
					<div class="row">
						<div class="item left">
							<input type="text" name="phone_number" placeholder="Phone Number">
						</div>
						<div class="item right">
							<select name="gender">
							<option value="male">Male</option>
							<option value="female">Female</option>
							<option value="other">Other</option>
							</select>
						</div>
					</div>
					<div class="row-dob">
						<label for="dateInput">DOB:</label>
						<input type="date" name="dob">
					</div>
					<textarea name="address"  placeholder="Address"></textarea>
					<input type="text" name="password" placeholder="Password">
					<input type="text" name="password2" placeholder="Re-Enter Password">
					<div class="row-check">
						<div class="left">
						<input type="checkbox" name="privacy_checkbox">
						</div>
						<div class="right">
						<p>I have read and agree to the<a href="privacy_policy.html" target="_blank"> Privacy Policy</a> </p>
						</div>
					</div>
					<input type="submit" name="register" value="Register">
			</fieldset>
		</form>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>