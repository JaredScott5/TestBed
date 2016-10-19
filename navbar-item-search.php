<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container-fluid" id="parentNavbar">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="home.php">Test Shop</a>
        </div>
        <div id="childNavbar" class="navbar-collapse collapse">
			<div id="childContainer" class="container">
			
				<ul id="ulLeft" class="nav navbar-nav navbar-left">
					<li id="liShopList"><a href="shopList.php"><span class="glyphicon glyphicon-tags"></span>&nbsp; Shop List</a></li>
					<li id="liOrderHistory"><a href="orderHistory.php"><span class="glyphicon glyphicon-check"></span>&nbsp; Order History</a></li>        
				</ul>
		  
				<ul id="ulSearchbar" class="nav navbar-nav">
					<form class="nav navbar-search">
						<li>
							<a href="javascript:itemSearch.js"><input type='text' id='search_bar'>
							<input type='button' id='search_string' value='Search' onClick="search()"></a>
						</li>		
					</form>
				</ul>
		  
				<ul id="ulRight" class="nav navbar-nav navbar-right">
					<li id="liUser"><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $_SESSION['username']; ?></a></li>
					<li id="liLogout"><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
					<li id="liShoppingCart"><a href="shoppingCart.php" id="cart"><span class="glyphicon glyphicon-shopping-cart">&nbsp;</span> <?php echo "Cart(" . $_SESSION['cartCount'] . ")"; ?> </a></li>
				</ul>
			</div>
        </div><!--/.nav-collapse -->
      </div>
</nav>