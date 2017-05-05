<?php

require 'connect.php';

$success=mysqli_query($con, "DELETE FROM images WHERE id=".$_REQUEST['id']);

if($success){
	unlink($_REQUEST['imagepath']);
}
 
mysqli_close($con);

?>

