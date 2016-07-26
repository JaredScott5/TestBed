<?php
//session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$searchTerm = $_POST['searchTerm'];

$query = $MySQLi_CON->query("SELECT users.user_id, users.username, users.email, 
orders.orderNumber, orders.shippedDate, orders.status, orders.comments
FROM orders 
LEFT JOIN users
ON orders.user_id = users.user_id
WHERE users.username = "$searchTerm" 
OR users.email = "$searchTerm"
OR orders.orderNumber = "$searchTerm");

store query into readable form and send it to admin.js as a php echo

$userRow=$query->fetch_array();

$user = $userRow['username'];

$MySQLi_CON->close();
?>

