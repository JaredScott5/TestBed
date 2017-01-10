<?php
session_start();
include_once 'dbconnect.php';

$time = date("Y-m-d H:i:s");
$orderNO = $_POST['order_number'];
$finalCost = $_POST['total_cost'];
//first check that the order exists and is STILL 'In Cart'
$orderQuery = 
    "SELECT *
    FROM orders
    WHERE orderNumber='$orderNO' AND status='In Cart'";
    
  if($MySQLi_CON->query($orderQuery)){
    //--Payment processing takes place at this point--
	  //change 'status' to 'Shipped' (Should be 'Processing' in final version)
	  $updatedOrderQuery = 
	  "UPDATE orders
	  SET status = 'Shipped', total = $finalCost, orderDate = '$time'
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