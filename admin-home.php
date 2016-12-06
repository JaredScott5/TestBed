<?php 
session_start();
include 'navbar.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" 
integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" 
integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<html lang="en">
	<link rel="stylesheet" type="text/css" href="admin.css">
	<link rel="stylesheet" type="text/css" href="footer.css">

<head>	
	<title>Admin Home Page</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Welcome - <?php echo $userRow['email']; ?></title>
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
	<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
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