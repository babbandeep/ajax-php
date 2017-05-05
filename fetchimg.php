<?php

require 'connect.php';

$sqlall = "SELECT COUNT(id) as num_rows FROM images WHERE id < ".$_POST['id']." ORDER BY id DESC";
$sqlq = mysqli_query($con, $sqlall) or die(mysqli_error($con));   
$row = mysqli_fetch_array($sqlq, MYSQLI_BOTH);
$allRows = $row['num_rows'];

$showLimit = 5;

$query = mysqli_query($con, "SELECT * FROM images WHERE id < ".$_POST['id']." ORDER BY id DESC LIMIT ".$showLimit);

$rowCount = mysqli_num_rows($query);

if($rowCount > 0){ 
    while($row = mysqli_fetch_array($query, MYSQLI_BOTH)){ 
        $id = $row["id"]; 
?>

<div class="list_item">
	<h1><?php echo $row["title"]; ?></h1>
	<img src="<?php echo $row["img_path"]; ?>" alt="">
	<button class="delete">Delete</button>
</div>

<?php 

}

if($allRows > $showLimit){ ?>
    <div class="show_more_main" id="show_more_main<?php echo $id; ?>">
        <span id="<?php echo $id; ?>" class=“show_more” title="Load more posts">Show more</span>
        <span class="loding" style="display: none;"><span class="loding_txt">Loading….</span></span>
    </div>

<?php
 } 
}

mysqli_close($con);
 
?>
