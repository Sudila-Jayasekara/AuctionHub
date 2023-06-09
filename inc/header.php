<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<header>
		<div class="logo"><h1><a href="index.php">AuctionHub</a></h1></div>
		<div class="search">
			<input type="text" name="" placeholder="Search" class="m-item">
			<img src="image/icons/loupe.png"class="m-item">
			<img src="image/icons/cart.png"class="m-item">
			<img src="image/icons/notification.png"class="m-item">
		</div>
		<div class="user">
			<div class="img"><a href="bidder-dashboard.php"><img src="image/icons/user.png" alt=""></a></div>
			<div><a href="bidder-dashboard.php"><?php echo $_SESSION['first_name']; ?></a></div>
		</div>
	</header>
</body>
</html>