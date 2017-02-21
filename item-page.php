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

  <link rel="stylesheet" type="text/css" href="css/item-page.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
  <?php include_once 'navbar.php'; ?>

  <title><?php echo $item_name; ?></title>
</head>

<body>
  <!-- Navigation -->
  
  <p style="display: block; padding-top: 50px;"></p>

 <!-- Page Content -->
  <div class="container">

      <div class="row col-md-12" id="content">

        <div class="container well row" id="item" id=<?php echo $row["item_id"]; ?>>

			<div class="container">
				<div class="caption-full  ">
					<a href="item-page.php?item_id=<?php echo $row["item_id"]; ?>">
					<img class="img-responsive"
					src=<?php echo $row["image"]; ?> 
					id='image'></img></a>
					
					<h1><a href="#"><?php echo $item_name; ?></a></h1>
				</div>				
				
				<div class=" " id="addToCart">
						<h4 class="" id="price" >$<?php echo $item_price; ?></h4>
						<p class='btn btn-lg btn-primary add-to-cart' 
						id=<?php echo $item_id; ?> href='#' role='button'>Add To Cart</p>
				</div> 
			</div>
				<div class="container" id="description">
					<h3>Descripion:</h3> <?php echo $item_desc; ?>
					<br>
					
				</div>
			  
			  <br>

				
			  <hr>
        </div>
		
        <div class="well row" id="reviews">
                
					<div id="numberOfStars">
						<h3><span class="glyphicon glyphicon-star"></span>
						<span class="glyphicon glyphicon-star"></span>
						<span class="glyphicon glyphicon-star"></span>
						<span class="glyphicon glyphicon-star"></span>
						<span class="glyphicon glyphicon-star-empty"></span>
                    
						4.0 stars</h3>

					</div>
					<div id="reviewAverage">
						<h3>3 reviews</h3>
					</div>
					<hr><hr>
				
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        Anonymous
                        <span class="pull-right">10 days ago</span>
                        <p>This product was great in terms of quality. I would definitely buy another!</p>

                <hr>

                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star-empty"></span>
                        Anonymous
                        <span class="pull-right">12 days ago</span>
                        <p>I've alredy ordered another one!</p>

                <hr>

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
  <!-- /.container -->
  
  <div id="footer"><?php include_once 'footer.php'; ?></div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.1.1.min.js"><\/script>')</script>

  <script src="js/vendor/bootstrap.min.js"></script>

  <script src="js/main.js"></script>

  <script src="js/shopList.js"></script>

</body>

</html>