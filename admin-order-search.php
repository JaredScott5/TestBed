<?php 
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">

<html lang="en">

<link rel="stylesheet" type="text/css" href="footer.css">
<link rel="stylesheet" type="text/css" href="admin.css">

<head>
		
<title>Admin Order Search Page</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome - <?php echo $userRow['email']; ?></title>

	<link rel="stylesheet" href="css/bootstrap.min.css">

<?php include ('navbar.php'); ?>

</head>

<body>

<p style="display: block; padding-top: 50px;"></p>

<div id="adminContainer" class='container' style="border: 2px solid black;">
	<h2 style="display: block;">  </h2>
		<div>
			<form id="myForm" method="POST">
				<fieldset>
				<label>Search by user_id, email, or username</label>
				<br>
					<input 
					type="radio" 
					name="radioGroup"
					id="userid" 
					value="0" 
					checked="checked"/>
					<label for="userid">user_id</label>
					
					<input 
					type="radio" 
					name="radioGroup"
					id="email" 
					value="1"/>
					<label for="email">email</label>
					
					<input 
					type="radio"
					name="radioGroup"
					id="username" 
					value="2"/>
					<label for="username">username</label>
					
					<input 
					type="radio"
					name="radioGroup"
					id="ordernumber" 
					value="3"/>
					<label for="ordernumber">ordernumber</label>
			
		<!--</div>-->
					<br>
		<!--<div id="orderButton" style="float:left">-->
					<input type='text' id='search_bar'>
			<input type="button" class='btn btn-default search-orders' id="search_string" value='Search'>	
			<!--<a class='btn btn-lg btn-primary search-orders' href='#' role='button'>Search</a>-->

					<div id="orderButton" style="float:right">
						<input type="button" class="btn btn-default" onclick="location.href='admin-home.php';" 
						value="Return Home"/>	
					</div>
				</fieldset>
			<div id="debug"> </div>
			</form>
		</div>
			
		<p id ="finalResult"></p>
		
</div>
	<p style="display: block; padding-top: 1px;"></p>

    <div id="footer"><?php include_once 'footer.php'; ?></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.1.1.min.js"><\/script>')</script>
<script src="js/vendor/bootstrap.min.js"></script>

<script src="adminsearch.js"></script>

</body>

</html>