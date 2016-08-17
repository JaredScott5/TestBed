<?php
session_start();
include_once 'dbconnect.php';

$orderNO = $_POST['order_number'];
//first check that the order exists and is STILL 'In Cart'
$orderQuery = 
    "SELECT *
    FROM orders
    WHERE orderNumber='$orderNO' AND status='In Cart'";
    
  if($MySQLi_CON->query($orderQuery)){
	  //change 'status' to 'Shipped'
	  $updatedOrderQuery = 
	  "UPDATE orders
	  SET status = 'Shipped'
	  WHERE orderNumber = $orderNO";
	  
		if($MySQLi_CON->query($updatedOrderQuery) === false){
		//do nothing
		}else{
			 $_SESSION['cartCount'] = 0;
      echo "<meta http-equiv=\"refresh\" content=\"0;URL=orderHistory.php\">";
		}
	}
  
$MySQLi_CON->close();

echo $_SESSION['cartCount'];
?>