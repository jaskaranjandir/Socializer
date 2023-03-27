<?php
session_start();
require_once("includes/conn.php");

if (!isset($_SESSION['username'])) {
    header("location:index.php");
}else {
    $suser= $_SESSION['username'];
    $user_q = "select * from users where username='$suser'";
    $ures = mysqli_query($conn,$user_q);
    $urow = mysqli_fetch_array($ures);
    $su_id= $urow['user_id'];
}
require_once("includes/header.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    if (isset($_GET['post_id'])) {
        $post_id = $_GET['post_id'];
        $get_posts = "select * from posts where post_id='$post_id'";
        $res_post = mysqli_query($conn, $get_posts);
        $row_post = mysqli_fetch_array($res_post);

        $user_id = $row_post['user_id'];
        $content = $row_post['post_content'];
        $upload_image = $row_post['upload_image'];
        $post_date = $row_post['post_date'];

        $get_user = "select * from users where user_id='$user_id'";
        $res_user = mysqli_query($conn, $get_user);
        $row_user = mysqli_fetch_array($res_user);

        $user_name = $row_user['username'];
        $user_image = $row_user['user_image'];
    }
    ?>
    <title><?php 
        if($content !='NO'){
            echo(ucwords($content));
        }else{
            echo("Post");
        }
    ?></title>
    <?php require_once("includes/head.php"); ?>
    <link rel="stylesheet" href="style/home_style2.css">
</head>

