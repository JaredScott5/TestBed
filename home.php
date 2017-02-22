<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();

$result = $MySQLi_CON->query("
SELECT item_id, image, itemName, price, description, DATE(dateAdded) 
AS time
FROM items
ORDER BY dateAdded DESC, dateAdded ASC
LIMIT 6");

if (!$result){
	die("Database query failed.");
}

$MySQLi_CON->close();
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Welcome - <?php echo $userRow['email']; ?></title>
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
  <link rel="stylesheet" href="css/shop-homepage.css">

  <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
  
</head>

<body>
  <!-- Navigation -->
  <?php include ('navbar.php'); ?>
  
  <!-- Page Content -->
  <div class="container">

      <div class="row">

          <div class="col-md-3">
              <p class="lead">Test Shop</p>
              <div class="list-group">
                  <a href="shopList.php?department=Books" class="list-group-item">Books</a>
                  <a href="shopList.php?department=Movies/TV" class="list-group-item">DVDs and BluRays</a>
                  <a href="shopList.php?department=Video_Game" class="list-group-item">Video Games</a>
              </div>
          </div>

          <div class="col-md-9">

              <div class="row carousel-holder">

                  <div class="col-md-12">
                      <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                          </ol>
                          <div class="carousel-inner" role="listbox">
						  <!-- The images should already be set to 940x400 -->
                              <div class="item active">
                                  <img class="slide-image" src="img\bastion_logo.png" style="width:940px; height:400px;" alt="">
                              </div>
                              <div class="item">
                                  <img class="slide-image" src="img\darksouls3.jpg" style="width:940x; height:400px;" alt="">
                              </div>
                              <div class="item">
                                  <img class="slide-image" src="img\fea.jpg" style="width:940px; height:400px;" alt="">
                              </div>
                          </div>
                          <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                              <span class="glyphicon glyphicon-chevron-left"></span>
                          </a>
                          <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                              <span class="glyphicon glyphicon-chevron-right"></span>
                          </a>
                      </div>
                  </div>

              </div>

              <div class="row">
<?php while($row = mysqli_fetch_assoc($result)) : ?>
                  <div class="col-sm-4 col-lg-4 col-md-4">
                      <div class="thumbnail">
						<br>
                          <img src="<?php echo $row["image"]?>" style="width:125px; height:125px;" alt="">
                          <div class="caption">
                              <h4 class="pull-right">$<?php echo $row["price"]?></h4>
                              <h4><a href="item-page.php?item_id=<?php echo $row["item_id"]; ?>"><?php echo $row["itemName"]?></a>
                              </h4>
                              <p> <?php echo $row["description"]?></p>
                          </div>
                         <!-- <div class="ratings">
                              <p class="pull-right">15 reviews</p>
                              <p>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                              </p>
                          </div>-->
                      </div>
                  </div>
<?php endwhile; ?>
<?php mysqli_free_result($result); ?>		  

              </div>

          </div>

      </div>

  </div>
  <!-- /.container -->

        <hr>


<div id="footer"><?php include_once 'footer.php'; ?></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.1.1.min.js"><\/script>')</script>

<script src="js/vendor/bootstrap.min.js"></script>

<script src="js/main.js"></script>


</body>
</html>