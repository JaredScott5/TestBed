<?php
session_start();
include_once 'navbar-item-search.php';
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$query = "SELECT item_id, image, itemName, price, description ";
$query .= "FROM items ";
$result = mysqli_query($MySQLi_CON, $query);

//test if the query failed
if (!$result){
	die("Database query failed.");
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
<link rel="stylesheet" type="text/css" href="navbar.css">
<link rel="stylesheet" type="text/css" href="shopList.css">

<title>Shop</title>
</head>

<body>
  <ul>
    
    <p  style='display: block; padding-top: 50px;'></p>
    		
		<p id ="finalResult"></p>
		<div id="debug"> </div>
		
    <!-- return items table entries -->
	<div id="display">
		<?php while($row = mysqli_fetch_assoc($result)) : ?>

		<div id="shopListContainer" class='container'>
		
			<div class="row">
			<p id="itemName"><h1><?php echo $row["itemName"]; ?></h1><p/>
				<div id="firstCol" class="col-lg-2 col-md-4 col-sm-4">
			
					<p>
						<a href="item-page.php?item_id=<?php echo $row["item_id"]; ?>">
							<img class="img-responsive" src=<?php echo $row["image"];?> id='image'/>
						</a>
					</p>
				</div>
		
				<div id="secondCol" class="col-lg-8 col-md-6 col-sm-5">
				<br>
					<p id='price' style="font-size:20px; float:middle;">$<?php echo $row["price"]; ?></p>
					<p id='desc' style="font-size:20px; float:middle;"><?php echo $row["description"]; ?></p>
				</div>
		
				<div id="thirdCol" class="col-lg-2 col-md-2 col-sm-3">
					<a class='btn btn-lg btn-primary' id="addToCartButton" href='#' role='button' onClick='addToCart(<?php echo $row["item_id"]; ?>)'>Add To Cart</a>
				</div>
			</div>
		</div>
    <hr>
    <?php endwhile; ?>
    <?php mysqli_free_result($result); ?>
	</div>
  </ul>
  
  <div id="footer"><?php include_once 'footer.php'; ?></div>
  
<!-- the passed array is what we use in shopList.js for using the data from array $row-->
<script src="shopList.js"></script>
<script src="itemSearch.js"></script>
</body>

</html>