<?php
$dbhost = "localhost:3306";
$dbuser = "root";
$dbpass = "";
$dbname = "store";

mysql_connect($dbhost,$dbuser,$dbpass) or die('cannot connect to the server'); 
mysql_select_db($dbname) or die('database selection problem');

echo "<h3 class='text-center'>Successfully connected to the database!</h3>";

?>