<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
$cart = 0;
//$MySQLi_CON->close();
?>

<?php
$secondquery = "SELECT image, itemName, price, description ";
$secondquery .= "FROM items ";

$result = mysqli_query($MySQLi_CON, $secondquery);

//test if the query failed
if (!$result){
	die("Database query failed.");
}else{
	echo "<p></p>";
}

//$querytwo = $MySQLi_CON->query("SELECT * FROM items");
//echo $querytwo;
//$userRow=$query->fetch_array();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


<html lang="en">
<head>

<script>
function showUser(){
	if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
			document.getElementById("notes").innerHTML = "testing2";
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			document.getElementById("notes").innerHTML = "testing3";
        }
		
					document.getElementById("notes").innerHTML = "goint to second part";

        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("notes").innerHTML = xmlhttp.responseText;
            }else{
				document.getElementById("notes").innerHTML = "failed 3rd part";

			}
		};
		
		xmlhttp.open("GET","getuser.php?q="+str,true);
        xmlhttp.send();
}
		</script>
		
<title>Shop</title>
</head>

<header>
<nav>
<ul>
<li id="cartItems">cart: <?php echo $cart;?> </li>
</ul>
</nav>
</header>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="http://www.codingcage.com">Coding Cage</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="http://www.codingcage.com/search/label/jQuery">jQuery</a></li>
            <li><a href="http://www.codingcage.com/search/label/PHP">PHP</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="#"><span class="glyphicon glyphicon-user"></span>&nbsp; <?php echo $userRow['username']; ?></a></li>
            <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp; Logout</a></li>
			<li><a=href="#" id="cart"><span></span></a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

<ul>

<p></p>
<p></p>

<p></p>
<p></p>
<p></p>
<p></p>

<?php
$count = 1;
//return database database
while($row = mysqli_fetch_assoc($result)){
	?>
	<h1>Item <?php echo $count?></h1>
		<li> <p><?php echo $row["image"]; echo $row["itemName"]; 
	echo $row["price"]; echo $row["description"];  ?>
	<a class="btn btn-lg btn-primary" href="#" role="button" onClick="myfunction()">Add To Cart</a></p> 
	</li>
	
	<?php $count = $count + 1;?>
<?php
}
?>

</ul>

<p id="notes"></p>

<?php
//release database
mysqli_free_result($result);
?>

<!--JavaScript -->
<script language="javascript" type="text/javascript">
<!-- Global Var-->
var cartCount = 0;
document.getElementById("cart").innerHTML = cartCount;

function myfunction(){
	document.getElementById("cart").innerHTML = ++cartCount;
document.getElementById("notes").innerHTML = "testing";

showUser();
}
	//check if user has an entry in orders table,
	//if so, choose one where STATUS != 'On Time'
	//else, create a new order
	//$orderQuery = "SELECT orderNumber";
	//$orderQuery .= "FROM orders";
	//$orderQuery .= "WHERE user_id = {$userRow['user_id']}";
	
	//$oqResult = mysqli_query($MySQLi_CON, $orderQuery);
	
	//check if we already have it in table orderDetails,
	//if so, find the item number and increament quantityOrdered
	
	//if (!$result){
	//echo "<p>order does not exist for a customer. Creating one...</p>";
	//$insertQuery = "INSERT INTO orders VALUES ({$userRow['user_id']}, '2016-05-23T14:25:10', 
	//'2016-05-28T12:00:10', 'In Cart', NULL)";
//}else{
	//increment
	//echo "order does exist";
	
	
</script>

</body>

</html>

<?php
//mysqli_close($connection);
?>