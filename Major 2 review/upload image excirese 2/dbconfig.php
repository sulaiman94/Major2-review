<?php
$dbhost = "sql106.byethost32.com";
$dbuser = "b32_17329788";
$dbpass = "00990099s";
$dbname = "b32_17329788_dbtuts";
mysql_connect($dbhost,$dbuser,$dbpass) or die('cannot connect to the server'); 
mysql_select_db($dbname) or die('database selection problem');
?>