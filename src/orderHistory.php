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
  
}else{
	 header("Location: blankOrderHistory.php");
}

//free the variable, we should not need it now
mysqli_free_result($check_cart);

$MySQLi_CON->close();
?>


<!-- CSS -->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Order History</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">

  <link rel="stylesheet" href="css/bootstrap.min.css">
  <style>
      body {
          padding-top: 50px;
          padding-bottom: 20px;
      }
  </style>
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/main.css">

  <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
  <link rel="stylesheet" type="text/css" href="css/orderHistory.css">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">

  
</head>

<body>
  <?php include ('navbar.php'); ?>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.1.1.min.js"><\/script>')</script>

  <script src="js/vendor/bootstrap.min.js"></script>>
  <script src="js/orderHistory.js"></script>

</body>

</html>