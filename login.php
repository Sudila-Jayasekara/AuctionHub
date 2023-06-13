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

			$sql = "SELECT * FROM users WHERE email='{$email}' and password ='{$hashed_password}' LIMIT 1";
			$result = $con->query($sql);
			

			//check database query failed  -- -- -- 

			if($result->num_rows == 1){
				//valid user found
				$row = $result->fetch_assoc();
				$_SESSION['user_id'] = $row['user_id'];
				$_SESSION['first_name'] = $row['first_name'];

				if($row['is_bidder'] == 1 && $row['is_seller']==1 &&$row['is_admin']==1){
					$_SESSION['is_bidder'] = 1;
					$_SESSION['is_seller'] = 1;
					$_SESSION['is_admin'] = 1;

					// get bidder id
					$sql1 = "SELECT bidder_id FROM bidder WHERE user_id = '{$row['user_id']}' ";
					$result1 = $con->query($sql1);
					$row1 = $result1->fetch_assoc();
					$_SESSION['bidder_id'] = $row1['bidder_id'];
					
					//get seller id
					$sql2 = "SELECT seller_id FROM seller WHERE user_id = '{$row['user_id']}' ";
					$result2 = $con->query($sql2);
					$row2 = $result2->fetch_assoc();
					$_SESSION['seller_id'] = $row2['seller_id'];

					//get admin id
					$sql3 = "SELECT admin_id FROM admin WHERE user_id = '{$row['user_id']}' ";
					$result3 = $con->query($sql3);
					$row3 = $result3->fetch_assoc();
					$_SESSION['admin_id'] = $row3['admin_id'];

					echo $_SESSION['admin_id'];
					echo $_SESSION['seller_id'];
					echo $_SESSION['bidder_id'];

					
				}else if($row['is_bidder'] == 1 && $row['is_seller']==1){
					$_SESSION['is_bidder'] = 1;
					$_SESSION['is_seller'] = 1;
					$_SESSION['is_admin'] = 0;

					// get bidder id
					$sql1 = "SELECT bidder_id FROM bidder WHERE user_id = '{$row['user_id']}' ";
					$result1 = $con->query($sql1);
					$row1 = $result1->fetch_assoc();
					$_SESSION['bidder_id'] = $row1['bidder_id'];
					
					//get seller id
					$sql2 = "SELECT seller_id FROM seller WHERE user_id = '{$row['user_id']}' ";
					$result2 = $con->query($sql2);
					$row2 = $result2->fetch_assoc();
					$_SESSION['seller_id'] = $row2['seller_id'];

					echo $_SESSION['seller_id'];
					echo $_SESSION['bidder_id'];
				}else{
					$_SESSION['is_bidder'] = 1;
					$_SESSION['is_seller'] = 0;
					$_SESSION['is_admin'] = 0;
					
					//get bidder id
					$sql1 = "SELECT bidder_id FROM bidder WHERE user_id = '{$row['user_id']}' ";
					$result1 = $con->query($sql1);
					$row1 = $result1->fetch_assoc();
					$_SESSION['bidder_id'] = $row1['bidder_id'];

					
					echo $_SESSION['bidder_id'];
				}
				header('Location:index.php');

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
</head>
<body>
	<?php require_once 'inc/guest-header.php'; ?>
	<form class="login" action="login.php" method="post">
		<fieldset>
			<h2>Login to AuctionHub</h2>
			<input type="text" name="email" placeholder="Email Address">
			<input type="text" name="password" placeholder="Password">
			<input type="submit" name="login" value="Login">
		</fieldset>
	</form>
	<?php require_once 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>