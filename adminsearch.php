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
"SELECT users.user_id, users.username, users.email, 
orders.orderNumber, orders.orderDate, orders.shippedDate, orders.status, orders.comments
FROM orders 
LEFT JOIN users
ON orders.user_id = users.user_id
WHERE users.username LIKE '%$searchTerm%' 
OR users.email LIKE '%$searchTerm%'
OR orders.orderNumber = '$searchTerm'
OR orders.orderDate LIKE '%$searchTerm%'
";

//store query into readable form and send it to admin.js as a php echo

 $result=mysqli_query($MySQLi_CON, $query);
 //test if the query failed
if (!$result){
	die("Database query failed.");
}else{
}

//these echos are the 'responseText' sent back to admin.js
 echo "<p  style='display: block; padding-top: 100px;'></p>";
 echo "<p " . $searchTerm . "p/>";
 echo "<table style='width:75%' align='center' cellpadding='2' cellspacing='2' border='2'>";
 echo "<tr>";
		echo "<th style='text-align:center'> Order # </th>"; 
		echo "<th style='text-align:center'> User Id </th>";
		echo "<th style='text-align:center'> Email </th>"; 
    echo "<th style='text-align:center'> Order Date </th>"; 
		echo "<th style='text-align:center'> Shipped Date </th>"; 
		echo "<th style='text-align:center'> Status </th>";
		echo "<th style='text-align:center'> Comments</th>";
	echo "</tr>";
	
	 while($itemRow = mysqli_fetch_assoc($result)){
	
	echo "<tr>";
		echo "<th style='text-align:center'>" . $itemRow["orderNumber"] . "</th>";
		echo "<th style='text-align:center'>" . $itemRow["user_id"] . "</th>";
		echo "<th style='text-align:center'>" . $itemRow["email"] . "</th>"; 
    echo "<th style='text-align:center'>" . $itemRow["orderDate"] . "</th>"; 
		echo "<th style='text-align:center'>" . $itemRow["shippedDate"] . "</th>"; 
		echo "<th style='text-align:center'>" . $itemRow["status"] . "</th>"; 
		echo "<th style='text-align:center'>" . $itemRow["comments"] . "</th>"; 
	echo "</tr>";	
 }
 echo "<th> </th>";
 echo "<th> </th>";
 echo "<th> </th>";
 echo "<th> </th>";
 echo "<th> </th>";
 echo "<th> </th>";
 echo "</table>";

$MySQLi_CON->close();
?>

