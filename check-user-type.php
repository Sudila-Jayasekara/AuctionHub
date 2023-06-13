<?php session_start(); ?>
<?php 
	if($_SESSION['is_bidder']==1 && $_SESSION['is_seller']==1 && $_SESSION['is_admin']==1){
		header('Location:admin-dashboard.php');
	}else if($_SESSION['is_bidder']==1 && $_SESSION['is_seller']==1){
		header('Location:seller-dashboard.php');
	}else if($_SESSION['is_bidder']==1){
		header('Location:bidder-dashboard.php');
	}
?>