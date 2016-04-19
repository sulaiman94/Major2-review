<!DOCTYPE html>
<html lang="en">
<head>
<title>WebStore</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet"
	href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
<script
	src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
<?php
	session_start();
	
	require("products.php");
	echo ("<h2 style='text-align:center;'>Welcome to Web Store</h2>");
	echo ("<p style='text-align:center;'><a href='./index.php?view_cart=1'>View Cart</a></p>");

	// load the shoping cart (we should use sesstion even if he refresh the page info. don't deleted)
	if(!isset($_SESSION['shoping_cart'])){
		$_SESSION['shoping_cart'] = array(); //  if not exist makes it empty
		//echo ("new array");
	}

	$message = '';

// Add product to cart 
// this part will take the 
/*
	- input from the form 
	- then will check if not added 
	- then display message that is added to the cart

*/
if(isset($_POST['add_to_cart'])) {
	$product_id = $_POST['product_id'];
	//echo ("inside the add_to_cart");

	// Check for valid item
	if(!isset($products[$product_id])) {
		$message = "Invalid item!<br />";
	}
	// If item is already in cart, tell user
	else if(isset($_SESSION['shoping_cart'][$product_id])) {
		$message = "Item already in cart!<br />";
		echo $message;
	}
	// Otherwise, add to cart
	else {
		$_SESSION['shoping_cart'][$product_id]['product_id'] = $_POST['product_id'];
		$_SESSION['shoping_cart'][$product_id]['quantity'] = $_POST['quantity'];
		$message = "Added to cart!";
		echo $message;
	}
}
	
	
	
	// prodcut view 
	if (isset($_GET['product_view'])){	
		$product_id = $_GET['product_view']; 
		echo("<p><a href='./index.php'>WebStore</a> &gt <a href='./index.php'>".$products[$product_id]['category']."</a></p>");
		//echo ("product_id=".$_GET['product_view']);	
		echo ("<table class='table'>");
		echo("<tr class='success'>");
		echo ("<td> <b>".$products[$product_id]['name']."</b></td>
			   <tr class='info'><td>"
			  .$products[$product_id]['price']."</td></tr><tr><td>"
			  .$products[$product_id]['category']."</td></tr>");	
		echo ("</table>");
		// add to the cart
		//action='./index.php?product_view=$product_id'[[[[[by this line it will go the product_view page then will take product_id]]]]]
		
		echo ("<form role='form' action='./index.php?product_view=$product_id' method='post'>");
			echo ("<select name ='quantity'>");
				echo ("<option value='1'>1</option>");
				echo ("<option value='2'>2</option>");
				echo ("<option value='3'>3</option>");
			echo ("<select/>");
			echo("<input type='submit' name='add_to_cart' value='Add to cart' />");
			echo("<input type='hidden' name='product_id' value='$product_id' />");
		echo ("</form>");
		//echo ("<p><a href='#'>Add to Cart</a></p>");
		

		// emoty the cart 
		if(isset($_GET['empty_cart'])){ // reinstiall the array to make empty
			$_SESSION['shoping_cart'] = array();
		}



		// view cart
	} else if (isset($_GET['view_cart'])){
		

		echo ("<h2 class='text-center'>Your cart</h2>");
		echo "<p><a href='./index.php'>WebStore</a></p>";

echo "<a href='./empty_cart'>empty the cart</a>";

		if(empty($_SESSION['shoping_cart'])){ // check if the the array is empty
			
			
		} else{ // if not empty
				echo "<p>your cart</p>";
				//echo "<p><a>empty cart</a></p>";
				echo "<form action='#' method='POST'>";
				echo ("<table class='table table-striped'>");
				//echo "it's inside not empty table";
				echo ("<tr>");
					echo "<td>Name</td>";
					echo "<td>Price</td>";
					echo "<td>Category</td>";
					echo "<td>Quantity</td>";
				echo ("</tr>");
				
				 foreach ($_SESSION['shoping_cart'] as $id => $x){
					$product_id = $x['product_id']; // same as --> $_SESSION['shoping_cart'][$id]['product_id']

					echo("<tr>");
					echo ("<td> <a href='./index.php?product_view=$id'>".$products[$product_id]['name']."</a></td>
						<td>".$products[$product_id]['price']."</td>
						<td>" .$products[$product_id]['category']."</td>".
						"<td> <input type='text' id='qty' name='quantity[]' value=".$product_id['quantity']."></td>"); // instend of $_SESSION['shoping_cart'][$product_id]['quantity'] 
					echo("</tr>");	 
				}
				
				echo ("</table>");
				echo "<input type='submit' name='update' value='update'>";
				echo "</form>";
			}
			
			
			
		} else{
		// All the prodcut
		echo("<p><a href='./index.php'>WebStore</a> &gt </p>");
		echo ("<h3>Our Products</h3>");
		echo ("<table class='table table-striped'>");
		foreach ($products as $id=>$x){
			echo("<tr>");
			echo ("<td> <a href='./index.php?product_view=$id'>".$x['name']."</a></td><td>"
			.$x['price']."</td><td>"
			.$x['category']."</td>");
			echo("</tr>");	
		}
		echo ("</table>");
	}
?>
</div>
</body>
</html>
