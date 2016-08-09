<?php
//session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users 
WHERE user_id=".$_SESSION['userSession']);

$userRow=$query->fetch_array();

$user = $userRow['username'];

//variabel for nuber of items from the db that will be displayed
$itemCount = 1;

//create an array of items from items table
$itemQuery = $MySQLi_CON->query("SELECT * FROM items");
$array = array();

//look through query 
while($itemRow = mysqli_fetch_assoc($itemQuery)){
	//add each row returned into an array
	$array[] = $itemRow;
}

$secondquery = "SELECT item_id, image, itemName, price, description ";
$secondquery .= "FROM items ";


$result = mysqli_query($MySQLi_CON, $secondquery);

//test if the query failed
if (!$result){
	die("Database query failed.");
}else{
}

//function displayItems(){
	global $result;
$count = 1;

echo "<ul>";

echo "<p  style='display: block; padding-top: 40px;'></p>";

//return database database
while($row = mysqli_fetch_assoc($result)){
	
	echo "<h1>" ."Item " . $row["item_id"] . "</h1>";
		echo "<li id=" . $row["item_id"] . " class='listItem'"; echo ">"; 
			echo "<img class=\"img-responsive\" width=\"150\" height=\"150\" src=" . $row["image"] . " id='image'>" . "</img>"; 
			echo "<p id='itemName'>"; echo $row["itemName"] . "</p>";
			echo "<p id='price'>"; echo $row["price"] . "</p>"; 
			echo "<p id='desc'>"; echo $row["description"] . "</p>";
			echo "<a class='btn btn-lg btn-primary' href='#' role='button' 
			  onClick='addToCart(this.parentNode)'>Add To Cart" . "</a>"; 
		echo "</li>";

}//enbd while
mysqli_free_result($result);
//}//end function
echo "</ul>";

function getUserName(){
	global $foo;
	$foo = $userRow['username'];
return $foo;
	}//return username



$MySQLi_CON->close();
?>

