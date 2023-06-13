<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>

<?php 
	$item = '';
	$sql = "SELECT * FROM users";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()){
		$item.="<tr>";
		$item.="<td>{$row['user_id']}</td>";
		$item.="<td>{$row['first_name']}</td>";
		$item.="<td>{$row['email']}</td>";
		$item.="<td>{$row['address']}</td>";
		$item.="<td>{$row['phone']}</td>";
		$item.="<td><a href='edit-category.php?user_id={$row['user_id']}'><button class='btnT'>waning</button></a> <a href='delete-category.php?user_id={$row['user_id']}'  onclick='return confirm(\"Are You sure to delete this category\")';> <button class='btnT'>suspend</button></a></td>";
		$item.="</tr>";
	}
?>
<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Users</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?php require_once('inc/header.php');?>
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
			<h3><a href="manage-category.php">Manage Users</a></h3>
		</div>
		<div class="container">
			<table class="item-list">
				<tr>
					<th>User Id</th>
					<th>First Name</th`>
					<th>Email</th`>
					<th>address</th`>
					<th>Phone</th`>
					<th>Edit or Delete</th>
				</tr>
				<?php echo $item;?>
			</table>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>