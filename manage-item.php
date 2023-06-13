<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 
	//get item details to table
	$item = '';
	$sql = "SELECT * FROM item WHERE seller_id = {$_SESSION['seller_id']}";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()){
		$item.="<tr>";
		$item.="<td>{$row['item_name']}</td>";
		$item.="<td>{$row['item_description']}</td>";
			$sql1 = "SELECT category_name FROM category WHERE category_id={$row['category_id']}";
			$result1 = $con->query($sql1);
			$row1 = $result1->fetch_assoc();
		$item.="<td>{$row1['category_name']}</td>";
		$item.="<td>{$row['numberOf_bids']}</td>";
		$item.="<td>$ {$row['price']}</td>";

		date_default_timezone_set('Asia/Kolkata');
		$deadline = new DateTime($row['end_date']);
		$current_time = new DateTime();
		
		if($current_time > $deadline){
			$sql2 = "SELECT first_name FROM users WHERE user_id = (SELECT bidder_id FROM bidder_item WHERE item_id ={$row['item_id']} ORDER BY bid_value DESC LIMIT 1)";
			$result2 = $con->query($sql2);
			$row2 = $result2->fetch_assoc();
			if($row['numberOf_bids']>0){
				$item.="<td>{$row2['first_name']}</td>";
			}else{
				$item.="<td>Not selled</td>";
			}
		}else{
			$item.="<td>-</td>";
		}
		
		$item.="<td><a href='edit-item.php?item_id={$row['item_id']}'><button class='btnT'>Edit</button></a> <a href='delete-item.php?item_id={$row['item_id']}'  onclick='return confirm(\"Are You sure to delete this item\")';> <button class='btnT'>Delete</button></a></td>";
		$item.="</tr>";
	}
?>
<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Items</title>
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
			<h3><a href="manage-item.php">Manage Items</a></h3>
		</div>
		<div class="container">
			<table class="item-list">
				<tr>
					<th>Item Name</th>
					<th>Item Description</th>
					<th>Category</th>
					<th>bids</th>
					<th>Current price</th>
					<th>Winner</th>
					<th>Edit or Delete</th>
				</tr>
				<?php echo $item;?>
			</table>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>