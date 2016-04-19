<!DOCTYPE html>
<html>
<head>
<title>Upoald pictures</title>
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
			<div class="row"> 
				<h1 class="text-center"> Upload Files </h1>
				<h3 class="text-center"> Sulaiman Aloraini </h3>
				<br> <br>
			</div>
			<div class="row">
				<div class="col-md-4"></div>
				
				<div class="col-md-4">
				
					<form action="upload.php" method="post" enctype="multipart/form-data">
						<input type="file" name="file" />
						<br>
							<button type="submit" name="upload" class="btn btn-primary">upload</button>
							<button type="submit" name="preview" class="btn btn-primary">Preview</button>
						</form>
						<br /><br />
						<?php
						if(isset($_GET['success']))
						{
							?>
							<label>File Uploaded Successfully...  <a href="view.php">click here to view file.</a></label>
							<?php
						}
						else if(isset($_GET['fail']))
						{
							?>
							<label>Problem While File Uploading !</label>
							<?php
						}
						else
						{
							?>
							<label>Try to upload any files(PDF, DOC, EXE, VIDEO, MP3, ZIP,etc...)</label>
							<?php
						}
						?>
				</div>
				
				
				<div class="col-md-4"></div>
			</div>
		</div>
	
	
	
	</body>
	
	</html>