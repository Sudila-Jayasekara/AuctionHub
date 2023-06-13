<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>

<?php 
	$item = '';
	$sql = "SELECT * FROM category";
	$result = $con->query($sql);
	while($row = $result->fetch_assoc()){
		$item.="<tr>";
		$item.="<td>{$row['category_id']}</td>";
		$item.="<td>{$row['category_name']}</td>";
		$item.="<td>{$row['category_description']}</td>";
		
		$sql2 = "SELECT count(item_id) AS numberOf_items FROM item WHERE category_id={$row['category_id']} GROUP BY category_id";
		$result2 = $con->query($sql2);
		$row2 = $result2->fetch_assoc();
		
		if(isset($row2['numberOf_items'])){
			$item.="<td>{$row2['numberOf_items']}</td>";
		}else{
			$item.="<td> 0 </td>";
		}
		$item.="<td><a href='edit-category.php?category_id={$row['category_id']}'><button class='btnT'>Edit</button></a> <a href='delete-category.php?category_id={$row['category_id']}'  onclick='return confirm(\"Are You sure to delete this category\")';> <button class='btnT'>Delete</button></a></td>";
		
		$item.="</tr>";
	}
?>
<!DOCTYPE html>
<html> 
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Manage Items</title>
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
			<h3><a href="manage-category.php">Manage Items</a></h3>
		</div>
		<div class="container">
			<table class="item-list">
				<tr>
					<th>Category id</th>
					<th>Category Name</th`>
					<th>Category Description</th`>
					<th>Items</th`>
					<th>Manage</th>
				</tr>
				<?php echo $item;?>
				<tr>
					<td><a href="add-new-category.php"><button class='btnT' >Add New Category</button></a></td>
				</tr>
				
			</table>
		</div>
	<?php require 'inc/footer.php'; ?>
</body>
</html>
<?php $con->close(); ?>