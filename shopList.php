<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();

//create an array of items from items table
$itemQuery = $MySQLi_CON->query("SELECT * FROM items");
$array = array();

//look through query 
while($itemRow = mysqli_fetch_assoc($itemQuery)){
	//add each row returned into an array
	$array[] = $itemRow;
}

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
$MySQLi_CON->close();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


<html lang="en">
<head>
		
<title>Shop</title>
</head>

<header>
<nav>
<ul>
<li id="filler">filler</li>
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
			<li><a href="#" id="cart"><span class="glyphicon"></span>&nbsp; Cart: </a></li>
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
		<li name="listItem"> 
			<p id="image"> <?php echo $row["image"];?> </p> 
			<p id="itemName"><?php echo $row["itemName"]; ?></p>
			<p id="price"><?php echo $row["price"];?></p> 
			<p id="desc"><?php echo $row["description"]; ?></p>
			<a class="btn btn-lg btn-primary" href="#" role="button" onClick="myfunction(this.parentNode)">Add To Cart</a> 
		</li>
	
	<?php $count = $count + 1;?>
<?php
}
?>

</ul>

<p id="notes" onLoad="buttonName()"></p>

<?php
//release database
mysqli_free_result($result);
?>

<!--JavaScript -->
<script language="javascript" type="text/javascript">
<!-- Global Var-->
var cartCount = 0;
document.getElementById("notes").innerHTML = "testing";
document.getElementById("cart").innerHTML = cartCount;

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

function myfunction(parent){
	//part 1 known to work
	document.getElementById("cart").innerHTML = ++cartCount;
	document.getElementById("notes").innerHTML = "testing";

	//part 2
	var itemToAddToCart = <?php $array[parent]['item_id']?>;
		document.getElementById("notes").innerHTML = "chldNode 1 value is" + itemToAddToCart;
	//document.getElementById("notes").innerHTML = "testing";

	//showUser();
}
	
function buttonName(){
	
		document.getElementById("notes2").innerHTML = "test again";
		//give each li a name that is the item_id
		//ex) LI1 is now item_id[0], LI2 is now item_id[1], etc
	var length = document.getElementsByName("LI").length;

	for(var i = 0; i < length; i++){
		document.getElementsByName("LI")[i].setAttribute(<?php echo $array[i]['item_id']?>));
		<?php echo $array[i]['item_id']?>
	}//end for
}//end function buttonName

</script>

</body>

</html>

<?php
//mysqli_close($connection);
?>