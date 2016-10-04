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
  JOIN orderdetails
  ON orders.orderNumber = orderdetails.orderNumber
  JOIN items
  ON orderdetails.item_id = items.item_id
  WHERE user_id = '$user_id' AND status <> 'In Cart' 
  ";
  
  $detailsResult = mysqli_query($MySQLi_CON, $detailsQuery);
  
  //test if the query failed
  if (!$ordersResult || !$detailsResult){
    die("Database query failed.");
  }
  
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
  <div id="orders" class="container">
    <?php while($orderRow = mysqli_fetch_assoc($ordersResult)) : ?>
      <?php $currentOrder = $orderRow['orderNumber']; ?>  
      <div class="order">
        <div class="summary">
          <div class="row">
            <div class="col-xs-2">
              <p class="order-number"><b>Order Number: </b><?php echo $orderRow['orderNumber'] ?></p>
            </div>
            <div class="col-xs-2">
              <p class="order-date"><b>Date Ordered: </b><?php echo $orderRow['orderDate'] ?></p>
            </div>
            <div class="col-xs-2">
              <p class="shipped-date"><b>Date Shipped: </b><?php echo $orderRow['shippedDate'] ?></p>
            </div>
            <div class="col-xs-2">
              <p class="total-cost"><b>Total: </b>$<?php echo $orderRow['total'] ?></p>
            </div>
            <div class="col-xs-2">
              <p class="comments"><b>Comments: </b><?php echo $orderRow['comments'] ?></p>
            </div>
            <div class="col-xs-2">
              <a class="exp-col">Show Details</a>
            </div>
          </div>
        </div>
        <div class="details">
          <?php while($detailRow = mysqli_fetch_assoc($detailsResult)) : ?>
              <?php if ($detailRow['orderNumber'] === $currentOrder) : ?>
              <div class="detail">
                <div class="row">
                  <div class="col-xs-2">
                    <p class="whitepace">&nbsp;</p>
                  </div>    
                  <div class="col-xs-2">
                    <p class="item-img"><?php echo "<img class=\"img-responsive\" width=\"150\" height=\"150\" src=" . $detailRow['image'] . "></img>"; ?></p>
                  </div>
                  <div class="col-xs-2">
                    <p class="item-name">Item: <?php echo $detailRow['itemName'] ?></p>
                  </div>
                  <div class="col-xs-2">
                    <p class="quantity-ordered">Quantity: <?php echo $detailRow['quantityOrdered'] ?></p>
                  </div>
                  <div class="col-xs-2">
                    <p class="price-per-item">Price: $<?php echo $detailRow['price'] ?></p>
                  </div>
                  <div class="col-xs-2">
                    <p class="total item price">Subtotal: $<?php echo $totalItemCost = $detailRow['price'] * $detailRow['quantityOrdered'] ?></p>
                  </div>
                </div>
              </div>
              <?php endif; ?>
          <?php endwhile; ?>
        <?php mysqli_data_seek($detailsResult, 0) ?>
        </div>
      </div>
    <?php endwhile; ?>
    <?php mysqli_free_result($ordersResult); ?>
    <?php mysqli_free_result($detailsResult); ?>
  </div>
  <div id="footer"><?php include_once 'footer.php'; ?></div>

  <script src="libs/jquery/jquery-3.0.0.min.js"></script>
  <script src="orderHistory.js"></script>

</body>

</html>