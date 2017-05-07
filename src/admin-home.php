<?php 
session_start();
include 'navbar.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">
	
<head>	
	<title>Admin Home Page</title>
	<link rel="stylesheet" type="text/css" href="css/admin.css">
	<link rel="stylesheet" type="text/css" href="css/footer.css">
	<link rel="stylesheet" type="text/css" href="css/navbar.css">
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome - <?php echo $userRow['email']; ?></title>
	
</head>

<body>
<p style="display: block; padding-top: 50px;"></p>
	<div id="adminContainer" class='container' style="border: 2px solid black;">
		<form class="" >
			<h2 style="display: block; padding-top: 0px;"> Would You Like To Add A New Product or Search The Data Base? </h2>
			
				<div id="newProductButton" class="form-group" style="float:left">
					<input type="button" id="newProductButton" class="btn btn-default" 
					onclick="location.href='createProduct.php';" value="Create New Product"/>
				</div>
			
				<div id="orderButton" class="form-group" style="float:right">
					<input type="button" id="orderButton" class="btn btn-default" 
					onclick="location.href='admin-order-search.php';" value="Search Data Base"/>
				</div>
		</form>
	</div>
	<p style="display: block; padding-top: 1px;"></p>

    <div id="footer"><?php include_once 'footer.php'; ?></div>
</body>
</html>