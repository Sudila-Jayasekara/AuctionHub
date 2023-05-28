<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php 
	$errors = array();
	$email = '';
	$password = '';

	if (isset($_POST['login'])) {
		$email = $_POST['email'];
		$password = $_POST['password'];

		//checking required fields 
		$req_fields = array('email','password');
		foreach ($req_fields as $fields ) {
			if (empty(trim($_POST[$fields]))) {
				$errors[]= "$fields is required";
			}
		}

		//checking valid email
		if(!is_email($_POST['email'])){
			$errors[]= "email is not valid";
		}

		if(empty($errors)){
			$email = $con->real_escape_string($_POST['email']);
			$password = $con->real_escape_string($_POST['password']);
			$hashed_password = sha1($password);

			$sql = "SELECT * FROM user WHERE email='{$email}' and hashed_password ='{$hashed_password}' LIMIT 1";
			$result = $con->query($sql);

			//check database query failed  -- -- -- 

			if($result->num_rows == 1){
				//valid user found
				$row = $result->fetch_assoc();

				//header
			}else {
				$errors[]= "Wrong email or Password";
				echo "<script>alert('{$errors[0]}')</script>";
			}

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
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<?php require 'inc/header.php'; ?>
</head>
<body>
	<form class="login" action="login.php" method="post">
		<fieldset>
			<h2>Login to AuctionHub</h2>
			<input type="text" name="email" placeholder="Email Address">
			<input type="text" name="password" placeholder="Password">
			<input type="submit" name="login" value="Login">
		</fieldset>
	</form>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>