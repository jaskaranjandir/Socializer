<?php
session_start();
require_once("includes/conn.php");

if (!isset($_SESSION['username'])) {
    header("location:index.php");
}
require_once("includes/header.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Document</title>
    <?php require_once("includes/head.php");?>
    <link rel="stylesheet" href="style/home_style2.css">
</head>
<body>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <?php
                if (isset($_GET['post_id'])) {
                    $get_post_id = $_GET['post_id'];
                    $get_post = "select * from posts where post_id='$get_post_id'";
                    $res = mysqli_query($conn,$get_post);
                    $row= mysqli_fetch_array($res);
                    
                    $content = $row['post_content'];
                    

                }       
                     
            ?>
            <form  method="post">
                <center>
                    <h2>Edit your Post </h2>
                </center><br>
                <textarea name="content" class="form-control" cols="83" rows="4"><?php echo($content); ?></textarea>
                <input type="submit" name="update_post" class="btn btn-success" value="Update Post" style="position:absolute; top:142px; right:14px;">
            </form>
            <?php
                if (isset($_POST['update_post'])) {
                    $content = htmlentities($_POST['content']);

                    $postquery = "UPDATE posts SET post_content='$content' where post_id='$get_post_id'";
                    mysqli_query($conn,$postquery);
                    $res_Count = mysqli_affected_rows($conn);
                    if($res_Count == 1){
                        echo ("<script>alert('Post Updated Successfully');</script>");
                            echo ("<script>window.open('profile.php','_self');</script>");
                    }
                    else{
                        echo ("<script>alert('Something went wrong!');</script>");
                            echo ("<script>window.open('profile.php','_self');</script>");

                    }
                }
            ?>
        </div>
    </div>
</body>
</html>