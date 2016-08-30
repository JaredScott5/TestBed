<?php
session_start();
include_once 'dbconnect.php';

if(isset($_GET['item_id'])){
$item_id = $_GET['item_id'];

$find_item = $MySQLi_CON->query(
    "SELECT *
    FROM items
    WHERE item_id='$item_id'"
  );
  
  $row = mysqli_fetch_assoc($find_item);
$item_id = $row['item_id'];
$item_name = $row['itemName'];
$item_price = $row['price'];
$item_image = $row['image'];
$item_desc = $row['description'];
	}else{
//		 echo "<p  style='display: block; padding-top: 100px;'></p>";
//	echo "error: variable is not set properly";
//	echo "post is " . $_GET['item_id'];
}
?>

 
  
 <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


<html lang="en">
<head>
<title><?php echo $item_name ?></title>
<?php include ('navbar.php'); ?>
</head>

<body>

<p  style="display: block; padding-top: 40px;"></p>
 <div class="item" style="display:block; border:1px solid  black">
	<div class="item-image" style="display:inline-block; border:1px solid  black;
	position: relative; left: 30px;">
		<?php echo $item_image ?>
	</div>
	<br>
	<br>
    <div class="item-name" style="display:inline-block; border:1px solid  black;
	position: relative; left: 30px;">
		<?php echo $item_name ?> 
	</div>
	<br>
	<br>
	<div class="item-id" style="display:inline-block; border:1px solid  black;
	position: relative; left: 30px;">
		Item ID#: <?php echo $item_id ?>
	</div>
	<br>
	<br>
    <div class="item-price" style="display:inline-block; border:1px solid  black;
	position: relative; left: 30px;">
		$<?php echo $item_price ?>
	</div>
	<br>
	<br>
	<div class="item-desc" style="display:inline-block; border:1px solid  black;
	position: relative; left: 30px;">
		Description: <br>
		<?php echo $item_desc ?>
	</div>
	<br><br>
    <div class="item-add-to-cart" style="position: relative; left: 30px;">
       <a class='btn btn-lg btn-primary' href='#' role='button' 
		  onClick='addToCart(this.parentNode)'>Add To Cart</a>
    </div>
  </div>

<ul>
</ul>



</body>

</html>