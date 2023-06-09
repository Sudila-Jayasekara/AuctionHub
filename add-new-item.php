<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 
	$errors = array();
	$item_name = ''; 
	$item_description = ''; 
	$start_price = '';
	$end_date = '';

	if (isset($_POST['Submit'])) {
		$item_name = $_POST['item_name']; 
		$item_description = $_POST['item_description']; 
		$start_price = $_POST['start_price'];
		$end_date = $_POST['end_date'];

		//path to store the uploaded image
		$target = "image/item/".basename($_FILES['image']['name']);
		$image = $_FILES['image']['name'];

		//checking required fields 
		$req_fields = array('item_name','item_description','start_price','end_date');
		foreach ($req_fields as $fields) {
			if (empty(trim($_POST[$fields]))) {
				$errors[]= "$fields is required";
			}
		}
		
		if(empty($errors)){	

			//sanitizing inputs
			$item_name = $con->real_escape_string($_POST['item_name']); 
			$item_description = $con->real_escape_string($_POST['item_description']); 
			// $image = $con->real_escape_string($_POST['image']); 
			$start_price = $con->real_escape_string($_POST['start_price']); 
			$end_date = $con->real_escape_string($_POST['end_date']); 


			//create database query
			//user index`
			$sql = "INSERT INTO item(item_name,item_description,image,numberOf_bids,start_price,end_date,is_reported,seller_id,category_id)
					VALUES('{$item_name}','{$item_description}','{$image}',0,'{$start_price}','{$end_date}',0,1,1)";
			$result = $con -> query($sql);

			if(move_uploaded_file($_FILES['image']['tmp_name'],$target)){
				echo "Image uploaded Successfully";
			}else{
				echo "There was a problem";
			}
		}else {
			echo "<script>alert('{$errors[0]}')</script>";
			echo "<script>history.back()</script>";
		}
	}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add New Item</title>
	<link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
	<?php require_once('inc/header.php');?>
	<div class="content">
		<div class="side-bar">
			<h3>Welcome <?php echo $_SESSION['first_name'];?></h3>
			<button class="btn">Bid History</button>
			<button>Watchlist</button>
			<button>Change Password</button>
			<hr>
			<button><a href="add-new-item.php">Add New Item</a></button>
			<button>Manage Item</button>
			<hr>
			<button>Deactive Selling</button>
			<button>Logout</button>
		</div>

		<div class="top-bar">
			<h3><a href="index.php">AuctionHub</a></h3>
			<h3> > </h3>
			<h3><a href="Seller-dashboard.php">Seller Dashboard</a></h3>
			<h3> > </h3>
			<h3><a href="add-new-item.php">Add New Item</a></h3>
		</div>
		<div class="container">
			<form class="register" action="add-new-item.php" method="post" enctype="multipart/form-data">
				<fieldset>
						<h2>Add New Item</h2>
						<input type="text" name = "item_name" placeholder = "item_name">
						<textarea name="item_description"  placeholder="item_description"></textarea>
						<input type="file" name="image">
						<input type="text" name = "start_price" placeholder = "start_price">
						<label for="date">End date</label>
						<input type="date" name="end_date">
						<input type="submit" name="Submit" value="Submit">
				</fieldset>
			</form>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>