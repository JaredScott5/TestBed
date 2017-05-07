<?php
session_start();
include_once 'navbar.php';
include_once 'dbconnect.php';

?>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Order History</title>
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

  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  
  <link rel="stylesheet" type="text/css" href="css/orderHistory.css">
  <link rel="stylesheet" type="text/css" href="css/navbar.css">
  <link rel="stylesheet" type="text/css" href="css/footer.css">

  
</head>

<body>

  <div id="orders" class="container">

      <div class="order">
        <div class="summary">
          <div class="row">
            <div class="col-xs-2">
              <p class="order-number"><b>Order Number: </b></p>
            </div>
            <div class="col-xs-2">
              <p class="order-date"><b>Date Ordered: </b></p>
            </div>
            <div class="col-xs-2">
              <p class="shipped-date"><b>Date Shipped: </b></p>
            </div>
            <div class="col-xs-2">
              <p class="total-cost"><b>Total: </b></p>
            </div>
            <div class="col-xs-2">
              <p class="comments"><b>Comments: </b></p>
            </div>
            <div class="col-xs-2">
              <a class="exp-col">Show Details</a>
            </div>
          </div>
        </div>
        <div class="details">

              <div class="detail">
                <div class="row">
                  <div class="col-xs-2">
                    <p class="whitepace">&nbsp;</p>
                  </div>    
                  <div class="col-xs-2">
                    <p class="item-img"></p>
                  </div>
                  <div class="col-xs-2">
                    <p class="item-name">Item:</p>
                  </div>
                  <div class="col-xs-2">
                    <p class="quantity-ordered">Quantity:</p>
                  </div>
                  <div class="col-xs-2">
                    <p class="price-per-item">Price: </p>
                  </div>
                  <div class="col-xs-2">
                    <p class="total item price">Subtotal: $</p>
                  </div>
                </div>
              </div>
        </div>
      </div>
  </div>
  <div id="footer"><?php include_once 'footer.php'; ?></div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/vendor/jquery-3.1.1.min.js"><\/script>')</script>

  <script src="js/vendor/bootstrap.min.js"></script>>
  <script src="js/orderHistory.js"></script>

</body>

</html>