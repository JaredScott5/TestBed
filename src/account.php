<?php
  session_start();
  include_once 'dbconnect.php';

  if(!isset($_SESSION['userSession'])) {
    header("Location: index.php");
  }

  if(isset($_POST['btn-update'])) {
    $user_id = $_SESSION['userSession'];
    $upass = $MySQLi_CON->real_escape_string(trim($_POST['password']));

    $msg = "";
    
    $query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id='$user_id'");
    $row=$query->fetch_array();
    
    if(password_verify($upass, $row['password'])) {
      if (isset($_POST['email']) && trim($_POST['email']) != ''){
        $new_email = $MySQLi_CON->real_escape_string(trim($_POST['email']));
        $check_email = $MySQLi_CON->query("SELECT email FROM users WHERE email='$new_email'");
        $count=$check_email->num_rows;
        if($count==0){
          $query = 
            "UPDATE users
            SET email = '$new_email'
            WHERE user_id = '$user_id'";
          $MySQLi_CON->query($query);
          if($MySQLi_CON->query($query)) {
            $msg .= "<div class='alert alert-success'>
              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully updated email !
            </div>";
          } else {
            $msg .= "<div class='alert alert-danger'>
              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while updating email !
            </div>";
          }
        } else {
            $msg .= "<div class='alert alert-danger'>
              <span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry email already taken !
            </div>";
        }
      }
      if(isset($_POST['new-password']) && trim($_POST['new-password']) != '') {
        $newpass = $MySQLi_CON->real_escape_string(trim($_POST['new-password']));
        $new_password = password_hash($newpass, PASSWORD_DEFAULT);
        
        $query = 
          "UPDATE users
          SET password = '$new_password'
          WHERE user_id = '$user_id'";
        $MySQLi_CON->query($query);
        if($MySQLi_CON->query($query)) {
          $msg .= "<div class='alert alert-success'>
            <span class='glyphicon glyphicon-info-sign'></span> &nbsp; password successfully updated !
          </div>";
        } else {
          $msg .= "<div class='alert alert-danger'>
            <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while updating password !
          </div>";
        }
      }
    }
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
    <title>Update Account Info</title>
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
  <link rel="stylesheet" type="text/css" href="css/footer.css">

    <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
	<?php include ('navbar.php'); ?>
  </head>
  <body>
    
    <div class="update-form">
      <div class="container">
        <form class="form-update" method="post" id="login-form">
          <h2 class="form-update-heading">Update Account Information</h2>
          <hr />
          <?php
            if(isset($msg)){
              echo $msg;
            }
          ?>
          <div class="form-group">
            <input type="email" class="form-control" placeholder="Change Email Address" name="email"/>
            <span id="check-e"></span>
          </div>
          
          <div class="form-group">
            <input type="password" class="form-control" placeholder="New Password" name="new-password"/>
          </div>
          
          <div class="form-group">
            <input type="password" class="form-control" placeholder="Current Password (Required)" name="password" required />
          </div>

          <hr />
          <div class="form-group">
              <button type="submit" class="btn btn-default" name="btn-update" id="btn-update">
                <span class="glyphicon glyphicon-ok"></span> &nbsp; Update
              </button> 
          </div>  
        </form>
      </div>
	  
    </div>
<hr>

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