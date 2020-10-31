<?php
  session_start();
  if(isset($_POST['submit'])){
    $imagefile = $_FILES['file'];
    $imagefilename = $_FILES['file']['name'];
    $imagefileer = $_FILES['file']['error'];

    $filename = $_SESSION["filename"];
    $filepath = $_SESSION["filepath"];

    $imagefileExt = explode('.', $imagefilename);
    $imagefileActualExt = strtolower(end($imagefileExt));
    $allowed = array('jpg', 'jpeg', 'png');

    if(in_array($imagefileActualExt, $allowed)) {
      if($imagefileer === 0){
        move_uploaded_file($_FILES['file']['tmp_name'], "keyimage/" . $imagefilename);
        $my_command = escapeshellcmd("python C:/xampp/htdocs/secure/decrypt.py C:/xampp/htdocs/secure/".$filepath." C:/xampp/htdocs/secure/keyimage/".$imagefilename);
        $command_output = shell_exec($my_command);
        echo $command_output;

        $filenameAfter = explode('.', $filename);
        $filenameDwnld = $filenameAfter[0].'.'.$filenameAfter[1];
        $filepathNew = 'uploads/'.$filenameDwnld;
        $filepathNew = str_replace(' ','',$filepathNew);

        header("Cache-Control: public");
        header("Content-Description: FIle Transfer");
        header("Content-Disposition: attachment; filename=".$filenameDwnld);
        header("Content-Transfer-Emcoding: binary");

        readfile($filepathNew);

        $imagefile_ptr = "keyimage/".$imagefilename;
        unlink($imagefile_ptr);
        unlink($filepathNew);

        exit;
      }
      else{
        echo "Error in uploading Key Image file!";
      }
    }
    else{
      echo "This is not an image file!";
    }

  }
?>
