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
 while($itemRow = mysqli_fetch_assoc($check_cart)){
	echo "<h1>" ."Item" . $count . "</h1>";
		echo "<li id=" . $itemRow["item_id"] . " class='listItem'"; echo ">"; 
			echo "<p id='image'>"; echo $itemRow["image"] . "</p>"; 
			echo "<p id='itemName'>"; echo $itemRow["itemName"] . "</p>";
			echo "<p id='price'>"; echo $itemRow["price"] . "</p>"; 
			echo "<p id='desc'>"; echo $itemRow["description"] . "</p>";
			echo "<a class='btn btn-lg btn-primary' href='#' role='button' 
			  onClick=''>Edit" . "</a>"; 
			  echo "<a class='btn btn-lg btn-primary' href='#' role='button' 
			  onClick=''>Cancel" . "</a>"; 
		echo "</li>";
		$count = $count + 1;
 }
}else{
	echo "<p  style='display: block; padding-top: 100px;'>Row Count is not 0</p>";
}

//free the variable, we should not need it now
mysqli_free_result($check_cart);

$MySQLi_CON->close();
?>