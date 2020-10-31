<?php
session_start();
if(isset($_GET['id'])){
	$filename = $_GET['id'];
	$filename = basename($_GET['id']);
	$filepath = 'uploads'.'/'.$filename;
	$filepath = str_replace(' ','',$filepath);

	$_SESSION["filename"] = $filename;
	$_SESSION["filepath"] = $filepath;
	include "selectkey.php";
	exit;
}
?>
