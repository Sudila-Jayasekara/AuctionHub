<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 
	$item = '';

	$sql = "SELECT * FROM item WHERE item_id IN (SELECT item_id FROM bidder_item WHERE bidder_id = '1' GROUP BY item_id) AND numberOf_bids>0";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()){
		$item.= "<div class='item'>";
		$item.=		"<div class='image'>";
		$item .= 		"<a href='item-details.php?item_id={$row['item_id']}'><img src='image/item/{$row["image"]}'></a>";
		$item.=		"</div>";
		$item.=		"<div class='info'>";
		$item.=			"<p><b>{$row['item_name']} -</b> <br> {$row['item_description']}</p>";
		$item.=			"<div class='price'>";
		$item.=				"<h1>$ {$row['price']}</h1>";
		$item.=				"<p>Bids - {$row['numberOf_bids']}</p>";
		$item.=			"</div>";
		$item.=			"<div class='btn-set'>";
		$item.=				"<a href='item-details.php?item_id={$row['item_id']}'><button class='btn'>Place a bid</button></a>";
		$item.=				"<button class='btn2'><img src='image/icons/heart.png'></button>";
		$item.=			"</div>";
		$item.=		"</div>";
		$item.=	"</div>";
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AuctionHub</title>
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
			<h3><a href="add-new-item.php">All bid items</a></h3>
		</div>

		<div class="item-container">
			<?php echo $item ?>
		</div>


	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>