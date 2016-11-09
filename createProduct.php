<?php
session_start();

include_once 'dbconnect.php';
include_once 'navbar.php';

if(isset($_POST['btn-signup']))
{
 $itemName = $MySQLi_CON->real_escape_string(trim($_POST['itemName']));
 $price = $MySQLi_CON->real_escape_string(trim($_POST['price']));
 $desc = $MySQLi_CON->real_escape_string(trim($_POST['desc']));
 
 
 $check = $MySQLi_CON->query("SELECT itemName FROM items WHERE itemName='$itemName'");
 $count=$check->num_rows;
 
 if($count==0){
  
  $query = "INSERT INTO items(item_id, itemName, price, image, description) 
  VALUES(NULL, '$itemName','$price', NULL, '$desc')";

  
  if($MySQLi_CON->query($query))
  {
   $msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
     </div>";
  }
  else
  {
   $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
     </div>";
  }
 }
 else{
  
  
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry email already taken !
    </div>";
   
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
<link rel="stylesheet" type="text/css" href="navbar.css">

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> 
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 

<link rel="stylesheet" type="text/css" href="footer.css">

</head>
<body>
<p style="display: block; padding-top: 50px;"></p>

<div class="signin-form">

 <div class="container" style="border: 2px solid black;>
      
    <form class="form-signin" method="post" id="register-form">
      
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
        <input type="password" class="form-control" placeholder="desc" name="desc" required  />
        </div>
        
      <hr />
        
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