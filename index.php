<?php
session_start();
include_once 'dbconnect.php';

if(isset($_SESSION['userSession'])!="")
{
 header("Location: home.php");
 exit;
}

if(isset($_POST['btn-login']))
{
 $email = $MySQLi_CON->real_escape_string(trim($_POST['user_email']));
 $upass = $MySQLi_CON->real_escape_string(trim($_POST['password']));
 
 $query = $MySQLi_CON->query("SELECT * FROM users WHERE email='$email'");
 $row=$query->fetch_array();
 
 if(password_verify($upass, $row['password']))
 {
  $_SESSION['userSession'] = $row['user_id'];
  $_SESSION['username'] = $row['username'];
  $user_id = $_SESSION['userSession'];
  $check_cart = $MySQLi_CON->query(
    "SELECT *
    FROM orders
    WHERE user_id='$user_id' AND status='In Cart'"
  );
  $count=$check_cart->num_rows;
  $cartCount = 0;
  if ($count!=0){
    $cartRow = mysqli_fetch_assoc($check_cart); // $check_cart only has one row, the 'In Cart' order
    $orderNumber = $cartRow['orderNumber'];
    $check_items = $MySQLi_CON->query(
    "SELECT *
    FROM orderDetails
    WHERE orderNumber = '$orderNumber'"
    );
    while ($cartRow = mysqli_fetch_assoc($check_items)){
      $cartCount=$cartCount + $cartRow['quantityOrdered'];
    }
    mysqli_free_result($check_cart);
  }
  $_SESSION['cartCount'] = $cartCount;
  //this line determines if the user is an admin or not
  if($row['admin_flag'] == 1){
    header("Location: admin-home.php");
  } else {
    header("Location: home.php");
  }
 }
 else
 {
  $msg = "
        email or password does not exist !
    ";
 }
 mysqli_free_result($query);
 $MySQLi_CON->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<link rel="stylesheet" type="text/css" href="footer.css">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration</title>
<link href="libs/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
</head>
<body>

<div class="signin-form">

 <div class="container">
     
        
       <form class="form-signin" method="post" id="login-form">
      
        <h2 class="form-signin-heading">Sign In.</h2><hr />
        
        <?php
  if(isset($msg)){
   echo $msg;
  }
  ?>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="user_email" required />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
        <input type="password" class="form-control" placeholder="Password" name="password" required />
        </div>
       
      <hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-login" id="btn-login">
      <span class="glyphicon glyphicon-log-in"></span> &nbsp; Sign In
   </button> 
            
            <a href="register.php" class="btn btn-default" style="float:right;">Sign UP Here</a>
            
        </div>  
      </form>
    </div>
</div>

<div id="footer"><?php include_once 'footer.php'; ?></div>

</body>
</html>