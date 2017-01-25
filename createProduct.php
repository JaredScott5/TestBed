<?php
session_start();

include_once 'dbconnect.php';
include_once 'navbar.php';

//check image params first
if(isset($_POST['btn-signup']))
{
	$itemName = $MySQLi_CON->real_escape_string(trim($_POST['itemName'])); 
	$department = $MySQLi_CON->real_escape_string(trim($_POST['department']));
	$price = $MySQLi_CON->real_escape_string(trim($_POST['price']));
	$price = ltrim($price, '$');  /*remove the $ from $price*/
	$desc = $MySQLi_CON->real_escape_string(trim($_POST['desc']));
	$target_dir = "img/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	list($width, $height) = getimagesize($target_file); /*acquire and store width/hieght image data in variables*/
	$image = $target_file;

// Check if file already exists or if its even a file
if ((!file_exists($target_file)) ||(($_FILES["fileToUpload"]["size"] > 50000))|| ($imageFileType != "jpg"))
{ 
	$uploadOk = 0;	 
}
else
{
	$upload = 1;
}

/* Check if $uploadOk is set to 0 by an error*/
if ($uploadOk == 0) 
{ 
	$msg = "<div class='alert alert-danger'>
		<span class='glyphicon glyphicon-info-sign'></span> 
		&nbsp; Sorry, image is unacceptable.
		<br>
		File should be under 50KB, a .jpg, and 200x200.
		<br>
		</div>";
} 
else /*if everything is ok, try to upload file*/
{
    if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
	{	
		//this is where we process the insert after some error checking	
		$check = $MySQLi_CON->query("SELECT itemName FROM items WHERE itemName='$itemName'");
		$count=$check->num_rows;
  
		if($count == 0)
		{
			$query = "INSERT INTO items(item_id, itemName, price, image, description, department) 
				VALUES(NULL, '$itemName','$price', '$target_file', '$desc', '$department')";
  
			if($MySQLi_CON->query($query))
			{
				$msg = "<div class='alert alert-success'>
				<span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
				</div>";
			}
			else
			{
				$msg = "<div class='alert alert-danger'>
				<span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering " . $target_file  . " !
				</div>";
			}
		}
		else
		{
			$msg = "<div class='alert alert-danger'>
			<span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry item already taken ! " . $count . "
			</div>"; 
		} 	
    } 
	else 
	{
		$msg = "<div class='alert alert-danger'>
		<span class='glyphicon glyphicon-info-sign'></span> &nbsp; Sorry, there was an error uploading your file.
		</div>";
    }
}
 
 $MySQLi_CON->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

<html lang="en">
	<head>

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

			<link rel="stylesheet" href="css/bootstrap.min.css">


		<link rel="stylesheet" type="text/css" href="footer.css">
		<link rel="stylesheet" type="text/css" href="navbar.css">

	</head>
<body>
<p style="display: block; padding-top: 50px;"></p>

<div class="signin-form">
	<div class="container" style="border: 2px solid black;">    
		<form class="form-signin" method="post" enctype="multipart/form-data" id="register-form">     
			<h2 class="form-signin-heading">Create New Product</h2><hr />        
			<?php
			if(isset($msg)){
				echo $msg;
			}else{
			?>    
				<div class='alert alert-info'>
					<span class='glyphicon glyphicon-asterisk'></span> &nbsp; all the fields are mandatory !
				</div>
				<?php
			}
			?>
          
			<div class="form-group">
				<input type="text" class="form-control" placeholder="itemName" name="itemName" required  />
			</div>
        
			<div class="form-group">
				<input type="text" class="form-control" placeholder="price" name="price" required  />
				<span id="check-e"></span>
			</div>
        
			<div class="form-group">
				<input type="text" class="form-control" placeholder="department" name="department" required  />
				<span id="check-e"></span>
			</div>
			
			<div class="form-group">
				<input type="file" accept=".jpg" class="form-control" name="fileToUpload" id="fileToUpload" required  />
			</div>
		
			<div class="form-group">
				<input type="text" class="form-control" placeholder="desc" name="desc" required  />
			</div>
        
			<hr/>
        
			<div class="form-group">
				<button type="submit" class="btn btn-default" name="btn-signup">
					<span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Product
				</button> 
				<div id="orderButton" style="float:right">
					<input type="button" class="btn btn-default" onclick="location.href='admin-home.php';" value="Return to admin home"/>
				</div> 
			</div>
		</form>
    </div>
</div>
	<p style="display: block; padding-top: 1px;"></p>

<div id="footer"><?php include_once 'footer.php'; ?></div>

</body>
</html>