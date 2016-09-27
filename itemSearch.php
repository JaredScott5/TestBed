<?php
include_once 'dbconnect.php';
 
if(isset($_POST['searchTerm']))
{
	//echo "search completed";
}else{
	echo "invalid search";
}

$searchTerm = $MySQLi_CON->real_escape_string(trim($_POST['searchTerm']));

//TODO: include order details for total cost, # of each item, id of each item 
//group by order number
$query =
"SELECT items.item_id, items.itemName, items.image, items.price, items.description
FROM items 
WHERE items.item_id LIKE '%$searchTerm%' 
OR items.itemName LIKE '%$searchTerm%'
";

//store query into readable form and send it to admin.js as a php echo
 $result=mysqli_query($MySQLi_CON, $query);
 
 //test if the query failed
if (!$result){
	die("Database query failed.");
}else{
//	echo "we have a result";
}
while($itemRow = mysqli_fetch_assoc($result)){
echo "<div id=" . $itemRow["item_id"] . " class='container'>" .
		"<h1>" . $itemRow["itemName"] . "</h1>" .
		"<div class='row'>" .
			"<div id='firstCol' class='col-lg-2 col-md-4 col-sm-4'>" .
			"<p><a href='item-page.php?item_id=" . $itemRow["item_id"] . "'>" .
				"<img class='img-responsive' width='150' height='150'  src=" . $itemRow["image"] . "" .  
				"id='image' align='top' style='float:left'></a></p>" .
			"</div>";
		
echo			"<div id='secondCol' class='col-lg-8 col-md-6 col-sm-5'>";
echo				"<p id='price' style='font-size:20px; float:middle;'>" . $itemRow["price"] . "</p>";
echo				"<p id='desc' style='font-size:20px; float:middle;'>" . $itemRow["description"] . "</p>";
echo			"</div>";
		
echo			"<div id='thirdCol' class='col-lg-2 col-md-2 col-sm-3'>";
echo				"<a class='btn btn-lg btn-primary' href='#' role='button' onClick='addToCart(" . $itemRow["item_id"] . ")'>Add To Cart</a>";
echo			"</div>";
echo		"</div>";
echo	"</div>";
}
$MySQLi_CON->close();
?>

