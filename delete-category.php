<?php session_start(); ?>
<?php require_once('inc/config.php'); ?>
<?php require_once('inc/functions.php'); ?>
<?php require_once('inc/check-login.php'); ?>
<?php 
    $sql2 = "SELECT count(item_id) AS numberOf_items FROM item WHERE category_id={$_GET['category_id']} GROUP BY category_id";
        $result2 = $con->query($sql2);
        $row2 = $result2->fetch_assoc();

        if(isset($row2['numberOf_items'])){
            echo "<script>alert('you cannot delete Category with items')</script>";
            echo "<script>history.back()</script>";
        }else{
            $sql = "DELETE FROM category WHERE category_id={$_GET['category_id']}";
            $result = $con->query($sql);
            header('location:manage-category.php');
        }

?>
<?php $con->close(); ?>