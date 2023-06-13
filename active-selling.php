<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 

	$errors = array();
	if(isset($_POST['submit'])){
		$store_name = $con->real_escape_string($_POST['store_name']);
		$store_description= $con->real_escape_string($_POST['store_description']);
		$store_address = $con->real_escape_string($_POST['store_address']);

		//create new seller account
		$sql = "INSERT INTO seller(store_name, store_description ,store_address, user_id)
				VALUES('{$store_name}','{$store_description}','{$store_address}','{$_SESSION["user_id"]}')";
		$result = $con->query($sql);

		//update user table
		$sql = "UPDATE users SET is_seller=1";
		$result = $con->query($sql);	


		echo "<script>alert('Log again to use seller dashboad')</script>";


	}
		
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Bidder Dashboard</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?php require_once('inc/header.php')?>
	<div class="content">
		<div class="side-bar">
			<h3>Welcome <?php echo $_SESSION['first_name'];?></h3>
			<button class="btn">Bid History</button>
			<button>Watchlist</button>
			<a href="change-password.php"><button>Change Password</button></a>
			<hr>
			<button>Active Selling</button>
			<a href="logout.php"><button>Logout</button></a>

		</div>

		<div class="top-bar">
			<h3><a href="index.php">AuctionHub</a></h3>
			<h3> > </h3>
			<h3><a href="bidder-dashboard.php">Bidder Dashboard</a></h3>
			<h3> > </h3>
			<h3><a href="active-selling.php">Active Selling</a></h3>
		</div>
		<div class="container">
			<form class="register" action="active-selling.php" method="post">
				<fieldset>
						<h2>Do you want to sell items?</h2>
						<input type="text" name="store_name" placeholder="Store Name">
						<input type="text" name="store_description" placeholder="Store Description">
						<textarea name="store_address" placeholder="store_address"></textarea>
						<input type="submit" name="submit" value="Create Selling Account">
				</fieldset>
			</form>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>