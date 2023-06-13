<?php session_start(); ?>
<?php require_once('inc/config.php')?>

<?php 
	if(isset($_POST["place_bid"])){
		$bid_value = $con->real_escape_string($_POST['bid_value']);
		$item_id = $con->real_escape_string($_GET['item_id']);
		$bidder_id = $con->real_escape_string($_SESSION['bidder_id']);

		//check new bid value is greater than last bid value or not
		$sql3 = "SELECT * from item WHERE item_id = '{$item_id}'";
		$result3 = $con -> query($sql3);
		$row = $result3->fetch_assoc();
		$last_bid = $row['price'];

		if($bid_value>$last_bid){
			//insertto bidder_item table
			$sql1 = "INSERT INTO bidder_item(bidder_id, item_id, bid_value) VALUES('{$bidder_id}','{$item_id}','{$bid_value}')";
			$result1 = $con -> query($sql1);

			//update item table price
			$sql2 = "UPDATE item SET price = '{$bid_value}' WHERE item_id = '{$item_id}'";
			$result2 = $con -> query($sql2);

			//increase number of bids by 1
			$numberOf_bids = $row['numberOf_bids'];
			$NewNumberOf_bids = $numberOf_bids+1;

			//update item table number of bids
			$sql4 = "UPDATE item SET numberOf_Bids = '{$NewNumberOf_bids}' WHERE item_id = '{$item_id}'";
			$result4 = $con -> query($sql4);

			if(!$result1||!$result2||!$result4){
				echo "Insert fails";
			}else{
				header("Location:item-details.php?item_id=$item_id");
			}

		} else{
			echo "<script>alert('Value Must be larger than Old bid value')</script>";
			echo "<script>history.back()</script>";
		}

		
	}
 ?>
 <?php $con->close(); ?>