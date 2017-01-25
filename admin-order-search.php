<?php 
session_start();
include_once 'dbconnect.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">

<link rel="stylesheet" type="text/css" href="css/footer.css">
<link rel="stylesheet" type="text/css" href="css/admin.css">

<head>	
<title>Admin Order Search Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>

	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css" type="text/css" />

<?php include ('navbar.php'); ?>
</head>

<body>

<p style="display: block; padding-top: 50px;"></p>

	<div id="adminContainer" class='container' style="border: 2px solid black;">
		<h2 style="display: block;">  </h2>
			<div>
				<form id="myForm" method="post">
					<fieldset>
						<h2>Search by user_id, email, or username</h2>
						<br>
						<input type="radio" name="radioGroup" id="userid" 
						value="0" checked="checked"/>
						<label for="userid" style="font-size:15px">user_id</label>
					
						<input type="radio" name="radioGroup"
						id="email" value="1"/>
						<label for="email" style="font-size:15px">email</label>
					
						<input type="radio"name="radioGroup"
						id="username" value="2"/>
						<label for="username" style="font-size:15px">username</label>
					
						<input type="radio"name="radioGroup"
						id="ordernumber" value="3"/>
						<label for="ordernumber" style="font-size:15px">ordernumber</label>
			
						<br><br>
						<?php 
						if(isset($_POST['search-bar']))
						{?>
							<input type='text' name="search-bar" id='search-bar' value=<?php echo $_POST['search-bar'];?>>
							<?php }
							else
							{?>
							<input type='text' name="search-bar" id='search-bar'>
						<?php };?>
						<input type="submit" name="search-orders" 
						class='btn btn-default' id="search-orders" value='Search'>

						<div id="orderButton" style="float:right">
							<input type="button" class="btn btn-default" onclick="location.href='admin-home.php';" 
							value="Return Home"/>	
						</div>
					</fieldset>
					<div id="debug"> </div>
				</form>
			</div>
		<p id ="finalResult">

<?php
if(isset($_POST['search-orders']))
{
	if(isset($_POST['search-bar']))
	{
		if(isset($_POST['radioGroup']))
		{
		//	echo "<br><br><br><br>search completed: " . $_POST['radioGroup'] . " " . $_POST['search-bar'];
		}else{
			echo "invalid search for radio. value is " . $_POST['radioVal'];
		}
	}else{
		echo "invalid search for searchTerm";
	}

	$searchTerm = $MySQLi_CON->real_escape_string(trim($_POST['search-bar']));
	$radioVal = $MySQLi_CON->real_escape_string(trim($_POST['radioGroup']));

	$query =
	"SELECT users.user_id, users.username, users.email, 
	orders.orderNumber, orders.orderDate, orders.shippedDate, 
	orders.status, orders.comments
	FROM orders 
	LEFT JOIN users
	ON orders.user_id = users.user_id
	WHERE users.user_id = '%$searchTerm%' 
	";

	if($radioVal == 0)
	{
	$query =
	"SELECT users.user_id, users.username, users.email, 
	orders.orderNumber, orders.orderDate, orders.shippedDate, 
	orders.status, orders.comments
	FROM orders 
	LEFT JOIN users
	ON orders.user_id = users.user_id
	WHERE users.user_id = '$searchTerm' 
	";
	}else if($radioVal == 1)
	{
	$query =
	"SELECT users.user_id, users.username, users.email, 
	orders.orderNumber, orders.orderDate, orders.shippedDate, 
	orders.status, orders.comments
	FROM orders 
	LEFT JOIN users
	ON orders.user_id = users.user_id
	WHERE users.email LIKE '%$searchTerm%'
	";
	}else if($radioVal == 2)
	{
	$query =
	"SELECT users.user_id, users.username, users.email, 
	orders.orderNumber, orders.orderDate, orders.shippedDate, 
	orders.status, orders.comments
	FROM orders 
	LEFT JOIN users
	ON orders.user_id = users.user_id
	WHERE users.username = '$searchTerm'
	";
	}else if($radioVal == 3)
	{
	$query =
	"SELECT users.user_id, users.username, users.email, 
	orders.orderNumber, orders.orderDate, orders.shippedDate, 
	orders.status, orders.comments
	FROM orders 
	LEFT JOIN users
	ON orders.user_id = users.user_id
	WHERE orders.orderNumber = '$searchTerm'
	";
	}

	$result=mysqli_query($MySQLi_CON, $query);
	//test if the query failed
	if (!$result){
		die("Database query failed.");
	}else{
		?>
		<hr>
	
	<table class='equalDevide' width='100%'  border='2'>
		<tr>
			<th style='text-align:center'> Order # </th> 
			<th style='text-align:center'> User Id </th>
			<th style='text-align:center'> Email </th>
			<th style='text-align:center'> Order Date </th>
			<th style='text-align:center'> Shipped Date </th>
			<th style='text-align:center'> Status </th>
			<th width='16%' style='text-align:center'> Comments</th>
		</tr>
	
		<?php while($itemRow = mysqli_fetch_assoc($result)) :?>
		<tr>
			<th width='14%' style='text-align:center'><?php echo $itemRow["orderNumber"]; ?></th>
			<th  style='text-align:center'><?php echo $itemRow["user_id"] ; ?></th>
			<th  style='text-align:center'><?php echo $itemRow["email"] ; ?></th>
			<th  style='text-align:center'><?php echo $itemRow["orderDate"] ; ?></th>
			<th  style='text-align:center'><?php echo $itemRow["shippedDate"] ; ?></th>
			<th  style='text-align:center'><?php echo $itemRow["status"] ; ?></th>
			<th width='16%' style='text-align:center'><?php echo $itemRow["comments"] ; ?></th>
			
		</tr>
		<?php endwhile; ?>
		
	 </table> 
	
	<p  style='display: block; padding-bottom: 10px;'></p>
	<?php }; ?>
<?php };//end if #1 
?>
		</p>
	</div>
	<p style="display: block; padding-top: 1px;"></p>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.1.1.min.js"><\/script>')</script>
<script src="js/vendor/bootstrap.min.js"></script>

<script src="js/adminsearch.js"></script>
<div id="footer"><?php include_once 'footer.php'; ?></div>
</body>
<?php $MySQLi_CON->close();?>
</html>