<?php
$dbhost="localhost";
$dbuser="root";
$dbpass="";
$dbname="dbtest";
$connection=mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

if(mysqli_connect_errno()){
	die("Database connection failed: " .
	mysqli_connect_error() . " (" . mysqli_connect_errno() . ")"
	);
}else{
	echo "success";
}
?>

<?php
$query = "SELECT image, itemName, price, description ";
$query .= "FROM items ";
//$query .= "WHERE visible = 1 ";
//$query .= "ORDER BY position ASC";

$result = mysqli_query($connection, $query);

//test if the query failed
if (!$result){
	die("Database query failed.");
}

$cart = 0;
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

<header>
<nav>
<ul>
<li>username: </li>
<li>cart: <?php echo $cart;?> </li>
</ul>
</nav>
</header>

<body>
<ul>
<?php
$count = 1;
//return database database
while($row = mysqli_fetch_assoc($result)){
	?>
	<h1>Item <?php echo $count?></h1>
		<li> <p><?php echo $row["image"]; echo $row["itemName"]; 
	echo $row["price"]; echo $row["description"];  ?>
	<a class="btn btn-lg btn-primary" href="#" role="button">Add To Cart</a></p> 
	</li>
	<?php $count = $count + 1;?>
<?php
}
?>
</ul>

<?php
//release database
mysqli_free_result($result);
?>
</body>

</html>

<?php
mysqli_close($connection);
?>