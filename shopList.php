<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();

//create an array of items from items table
$itemQuery = $MySQLi_CON->query("SELECT * FROM items");
$array = array();

//look through query 
while($itemRow = mysqli_fetch_assoc($itemQuery)){
	//add each row returned into an array
	$array[] = $itemRow;
}

$secondquery = "SELECT image, itemName, price, description ";
$secondquery .= "FROM items ";

$result = mysqli_query($MySQLi_CON, $secondquery);

//test if the query failed
if (!$result){
	die("Database query failed.");
}else{
	echo "<p></p>";
}

//$querytwo = $MySQLi_CON->query("SELECT * FROM items");
//echo $querytwo;
//$userRow=$query->fetch_array();
$MySQLi_CON->close();
?>

<?php
//mysqli_close($connection);
?>