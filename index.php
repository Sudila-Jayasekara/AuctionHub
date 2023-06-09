<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 
	$item = '';

	$sql = "SELECT * FROM item";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()){
		$item.= "<div class='item'>";
		$item.=		"<div class='image'>";
		$item .= "<img src='image/item/{$row["image"]}'>";
		$item.=		"</div>";
		$item.=		"<div class='info'>";
		$item.=			"<p><b>{$row['item_name']} -</b> <br> {$row['item_description']}</p>";
		$item.=			"<div class='price'>";
		$item.=				"<h1>$ {$row['start_price']}</h1>";
		$item.=				"<p>Bids - {$row['numberOf_bids']}</p>";
		$item.=			"</div>";
		$item.=			"<div class='btn-set'>";
		$item.=				"<button class='btn'>Place a bid</button>";
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
			<h3>Category</h3>
			<p>abc</p>
			<p>abc</p>
		</div>

		<div class="top-bar">
			<h3>topbar</h3>
		</div>

		<div class="item-container">
			<?php echo $item ?>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>