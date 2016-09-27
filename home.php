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
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>

<link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">

<link rel="stylesheet" href="home.css" type="text/css" />

<?php include ('navbar.php'); ?>

</head>
<body>
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

</body>
</html>