<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
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
              <p class="lead">Shop Name</p>
              <div class="list-group">
                  <a href="#" class="list-group-item">Category 1</a>
                  <a href="#" class="list-group-item">Category 2</a>
                  <a href="#" class="list-group-item">Category 3</a>
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
                          <div class="carousel-inner">
                              <div class="item active">
                                  <img class="slide-image" src="http://placehold.it/800x300" alt="">
                              </div>
                              <div class="item">
                                  <img class="slide-image" src="http://placehold.it/800x300" alt="">
                              </div>
                              <div class="item">
                                  <img class="slide-image" src="http://placehold.it/800x300" alt="">
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

                  <div class="col-sm-4 col-lg-4 col-md-4">
                      <div class="thumbnail">
                          <img src="http://placehold.it/320x150" alt="">
                          <div class="caption">
                              <h4 class="pull-right">$24.99</h4>
                              <h4><a href="#">First Product</a>
                              </h4>
                              <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                          </div>
                          <div class="ratings">
                              <p class="pull-right">15 reviews</p>
                              <p>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                              </p>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-4 col-lg-4 col-md-4">
                      <div class="thumbnail">
                          <img src="http://placehold.it/320x150" alt="">
                          <div class="caption">
                              <h4 class="pull-right">$64.99</h4>
                              <h4><a href="#">Second Product</a>
                              </h4>
                              <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                          </div>
                          <div class="ratings">
                              <p class="pull-right">12 reviews</p>
                              <p>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star-empty"></span>
                              </p>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-4 col-lg-4 col-md-4">
                      <div class="thumbnail">
                          <img src="http://placehold.it/320x150" alt="">
                          <div class="caption">
                              <h4 class="pull-right">$74.99</h4>
                              <h4><a href="#">Third Product</a>
                              </h4>
                              <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                          </div>
                          <div class="ratings">
                              <p class="pull-right">31 reviews</p>
                              <p>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star-empty"></span>
                              </p>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-4 col-lg-4 col-md-4">
                      <div class="thumbnail">
                          <img src="http://placehold.it/320x150" alt="">
                          <div class="caption">
                              <h4 class="pull-right">$84.99</h4>
                              <h4><a href="#">Fourth Product</a>
                              </h4>
                              <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                          </div>
                          <div class="ratings">
                              <p class="pull-right">6 reviews</p>
                              <p>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star-empty"></span>
                                  <span class="glyphicon glyphicon-star-empty"></span>
                              </p>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-4 col-lg-4 col-md-4">
                      <div class="thumbnail">
                          <img src="http://placehold.it/320x150" alt="">
                          <div class="caption">
                              <h4 class="pull-right">$94.99</h4>
                              <h4><a href="#">Fifth Product</a>
                              </h4>
                              <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                          </div>
                          <div class="ratings">
                              <p class="pull-right">18 reviews</p>
                              <p>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star"></span>
                                  <span class="glyphicon glyphicon-star-empty"></span>
                              </p>
                          </div>
                      </div>
                  </div>

                  <div class="col-sm-4 col-lg-4 col-md-4">
                      <h4><a href="#">Like this template?</a>
                      </h4>
                      <p>If you like this template, then check out <a target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">this tutorial</a> on how to build a working review system for your online store!</p>
                      <a class="btn btn-primary" target="_blank" href="http://maxoffsky.com/code-blog/laravel-shop-tutorial-1-building-a-review-system/">View Tutorial</a>
                  </div>

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