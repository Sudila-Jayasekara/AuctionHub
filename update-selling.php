<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 
	if(isset($_SESSION['seller_id'])){
		$sql = "SELECT * FROM seller WHERE seller_id={$_SESSION['seller_id']}";
		$result = $con->query($sql);
		$row = $result->fetch_assoc();
		$store_name = $row['store_name'];
		$store_description = $row['store_description'];
		$store_address = $row['store_address'];
	}
?>
<?php 

	$errors = array();
	if(isset($_POST['update'])){
		$store_name = $con->real_escape_string($_POST['store_name']);
		$store_description= $con->real_escape_string($_POST['store_description']);
		$store_address = $con->real_escape_string($_POST['store_address']);

		//update store details
		$sql = "UPDATE seller SET store_name = '{$store_name}', store_description = '{$store_description}', store_address = '{$store_address}' WHERE seller_id= '{$_SESSION['seller_id']}'";
		$result = $con->query($sql);
	}
		
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Update store details</title>
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
			<h3><a href="update-selling.php">Update Store details</a></h3>
		</div>
		<div class="container">
			<form class="register" action="update-selling.php" method="post">
				<fieldset>
						<h2>Update Store details</h2>
						<input type="text" name="store_name"  value="<?php echo $store_name ?>">
						<input type="text" name="store_description"  value="<?php echo $store_description ?>">
						<textarea name="store_address"><?php echo $store_address ?></textarea>
						<input type="submit" name="update" value="update">
				</fieldset>
			</form>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>