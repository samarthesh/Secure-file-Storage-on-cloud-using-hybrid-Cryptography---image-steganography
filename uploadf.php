	<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:index.php");
	}
?>
<link href="sk/cloud.css" rel="stylesheet" type="text/css" media="all" />

<style>
div.rel1 {
  position: fixed;
  left: 100px;
  top: 600px;
}

div.rel2 {
  position: fixed;
  left: 1400px;
  top: 400px;
}

div.rel3 {
  position: fixed;
  left: 250px;
  top: 400px;
}

div.rel4 {
  position: fixed;
  left: 1300px;
  top: 30px;
}

div.rel5 {
  position: fixed;
  left: 1200px;
  top: 600px;
}
</style>



<h1><i><a style="color:white; position:center; top:70px; left:140px;" href="uploadf.php">SECURE FILE STORAGE LTCE</a></i></h1>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/js/all.min.js" integrity="sha256-qM7QTJSlvtPSxVRjVWNM2OfTAz/3k5ovHOKmKXuYMO4=" crossorigin="anonymous"></script>
<div class="rel">
<h2 style="color:skyblue; font-size:70px; left:100px;">&#9729;</h2></div>

<div class="rel1">
<h2 style="color:skyblue; font-size:50px; left:100px;">&#9729;</h2></div>

<div class="rel2">
<h2 style="color:skyblue; font-size:30px; left:100px;">&#9729;</h2></div>

<div class="rel3">
<h2 style="color:skyblue; font-size:110px; left:100px;">&#9729;</h2></div>

<div class="rel4">
<h2 style="color:skyblue; font-size:90px; left:100px;">&#9729;</h2></div>

<div class="rel5">
<h2 style="color:skyblue; font-size:120px; left:100px;">&#9729;</h2></div>	
	
<style>

div.relative {
  position: relative;
  left: 50px;
  bottom: -350px;

}
div.relative1 {
  position: relative;
  left: 210px;
  bottom: -310px;

}
div.relative2 {
  position: relative;
  left: 1300px;
  bottom: -450px;

}
</style>
<link rel="stylesheet" type="text/css" href="mystyle.css">
<div class="frame">
	<div class="center">
		<div class="title">
		<h5> Click on the icon below! <br> Note:-File name must not contain spaces.</h5>

		</div>

		<div class="dropzone">
			<img src="http://100dayscss.com/codepen/upload.svg" class="upload-icon" />
			<form action="upload.php" method="POST" enctype="multipart/form-data">
			<input type="file" name="file" class="upload-input">
		</div>

		<button type="submit" class="btn" name="submit">UPLOAD</button>
	


	</div>
</form>
		<div class="relative">
		<button type="button" class="btn" data-toggle="modal" data-target="#myModal" name="view_files">VIEW FILES</button>
</div>

<div class="relative1"><button type="submit" class="btn" data-toggle="modal" data-target="#myModall" name="download">DOWNLOAD</button>

		
</div>
</div>
<div class="relative2">
<form action="logout.php" method="POST"> <button type="submit" class="btn btn-danger btn-xs" name="download">LOGOUT</button></form>
</div>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>FILE UPLOAD</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">

  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Files On Cloud</h4>
        </div>
        <div class="modal-body">

<?php

	$dir = 'uploads';
	$file_data = scandir($dir);
	$output = '
	<table class="table table-bordered table-striped">
		<tr>
			<th>Image</th>
			<th>File Name</th>
			
		</tr>
	';
	foreach($file_data as $file)
	{
		if($file === '.' OR $file === '..')
		{
			continue;
		}
		else
		{
		 $path = 'uploads' . '/' . $file;
		$output .= '
				<tr>
					<td><img src="'.$path.'"
						class="img-thumbnail" height="50" width="50" /></td>
					<td>'.$file.'</td>
					
				</tr>
			';
		}
	}
	$output .= '</table>';
	echo $output;


?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>

</div>

<!------- Another modal for delete ----!>

<div class="container">

  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div class="modal fade" id="myModall" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Files On Cloud</h4>
        </div>
        <div class="modal-body">


	<?php

	$dir = 'uploads';
	$file_data = scandir($dir);
	$output = '
	<table class="table table-bordered table-striped">
		<tr>
			<th>Image</th>
			<th>File Name</th>
			<th>Download</th>
		</tr>
	';
	foreach($file_data as $file)
	{
		if($file === '.' OR $file === '..')
		{
			continue;
		}
		else
		{
		 $path = 'uploads' . '/' . $file;
		$output .= '
				<tr>
					<td><img src="'.$path.'"
						class="img-thumbnail" height="50" width="50" /></td>
					<td>'.$file.'</td>
					<td><a href="download.php?id= '.$file.'" type="submit" name="submit" class="download_file btn btn-danger btn-xs"
						id="'.$path.'" >Download</a></td>
				</tr>
			';
		}
	}
	$output .= '</table>';
	echo $output;




?>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

    </div>
  </div>
</body>
</html>