<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Login Page</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<?php require 'inc/header.php'; ?>
</head>
<body>
	<div class="login">
		<form>
			<fieldset>
				<h2>Login to AuctionHub</h2>
				<input type="text" name="email" placeholder="Email Address">
				<input type="text" name="password" placeholder="Password">
				<input type="submit" name="login" value="Login">
			</fieldset>
		</form>
	</div> <!-- login -->
	<?php require 'inc/footer.php'; ?>
</body>
</html>