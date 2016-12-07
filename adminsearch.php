<?php
include_once 'dbconnect.php';
 
if(isset($_POST['searchTerm']))
{
	//echo "search completed";
}else{
	echo "invalid search";
}
$test = 0;
$searchTerm = $MySQLi_CON->real_escape_string(trim($_POST['searchTerm']));
$query =
"SELECT users.user_id, users.username, users.email, 
orders.orderNumber, orders.orderDate, orders.shippedDate, orders.status, orders.comments
FROM orders 
LEFT JOIN users
ON orders.user_id = users.user_id
WHERE users.user_id = '%$searchTerm%' 
";
//TODO: do an if for each checkbox POST value do determine query 
if(isset($_POST['userid']))
{
$query =
"SELECT users.user_id, users.username, users.email, 
orders.orderNumber, orders.orderDate, orders.shippedDate, orders.status, orders.comments
FROM orders 
LEFT JOIN users
ON orders.user_id = users.user_id
WHERE users.user_id = '%$searchTerm%' 
";
$test = 1;
}

if(isset($_POST['email']))
{
$query =
"SELECT users.user_id, users.username, users.email, 
orders.orderNumber, orders.orderDate, orders.shippedDate, orders.status, orders.comments
FROM orders 
LEFT JOIN users
ON orders.user_id = users.user_id
WHERE users.email = '%$searchTerm%'
";
$test = 2;
}

if(isset($_POST['username']))
{
$query =
"SELECT users.user_id, users.username, users.email, 
orders.orderNumber, orders.orderDate, orders.shippedDate, orders.status, orders.comments
FROM orders 
LEFT JOIN users
ON orders.user_id = users.user_id
WHERE users.username = '$searchTerm'
";
$test = 3;
}

if(isset($_POST['ordernumber']))
{
$query =
"SELECT users.user_id, users.username, users.email, 
orders.orderNumber, orders.orderDate, orders.shippedDate, orders.status, orders.comments
FROM orders 
LEFT JOIN users
ON orders.user_id = users.user_id
WHERE orders.orderNumber = '$searchTerm'
";
$test = 4;
}
//store query into readable form and send it to admin.js as a php echo

 $result=mysqli_query($MySQLi_CON, $query);
 //test if the query failed
if (!$result){
	die("Database query failed.");
}else{
}
?>

<p  style='display: block; padding-top: 25px;'></p>
<style>

</style>
<?php echo $test; ?>
<center>
<table class="equalDevide" width="100%"  border='2'>
	<tr>
		<th  style='text-align:center'> Order # </th>
		<th  style='text-align:center'> User Id </th>
		<th  style='text-align:center'> Email </th>
		<th  style='text-align:center'> Order Date </th>
		<th  style='text-align:center'> Shipped Date </th>
		<th style='text-align:center'> Status </th>
		<th width='16%' style='text-align:center'> Comments</th>
	</tr>
	
	 <?php while($itemRow = mysqli_fetch_assoc($result)) :?>
	<tr>
		<th width='14%' style='text-align:center'><?php echo$itemRow["orderNumber"];?></th>
		<th  style='text-align:center'><?php echo$itemRow["user_id"];?></th>
		<th  style='text-align:center'><?php echo$itemRow["email"];?></th>
		<th  style='text-align:center'><?php echo$itemRow["orderDate"];?></th> 
		<th  style='text-align:center'><?php echo$itemRow["shippedDate"];?></th> 
		<th  style='text-align:center'><?php echo$itemRow["status"];?></th> 
		<th width='16%' style='text-align:center'><?php echo$itemRow["comments"];?></th> 
	</tr>
	<?php endwhile; ?>
 </table>
 </center>
 <p  style='display: block; padding-bottom: 25px;'></p>

<?php $MySQLi_CON->close();?>

