<?php
session_start();
include_once 'dbconnect.php';
include_once 'footer.php';
if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$user_id = $_SESSION['userSession'];
$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id= '$user_id'");
$userRow=$query->fetch_array();
$user = $userRow['username'];
$count = 1;

// Check for any orders the user has ever made
$check_cart = $MySQLi_CON->query(
  "
  SELECT orderNumber, status
  FROM orders
  WHERE user_id='$user_id'
  "
);

//1 or higher means it is not empty
$rowCount=$check_cart->num_rows;

//store the orderNumber variable from the past table orders
	$tempItemRow = mysqli_fetch_assoc($check_cart);
	$orderNum=$tempItemRow["orderNumber"];
	
//if not empty display the order as a table 
if($rowCount!=0){
	
  //look through join query based off orderdetails and items and display 
  $secondQuery =
  "
  SELECT orderdetails.orderNumber, orderdetails.item_id, orderdetails.quantityOrdered,
    items.itemName, items.price, items.image, orders.orderDate, orders.shippedDate,
    orders.comments
  FROM orderdetails
  INNER JOIN items
  ON orderdetails.item_id = items.item_id
  INNER JOIN orders
  ON orderdetails.orderNumber = orders.orderNumber
  WHERE user_id = '$user_id' AND status <> 'In Cart' 
  ORDER BY orders.orderNumber
  ";

  $result=mysqli_query($MySQLi_CON, $secondQuery);
  $finfo = $result->fetch_fields();
  /*
  $query =
  "
  SELECT orders.orderNumber, COUNT(orderdetails.item_id) AS UniqueItems
  FROM orders
  INNER JOIN orderdetails
  ON orders.orderNumber = orderdetails.orderNumber
  WHERE user_id = '$user_id' AND status <> 'In Cart' 
  GROUP BY orderNumber
  ";
  */
  $newResult = mysqli_query($MySQLi_CON, $query);

  $ordersQuery =
  "
  SELECT *
  FROM orders
  WHERE user_id = '$user_id' AND status <> 'In Cart' 
  GROUP BY orderNumber
  ";
  
  $ordersResult = mysqli_query($MySQLi_CON, $ordersQuery);
  
  $detailsQuery =
  "
  SELECT *
  FROM orders
  INNER JOIN orderdetails
  ON orders.orderNumber = orderdetails.orderNumber
  WHERE user_id = '$user_id' AND status <> 'In Cart' 
  GROUP BY orderNumber
  ";
  
  $detailsResult = mysqli_query($MySQLi_CON, $detailsQuery);
  
  //test if the query failed
  if (!$result){
  die("Database query failed.");
  }else{
  }

}else{
	echo "<p  style='display: block; padding-top: 100px;'>Row Count is not 0</p>";
}

//free the variable, we should not need it now
mysqli_free_result($check_cart);

$MySQLi_CON->close();
?>

<html lang="en">

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<!-- CSS -->
<link rel="stylesheet" href="orderHistory.css">

<head>
<title>Order History</title>
<?php include ('navbar.php'); ?>
</head>

<body>
  <!-- tables for past orders -->
  <p  style='display: block; padding-top: 100px;'></p>

  <?php $prev = NULL; ?>
  <?php $totalCost = 0; ?>
  <?php while($itemRow = mysqli_fetch_assoc($result)): ?>
    <?php if ($itemRow['orderNumber'] != $prev) :?>
  
      <table style='width:75%' align='center' cellpadding='2' cellspacing='2' border='2'>
      <tr>
      <?php foreach ($finfo as $val) : ?>
        <th style='text-align:center'><?php $name = str_replace('_', ' ', $val->name); echo $name; ?></th>
      <?php endforeach; ?>
      </tr>
      <?php if ($totalCost != 0) :?>
        <h4 style='text-align:center'> Total Cost: <?php echo $totalCost ?> </h4>
      <?php endif; ?>
      <?php $totalCost = 0; ?>
    <?php endif; ?>
    <?php //while($itemRow = mysqli_fetch_assoc($result)): ?>
    
    <tr>
      <?php foreach ($finfo as $val) : ?>
        <th style='text-align:center'>
          <?php
            if ($val->name === 'image') {
              echo "<img class=\"img-responsive\" width=\"150\" height=\"150\" src=" . $itemRow[$val->name] . "></img>";
            } else {
            echo $itemRow[$val->name];
            }
          ?>
      <?php endforeach; ?>
    </tr>
    <?php
		$totalCost = $totalCost + ($itemRow["price"] * $itemRow["quantityOrdered"]);
		$count = $count + 1;
    $prev = $itemRow['orderNumber'];
    ?>
    <?php endwhile; ?>
  </table>
<h4 style='text-align:center'> Total Cost: <?php echo $totalCost ?> </h4>



<!-- Bootstrap/CSS Work In Progress

<div class="order">
  <div class="summary row">
    <div class="col-xs-2">
      <p class="order number"><?php //echo $itemRow['orderNumber'] ?></p>
    </div>
    <div class="col-xs-2">
      <p class="order date"><?php //echo $itemRow['orderDate'] ?></p>
    </div>
    <div class="col-xs-2">
      <p class="shipped date"><?php //echo $itemRow['shippedDate'] ?></p>
    </div>
    <div class="col-xs-2">
      <p class="total cost"><?php //echo $totalCost ?></p>
    </div>
    <div class="col-xs-2">
      <p class="comments"><?php //echo $itemRow['comments'] ?></p>
    </div>
    <div class="col-xs-2">
      <p class="whitepace">&nbsp;</p>
    </div>  
  </div>
  <div class="detail row">
    <div class="col-xs-2">
      <p class="whitepace">&nbsp;</p>
    </div>    
    <div class="col-xs-2">
      <p class="item img"><?php //echo "<img class=\"img-responsive\" width=\"150\" height=\"150\" src=" . $itemRow[$val->name] . "></img>"; ?></p>
    </div>
    <div class="col-xs-2">
      <p class="item name"><?php //echo $itemRow['itemName'] ?></p>
    </div>
    <div class="col-xs-2">
      <p class="quantity ordered"><?php //echo $itemRow['quantityOrdered'] ?></p>
    </div>
    <div class="col-xs-2">
      <p class="price per item"><?php //echo $itemRow['price'] ?></p>
    </div>
    <div class="col-xs-2">
      <p class="total item price"><?php //echo $totalItemPrice ?></p>
    </div>    
  </div>
  
-->
<?php //foreach ($orders as $val1) : ?>
  <?php //foreach $details as $val2) : ?>
  <?php //endforeach; ?>
<?php //endforeach; ?>

<script src="libs/jquery/jquery-3.0.0.min.js"></script>
<script src="orderHistory.js"></script>

</body>

</html>