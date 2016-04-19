<?php

require("db.php");

if(isset($_POST['btn-upload']))
{
	 
	$file = rand(1000,100000)."-".$_FILES['file']['name'];
	$file_loc = $_FILES['file']['tmp_name'];
	$file_size = $_FILES['file']['size'];
	$file_type = $_FILES['file']['type'];
	$folder="uploads/";

	foreach($_FILES['file'] as $key=>$value){
		echo "<p><br>$key:</b> ".$_FILES['file'][$key]."</p>";
	}
	
	
	
	move_uploaded_file($file_loc,$folder.$file);
	$sql="INSERT INTO tbl_uploads(file,type,size) VALUES('$file','$file_type','$file_size')";
	//mysqli_query($sql);
	
	

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
	
	
}
?>