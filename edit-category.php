<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 
	$errors = array();
	if(isset($_GET['category_id'])){
		$category_id = $_GET['category_id'];
		$sql = "SELECT * FROM category WHERE category_id={$category_id}";
		$result = $con->query($sql);
		$row = $result->fetch_assoc();

		$category_name = $row['category_name'];
		$category_description = $row['category_description'];
	}
	if (isset($_POST['submit'])) {
		$category_name = $_POST['category_name']; 
		$category_description = $_POST['category_description']; 

		//checking required fields 
		$req_fields = array('category_name','category_description');
		foreach ($req_fields as $fields) {
			if (empty(trim($_POST[$fields]))) {
				$errors[]= "$fields is required";
			}
		}
		
		if(empty($errors)){	
			//sanitizing inputs
			$category_name = $con->real_escape_string($_POST['category_name']); 
			$category_description = $con->real_escape_string($_POST['category_description']); 

			$sql = "UPDATE category SET category_name='{$category_name}',category_description='{$category_description}' WHERE category_id = {$_GET['category_id']}";
			$result = $con->query($sql);

			header('location:manage-category.php');

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
	<title>Add New Category</title>
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
			<?php 
				if($_SESSION['is_admin']==1 && $_SESSION['is_seller']==1 && $_SESSION['is_bidder']==1){
					echo "<h3><a href='admin-dashboard.php'>Admin Dashboard</a></h3>";
				}else if($_SESSION['is_seller']==1 && $_SESSION['is_bidder']==1){
					echo "<h3><a href='seller-dashboard.php'>Seller Dashboard</a></h3>";
				}else if($_SESSION['is_bidder']==1){
					echo "<h3><a href='bidder-dashboard.php'>Bidder Dashboard</a></h3>";
				}
			?>
			<h3> > </h3>
			<h3><a href="add-new-item.php">Add New Category</a></h3>
		</div>
		<div class="container">
			<form class="register" action="edit-category.php?category_id=<?php echo $category_id; ?>" method="post" enctype="multipart/form-data">
				<fieldset>
						<h2>Add New Category</h2>
						<input type="text" name = "category_name" value="<?php echo $category_name?>">
						<textarea name="category_description"><?php echo $category_description?></textarea>
						<input type="submit" name="submit" value="submit">
				</fieldset>
			</form>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>