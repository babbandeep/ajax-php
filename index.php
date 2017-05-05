<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>php ajax project</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    </head>
    <body>
        <?php
            
        require 'connect.php';
        ?>
        <div class="container-fluid no-padding">
        <div class="form">
        <div class="col-sm-12">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
            <div class="col-sm-1"></div>
            <div class="col-sm-4">
            <div class="title_bx">
            <div><label>Title</label></div>
            <input type="text" name="title" id="title" placeholder="Title" required>
            </div>
            </div>
            <div class="col-sm-4">
            <div class="file_bx">
            <div><label>File Upload</label></div>
            <input type="file" name="image" id="image" class="hidden" required>
            <label for="image" id="sl_img">Select</label>
            </div>
            </div>
            <div class="col-sm-2">
            <div class="sbmt_bx">
            <input type="submit" value="Upload Image" name="submit">
            </div>
            </div>
            <div class="col-sm-1"></div>
        </form>
        </div>
        <div class="clearfix"></div>
        </div>
        </div>
        <?php
        require 'upload.php';
        ?>
        <div class="tutorial_list">
            <?php
            $sql = "SELECT id,title,img_path FROM images ORDER BY id DESC LIMIT 5";
            $sqlq = mysqli_query($con, $sql) or die(mysqli_error($con));
            $rowCount = mysqli_num_rows($sqlq);
            if($rowCount > 0){
                while($row = mysqli_fetch_array($sqlq, MYSQLI_BOTH)){
                $id = $row['id'];
            
            ?>
            <div class="list_item" >
                
                <div class="ba_img">
                <div data-imagepath="<?php echo $row["img_path"]; ?>" data-id="<?php echo $id; ?>" class="delete">&#10006;</div>
                <img src="<?php echo $row["img_path"]; ?>" alt="<?php echo $row['title']; ?>" class="img-responsive">
                <h1><?php echo $row["title"]; ?></h1>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
        <div class="show_more_main" id="show_more_main<?php echo $id; ?>">
            <span id="<?php echo $id; ?>" class="show_more" title="Load more posts">Show more</span>
            <span class="loding" style="display: none;"><span class="loding_txt">Loading....</span></span>
        </div>
        <?php } ?>

        <!-- javascript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script>
            $(document).ready(function(){
                $('body').on('click','.show_more',function(){
                    var ID = $(this).attr('id');
                    $('.show_more').hide();
                    $('.loding').show();
                $.ajax({
                    type:'POST',
                    url:'fetchimg.php',
                    data:'id='+ID,
                success:function(html){
                    $('#show_more_main'+ID).remove();
                    $('.tutorial_list').append(html);
                    }
                });
            });

                $('.list_item').on('click','.delete',function(){
                    $(this).fadeOut("slow", function() { $(this).parent().remove(); });
                    var ID = $(this).attr('data-id');
                    var imagepath = $(this).attr('data-imagepath');
                $.ajax({
                    type:'POST',
                    url:'delete.php',
                    data:'id='+ID+'&imagepath='+imagepath,
                    });
                });
            });
        </script>
    </body>
</html>