<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--
Design by TEMPLATED
http://templated.co
Released for free under the Creative Commons Attribution License

Name       : Assembly 
Description: A two-column, fixed-width design with dark color scheme.
Version    : 1.0
Released   : 20140330

-->
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="http://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet" />
<link href="iu/default.css" rel="stylesheet" type="text/css" media="all" />
<link href="iu/fonts.css" rel="stylesheet" type="text/css" media="all" />
<link href="sk/cloud.css" rel="stylesheet" type="text/css" media="all" />

<!--[if IE 6]><link href="default_ie6.css" rel="stylesheet" type="text/css" /><![endif]-->
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
</head>
<body>

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


	<div id="banner" class="container">
<h1><i><a style="color:white; position:center; bottom:80px; right:500px;" href="uploadf.php">SECURE FILE STORAGE LTCE </a></i></h1>
		<div class="title">
	
			<i><h2 style="color:red; opacity:0.8; animation:example 1.2s infinite; animation-duration: 1s;">Download the image key &#8595;</h2></i>
			<i><span style="color:white; opacity:0.7;" class="byline">Use this key to download your file from cloud</span></i>
			<style>@keyframes example{
				0%{     color: yellow;    }
   				100%{    color: red; }
 				
					}</style>	
		</div>
		<ul class="actions">


<?php
// This will return all files in that folder
  $files = scandir("images");
  for ($a = 2; $a < count($files); $a++) {
    if($files[$a] === "keyImage.png"){
?>
      <p>
    	  <!-- Displaying file name !-->
        <?php echo $files[$a]; ?>
        <li><a class="button" href="images/<?php echo $files[$a]; ?>" download="<?php echo $files[$a]; ?>">
            Download
        </a></li>
      </p>
      <?php
    }
  }
?>
			
		</ul>
	</div>
</div>


</body>
</html>





			
		</ul>
	</div>
</div>


</body>
</html>








