<?php
 $target = "nzb/";
 $target = $target . basename( $_FILES['uploaded']['name']) ;
  if(move_uploaded_file($_FILES['uploaded']['tmp_name'], $target))
 {
  echo "The file successfully ". basename( $_FILES['uploadedfile']['name']). " has been uploaded";
 }
 else
 {
  echo "Sorry, there was a problem uploading your file.";
 }
 ?>
