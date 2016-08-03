<?php
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$user_id = $_SESSION['userSession'];

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();

$user = $userRow['username'];
$status = "In Cart";
$count = 1;

// Check if the cart is empty
$check_cart = $MySQLi_CON->query(
  "
  SELECT orderNumber, status
  FROM orders
  WHERE user_id='$user_id' AND status='$status'
  "
);

//1 or higher means it is not empty
$rowCount=$check_cart->num_rows;

//store orderNumber from table orders
	$tempItemRow = mysqli_fetch_assoc($check_cart);
	$orderNum=$tempItemRow["orderNumber"];
	echo "assigned data to orderNum: $orderNum";
	
//if not empty display the order as a table 
if($rowCount!=0){
	
 //look through join query based off orderdetails and items and display 
 $secondQuery =
 "
 SELECT orderdetails.orderNumber, orderdetails.item_id, orderdetails.quantityOrdered,
		items.itemName, items.price, items.image 
 FROM orderdetails
 INNER JOIN items
 ON orderdetails.item_id = items.item_id
 WHERE orderdetails.orderNumber='$orderNum'
 ";
 
 $result=mysqli_query($MySQLi_CON, $secondQuery);
 
 //test if the query failed
if (!$result){
	die("Database query failed.");
}else{
}

 //table 1 for 'in cart' items
 echo "<p  style='display: block; padding-top: 100px;'></p>";
 
 echo "<table style='width:75%' align='center' cellpadding='2' cellspacing='2' border='2'>";
 echo "<tr>";
		echo "<th style='text-align:center'> Order # </th>"; 
		echo "<th style='text-align:center'> Image </th>";
		echo "<th style='text-align:center'> Item </th>"; 
		echo "<th style='text-align:center'> Price </th>"; 
		echo "<th style='text-align:center'> Quantity </th>";
		echo "<th style='text-align:center'> Order Total</th>";
		echo "<th style='text-align:center'> </th>";
		echo "<th style='text-align:center'> </th>";
	echo "</tr>";
	
	$totalCost = 0;
	
 while($itemRow = mysqli_fetch_assoc($result)){
	
	echo "<tr>";
		echo "<th style='text-align:center'>" . $itemRow["orderNumber"] . "</th>";
		echo "<th style='text-align:center'>" . $itemRow["image"] . "</th>";
		echo "<th style='text-align:center'>" . $itemRow["itemName"] . "</th>"; 
		echo "<th style='text-align:center'>" . $itemRow["price"] . "</th>"; 
		echo "<th style='text-align:center'>
			<input type='text' value='" . $itemRow['quantityOrdered'] . 
			"'style='width: 50px;'> </th>"; 
		echo "<th style='text-align:center'>" . $itemRow['price']  * $itemRow['quantityOrdered'] . "</th>"; 	
		echo "<th style='text-align:center'>" . "<a class='btn btn-lg btn-primary' href='#' role='button' 
			  onClick='updateQuantity(" . $itemRow["item_id"] . ")'>Update Quantity" . "</a>" . "</th>";
		echo "<th style='text-align:center'>" . "<a class='btn btn-lg btn-primary' href='#' role='button' 
			  onClick='removeItem(" . $itemRow["item_id"] . ")'>Remove Item" .  "</a>" . "</th>";
	echo "</tr>";	
	
		$totalCost = $totalCost + ($itemRow["price"] * $itemRow["quantityOrdered"]);
		$count = $count + 1;
 }
 echo "<th> </th>";
 echo "<th> </th>";
 echo "<th> </th>";
 echo "<th> </th>";
 echo "<th> </th>";
 echo "<th> Total Cost: " . $totalCost . "</th>";
 echo "<th> </th>";
 echo "<th> </th>";
 echo "</table>";

}else{
	echo "<p  style='display: block; padding-top: 100px;'>Row Count is not 0</p>";
}

//free the variable, we should not need it now
mysqli_free_result($check_cart);

$MySQLi_CON->close();
?>