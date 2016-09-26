<?php
session_start();
include_once 'dbconnect.php';
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
    orders.comments, orders.total
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
  //$newResult = mysqli_query($MySQLi_CON, $query);

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
  GROUP BY orders.orderNumber
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

<?php $currentOrder = 0; ?>

<?php while($itemRow = mysqli_fetch_assoc($result)) : ?>
  <?php if ($itemRow['orderNumber'] !== $currentOrder) : ?>
    <div class="order">
      <div class="summary row">
        <div class="col-xs-2">
          <p class="order number"><?php echo $itemRow['orderNumber'] ?></p>
        </div>
        <div class="col-xs-2">
          <p class="order date"><?php echo $itemRow['orderDate'] ?></p>
        </div>
        <div class="col-xs-2">
          <p class="shipped date"><?php echo $itemRow['shippedDate'] ?></p>
        </div>
        <div class="col-xs-2">
          <p class="total cost"><?php echo $itemRow['total'] ?></p>
        </div>
        <div class="col-xs-2">
          <p class="comments"><?php echo $itemRow['comments'] ?></p>
        </div>
        <div class="col-xs-2">
          <p class="whitepace">&nbsp;</p>
        </div>  
      </div>
  <?php endif; ?>
      <div class="detail row">
        <div class="col-xs-2">
          <p class="whitepace">&nbsp;</p>
        </div>    
        <div class="col-xs-2">
          <p class="item img"><?php echo "<img class=\"img-responsive\" width=\"150\" height=\"150\" src=" . $itemRow['image'] . "></img>"; ?></p>
        </div>
        <div class="col-xs-2">
          <p class="item name"><?php echo $itemRow['itemName'] ?></p>
        </div>
        <div class="col-xs-2">
          <p class="quantity ordered"><?php echo $itemRow['quantityOrdered'] ?></p>
        </div>
        <div class="col-xs-2">
          <p class="price per item"><?php echo $itemRow['price'] ?></p>
        </div>
        <div class="col-xs-2">
          <p class="total item price"><?php echo $totalItemCost = $itemRow['price'] * $itemRow['quantityOrdered'] ?></p>
        </div>    
      </div>
    </div>
  <?php $currentOrder = $itemRow['orderNumber']; ?>
<?php endwhile; ?>

<div id="footer"><?php include_once 'footer.php'; ?></div>

<script src="libs/jquery/jquery-3.0.0.min.js"></script>
<script src="orderHistory.js"></script>

</body>

</html>