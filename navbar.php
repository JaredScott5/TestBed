<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">Test Shop</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="shopList.php"><span class="glyphicon glyphicon-tags"></span>&nbsp; Shop List</a></li>
            <li><a href="orderHistory.php"><span class="glyphicon glyphicon-check"></span>&nbsp; Order History</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $_SESSION['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
            <li><a href="shoppingCart.php" id="cart"><span class="glyphicon glyphicon-shopping-cart">&nbsp;</span> <?php echo "Cart(" . $_SESSION['cartCount'] . ")"; ?> </a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
</nav>