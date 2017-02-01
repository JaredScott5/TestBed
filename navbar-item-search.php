<nav class="navbar navbar-default navbar-fixed-top" id="test">
	<div class="row">
	<br>
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1 " style="">
			<div class="input-group buscador-principal">    					
						<input name="search_param" value="all" id="search_param" type="hidden">         
						<input id="search_bar" class="form-control" name="x" placeholder="Item" type="text">
						
						<span class="input-group-btn">
							<button class="btn btn-primary" type="button" onclick="search()"><span class="glyphicon glyphicon-search"></span> Search</button>
						</span>
			</div>
        </div>
	</div>
	
	 <div class="container" id="parentNavbar">
	  
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">Test Shop</a>
        </div>
		
        <div id="navbar" class="collapse navbar-collapse ">
			<div id="childContainer" class="container">			
				<ul id="ulLeft" class="nav navbar-nav navbar-left">
					<li id="liShopList"><a href="shopList.php"><span class="glyphicon glyphicon-tags"></span>&nbsp; Shop List</a></li>
					<li id="liOrderHistory"><a href="orderHistory.php"><span class="glyphicon glyphicon-check"></span>&nbsp; Order History</a></li>        
				</ul>
					
				<ul id="ulRight" class="nav navbar-nav navbar-right">
					<li id="liUser"><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $_SESSION['username']; ?></a></li>
					<li id="liLogout"><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
					<li id="liShoppingCart"><a href="shoppingCart.php" id="cartCount"><span class="glyphicon glyphicon-shopping-cart"></span>&nbsp; <?php echo "Cart(" . $_SESSION['cartCount'] . ")"; ?> </a></li>
				</ul>
									
			</div>
        </div><!--/.nav-collapse -->
      </div>
</nav>