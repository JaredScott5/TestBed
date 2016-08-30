<?php
session_start();
include_once 'navbar.php';
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
		
<title>Shop</title>
</head>

<body>
  <ul>
    
    <p  style='display: block; padding-top: 40px;'></p>
    
    <!-- return items table entries -->
    <?php while($row = mysqli_fetch_assoc($result)) : ?>
    

		<li id=<?php echo $row["item_id"]; ?> class='listItem'>
    <h1>Item <?php echo $row["item_id"]; ?></h1>
	<a href="item-page.php?item_id=<?php echo $row["item_id"]; ?>">
		<img class="img-responsive" 
		width="150" 
		height="150"  
		src=<?php echo $row["image"]; ?> 
		id='image'>
		</img>
		</a>
		
    <p id='itemName'><?php echo $row["itemName"]; ?></p>
    <p id='price'><?php echo $row["price"]; ?></p>
    <p id='desc'><?php echo $row["description"]; ?></p>
    <a class='btn btn-lg btn-primary' href='#' role='button' onClick='addToCart(this.parentNode)'>Add To Cart</a>
		</li>
    
    <?php endwhile; ?>
    
  </ul>
  
<!-- the passed array is what we use in shopList.js for using the data from array $row-->
<script src="shopList.js"></script>

</body>

</html>