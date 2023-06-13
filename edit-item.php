<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 
	$errors = array();
	if(isset($_GET['item_id'])){
		$sql = "SELECT * FROM item WHERE item_id = {$_GET['item_id']} ";
		$result = $con->query($sql);
		$row = $result->fetch_assoc();
		if($row['numberOf_bids']>0){
			echo "<script>alert('You can not edit item details after start bidding')</script>";
			echo "<script>history.back()</script>";
		}
		$item_id = $_GET['item_id'];
		$item_name = $row['item_name']; 
		$item_description = $row['item_description']; 
		$price = $row['price'];
		$end_date = $row['end_date'];
		$category_id = $row['category_id'];
	
	}
	if (isset($_POST['Submit'])) {
		$item_name = $_POST['item_name']; 
		$item_description = $_POST['item_description']; 
		$price = $_POST['price'];
		$end_date = $_POST['end_date'];
		$category_id = $_POST['category_id'];

		//path to store the uploaded image
		$target = "image/item/".basename($_FILES['image']['name']);
		$image = $_FILES['image']['name'];

		//checking required fields 
		$req_fields = array('item_name','item_description','price','end_date','category_id');
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
			$price = $con->real_escape_string($_POST['price']); 
			$end_date = $con->real_escape_string($_POST['end_date']); 
			$category_id = $con->real_escape_string($_POST['category_id']); 


			//create database query
			//user index`
			// $sql = "INSERT INTO item(item_name,item_description,image,numberOf_bids,price,end_date,is_reported,seller_id,category_id)
			// 		VALUES('{$item_name}','{$item_description}','{$image}',1,'{$price}','{$end_date}',0,'{$_SESSION['seller_id']}','{$category_id}')";
			
			$sql = "UPDATE item SET item_name='{$item_name}',item_description='{$item_description}',image='{$image}',price='{$price}',end_date='{$end_date}',category_id='{$category_id}' WHERE item_id={$_GET['item_id']}";
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
<?php 
	//category 
	$category='';
	$sql = "SELECT * FROM category";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()){
		$category.="<option value={$row['category_id']}>{$row['category_id']} - {$row['category_name']}</option>";
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
			<h3><a href="Seller-dashboard.php">Seller Dashboard</a></h3>
			<h3> > </h3>
			<h3><a href="add-new-item.php">Add New Item</a></h3>
		</div>
		<div class="container">
			<form class="register" action="edit-item.php?item_id=<?php echo $item_id;?>" method="post" enctype="multipart/form-data">
				<fieldset>
						<h2>Edit Item details</h2>
						<input type="text" name = "item_name" value="<?php echo $item_name?>">
						<textarea name="item_description"  placeholder="item_description"><?php echo $item_description?></textarea>
						<div class="row">
						<div class="item left"><input type="file" name="image"></div>
						<div class="item right">
							<select name="category_id">
							<option value="default" selected disabled>Select Category</option>
							<?php echo "$category"?>
							</select>
						</div>
						</div>
						
						<input type="text" name = "price" value="<?php echo $price?>">
						<label for="date">End date</label>
						<input type="date" name="end_date" value="<?php echo $end_date?>">
						<input type="submit" name="Submit" value="Update Item details">
				</fieldset>
			</form>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>