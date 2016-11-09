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
	$orderNum = $tempItemRow["orderNumber"];
	
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
  }
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
<link rel="stylesheet" type="text/css" href="styles.css">
<link rel="stylesheet" type="text/css" href="shoppingCart.css">
<link rel="stylesheet" type="text/css" href="navbar.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>

<link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="libs/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen"> 

<link rel="stylesheet" type="text/css" href="footer.css">

</head>

<body>

<form id="cart" class="container">
  <?php $count = 0; ?>
  <?php $total = 0; ?>
  <?php if(isset($result)) : ?>
    <?php while($itemRow = mysqli_fetch_assoc($result)) : ?>
      <?php $subTotal = $itemRow['price']  * $itemRow['quantityOrdered']; ?>
      <?php $total += $subTotal; ?>
      <div class="row" id="<?php echo $itemRow['item_id']; ?>">
        <div class="col-xs-2">
          <p id="item-img"><?php echo "<img class=\"img-responsive\" width=\"150\" height=\"150\" src=" . $itemRow['image'] . "></img>"; ?></p>
        </div>
        <div class="col-xs-2">
          <p class="item-name"><b>Item: </b><?php echo $itemRow['itemName']; ?></p>
        </div>
        <div class="col-xs-1">
          <p><b>Price: </b></p>
        </div>
        <div class="col-xs-1">
          <p class="price">$<?php echo $itemRow['price']; ?></p>
        </div>
        <div class="col-xs-1">
          <p><b>In Cart:</b></p>
        </div>
        <div class="col-xs-1">
          <input class='form-control' type="number" min="1" value="<?php echo $itemRow['quantityOrdered']; ?>">
          </input>
        </div>
        <div class="col-xs-1">
          <p><b>Subtotal: </b></p>
        </div>
        <div class="col-xs-1">
          <p class="subtotal">$<?php echo $subTotal; ?></p>
        </div>
        <div class="col-xs-2">
          <button class="remove">Remove From Cart</button>
        </div>
      </div>
    <?php ++$count; ?>
    <?php endwhile; ?>
    </form>
    
    <?php $check = mysqli_data_seek ($result, 0); ?>
    <?php if($check != NULL): ?>
    <div id="checkout-info" class="container">
      <p id="total"><b>Total: </b>$<?php echo $total ?></p>
      <button onclick="checkOut(<?php echo $orderNum; ?>, <?php echo $total; ?>)">Checkout</button>
    </div>
    <?php endif; ?>
  <?php else: ?>
    <p id="empty-cart-msg">Your cart is empty.</p>
  <?php endif; ?>
  

<?php if (isset($result)) mysqli_free_result($result); ?>
<div id="footer"><?php include_once 'footer.php'; ?></div>
<script src="libs/jquery/jquery-3.0.0.min.js"></script>
<script src="shoppingCart.js">
</script>

</body>


</html>