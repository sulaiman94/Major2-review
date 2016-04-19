<?php
$dbhost = "mysql.coins-lab.org";
$dbuser = "abdelrahman";
$dbpass = "psuiot2016";
$dbname = "psuiot";

$table = "fileuploads";
//mysql_connect($dbhost,$dbuser,$dbpass) or die('cannot connect to the server');
//mysql_select_db($dbname) or die('database selection problem');

// Create connection
$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


?>