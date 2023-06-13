<?php 
$search ='';
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
	<header>
		<div class="logo"><h1><a href="index.php">AuctionHub</a></h1></div>
		<div class="search">
			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
			<input type="text" name="search" placeholder = "Press Enter for search "value="<?php echo $search; ?>" class="m-item">
			</form>
			<img src="image/icons/loupe.png"class="m-item">
			<img src="image/icons/cart.png"class="m-item">
			<img src="image/icons/notification.png"class="m-item">
		</div>
		<div class="user">
			<div class="img"><a href="check-user-type.php"><img src="image/icons/user.png" alt=""></a></div>
			<div><a href="check-user-type.php"><?php echo $_SESSION['first_name']; ?></a></div>
		</div>
	</header>
</body>
</html>