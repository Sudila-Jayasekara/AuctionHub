<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register Page</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<?php require 'inc/header.php'; ?>
</head>
<body>
		<form class="register">
			<fieldset>
					<h2>Register to AuctionHub</h2>
					<div class="row">
						<div class="item left"><input type="text" name="firstName" placeholder="First Name"></div>
						<div class="item right"><input type="text" name="lastName" placeholder="Last Name"></div>
					</div>
					<input type="text" name="email" placeholder="Email Address">
					<div class="row">
						<div class="item left">
							<input type="text" name="phone" placeholder="Phone Number">
							<!-- 
							 -->
						</div>
						<div class="item right">
							<select name="gender">
							<option value="male">Male</option>
							<option value="female">Female</option>
							<option value="other">Other</option>
							</select>
						</div>
					</div>
					<div class="row-dob">
						<label for="dateInput">DOB:</label>
						<input type="date" id="dateInput">
					</div>
					<textarea id="address" name="address"  placeholder="Address"></textarea>
					<input type="text" name="password" placeholder="Password">
					<input type="text" name="password2" placeholder="Re-Enter Password">
					<div class="row-check">
						<div class="left">
						<input type="checkbox" id="privacyCheckbox" required>
						</div>
						<div class="right">
						<p>I have read and agree to the<a href="privacy_policy.html" target="_blank"> Privacy Policy</a> </p>
						</div>
					</div>
					<input type="submit" name="register" value="Register">
			</fieldset>
		</form>
	<?php require 'inc/footer.php'; ?>
</body>
</html>