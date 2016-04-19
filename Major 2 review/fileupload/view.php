<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>File Upload and view With PHP and MySql</title>
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

	<table width="80%" border="1">
		<tr>
			<td>File Name</td>
			<td>File Type</td>
			<td>File Size(KB)</td>
			<td>View</td>
		</tr>
		<?php
		require("db.php");


		$sql="SELECT * FROM tbl_uploads";
		$result_set = mysqli_query($conn, $sql);
	
		echo mysqli_num_rows($result_set) ;
		if (mysqli_num_rows($result_set) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result_set))
			{
				?>
		<tr>
			<td><?php echo $row['file'] ?></td>
			<td><?php echo $row['type'] ?></td>
			<td><?php echo $row['size'] ?></td>
			<td><a href="uploads/<?php echo $row['file'] ?>" target="_blank">view
					file</a></td>
			<td><img src="uploads/<?php echo $row['file']  ?>" alt="not an image" height="100" width="100"></td>
		</tr>
		<?php
			}
		}
		?>
	</table>
</body>
</html>
