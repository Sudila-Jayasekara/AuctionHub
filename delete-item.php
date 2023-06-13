<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 
    $sql1 = "SELECT *FROM item WHERE item_id={$_GET['item_id']}";
    $result1 = $con->query($sql1);
    $row1 = $result1->fetch_assoc();

    if($row1['numberOf_bids']==0){
        $sql = "DELETE FROM bidder_item WHERE item_id={$_GET['item_id']}";
        $result = $con->query($sql);

        $sql = "DELETE FROM item WHERE item_id={$_GET['item_id']}";
        $result = $con->query($sql);
        
        header('location:manage-item.php');
    } else{
        echo "<script>alert('you cannot delete items after starting bidding')</script>";
        echo "<script>history.back()</script>";
    }

?>
<?php $con->close(); ?>