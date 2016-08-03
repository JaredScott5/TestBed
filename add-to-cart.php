<?php
session_start();
include_once 'dbconnect.php';

$user_id = $_SESSION['userSession'];
$item_id = $_POST['item_id'];
$quantity = $_POST['quantity'];
$time = date("Y-m-d H:i:s");
$quantityToRemove = 0; 
// Check if the cart is empty

  $check_cart = $MySQLi_CON->query(
    "SELECT orderNumber, status
    FROM orders
    WHERE user_id='$user_id' AND status='In Cart'"
  );

$count=$check_cart->num_rows;

//if 'quantity' == 0, we know that we want to completly remove an EXISTING item in an order
if($quantity==0){
	echo "removing $item_id from order...";
	
	$row = mysqli_fetch_assoc($check_cart); // $check_cart only has one row, the 'In Cart' order
  $orderNumber = $row['orderNumber'];
  
  $itemQuantityQuery = "SELECT quantityOrdered FROM orderDetails
	WHERE orderNumber='$orderNumber' AND item_id='$item_id'";
  $result = mysqli_query($MySQLi_CON, $itemQuantityQuery);
  $q = mysqli_fetch_assoc($result);
  $quantityToRemove = $q["quantityOrdered"];
  
  echo "<p  style='display: block; padding-top: 100px;'> result is" . $quantityToRemove . "</p>";
  
	echo "orderNumber is $orderNumber and item id is $item_id...";
	// change this inserstion into a removal
    $deleteQuery = "DELETE FROM orderDetails
	WHERE orderNumber='$orderNumber' AND item_id='$item_id'";
	echo "made it past delete statement...";
	
	if($MySQLi_CON->query($deleteQuery) === TRUE){
		echo "delete worked...";
	}else{
	echo "error deleting record" . $MySQLi_CON->error;
}
	//(orderNumber,item_id,quantityOrdered)
   // VALUES('$orderNumber','$item_id','$quantity')";
    //$MySQLi_CON->query($query);
	
}else if($count==0){// If the cart is empty, create a new order with status 'In Cart'

  $query = "INSERT INTO orders(user_id,orderDate,status)
  VALUES('$user_id','$time','In Cart')";
 
  $MySQLi_CON->query($query);
 
  // Fetch the new order's orderNumber
  $order = $MySQLi_CON->query(
    "SELECT *
    FROM orders
    WHERE user_id='$user_id' AND status='In Cart' AND orderDate='$time'"
  );
  $row = mysqli_fetch_assoc($order);
  $orderNumber = $row['orderNumber'];
  
  // add orderDetails for the added item to the newly created order
  $query = "INSERT INTO orderDetails(orderNumber,item_id,quantityOrdered)
  VALUES('$orderNumber','$item_id','$quantity')";
  
  $MySQLi_CON->query($query);
  mysqli_free_result($order);
}

// If the cart is not empty, check order with status 'In Cart' for duplicate item_id
else{
  // echo "Cart not empty, ";
  // Check 'In Cart' order for duplicate item
  $row = mysqli_fetch_assoc($check_cart); // $check_cart only has one row, the 'In Cart' order
  $orderNumber = $row['orderNumber'];
  // echo "quantityIn is" . $quantity;
  
  $check_duplicate = $MySQLi_CON->query(
    "SELECT *
    FROM orderDetails
    WHERE item_id = '$item_id' AND orderNumber = '$orderNumber'"
  );
  $count=$check_duplicate->num_rows;
  // If duplicate exists, increment quantityOrdered accordingly
  if(!$count==0){
    // echo "Duplicate item found";
    $row = mysqli_fetch_assoc($check_duplicate);
    $quantityInCart = $row['quantityOrdered'];
    // echo "quantityInCart is" . $quantityInCart;
    $quantityTotal = $quantityInCart + $quantity;
    // echo "quantityTotal is " . $quantityTotal;
    $query = 
      "UPDATE orderDetails
      SET quantityOrdered = '$quantityTotal'
      WHERE item_id = '$item_id' AND orderNumber = '$orderNumber'";
    $MySQLi_CON->query($query);
  }
	// If duplicate does not exist, insert new orderDetails
  else{
    // echo "No duplicate item";
    $query = "INSERT INTO orderDetails(orderNumber,item_id,quantityOrdered)
    VALUES('$orderNumber','$item_id','$quantity')";
    
    $MySQLi_CON->query($query);
  }
  mysqli_free_result($check_duplicate);
}
mysqli_free_result($check_cart);
$MySQLi_CON->close();

$_SESSION['cartCount'] = $_SESSION['cartCount'] + $quantity - $quantityToRemove;

echo $_SESSION['cartCount'];
?>