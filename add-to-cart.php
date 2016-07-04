<?php
session_start();
include_once 'dbconnect.php';

$user_id = $_SESSION['userSession'];
$item_id = $_POST['item_id'];
$quantity = $_POST['quantity'];
$time = date("Y-m-d H:i:s");

// Check if the cart is empty
$check_cart = $MySQLi_CON->query(
  "
  SELECT orderNumber, status
  FROM orders
  WHERE user_id='$user_id' AND status='In Cart'
  "
);

$count=$check_cart->num_rows;

// If the cart is empty, create a new order with status 'In Cart'
if($count==0){
 
  $query = "INSERT INTO orders(user_id,orderDate,status)
  VALUES('$user_id',$time,'In Cart')";
 
  $MySQLi_CON->query($query);
 
  // Fetch the new order's orderNumber
  $order = $MySQLi_CON->query(
    "
    SELECT *
    FROM orders
    WHERE user_id='$user_id' AND status='In Cart' AND orderDate=$time
    "
  );
  $orderNumber = $order[orderNumber];
  
  // add orderDetails for the added item to the newly created order
  $query = "INSERT INTO orderDetails(orderNumber,item_id,quantityOrdered)
  VALUES('$orderNumber',$item_id,'$quantity')";
 
  $MySQLi_CON->query($query);
}

// If the cart is not empty, check orders with status 'In Cart' for duplicate item_id
else{
	// If duplicate exists, increment quantityOrdered accordingly
	// If duplicate does not exist, insert new orderDetails
}
 
$MySQLi_CON->close();
?>