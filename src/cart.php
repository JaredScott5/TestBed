<?php
session_start();
header('Content-Type: application/json');
include_once 'dbconnect.php';

$user_id = $_SESSION['userSession'];
$updatedQuantity = 0;

$check_cart = $MySQLi_CON->query(
    "SELECT orderNumber, status
    FROM orders
    WHERE user_id='$user_id' AND status='In Cart'"
  );

$item_id = $_POST['item_id'];
$quantity = $_POST['quantity'];
$time = date("Y-m-d H:i:s");
$data = array();

$count=$check_cart->num_rows;

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

  $_SESSION['cartCount'] = $_SESSION['cartCount'] + $quantity;
  echo json_encode(array('cartCount' => $_SESSION['cartCount'], 'msg' => "Created New Cart Order"));

  mysqli_free_result($order);
}

// If the cart is not empty, check order with status 'In Cart' for duplicate item_id
else{
  // Check 'In Cart' order for duplicate item

  $row = mysqli_fetch_assoc($check_cart); // $check_cart only has one row, the 'In Cart' order
  $orderNumber = $row['orderNumber'];

  $check_duplicate = $MySQLi_CON->query(
    "SELECT *
    FROM orderDetails
    WHERE item_id = '$item_id' AND orderNumber = '$orderNumber'"
  );
  $count=$check_duplicate->num_rows;

  // If duplicate exists, increment quantityOrdered accordingly
  if(!$count==0){
    $row = mysqli_fetch_assoc($check_duplicate);
    $quantityInCart = $row['quantityOrdered'];
    if(isset($_POST['f'])){
      $quantityTotal = $quantity;
      $quantityDiff = $quantity - $quantityInCart;
      $_SESSION['cartCount'] = $_SESSION['cartCount'] + $quantityDiff;
      echo json_encode(array('itemsInCart' => $quantityTotal, 'cartCount' => $_SESSION['cartCount'], 'msg' => "Updated Quantity"));
    } else {
      $quantityTotal = $quantityInCart + $quantity;
      $_SESSION['cartCount'] = $_SESSION['cartCount'] + $quantity;
      echo json_encode(array('itemsInCart' => $quantityTotal, 'cartCount' => $_SESSION['cartCount'], 'msg' => "Incremented Item in Cart"));
    }
    $query =
      "UPDATE orderDetails
      SET quantityOrdered = '$quantityTotal'
      WHERE item_id = '$item_id' AND orderNumber = '$orderNumber'";

    $MySQLi_CON->query($query);
  }
	// If duplicate does not exist, insert new orderDetails
  else{
    $query = "INSERT INTO orderDetails(orderNumber,item_id,quantityOrdered)
    VALUES('$orderNumber','$item_id','$quantity')";
    $MySQLi_CON->query($query);
    $_SESSION['cartCount'] = $_SESSION['cartCount'] + $quantity;
    echo json_encode(array('cartCount' => $_SESSION['cartCount'], 'msg' => "Test"));
  }
  mysqli_free_result($check_duplicate);
}
mysqli_free_result($check_cart);
$MySQLi_CON->close();

?>
