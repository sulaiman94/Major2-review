<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>
<?php 

/** start the session **/
session_start();

/** import products array **/
require("products.php");

/** title of page **/
echo ("<h2 style='text-align:center;'>Welcome to Web Store</h2>");
echo ("<p style='text-align:center;'><a href='./index.php?view_cart=1'>View Cart</a></p>");


/** Load the shopping cart **/
if (!isset($_SESSION['shopping_cart'])){
	$_SESSION['shopping_cart'] = array();
}

/** Empty the cart **/
if(isset($_GET['empty_cart'])) {
	$_SESSION['shopping_cart'] = array();
}

/** process add to card POST message **/

$message = '';

// Add product to cart
if(isset($_POST['add_to_cart'])) {
	$product_id = $_POST['product_id'];
	
	// Check for valid item
	if(!isset($products[$product_id])) {
		$message = "Invalid item!<br />";
	}
	// If item is already in cart, tell user
	else if(isset($_SESSION['shopping_cart'][$product_id])) {
		$message = "Item already in cart!<br />";
	}
	// Otherwise, add to cart
	else {
		$_SESSION['shopping_cart'][$product_id]['product_id'] = $_POST['product_id'];
		$_SESSION['shopping_cart'][$product_id]['quantity'] = $_POST['quantity'];
		$message = "Added to cart!";
	}
}

/********* update cart   **********/
if (isset($_POST['update_cart'])){
$quantities = $_POST['quantity'];
	foreach($quantities as $id => $quantity) {
		if(!isset($products[$id])) {
			$message = "Invalid product!";
			break;
		}
		$_SESSION['shopping_cart'][$id]['quantity'] = $quantity;
	}
	if(!$message) {
		$message = "Cart updated!<br />";
	}
}

echo $message;



/********* product view   **********/
if (isset($_GET['view_product'])){
	$product_id=$_GET['view_product'];
	//view product
	//echo "View product: ".$_GET['view_product']."<br/>";
	echo "<p>
			<a href='./index.php'>WebStore</a> &gt; <a href='./index.php'>" . 
			$products[$product_id]['category'] . "</a></p>";
	echo "<table class='table'>
			<tr><td>" . $products[$product_id]['name'] . "</td></tr>
			<tr><td>$" . $products[$product_id]['price'] . "</td></tr>
			<tr><td>" . $products[$product_id]['description'] . "</td></tr></table>";
	
	echo "<p>
				<form action='./index.php?view_product=$product_id' method='post'>
					<select name='quantity'>
						<option value='1'>1</option>
						<option value='2'>2</option>
						<option value='3'>3</option>
					</select>
					<input type='hidden' name='product_id' value='$product_id' />
					<input type='submit' name='add_to_cart' value='Add to cart' />
				</form>
			</p>";
	
	
}else 
/********* view cart   **********/
if (isset($_GET['view_cart'])){
	
	echo "<p>
			<a href='./index.php'>WebStore</a></p>";
	echo ("<h3 style='text-align:center;'> Your cart</h3>");
	echo "<p>
		<a href='./index.php?empty_cart=1'>Empty Cart</a>
	</p>";
	
	if(empty($_SESSION['shopping_cart'])) {
		echo "Your cart is empty.<br />";
	}
	else {
		echo "<form action='./index.php?view_cart=1' method='post'>
		<table class='table'>
				<tr class='warning'>
					<th>Name</th>
					<th>Price</th>
					<th>Category</th>
					<th>Quantity</th>
				</tr>";
				foreach($_SESSION['shopping_cart'] as $id => $product) {
					$product_id = $_SESSION['shopping_cart'][$id]['product_id'];
					$product_id = $product['product_id'];
					echo "<tr>
						<td><a href='./index.php?view_product=$id'>" . 
							$products[$product_id]['name'] . "</a></td>
						<td>$" . $products[$product_id]['price'] . "</td> 
						<td>" . $products[$product_id]['category'] . "</td>
						<td>
							<input type='text' name='quantity[$product_id]' value='" . $product['quantity'] . "' /></td>
					</tr>";
				}
			echo "</table>
			<input type='submit' name='update_cart' value='Update' />
			</form>
			<p>
				<a href='./index.php?checkout=1'>Checkout</a>
			</p>";
		
	}

}
/* Checkout */
else if(isset($_GET['checkout'])) {
	// Display site links
	echo "<p>
		<a href='./index.php'>DropShop</a></p>";
	
	echo "<h3>Checkout</h3>";
	
	if(empty($_SESSION['shopping_cart'])) {
		echo "Your cart is empty.<br />";
	}
	else {
		echo "<form action='./index.php?checkout=1' method='post'>
		<table class='table'>
				<tr>
					<th>Name</th>
					<th>Item Price</th>
					<th>Quantity</th>
					<th>Cost</th>
				</tr>";
				
				$total_price = 0;
				foreach($_SESSION['shopping_cart'] as $id => $product) {
					$product_id = $product['product_id'];
					
					
					$total_price += $products[$product_id]['price'] * $product['quantity'];
					echo "<tr>
						<td><a href='./index.php?view_product=$id'>" . 
							$products[$product_id]['name'] . "</a></td>
						<td>$" . $products[$product_id]['price'] . "</td> 
						<td>" . $product['quantity'] . "</td>
						<td>$" . ($products[$product_id]['price'] * $product['quantity']) . "</td>
					</tr>";
				}
			echo "</table>
			<p>Total price: $" . $total_price . "</p>";
		
	}
}

/** view all products **/
else{

echo "<p>
			<a href='./index.php'>WebStore</a></p>";

echo ("<h3> Our Products</h3>");

echo ("<table  class='table table-striped table-responsive'> ");
foreach ($products as $id => $product){
echo("	<tr>
		<td> <a href='index.php?view_product=$id'>".$product['name']."</td><td>"
		.$product['price']."</td><td>"
		.$product['category']."</td>	</tr>

	");
}
echo ("</table> ");



}
?>
</body>
</html>