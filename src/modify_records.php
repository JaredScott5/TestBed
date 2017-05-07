<?php
session_start();
include_once 'dbconnect.php';

if(isset($_POST['edit_row']))
{
 $row=$_POST['row_id'];
 //$user_id=$_POST['user_id_val'];
 //$email=$_POST['email_val'];
 $orderDate=$_POST['orderDate_val'];
 $shippedDate=$_POST['shippedDate_val'];
 $status=$_POST['status_val'];
 $comments=$_POST['comments_val'];

 $query ="UPDATE orders
 SET orderDate='$orderDate',
 shippedDate='$shippedDate', status='$status', comments='$comments'
 WHERE orderNumber='$row'";
 $result=mysqli_query($MySQLi_CON, $query);
 if (!$result){
   die("Database query failed.");
 }else{
  echo "success";
  exit();
 }
}

if(isset($_POST['delete_row']))
{
 $row_no=$_POST['row_id'];
 $query="DELETE FROM orders WHERE orderNumber='$row_no'";
 $result=mysqli_query($MySQLi_CON, $query);
 if (!$result){
   die("Database query failed.");
 }else{
  echo "success";
  exit();
 }
}
/*
if(isset($_POST['insert_row']))
{
 $name=$_POST['name_val'];
 $age=$_POST['age_val'];
 mysql_query("insert into orders values('','$name','$age')");
 echo mysql_insert_id();
 exit();
}
*/
?>