<body>
    <?php
     
     $lq="select * from likes where post_id=$post_id";
     $rq = mysqli_query($conn,$lq);
     $rescount = mysqli_num_rows($rq);
     if($rescount==0){
         $like_count = 0;
     }
     if($rescount>0){
         $like_count = $rescount;
     }
    if ($content == "NO" && strlen($upload_image) >= 1) {
        echo ("
                <div class='row'>
                    <div class='col-sm-3'></div>
                    <div id='posts' class='col-sm-6'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='$user_image' class='img-circle' width='75px' height='75px'></p>
                            </div>
                            <div class='col-sm-6' align='left'>
                                <h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                                <h4><small>$post_date</small></h4>
                            </div>
                            <div class='col-sm-4'></div>
                        </div>
                        <div class='row'>
                        <div class='col-sm-12'>
                            <img src='$upload_image' id='posts-img' style='height:350px;width:100%;'>
                        </div>
                        </div><br>
                        <div class='row'>

                            <div class='col-sm-6' >
                            <p style='font-size:23px;float:left;border:1px solid #4aaee7;border-radius:2px; margin-right:8px; padding:5px; color:#4aaee7;'>$like_count&nbsp;<a href='likes.php?post_id=$post_id'><i class='glyphicon glyphicon-thumbs-up ' style='padding:3px 0;'></i>&nbsp;Like</a><i></i></p>
                            <p style='font-size:23px;float:left;border:1px solid #4aaee7;border-radius:2px; margin-right:8px; padding:5px;'><a href='single.php?post_id=$post_id'><i class='glyphicon glyphicon-comment ' style='padding:3px 0;'></i>&nbsp;Comment</a><i></i></p>
                            </div>
                           
                        </div>
                    </div>
                    <div class='col-sm-3'></div>
                </div>
            ");
    } else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
        echo ("
            <div class='row'>
                <div class='col-sm-3'></div>
                <div id='posts' class='col-sm-6'>
                    <div class='row'>
                        <div class='col-sm-2'>
                            <p><img src='$user_image' class='img-circle' width='75px' height='75px'></p>
                        </div>
                        <div class='col-sm-6' align='left'>
                            <h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                            <h4 ><small>$post_date</small></h4>
                        </div>
                        <div class='col-sm-4'></div>
                    </div>
                    <div class='row'>
                    <div class='col-sm-12'>
                        <h4><p align='left' style='margin-left:15px;'>$content</p></h4>
                        <img src='$upload_image' id='posts-img' style='height:350px; width:100%;'>
                    </div>
                    </div><br>
                    <div class='row'>

                            <div class='col-sm-6' >
                            <p style='font-size:23px;float:left;border:1px solid #4aaee7;border-radius:2px; margin-right:8px; padding:5px; color:#4aaee7;'>$like_count&nbsp;<a href='likes.php?post_id=$post_id'><i class='glyphicon glyphicon-thumbs-up ' style='padding:3px 0;'></i>&nbsp;Like</a><i></i></p>
                            <p style='font-size:23px;float:left;border:1px solid #4aaee7;border-radius:2px; margin-right:8px; padding:5px;'><a href='single.php?post_id=$post_id'><i class='glyphicon glyphicon-comment ' style='padding:3px 0;'></i>&nbsp;Comment</a><i></i></p>
                            </div>
                           
                        </div>
                </div>
                <div class='col-sm-3'></div>
            </div>
        ");
    } else {
        echo ("
            <div class='row'>
                <div class='col-sm-3'></div>
                <div id='posts' class='col-sm-6'>
                    <div class='row'>
                        <div class='col-sm-2'>
                            <p><img src='$user_image' class='img-circle' width='75px' height='75px'></p>
                        </div>
                        <div class='col-sm-6' align='left'>
                            <h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                            <h4 ><small>$post_date</small></h4>
                        </div>
                        <div class='col-sm-4'></div>
                    </div>
                    <div class='row'>
                    <div class='col-sm-12'>
                        <h3 align='left' style='margin-left=15px;'> <p>$content</p></h3>
                    </div>
                    </div><br>
                    <div class='row'>

                    <div class='col-sm-6' >
                    <p style='font-size:23px;float:left;border:1px solid #4aaee7;border-radius:2px; margin-right:8px; padding:5px; color:#4aaee7;'>$like_count&nbsp;<a href='likes.php?post_id=$post_id'><i class='glyphicon glyphicon-thumbs-up ' style='padding:3px 0;'></i>&nbsp;Like</a><i></i></p>
                    <p style='font-size:23px;float:left;border:1px solid #4aaee7;border-radius:2px; margin-right:8px; padding:5px;'><a href='single.php?post_id=$post_id'><i class='glyphicon glyphicon-comment ' style='padding:3px 0;'></i>&nbsp;Comment</a><i></i></p>
                    </div>
                   
                </div>
                </div>
                <div class='col-sm-3'></div>
            </div>
        ");
    }

    ?>
    <!-- Comment Section -->
    <div class='row'>
        <div class='col-sm-3'></div>
        <div id='posts' class='col-sm-6'>
            <div class='row'>
                <form method="post">
                    <textarea name="comment_content" class="form-control" rows="4" placeholder="Write a comment"></textarea>
                    <input type="submit" name="update_comment" class="btn btn-info" style="position:absolute;top:100px;right: 33.5px;" value="Comment">
                </form>
                <?php
                if (isset($_POST['update_comment'])) {
                    $comment = htmlentities($_POST['comment_content']);
                   


                    $comment_query = "insert into comments(post_id,user_id,comment_content) values('$post_id','$su_id','$comment')";
                    mysqli_query($conn, $comment_query);
                    $res_count = mysqli_affected_rows($conn);
                    if ($res_count == 1) {
                        echo ("<script>alert('Comment posted Successfully');</script>");
                        echo ("<script>window.open('single.php?post_id=$post_id','_self');</script>");
                    } else {
                        echo ("<script>alert('Something Went wrong!');</script>");
                        echo ("<script>window.open('single.php?post_id=$post_id','_self');</script>");
                    }
                }
                ?>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>
    <div class='row'>
        <div class='col-sm-3'></div>
        <div id='posts' class='col-sm-6'>
            
                <?php
                $get_comments = "select * from comments where post_id='$post_id' order by 1 desc";
                $res = mysqli_query($conn, $get_comments);

                while ($row = mysqli_fetch_array($res)) {
                    $comment_id = $row['comment_id'];
                    $cuser_id = $row['user_id'];
                    $comment_content = $row['comment_content'];
                    $comment_date = $row['comment_date'];

                    $user_query = "select * from users where user_id='$cuser_id'";
                    $user_res = mysqli_query($conn, $user_query);
                   while ($user_row = mysqli_fetch_array($user_res)) {
                    
                    $user_name = $user_row['username'];
                    $user_image = $user_row['user_image'];

                   }
                    echo("
                    <div class='row'>
                        <div class='col-sm-2'>
                             <p><img src='$user_image' class='img-circle' width='55px' height='55px' style='margin-top:15px;'></p>
                        </div>
                        <div class='col-sm-6' align='left'>
                             <h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                             <h4 ><small>$comment_date</small></h4>
                        </div>
                        <div class='col-sm-4'></div>
                    </div>
                    <div class='row'>
                        <div class='col-sm-2'></div>
                        <div class='col-sm-8'>
                            <h3 align='left' style='margin-left=30px;'> <p>$comment_content</p></h3>
                        </div>
                        <div class='col-sm-2'></div>
                    </div><br><hr>
                    ");
                }

                ?>
            </div>
            <div class="col-sm-3"></div>
        </div>
    </div>

</body>

</html>