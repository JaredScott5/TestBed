<?php
session_start();
include_once 'dbconnect.php';

//first check that the order exists and is STILL 'In Cart'
$orderQuery = $MySQLi_CON->query(
    "SELECT *
    FROM orders
    WHERE orderNumber='$order_number' AND status='In Cart'"
  );
  
  if($MySQLi_CON->query($orderQuery) === true){
	  //change 'status' to 'Shipped'
	  $updatedOrderQuery = 
	  "UPDATE orders
	  SET status = 'Shipped'
	  WHERE orderNumber = $order_number";
	  
		if($MySQLi_CON->query($updatedOrderQuery))
			echo "order was not updated to SHIPPED!!!";
		else
			header("Location: orderHistory.php");
	}
  
  $MySQLi_CON->close();
?>