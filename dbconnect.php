<?php

  $DB_host = "localhost";
  $DB_user = "root";
  $DB_pass = "testbedproject";
  $DB_name = "dbtest";
  
  $MySQLi_CON = new MySQLi($DB_host,$DB_user,$DB_pass,$DB_name);
    
     if($MySQLi_CON->connect_errno)
     {
         die("ERROR : -> ".$MySQLi_CON->connect_error);
     }

?>