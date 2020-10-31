<?php
if (isset($_POST['submit'])) {
  $file = $_FILES['file'];
  $fileName = $_FILES['file']['name'];
  $fileSize = $_FILES['file']['size'];
  $fileError = $_FILES['file']['error'];
  $fileType = $_FILES['file']['type'];

  $fileExt = explode('.', $fileName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = array('jpg', 'jpeg', 'png', 'pdf' , 'mp3' , 'txt');

  if(in_array($fileActualExt, $allowed)) {
    if($fileError=== 0) {
      if($fileSize < 100000000000) {
        move_uploaded_file($_FILES["file"]["tmp_name"], "uploads/" . $fileName);
        $file_pointer = "images/keyImage.png";
        if (!unlink($file_pointer)) {
        	echo ("$file_pointer cannot be deleted due to an error");
        }
        else {
        	echo ("$file_pointer has been deleted");
        }
        $my_command = escapeshellcmd("python C:/xampp/htdocs/secure/encrypt.py C:/xampp/htdocs/secure/uploads/" .$fileName);
        $command_output = shell_exec($my_command);
        echo $command_output;
		  	header("Location: downloadkey.php");
   		}
	    else {
        echo "error in size";
  	  }
    }
    else {
      echo "THERE WAS ERROR ON UPLOADING";
	  }
  }
  else {
   echo " you cannot upload this file";
  }
}
?>
