<?php
session_start();
include_once 'navbar.php';
include_once 'footer.php';
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
</head>

<body>

<p  style="display: block; padding-top: 50px;"></p>

<div class="item-name" style="display:inline-block;
	position: relative; left: 30px; font-size:45px;">
		
	</div>
	
	<div id="leftColumn" class="leftColumn" style="display:block; width:34.5%; float:left">
	<h1><?php echo $item_name ?> </h1>
		<div class="item-image" style="position: relative; left: 30px;">
			<img class="img-responsive" 
			width="200" 
			height="200"  
			src=<?php echo $row["image"]; ?> 
			id='image'>
			</img>
		</div>
	</div>
	<br>
	
	<div id="centerColumn" class="centerColumn" style="display:block; margin-left: 36.0%; margin-right: 270px;">
		<div style="position: relative; left: 30px; font-size:20px;"> 
		<hr><p style="border-left: 6px solid red; background-color: lightgrey">About this item:<br><?php echo $item_desc; ?></p></hr>
		</div>
	
		<div class="item-id" style="position: relative; left: 30px; font-size:20px;">
			<hr><p style="border-left: 6px solid red; background-color: lightgrey">Item ID#: <?php echo $item_id ?></p></hr>
		</div>

		<div class="item-price" style="position: relative; left: 30px; font-size:20px;">
			<hr><p style="border-left: 6px solid red; background-color: lightgrey">$<?php echo $item_price ?></p></hr>
		</div>
	
		<div class="item-desc" style="position: relative; left: 30px; font-size:20px;">
			<hr><p style="border-left: 6px solid red; background-color: lightgrey">Description: <br> <?php echo $item_desc ?></p></hr>
		</div>

		
		</div>
  </div>

  <div id="rightColumn" class="rightColumn" style="display:block; float:right; width: 34.5%; margin-left: 20px;">
  <div class="item-add-to-cart" style=" font-size:20px;">
		<hr> <a class='btn btn-lg btn-primary' href='#' role='button' onClick='addToCart(this.parentNode)'>Add To Cart</a></hr>
  </div>
  
<ul></ul>

<script src="shopList.js"></script>

</body>

</html>