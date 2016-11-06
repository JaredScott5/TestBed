<?php
session_start();
include_once 'navbar.php';
include_once 'dbconnect.php';

if(isset($_POST['btn-add-item']))
{
 $itemName = $MySQLi_CON->real_escape_string(trim($_POST['itemName']));
 $price = $MySQLi_CON->real_escape_string(trim($_POST['price']));
 $image = $MySQLi_CON->real_escape_string(trim($_POST['image']));
 $description = $MySQLi_CON->real_escape_string(trim($_POST['description']));
 
 $queryCheck = 
			$MySQLi_CON->query("SELECT *
			FROM items
			WHERE itemName='$itemName'");
 $count = $queryCheck->num_rows;
 
 if($count==0){
	 $query = "INSERT INTO items(itemName, price, image, description)
				VALUES('$itemName', '$price', '$image', '$description')";
				
	if($MySQLi_CON->query($query)){
		$msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered new item!
     </div>";
	}else{
		$msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
     </div>";
	}
}else
 {
  $msg = "item is already in data base";
 }
 mysqli_free_result($query);
 $MySQLi_CON->close();
?>  

 <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<html lang="en">

<head>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<link rel="stylesheet" type="text/css" href="footer.css">
</head>

<body>

	<p  style="display: block; padding-top: 50px;"></p>

	<div class="container">
		<form class="form-signin" method="post">
		
			<fieldset>
				<legend>New Item Details</legend>
		
				Item Name:<br>
				<input type="text" name="itemName" required><br><br>

				Price:<br>
				<input type="text" name="price" required><br><br>

				Image:<br>
				<input type="text" name="image" required><br><br>

				Description:<br>
				<input type="text" name="description" required><br><br>

				<div class="form-group">
					<button type="submit" class="btn btn-default" name="" id="btn-add-item">
						<span class="glyphicon glyphicon-log-in"></span> &nbsp; Add Item
					</button> 
                       
				</div> 
			</fieldset>
		</form>
	</div>
	
	<div id="footer"><?php include_once 'footer.php'; ?></div>

</body>

</html>