<?php
session_start();
header('Content-Type: application/json');
include_once 'dbconnect.php';

$quantity = 0;
$user_id = $_SESSION['userSession'];
$updatedQuantity = 0;

//echo "quantity, user_id and updatedQuantity is " . $quantity . " " . $user_id . " " . $updatedQuantity . "<p></p>";

$check_cart = $MySQLi_CON->query(
    "SELECT orderNumber, status
    FROM orders
    WHERE user_id='$user_id' AND status='In Cart'"
  );
/*
//this statement checks if we need to UPDATE the quantity of a single item in the cart
if(isset($_POST['q']) && isset($_POST['iN'])){
$updatedQuantity = $MySQLi_CON->real_escape_string(trim($_POST['q']));
$item_id = $MySQLi_CON->real_escape_string(trim($_POST['iN']));
  
$row = mysqli_fetch_assoc($check_cart);
$orderNumber = $row['orderNumber'];
  
  //create a query for ALL items in cart
  $totalOrderQuantity = $MySQLi_CON->query(
    "SELECT SUM(quantityOrdered) AS value_sum
    FROM orderDetails
    WHERE orderNumber='$orderNumber'"
  );
  
  //create query for only the ONE item that we want to update 
  $singleOrderQuantity = $MySQLi_CON->query(
    "SELECT SUM(quantityOrdered) AS value_sum
    FROM orderdetails
    WHERE orderNumber='$orderNumber' AND item_id='$item_id'"
  );
  
  //subtract them and store them in a variable
  $total1 = mysqli_fetch_assoc($totalOrderQuantity);
  $total2 = mysqli_fetch_assoc($singleOrderQuantity);
  
  $var1 = $total1['value_sum'];
  $var2 = $total2['value_sum'];
  $newCart = ($var1 - $var2) + $updatedQuantity;
  
  //add the new quantity and use it to update the cart properly
  $updateQuery = 
    "UPDATE orderDetails
    SET quantityOrdered = '$updatedQuantity'
    WHERE item_id = '$item_id' AND orderNumber = '$orderNumber'";
	  
	if($MySQLi_CON->query($updateQuery) === true){
		$_SESSION['cartCount'] = $newCart;
		header("Location: shoppingCart.php");
	}
}else { */

$item_id = $_POST['item_id'];
$quantity = $_POST['quantity'];
$time = date("Y-m-d H:i:s");
$data = array();

//echo "line64: item id, quantity, and time are " . $item_id . ", " . $quantity . ", " . $time;

$count=$check_cart->num_rows;


//echo "count is " . $count;

//if 'quantity' == 0, we know that we want to completely REMOVE 
//an EXISTING item in an EXISTING order
if($quantity==0){
  $row = mysqli_fetch_assoc($check_cart);
  $orderNumber = $row['orderNumber'];
  
    //create a query for ALL items
  $totalOrderQuantity = $MySQLi_CON->query(
    "SELECT SUM(quantityOrdered) AS value_sum
    FROM orderDetails
    WHERE orderNumber='$orderNumber'"
  );
  
  //create query for only the ONE item 
  $singleOrderQuantity = $MySQLi_CON->query(
    "SELECT SUM(quantityOrdered) AS value_sum
    FROM orderdetails
    WHERE orderNumber='$orderNumber' AND item_id='$item_id'"
  );
  
  //subtract them and store them in a variable
  $total1 = mysqli_fetch_assoc($totalOrderQuantity);
  $total2 = mysqli_fetch_assoc($singleOrderQuantity);
  
  $var1 = $total1['value_sum'];
  $var2 = $total2['value_sum'];
  $newCart = ($var1 - $var2) + $updatedQuantity;

  $deleteQuery = "DELETE FROM orderDetails
    WHERE orderNumber='$orderNumber' AND item_id='$item_id'";
	
	if($MySQLi_CON->query($deleteQuery) === true){
		$_SESSION['cartCount'] = $newCart;
    $data += array('cartCount' => $_SESSION['cartCount']);
    $data += array('msg' => "Ran remove successfully");
		echo json_encode($data);
	}
	
}else if($count==0){
	// If the cart is empty, create a new order with status 'In Cart'

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
	//echo "cart is not empty";
  // Check 'In Cart' order for duplicate item
  
  $row = mysqli_fetch_assoc($check_cart); // $check_cart only has one row, the 'In Cart' order
  $orderNumber = $row['orderNumber'];
 // echo "orderNumber that we are looking into is " . $orderNumber;
  $check_duplicate = $MySQLi_CON->query(
    "SELECT *
    FROM orderDetails
    WHERE item_id = '$item_id' AND orderNumber = '$orderNumber'"
  );
  $count=$check_duplicate->num_rows;
  
  //echo "there are " . $count . "duplicate orders";
  
  // If duplicate exists, increment quantityOrdered accordingly
  if(!$count==0){
	 // echo "duplicate exists";
    $row = mysqli_fetch_assoc($check_duplicate);
    $quantityInCart = $row['quantityOrdered'];
    if(isset($_POST['f'])){
      $quantityTotal = $quantity;
      $quantityDiff = $quantity - $quantityInCart;
      $_SESSION['cartCount'] = $_SESSION['cartCount'] + $quantityDiff;
      echo json_encode(array('itemsInCart' => $quantityTotal, 'cartCount' => $_SESSION['cartCount']));
    } else {
      $quantityTotal = $quantityInCart + $quantity;
      $_SESSION['cartCount'] = $_SESSION['cartCount'] + $quantity;
      echo json_encode(array('itemsInCart' => $quantityTotal, 'cartCount' => $_SESSION['cartCount']));
    }
    $query = 
      "UPDATE orderDetails
      SET quantityOrdered = '$quantityTotal'
      WHERE item_id = '$item_id' AND orderNumber = '$orderNumber'";

    $MySQLi_CON->query($query);
  }
	// If duplicate does not exist, insert new orderDetails
  else{
	//  echo "we are going to insert into the database table orderDetails";
    $query = "INSERT INTO orderDetails(orderNumber,item_id,quantityOrdered)
    VALUES('$orderNumber','$item_id','$quantity')";
    //echo "values inserted are orderNumber: " . $orderNumber . ", item_id: " .
	$item_id . ", and quantity: " . $quantity;
    $MySQLi_CON->query($query);
	
  }
  mysqli_free_result($check_duplicate);
}
mysqli_free_result($check_cart);
//}//outer most if/very first if
$MySQLi_CON->close();

?>