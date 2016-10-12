<?php
session_start();
include_once 'navbar.php';
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
<link rel="stylesheet" type="text/css" href="styles.css">
<title><?php echo $item_name ?></title>
</head>

<body>

<p  style="display: block; padding-top: 50px;"></p>

<div id="page">
	<div class="container">
	<h1><?php echo $item_name ?> </h1>
	</div>
	<div class="container" id="topContainer">
		<div class="row">
			<div id="firstCol" class="col-lg-10 col-md-10 col-sm-10" style="">
				<div id="item-image" style="position: relative;">
					<a href="item-page.php?item_id=<?php echo $row["item_id"]; ?>">
					<img class="" 
					width="200" 
					height="200"  
					src=<?php echo $row["image"]; ?> 
					id='image'></a>
					</img>
				</div>
			</div>

			<div id="thirdCol" class="col-lg-2 col-md-2 col-sm-2" style="">
				<div id="item-price" class="" style="position: relative; font-size:20px;">
					<p style="">$<?php echo $item_price ?></p>
				</div>
				<div class="item-add-to-cart" style="padding-top: 120px; right: 0;" id=<?php echo $item_id?>>
					<a class='btn btn-lg btn-primary' href='#' role='button' onClick='addToCart(<?php echo $row["item_id"]; ?>)'>Add To Cart</a>
				</div>
			</div>
		</div>  
	</div>
  
  <hr></hr>
	<div class="container" id="midContainer">
		<div class="" style="position: relative; font-size:20px;"> 
			<h3> About This Item:</h3>
				<div id="features">
					<p style="border-left: 6px solid red;"><?php echo $item_desc; ?></p>
				</div>
				<br>
		</div>
	</div>
	<hr></hr>
	<div class="container" id="midContainer">
		<div id="item-id" class="" style="position: relative; font-size:20px;">
			<h3> Item ID#: </h3>
			<p style="border-left: 6px solid red;"><?php echo $item_id ?></p>
		</div>
		<br>
	</div>
	<hr></hr>
	<div class="container" id="midContainer">
		<div id="item-desc" class="" style="position: relative; font-size:20px;">
			<h3> Description: <br></h3>
			<p style="border-left: 6px solid red;"><?php echo $item_desc ?></p>
		</div>
		<br>
	</div>
  </div>
<ul></ul>

<div id="footer"><?php include_once 'footer.php'; ?></div>

<script src="shopList.js"></script>

</body>

</html>