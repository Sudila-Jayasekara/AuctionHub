<?php 
	
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "auctionhub";

	$con = new mysqli($dbhost,$dbuser,$dbpass,$dbname);

	if($con->connect_error){
		die("Database Connection failed: " . $conn->connect_error);
	}else{
		//echo "Database Connection Successful";
	}
 ?>