<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require_once("functions/functions.php");
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}
?>

<head>
    <title>Home | Socializer</title>
    <?php require_once("includes/head.php"); ?>
    <link rel="stylesheet" href="style/home_style2.css">
</head>

<body>
    <?php require("includes/header.php") ?>
    <div class="row">
        <div id="insert_post" class="col-sm-12">
            <center>
                <form action="home.php?id=<?php echo ($user_id); ?>" id="f" method="post" enctype="multipart/form-data">
                    <textarea name="content" id="content" class="form-control" rows="4" placeholder="What's in your mind?"></textarea><br>
                    <label class="btn btn-warning" id="upload_image_button">Select Image<input type="file" name="upload_image" size="30" ></label>
                    <button id="btn-post" name="submit_post" class="btn btn-success">Post</button>
                </form>
                <?php
                insertPosts();
                ?>
            </center>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <center>
                <h2><strong>News Feed</strong></h2><br>
                <?php 
                    echo(getPosts());
                    
                ?>
            </center>
        </div>

    </div>
</body>

</html>