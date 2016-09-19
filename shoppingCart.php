<?php 
session_start();
include_once 'dbconnect.php';
include ('navbar.php');

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$user_id = $_SESSION['userSession'];

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$orderNumber = 0;
$user = $userRow['username'];
$count = 1;

// Check if the cart is empty
$check_cart = $MySQLi_CON->query(
  "
  SELECT orderNumber, status
  FROM orders
  WHERE user_id='$user_id' AND status='In Cart'
  "
);

//if rowCount comes back as 1 or higher, it means the cart is not empty
$rowCount=$check_cart->num_rows;

//store orderNumber from table orders
	$tempItemRow = mysqli_fetch_assoc($check_cart);
	$orderNum=$tempItemRow["orderNumber"];
	
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
		//echo "<th style='text-align:center'> Order # </th>"; 
		echo "<th style='text-align:center'> Image </th>";
		echo "<th style='text-align:center'> Item </th>"; 
		echo "<th style='text-align:center'> Price </th>"; 
		echo "<th style='text-align:center'> Quantity </th>";
		echo "<th style='text-align:center'> Order Total</th>";
		echo "<th style='text-align:center'> </th>";
	echo "</tr>";
	
	$totalCost = 0;
	
 while($itemRow = mysqli_fetch_assoc($result)){
	
	echo "<tr>";
		//echo "<th style='text-align:center'>" . $itemRow["orderNumber"] . "</th>";
		echo "<th style='text-align:center'>" . "<img class=\"img-responsive\" width=\"150\" height=\"150\" src=" . $itemRow["image"] . " id='image'>" . "</img>" . "</th>";
		echo "<th style='text-align:center'>" . $itemRow["itemName"] . "</th>"; 
		echo "<th style='text-align:center'>" . $itemRow["price"] . "</th>"; 
		echo "<th style='text-align:center'>
			<form action='add-to-cart.php' method='post'>
			<input type='hidden' name='iN' value='" . $itemRow["item_id"] . "' />
			<input type='text' name='q' value='" . $itemRow['quantityOrdered'] . 
			"'style='width: 50px;'/> 
			<input type='submit'>
			</form>
			</th>"; 
		echo "<th style='text-align:center'>" . $itemRow['price']  * $itemRow['quantityOrdered'] . "</th>"; 	
		echo "<th style='text-align:center'>" . "<a class='btn btn-sm btn-primary' href='#' role='button' 
			  onClick='removeItem(" . $itemRow["item_id"] . ")'>Remove Item" .  "</a>" . "</th>";
	echo "</tr>";	
	
		$totalCost = $totalCost + ($itemRow["price"] * $itemRow["quantityOrdered"]);
		$count = $count + 1;
		$orderNumber = $itemRow["orderNumber"];
 }
 //echo "<th> </th>";
 echo "<th> </th>";
 echo "<th> </th>";
 echo "<th> </th>";
 echo "<th>" . $itemRow["orderNumber"] . "</th>";
 echo "<th> Total: " . $totalCost . "</th>";
 echo "<th style='text-align:center'>" . "<a class='btn btn-sm btn-primary' href='#' role='button' 
			  onClick='checkOut(" . $orderNumber . ',' . $totalCost . ")'>Check Out" .  "</a>" .  "</th>";
 echo "</table>";
}else{
	//echo "<p  style='display: block; padding-top: 100px;'>Row Count is not 0</p>";
}

//free the variable, we should not need it now
mysqli_free_result($check_cart);

$MySQLi_CON->close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 

<link rel="stylesheet" href="style.css" type="text/css" />

</head>

<body>
<div id="footer"><?php include_once 'footer.php'; ?></div>
<script src="shoppingCart.js">
</script>

</body>


</html>