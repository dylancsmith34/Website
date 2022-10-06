<?php
ini_set('file_uploads', 'On');
$target_dir = "images/paintings/";
$target_file = $target_dir . $_FILES["imageToUpload"]["name"];
$target_file = str_replace(' ', '', $target_file);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["imageToUpload"]["tmp_name"]);
  if($check !== false) {
  } else {
    echo "File is not an image. ";
      sleep(1);
    $uploadOk = 0;
  }
    // Check if file already exists
if (file_exists($target_file)) {
  echo "File already exists. ";
    sleep(1);
  $uploadOk = 0;
}
    
    // Check file size
if ($_FILES["imageToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large. ";
    sleep(1);
  $uploadOk = 0;
}
    // Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
  echo "Sorry, only JPG, JPEG & PNG files are allowed. ";
    sleep(1);
  $uploadOk = 0;
}
    // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded. ";
    sleep(1);
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["imageToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["imageToUpload"]["name"])). " has been uploaded. ";
      header('location: admin.php');
  } else {
    echo "Sorry, there was an error uploading your file. ";
      sleep(1);
  }
}
}

?>
