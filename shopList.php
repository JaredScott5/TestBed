<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}


$query = "SELECT item_id, image, itemName, price, description ";
$query .= "FROM items ";

//from here see if the var was passed, if not, leave query as is
if(isset($_GET['department']))
{
	$department = $_GET['department'];//mysqli_real_escape_string($link, $GET['department']);
$query .= "WHERE department = '$department'";	
}

$result = mysqli_query($MySQLi_CON, $query);

//test if the query failed
if (!$result){
	die("Database query failed.");
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
  <title>Shop</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" href="apple-touch-icon.png">
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <?php include_once 'navbar-item-search.php'; ?>
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/main.css">

  <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <link rel="stylesheet" type="text/css" href="css/shopList.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">
</head>

<body>
  <ul>
    
    <p  style='display: block; padding-top: 65px;'></p>
    		
		<p id ="finalResult"></p>
		<div id="debug"> </div>
		
    <!-- return items table entries -->
	<div id="display">
		<?php while($row = mysqli_fetch_assoc($result)) : ?>
    <div class='container shopListContainer'>
        
        <div class="row" id="<?php echo $row["item_id"]; ?>">
          <p class="itemName"><h1>&nbsp;&nbsp;<?php echo $row["itemName"]; ?></h1><p/>
            <div class="col-lg-2 col-md-4 col-sm-4 column firstCol">
              <p>
                <a href="item-page.php?item_id=<?php echo $row["item_id"]; ?>">
                  <img class="img-responsive" src=<?php echo $row["image"];?> id='image'/>
                </a>
              </p>
            </div>
        
            <div class="col-lg-8 col-md-6 col-sm-5 column secondCol">
            <br>
              <p class='desc' style="font-size:20px; float:middle;"><?php echo $row["description"]; ?></p>
            </div>
        
            <div class="col-lg-2 col-md-2 col-sm-3 column thirdCol">
			<p class='price' style="font-size:20px; float:middle;">$<?php echo $row["price"]; ?></p>
            <br>
			<br>			
			<p class='btn btn-lg btn-primary add-to-cart' id=<?php echo $row["item_id"]; ?> href='#' role='button'>Add To Cart</p>
            </div>
          </div>
        </div>
        <hr>
        <?php endwhile; ?>
        <?php mysqli_free_result($result); ?>
    </div>
  </div>
  
  <div id="footer"><?php include_once 'footer.php'; ?></div>
  
<!-- the passed array is what we use in shopList.js for using the data from array $row-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-3.1.1.min.js"><\/script>')</script>

<script src="js/vendor/bootstrap.min.js"></script>
<script src="js/shopList.js"></script>
<script src="js/itemSearch.js"></script>
</body>

</html>