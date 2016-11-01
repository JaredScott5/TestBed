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
?>

<p  style='display: block; padding-top: 25px;'></p>

<table style='width:75%' align='center' cellpadding='2' cellspacing='2' border='2'>
	<tr>
		<th style='text-align:center'> Order # </th>
		<th style='text-align:center'> User Id </th>
		<th style='text-align:center'> Email </th>
		<th style='text-align:center'> Order Date </th>
		<th style='text-align:center'> Shipped Date </th>
		<th style='text-align:center'> Status </th>
		<th style='text-align:center'> Comments</th>
	</tr>
	
	 <?php while($itemRow = mysqli_fetch_assoc($result)) :?>
	
	<tr>
		<th style='text-align:center'><?php echo$itemRow["orderNumber"];?></th>
		<th style='text-align:center'><?php echo$itemRow["user_id"];?></th>
		<th style='text-align:center'><?php echo$itemRow["email"];?></th>
		<th style='text-align:center'><?php echo$itemRow["orderDate"];?></th> 
		<th style='text-align:center'><?php echo$itemRow["shippedDate"];?></th> 
		<th style='text-align:center'><?php echo$itemRow["status"];?></th> 
		<th style='text-align:center'><?php echo$itemRow["comments"];?></th> 
	</tr>
	<?php endwhile; ?>
	

 </table>
 <p  style='display: block; padding-bottom: 25px;'></p>

<?php $MySQLi_CON->close();?>

