<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>AuctionHub</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<?php require 'inc/header.php'; ?>
</head>
<body>
	<!-- <form class="login" action="login.php" method="post">
		<fieldset>
			<h2>Login to AuctionHub</h2>
			<input type="text" name="email" placeholder="Email Address">
			<input type="text" name="password" placeholder="Password">
			<input type="submit" name="login" value="Login">
		</fieldset>
	</form> -->



	<!-- <div class="content">
		<form class="side-bar"act ion="">
			<h3>Category</h3>
		</form>
		<div class=" ">
		<div class="top-bar">
			breadcrumb
		</div>
		</div>		
	</div> -->
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
			<div class="item">
				<div class="image">
					<img src="image/iphone2.jpg" alt="">	
				</div>
				<div class="info">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
					<div class="price">
						<h1>$100</h1>
						<p>Bids - 12</p>
					</div>
					<div class="btn-set">
						<button class="btn">Place a bid</button>
						<button class="btn2"><img src="image/heart.png" alt=""></button>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="image">
					<img src="image/iphone3.jpg" alt="">	
				</div>
				<div class="info">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
					<div class="price">
						<h1>$100</h1>
						<p>Bids - 12</p>
					</div>
					<div class="btn-set">
						<button class="btn">Place a bid</button>
						<button class="btn2"><img src="image/heart.png" alt=""></button>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="image">
					<img src="image/iphone.jpg" alt="">	
				</div>
				<div class="info">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
					<div class="price">
						<h1>$100</h1>
						<p>Bids - 12</p>
					</div>
					<div class="btn-set">
						<button class="btn">Place a bid</button>
						<button class="btn2"><img src="image/heart.png" alt=""></button>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="image">
					<img src="image/iphone5.jpg" alt="">	
				</div>
				<div class="info">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
					<div class="price">
						<h1>$100</h1>
						<p>Bids - 12</p>
					</div>
					<div class="btn-set">
						<button class="btn">Place a bid</button>
						<button class="btn2"><img src="image/heart.png" alt=""></button>
					</div>
				</div>
			</div>
			<div class="item">
				<div class="image">
					<img src="image/iphone4.jpg" alt="">	
				</div>
				<div class="info">
					<p>Lorem ipsum dolor sit amet consectetur adipisicing elit.Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
					<div class="price">
						<h1>$100</h1>
						<p>Bids - 12</p>
					</div>
					<div class="btn-set">
						<button class="btn">Place a bid</button>
						<button class="btn2"><img src="image/heart.png" alt=""></button>
					</div>
				</div>
			</div>
		</div>

		
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>