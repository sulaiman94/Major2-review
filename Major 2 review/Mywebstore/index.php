<!DOCTYPE html>
<html>
<head>
<title>Mywebstore</title>
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

<!-- Database(6) : id, name, price, catagory, description, pic -->



<!-- this line is very important to save data through browsing the website and connection to database-->
<?php 
	//session_start();
	 // the database 
?>

	<div class="container">

		<?php
		include_once 'dbconfig.php';
			// add prodcut to the database
			if (isset($_GET['addprodcut'])){
			//	echo "inside addprodcut!";
				echo "<h3 class='text-center'> Add prodcut </h3> ";
				echo "<p id='Map_website'> <a href='index.php'> Home Page -> </a> 
										   <a herf='./index.php?addprodcut'> Add prodcut -> </a> 

										   </p> ";

				echo("<form method='POST' action='./index.php?addprodcut' enctype='multipart/form-data'>");
				echo "<table class='table'>";

					echo "<tr>";
					echo "<td><lable>Picture : </lable> <input type='file' name='file' value='upload picture'/></td>";
					echo("</tr>");

					echo "<tr>";
					echo "<td id='name' name='name'>Name <input type='text' name='name' placeholder='Name of the prodcut'></td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td id='price' name='price'>Price <input type='text' name='price' placeholder='price of the prodcut'></td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td id='catagory' name='catagory'>Catagory <input type='text' name='catagory' placeholder='catagory of the prodcut'></td>";
					echo "</tr>";

					echo "<tr>";
					echo "<td id='description' name='description'>description <input type='text' name='description' placeholder='description of the prodcut'></td>";
					echo "</tr>";

				echo "</table>";
				echo "<input type='submit' value='Add' name='addToProdcut'/>";
				echo "</form>";



				// here we'll insert the information of the prodcut
				if(isset($_POST['addToProdcut'])) {


					//echo "$_FILES";

				$name = $_POST['name'];
				$price = $_POST['price'];
				$catagory = $_POST['catagory'];
				$description = $_POST['description'];  

				// add the image
				$fileName = $_FILES['file']['name'];
				$fileType = $_FILES['file']['type'];
				$fileSize = $_FILES['file']['size'];
				$fileError = $_FILES['file']['error'];
    			$fileTemp = $_FILES['file']['tmp_name'];
    			$folder="uploads/";
    			//$new_file_name = strtolower($fileName);
    			//$final_file=str_replace(' ','-',$new_file_name);


    			if($fileError > 0 ){
    				echo "Can't upload the file code : $fileError";
    			} else {
    				move_uploaded_file($fileTemp, $folder.$fileName);
    				//echo "upload completed ";
					$sql = "INSERT INTO `product` (`id`, `name`, `price`, `catagory`, `description`, `pic`) VALUES ('','$name','$price','$catagory','$description','$fileName');";

					//echo "$sql";

					$result = mysql_query($sql);

					if($result){
					echo" <br>	<div class='alert alert-success'>
	  						<strong>Success!</strong> Prodcut Added to the database.
						</div> ";

					}
					else
					{
						echo "<h3><code>Error</code></h3>";
					}
    			
				}
			} 



			} else if (isset($_GET['product_view'])) {
				$product_id = $_GET['product_view'];
				
				if(isset($product_id)){
					//echo "works";
					//echo $product_id;

					$sql = "SELECT `name`, `price`, `catagory`, `pic`,  `description` FROM `product` where id = $product_id";

					$display_prodcut = mysql_query($sql);

					if($display_prodcut){
						echo "we found the product .. ";
						echo "<table class='table'> ";
						while ($row = mysql_fetch_array($display_prodcut)){
							echo "<tr>";
							
							echo "<th>".$row["catagory"]."</th>";

							echo "<th>
							<a href='uploads/".$row['pic']."' target='_blank'>
							<img src='uploads/".$row['pic']."' alt ='no picture' width ='100' height ='100'> </a></th>";

														echo "<th>".$row["price"]."</th>";
							echo "</tr>";
						}


						echo "</table>";

						echo "<form action='./index.php?add_cart' method='POST'>";
							echo "<button type='submit' name='addcart'> Add to the cart </button>";
						echo "</from>";

					} else {
						echo "error print information about the prodcut";
					}
				}


			




			}else { // home page
				//echo "inside index.php";
				//include_once 'dbconfig.php';

				echo "<div class='row'>";
				echo"<h2> My Web Store Review For Major 2 </h2>";
				echo"</div>";
				

				echo "
				<div class='row' >
					<br><br>
					<h3> Our products </h3>
					<p id='Map_website'> <a href='index.php'> Home Page > </a> </p> 

					<form action='./index.php?addprodcut' method='post'>
						<button type='submit'>Add new product</button>
					</form>
					<br>
					<table class='table'>
					<tr>
						<td id='name'>Name</td>
						<td id='price'>Price</td>
						<td id='catagory'>Catagory</td>
						<td id='picture'>Picture</td>
					</tr> ";

					// print avaliable items from the database
					$printData = "SELECT `id` ,`name`, `price`, `catagory`, `pic` FROM `product";
					echo "<br>";
					$items = mysql_query($printData);
					echo $items;

					if($items){
						while ($row = mysql_fetch_array($items)){
							echo "<tr>";
							echo "<td> <a href='./index.php?product_view=".$row['id']."'>".$row["name"]."</a></td>";
							echo "<td>".$row["price"]."</td>";
							echo "<td>".$row["catagory"]."</td>";
							echo "<td>
							<a href='uploads/".$row['pic']."' target='_blank'>
							<img src='uploads/".$row['pic']."' alt ='no picture' width ='100' height ='100'> </a></td>";
							echo "</tr>";
						}
					} else {
						echo "error in print products";
					}
					
					echo "</table> </div>";

} // end of if 
		?>



	</div>

</body>

</html>