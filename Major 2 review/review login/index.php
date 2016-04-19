<!DOCTYPE html>
<html>
<head>
<title>Major</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script type="text/javascript" src="script.js"></script>
</head>
<body>

	<div class="container">



		<?php
		include_once 'dbconfig.php';

		echo "<form action='index.php' method='POST'>";
		echo "Enter username : <input type='text' name ='username'>";
		echo "Enter password : <input type='password' name ='password'>";
		echo "<input type='submit' name='login'>";
		echo "</form>";

		echo "Don't have the account <a href='./index.php?register'>sign-up</a>";


		if (isset($_GET['product_view'])){	
		}

		$sql = "SELECT `username`, `password` FROM `users` " ;
		$log = mysql_query($sql);

					if(isset($log)){
					//echo "login sql works";
			     	$msg = '';	

			     		if (isset($_POST['login']) && !empty($_POST['username']) 
				               && !empty($_POST['password'])) {
			     		//echo $_POST['username'];

						while ($row = mysql_fetch_array($log)){
								//echo $_POST['login'];

				               if ($_POST['username'] == $row['username'] && 
				                  $_POST['password'] == $row['password']) {
				                  $_SESSION['valid'] = true;
				                  $_SESSION['timeout'] = time();
				                  $_SESSION['username'] = $row['username'];
				                  
				                  echo 'You have entered valid use name and password';
				                  header('Location: ./index.php?logedin');
				               }else {
				                  $msg = 'Wrong username or password';
				               }
				            }
						}

					}


		?>

	</div>


</body>
</html>