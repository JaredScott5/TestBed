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


<link rel="stylesheet" href="style.css" type="text/css" />

<?php include ('navbar.php'); ?>

</head>

<body>

<p style="display: block; padding-top: 50px;"></p>

<div id="adminContainer" class='container' style="border: 2px solid black;">
<h2 style="display: block;"> Search by user_id, email, or username </h2>
<div id="orderButton" style="float:left">
    <input type='text' id='search_bar'>
        <input type='button' class="btn btn-default" id='search_string' value='Search' onClick="search()">	
		<p id ="finalResult"></p>
		<div id="debug"> </div>
		</div>
		
		<div id="orderButton" style="float:right">
			<input type="button" class="btn btn-default" onclick="location.href='admin-home.php';" 
			value="Return Home"/>	
</div>
</div>
	<p style="display: block; padding-top: 1px;"></p>


    <div id="footer"><?php include_once 'footer.php'; ?></div>
<script src="adminsearch.js">
</script>

</body>

</html>