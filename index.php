<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 
	if(isset($_GET['category_id'])){
		$item = '';
		$sql = "SELECT * FROM item WHERE category_id={$_GET['category_id']} order by item_id desc";
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
	}else if(isset($_GET['search'])){
		$item = '';
		$search = $con -> real_escape_String($_GET['search']);
		$sql = "SELECT * FROM item WHERE (item_name LIKE '%{$search}%') ";
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
	}	
	
	else{
		$item = '';
		$sql = "SELECT * FROM item order by item_id desc";
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
	}
?>





<?php 
	$category = '';

	$sql = "SELECT * FROM category";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()){
		$category.= "<p><a href='index.php?category_id={$row['category_id']}'>{$row['category_name']}</a></p>";
		$category.= "<br>";
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
			<?php echo $category ?>
		</div>
		<div class="top-bar">
			<a href="index.php"><h3>All Items</h3></a>
			<h3>
				<?php 
					if(isset($_GET['category_id'])){
						$sql = "SELECT * FROM category WHERE category_id={$_GET['category_id']}";
						$result = $con->query($sql);
						$row = $result->fetch_assoc();
						echo " > {$row['category_name']}";
					}
				?>
			</h3>
		</div>

		<div class="item-container">
			<?php echo $item ?>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>