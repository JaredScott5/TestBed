<?php
session_start();
include_once 'navbar.php';
include_once 'dbconnect.php';

if(isset($_GET['item_id'])){
$item_id = $_GET['item_id'];

$find_item = $MySQLi_CON->query(
    "SELECT *
    FROM items
    WHERE item_id='$item_id'"
  );
  
$row = mysqli_fetch_assoc($find_item);

$item_id = $row['item_id'];
$item_name = $row['itemName'];
$item_price = $row['price'];
$item_image = $row['image'];
$item_desc = $row['description'];
	}else{
//		 echo "<p  style='display: block; padding-top: 100px;'></p>";
//	echo "error: variable is not set properly";
//	echo "post is " . $_GET['item_id'];
}
?>

 
  
 <!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">


<html lang="en">
<head>
	<link rel="stylesheet" href="css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="item-page.css">
  <link rel="stylesheet" type="text/css" href="footer.css">

  <title><?php echo $item_name; ?></title>
</head>

<body>
  <!-- Navigation -->
  <?php include ('navbar.php'); ?>
  <p  style="display: block; padding-top: 50px;"></p>

 <!-- Page Content -->
  <div class="container">

      <div class="row">

          <div class="col-md-3">
              <p class="lead">Shop Name</p>
              <div class="list-group">
                  <a href="#" class="list-group-item active">Category 1</a>
                  <a href="#" class="list-group-item">Category 2</a>
                  <a href="#" class="list-group-item">Category 3</a>
              </div>
          </div>

          <div class="col-md-9">

            <div class="item" id=<?php echo $row["item_id"]; ?>>
              <a href="item-page.php?item_id=<?php echo $row["item_id"]; ?>">
              <img class="img-responsive"
              src=<?php echo $row["image"]; ?> 
              id='image'></a>
              </img>
              <div class="caption-full" id=<?php echo $row["item_id"]; ?>>
                <h4 class="pull-right">$<?php echo $item_price; ?></h4>
                <h4><a href="#"><?php echo $item_name; ?></a>
                </h4>
                <p><?php echo $item_desc; ?></p>
                <div id=<?php echo $item_id; ?> class="add-to-cart">
                  <a class='btn btn-lg btn-primary' href='#' role='button'>Add To Cart</a>
                </div>
              </div>
              <div class="ratings">
                <p class="pull-right">3 reviews</p>
                <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    4.0 stars
                </p>
              </div>
            </div>

            <div class="well">

                <div class="text-right">
                    <a class="btn btn-success">Leave a Review</a>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        Anonymous
                        <span class="pull-right">10 days ago</span>
                        <p>This product was great in terms of quality. I would definitely buy another!</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        Anonymous
                        <span class="pull-right">12 days ago</span>
                        <p>I've alredy ordered another one!</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-md-12">
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        Anonymous
                        <span class="pull-right">15 days ago</span>
                        <p>I've seen some better than this, but not at this price. I definitely recommend this item.</p>
                    </div>
                </div>

            </div>

          </div>

      </div>

  </div>
  <!-- /.container -->
  
  <div id="footer"><?php include_once 'footer.php'; ?></div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.1.1.min.js"><\/script>')</script>

  <script src="js/vendor/bootstrap.min.js"></script>

  <script src="js/main.js"></script>

  <script src="shopList.js"></script>

</body>

</html>