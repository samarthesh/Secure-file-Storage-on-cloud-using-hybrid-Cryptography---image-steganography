<?php
require_once 'dbconnect.php';

$username=$password="";

if(isset($_POST['submit'])){
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);
  

  $sql =" INSERT INTO registered(username,password) values('$username','$password')";
	$sql1 =" INSERT INTO login(username,password) values('$username','$password')";
  $query = mysqli_query($conn,$sql);
	$query1 = mysqli_query($conn,$sql1);
  if($query){
    echo "<script>alert('you are registered successfully')</script>";
  }else{
    echo "<script>alert('sorry!! Error!!')</script>";
  }
}else{
  
}

 ?>






<?php
require_once 'dbconnect.php';
session_start();

$username=$password="";
if(isset($_POST['value'])){
  $username = trim($_POST['username']);
  $password = trim($_POST['password']);

  if(!$username=='' && !$password=='')
  {
    $sql = "SELECT * FROM login where username='$username' and password='$password'";

    $query = mysqli_query($conn,$sql);

    $count = mysqli_num_rows($query);

    if($count == 1){
      $_SESSION['username'] = $username;
      header('Location: uploadf.php');

    }else{
      echo "<script>alert('username and password is incorrect')</script>";
    }
  }else{
    echo "<script>alert('all fields should not be blank')</script>";
  }
}else{

}
 ?>



<!-- PHP MYADMIN ABOVE -->
<html>
<head>
<link href="default.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<link href="sk/cloud.css" rel="stylesheet" type="text/css" media="all" />
<link rel="stylesheet" href="style.css"/>

<style>@keyframes example{
				0%{     color: magenta;    }
   				100%{    color: skyblue; }
 				
					}</style>


<style>
div.rel {
  position: fixed;
  left: 1100px;
  top: 100px;
}

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
  left: 50px;
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
<p><i><b><font style="color:red; opacity:0.8; animation:example 1.2s infinite; animation-duration: 1s;" size="50" color="orange"> SECURE FILE STORAGE LTCE<b></i></font></p>
<div class="container" id="container">
	<div class="form-container sign-up-container">
		<form action="" method="POST">
			<h1>Create Account</h1>
			
			  <input type="text" name="username" placeholder="enter your user name">    <input type="password" name="password" placeholder="enter your password">
		<input type="submit" name="submit" value="submit">
		</form>
	</div>
	<div class="form-container sign-in-container">
		<form action="" method="POST">
			<h1>Sign in</h1>
			
<input type="text" name="username" placeholder="username"><br>
<input type="password" name="password" placeholder="password"><br>
<input type="submit" name="value" value="submit">		</form>
	</div>
	<div class="overlay-container">
		<div class="overlay">
			<div class="overlay-panel overlay-left">
				<h1>Welcome Back!</h1>
				<p>To keep connected with us please login with your personal info</p>
				<button class="ghost" id="signIn">Sign In</button>
			</div>
			<div class="overlay-panel overlay-right">
				<h1>Don't have an account?</h1>
				<p>Enter your personal details and start journey with us</p>
				<button class="ghost" id="signUp">Sign Up</button>
			</div>
		</div>
	</div>
</div>
<script src="main.js"></script>     
    </div>





</body>
</html>
