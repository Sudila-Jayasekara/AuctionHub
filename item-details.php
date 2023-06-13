<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 
	//get category details
	$category = '';
	$item_id = $_GET['item_id'];
	$sql = "SELECT * FROM category";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()){
		$category.= "<p><a href='index.php?category_id={$row['category_id']}'>{$row['category_name']}</a></p>";
		$category.= "<br>";
	}

	//get item details
	$sql = "SELECT * FROM item WHERE item_id={$_GET['item_id']}";
	$result = $con->query($sql);
	$item = $result->fetch_assoc();
	
	//get seller Name
	$sql = "SELECT first_name
			FROM users
			WHERE user_id = (SELECT s.user_id FROM item i, seller s WHERE i.seller_id = s.seller_id AND i.item_id={$_GET['item_id']}) ";
	$result = $con->query($sql);
	$user = $result ->fetch_assoc();

	//get store details
	$sql = "SELECT * FROM seller s, item i WHERE i.seller_id = s.seller_id AND i.item_id={$_GET['item_id']}";
	$result = $con->query($sql);
	$seller = $result ->fetch_assoc();

	//get started bid value
	$sql = "SELECT MIN(bid_value) AS min_bid
	FROM bidder_item 
	WHERE item_id={$_GET['item_id']}";
	$result = $con->query($sql);
	$bid = $result ->fetch_assoc();
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Item details</title>
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
			<h3><a href="index.php">AuctionHub</a></h3>
			<h3>></h3>
			<h3>Category Name</h3>
			<h3>></h3>
			<h3>Item</h3>
		</div>
		<div class="item-details">
			<div class="img-left">
				<?php echo "<img src='image/item/{$item["image"]}'>";?>
				<h3>Seller: <?php echo "{$user['first_name']}";?></h3>
				<h3>Store Name: <?php echo "{$seller['store_name']}";?></h3>
				<h3>Store Description: <?php echo "{$seller['store_description']}";?></h3>
			</div>
			<div class="details-right">
				<h1><?php echo "{$item['item_name']}";?></h1>
				<h3><?php echo "{$item['item_description']}";?></h3>
				<hr>
				<h4>Starting Price: $<?php echo "{$bid['min_bid']}";?></h4>
				<h4>Last Bid Value: <h1>$<?php echo "{$item['price']}";?></h1></h4>
				<h4>bids: <?php echo "{$item['numberOf_bids']}";?></h4>
				<h4 class="timer">Time left: </h4>
				<h4 class="timer" id="timer"></h4>
				<script>
		
					var deadline = new Date("<?php echo $item['end_date']; ?>").getTime();
					var countdown = setInterval(function() {
					var now = new Date().getTime();

					var timeRemaining = deadline - now;

					var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
					var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
					var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
					var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

					document.getElementById("timer").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s";

					if (timeRemaining < 0) {
						clearInterval(countdown);
						document.getElementById("timer").innerHTML = "Auction has ended!";
					}
					}, 1000);
				</script>
				<hr>
				<div class='btn-set'>
				<form action="update-bid-value.php?item_id=<?php echo $_GET['item_id']; ?>" method="post">
					<input type="text" name="bid_value" id="bid_value" placeholder = "Input Value to bid">
					<input type="submit" name="place_bid" class='btn1'>
				</form>
				<button class='btn2'>Add to Watchlist</button>
				</div>
			</div>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>