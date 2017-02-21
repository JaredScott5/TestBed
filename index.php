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
        email or password does not exist
    ";
 }
 mysqli_free_result($query);
 $MySQLi_CON->close();
}
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
  <head>
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
      <title>Login $ Registration</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="apple-touch-icon" href="apple-touch-icon.png">

      <link rel="stylesheet" href="css/bootstrap.min.css">
      <style>
          body {
              padding-top: 50px;
              padding-bottom: 20px;
          }
      </style>
      <link rel="stylesheet" href="css/bootstrap-theme.min.css">
      <link rel="stylesheet" href="css/main.css">

      <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
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

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.1.1.min.js"><\/script>')</script>

  <script src="js/vendor/bootstrap.min.js"></script>

  <script src="js/main.js"></script>

  <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
  <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='https://www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X','auto');ga('send','pageview');
  </script>

  </body>
</html>