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
$time = date("Y-m-d H:i:s");
$count = 1;
// Check if the cart is empty
$check_cart = $MySQLi_CON->query(
  "
  SELECT orderNumber, status
  FROM orders
  WHERE user_id='$user_id' AND status='In Cart'
  "
);

//1 or higher means it is not empty
$rowCount=$check_cart->num_rows;


//if not empty display the order as a table (via js?)
if($rowCount!=0){
 //look through query and display 
 //change this to a table
 echo "<table style='width:75%>";
 while($itemRow = mysqli_fetch_assoc($check_cart)){
	 echo "<tr>";
		echo "<th>" . "Item" . "</th>";
		echo "<th>" . "Item ID" . "</th>"; 
		echo "<th>" . "Image" . "</th>"; 
		echo "<th>" . "Item Name" . "</th>";
		echo "<th>" . "Item Price" . "</th>"; 
		echo "<th>" . "Description" . "</th>";
	echo "</tr>";	
	
	echo "<tr>";
		echo "<th>" . $count . "</th>";
		echo "<th>" . $itemRow["item_id"] . "</th>";
		echo "<th>" . $itemRow["image"] . "</th>";
		echo "<th>" . $itemRow["itemName"] . "</th>";
		echo "<th>" . $itemRow["price"] . "</th>";
		echo "<th>" . $itemRow["description"] . "</th>";
		echo "<th>" . "<a class='btn btn-lg btn-primary' href='#' role='button' 
			  onClick=''>Edit" . "</a>" . "</th>";
		echo "<th>" . "<a class='btn btn-lg btn-primary' href='#' role='button' 
			  onClick=''>Cancel" . "</th>";
	echo "</tr>";	
	
		$count = $count + 1;
 }
}else{
	echo "<p  style='display: block; padding-top: 100px;'>Row Count is not 0</p>";
}

//free the variable, we should not need it now
mysqli_free_result($check_cart);

$MySQLi_CON->close();
?>