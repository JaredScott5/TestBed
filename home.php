<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$MySQLi_CON->close();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

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
  
  <link rel="stylesheet" type="text/css" href="styles.css">
  <link rel="stylesheet" type="text/css" href="footer.css">
  <link rel="stylesheet" type="text/css" href="home.css">
  
</head>

<body>
  <?php include ('navbar.php'); ?>
  <div class="jumbotron text-center">
    <br/><h1>Test Shop</h1><br/>
    <p>This website serves as an interface for testing our order processing software.</p> 
  </div>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <h3>Shop List</h3>
        <p>Contains the list of items available for sale.</p>
        <p>Add to Cart adds items to the current customer's cart.</p>
      </div>
      <div class="col-sm-4">
        <h3>Order History</h3>
        <p>Allows the user to check the status of their orders.</p>
        <p>Contains all orders the user has ever checked out.</p>
      </div>
      <div class="col-sm-4">
        <h3>Cart</h3> 
        <p>Contains all items the user has added to their unprocessed order.</p>
        <p>The cart is persistent across user sessions.</p>
      </div>
    </div>
  </div>


<div id="footer"><?php include_once 'footer.php'; ?></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.1.1.min.js"><\/script>')</script>

<script src="js/vendor/bootstrap.min.js"></script>

<script src="js/main.js"></script>



</body>
</html>