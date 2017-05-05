<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";

$con = mysqli_connect($dbhost, $dbuser, $dbpass);

// If we couldn't, then it either doesn't exist, or we can't see it.
if (!mysqli_select_db($con, 'my_db')){
    $sql = "CREATE DATABASE IF NOT EXISTS my_db";
     if (!mysqli_query($con, $sql)) {
      echo "Error creating database: " . mysqli_error($con);
    } 
}

$sql = "CREATE TABLE IF NOT EXISTS my_db.images (
        `id` int(100) unsigned NOT NULL AUTO_INCREMENT,
        `title` varchar(255) NOT NULL,
        `filename` varchar(255) NOT NULL,
        `img_path` varchar(255) NOT NULL,
        UNIQUE KEY `id` (`id`)
        ) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;";


if (!mysqli_query($con, $sql)) {
    echo "Error creating table: " . mysqli_error($con);
}



?>
