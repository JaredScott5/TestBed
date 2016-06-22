<?php
session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['userSession']))
{
 header("Location: index.php");
}

$query = $MySQLi_CON->query("SELECT * FROM users WHERE user_id=".$_SESSION['userSession']);
$userRow=$query->fetch_array();
//$MySQLi_CON->close();
?>

<HTML>
<HEAD>
<TITLE>Crunchify - Refresh Div without Reloading Page</TITLE>
 
<style type="text/css">
body {
    background-image:
        url('http://cdn.crunchify.com/wp-content/uploads/2013/03/Crunchify.bg_.300.png');
}
</style>
<script type="text/javascript"
    src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script>
var item = 0;
    $(document).ready(
            function() {
                setInterval(function() {
				item = item + 1;
          //          var randomnumber = Math.floor(Math.random() * 100);
                    $('#show').text(
                            'I am getting refreshed every 3 seconds..! Random Number ==> '
                                    + item);
                }, 3000);
            });
</script>
 
</HEAD>
<BODY>
    <br>
    <br>
    <div id="show" align="center"></div>
 
    <div align="center">
        <p>
            by <a href="http://crunchify.com">Crunchify.com</a>
        </p>
    </div>
</BODY>
</HTML>