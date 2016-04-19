<?php
session_start();

if (isset($_GET['reset_session'])){
	session_destroy();
	unset($_SESSION);
}

if (!isset($_SESSION['count'])){
	$_SESSION['count']=0;
}

$_SESSION['count']+=1;
echo ("<p>count: ".$_SESSION['count']."</p>");

echo("<p><a href='./sessiondemo.php'> Refresh</a></p>");
echo("<p><a href='./sessiondemo.php?reset_session=1'> Reset</a></p>");
?>