<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

$name = $_POST['title'];
$image = $_FILES['image']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);

$uploadOk = 1;

$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])){
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check == false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}
// Check file size
if ($_FILES["image"]["size"] > 50000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {

    if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
        echo "Sorry, there was an error uploading your file.";
    }

    if(!$con ){
         die('Could not connect: ' . mysqli_error($con));
    }    



$sql = "INSERT INTO images (title,filename,img_path)
    VALUES ('$name','$image','$target_file')";  

$db_selected = mysqli_select_db($con, 'my_db');
if (!$db_selected) {
    die ('Database selection error : ' . mysqli_error($con));
}

$retval = mysqli_query($con, $sql);
if(! $retval ){
  die('Could not enter data: ' . mysqli_error($con));
    }   

  }

}

?>
