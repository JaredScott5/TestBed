<?php
session_start();
include_once 'dbconnect.php';
include_once 'navbar.php';

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
	$orderNum = $tempItemRow["orderNumber"];

//if not empty display the order as a table
if($rowCount!=0){
 //look through join query based off orderdetails and items and display
 $secondQuery =
 "
 SELECT orderDetails.orderNumber, orderDetails.item_id, orderDetails.quantityOrdered,
		items.itemName, items.price, items.image
 FROM orderDetails
 INNER JOIN items
 ON orderDetails.item_id = items.item_id
 WHERE orderDetails.orderNumber='$orderNum'
 ";

 $result=mysqli_query($MySQLi_CON, $secondQuery);

  //test if the query failed
  if (!$result){
    die("Database query failed.");
  }else{
  }
}

//free the variable, we should not need it now
mysqli_free_result($check_cart);

$MySQLi_CON->close();
?>


<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Welcome - <?php echo $userRow['email']; ?></title>
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

  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="css/shoppingCart.css">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">

</head>

<body>
<form id="cart">
  <div class="container">
  <div class="well">
  <?php $count = 0; ?>
  <?php $total = 0; ?>
  <?php if(isset($result) && $result->num_rows != 0) : ?>
  <div id="order-header">Order Number: <span id="orderNum"><?php echo $orderNum; ?></span></div>
    <?php while($itemRow = mysqli_fetch_assoc($result)) : ?>
      <?php $subTotal = $itemRow['price'] * $itemRow['quantityOrdered']; ?>
      <?php $total += $subTotal; ?>
      <div class="item-line">
        <div class="summary">
          <div class="row" id="<?php echo $itemRow['item_id']; ?>">
            <div class="col-xs-2">
              <p id="item-img"><?php echo "<img class=\"img-responsive\" width=\"150\" height=\"150\" src=" . $itemRow['image'] . "></img>"; ?></p>
            </div>
            <div class="col-xs-2">
              <span class="item-name"><strong>Item: </strong><?php echo $itemRow['itemName']; ?></span>
            </div>
            <div class="col-xs-2">
              <strong>Price: </strong><span class="price">$<?php echo $itemRow['price']; ?></span>
            </div>
            <div class="col-xs-2">
              <strong>In Cart:</strong><input class='form-control' type="number" min="1" value="<?php echo $itemRow['quantityOrdered']; ?>">
              </input>
            </div>
            <div class="col-xs-2">
              <strong>Subtotal: </strong><span class="subtotal">$<?php echo $subTotal; ?></span>
            </div>
            <div class="col-xs-2">
              <button class="remove">Remove From Cart</button>
            </div>
          </div>
        </div>
      </div>
    <?php ++$count; ?>
    <?php endwhile; ?>
    </form>

    <?php $check = mysqli_data_seek ($result, 0); ?>
    <?php if($check != NULL): ?>
    <div id="checkout-info" class="container">
      <span><strong>Total: </strong></span><p id="total">$<?php echo $total ?></p>
      <button class="checkout">Checkout</button>
    </div>
    <?php endif; ?>
  <?php else: ?>
    <div class="well"><h3 id="empty-cart-msg">Your cart is empty.</h3></div>
  <?php endif; ?>
  </div>
  </div> <!-- container -->

<?php if (isset($result)) mysqli_free_result($result); ?>
<div id="footer"><?php include_once 'footer.php'; ?></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.1.1.min.js"><\/script>')</script>

<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/shoppingCart.js"></script>

</body>


</html>
