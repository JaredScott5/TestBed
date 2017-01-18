<?php
session_start();
if(isset($_SESSION['userSession'])!="")
{
 header("Location: home.php");
}
include_once 'dbconnect.php';

if(isset($_POST['btn-signup']))
{
 $uname = $MySQLi_CON->real_escape_string(trim($_POST['user_name']));
 $email = $MySQLi_CON->real_escape_string(trim($_POST['user_email']));
 //$upass = $MySQLi_CON->real_escape_string(trim($_POST['password']));
 
 $new_password = rand(1000,5000);//= password_hash($upass, PASSWORD_DEFAULT);
 
 //create a email/link password
 $hash = md5( rand(0,1000) );
 
 $check_email = $MySQLi_CON->query("SELECT email FROM users WHERE email='$email'");
 $count=$check_email->num_rows;
 
 if($count==0){
 // $query = "INSERT INTO users(username,email,password) VALUES('$uname','$email','$new_password')";

 //this is where we enter the new code for sending an email for confirmation
  $query = "INSERT INTO users(username,email,password,hash) VALUES('$uname','$email','$new_password', '$hash')";

  
  
  if($MySQLi_CON->query($query))
  {
   $msg = "<div class='alert alert-success'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; successfully registered !
     </div>";
	 
	 
	 //test email
	 
/**
 * This example shows sending a message using PHP's mail() function.
 */

//require '../PHPMailerAutoload.php';
require '/libs/PHPMailer-master/PHPMailerAutoload.php';
//Create a new PHPMailer instance
$mail = new PHPMailer;
//Set who the message is to be sent from
$mail->setFrom('from@example.com', 'First Last');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress('jmsmm92@gmail.com');
//Set the subject line
$mail->Subject = 'PHPMailer mail() test';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('testEmail.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}

	 
	 
	 //send confirmation email
	 
	 
	 /*
	 $to      = $email; // Send email to our user
	$subject = 'Signup | Verification'; // Give the email a subject 
	$message = '
 
	Thanks for signing up!
	Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
 
	------------------------
	Username: '.$uname.'
	Password: '.$new_password.'
	------------------------
 
Please click this link to activate your account:
http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'
 
'; // Our message above including the link
                     
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set 
mail($to, $subject, $message, $headers); // Send our email
*/
  }else{
   $msg = "<div class='alert alert-danger'>
      <span class='glyphicon glyphicon-info-sign'></span> &nbsp; error while registering !
     </div>";
  }
 }else{
  
  
  $msg = "<div class='alert alert-danger'>
     <span class='glyphicon glyphicon-info-sign'></span> &nbsp; sorry email already taken !
    </div>";
   
 }
 
 $MySQLi_CON->close();
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login & Registration System</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
<link rel="stylesheet" href="style.css" type="text/css" />
<link rel="stylesheet" type="text/css" href="footer.css">

</head>
<body>

<div class="signin-form">

 <div class="container">
      
    <form class="form-signin" method="post" id="register-form">
      
        <h2 class="form-signin-heading">Sign Up</h2><hr />
        
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
        <input type="text" class="form-control" placeholder="Username" name="user_name" required  />
        </div>
        
        <div class="form-group">
        <input type="email" class="form-control" placeholder="Email address" name="user_email" required  />
        <span id="check-e"></span>
        </div>
        
        <div class="form-group">
       <!-- <input type="password" class="form-control" placeholder="Password" name="password" required  /> -->
        </div>
        
      <hr />
        
        <div class="form-group">
            <button type="submit" class="btn btn-default" name="btn-signup">
      <span class="glyphicon glyphicon-log-in"></span> &nbsp; Create Account
   </button> 
            
            <a href="index.php" class="btn btn-default" style="float:right;">Log In Here</a>
            
        </div> 
      
      </form>
    </div>
</div>
<div id="footer"><?php include_once 'footer.php'; ?></div>

</body>
</html>