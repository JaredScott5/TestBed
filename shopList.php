<?php
session_start();
include_once 'shopListFunctions.php';
//include_once 'dbconnect.php';
?>

<!-- Call shopList.js -->
<!-- <script type="text/javascript" src="shopList.js"></script>-->


<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">


<html lang="en">
<head>
		
<title>Shop</title>
<?php include ('navbar.php'); ?>
</head>

<body>

<p  style="display: block; padding-top: 40px;"></p>


<ul>
</ul>



<!-- the passed array is what we use in shopList.js for using the data from array $row-->
<script src="shopList.js">
</script>

</body>

</html>

<?php
//mysqli_close($connection);
?>