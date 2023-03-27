<!DOCTYPE html>
<?php
session_start();
require_once("includes/conn.php");

if (!isset($_SESSION['username'])) {
    header("location:index.php");
} else {
    $suname = $_SESSION['username'];
    if (isset($_GET['user_id'])) {
        $guid = $_GET['user_id'];
        $gq = "select * from users where user_id='$guid'";
        $gres = mysqli_query($conn, $gq);
        $grow = mysqli_fetch_array($gres);
        $guname = $grow['username'];

        $sq = "select * from users where username='$suname'";
        $sres = mysqli_query($conn, $sq);
        $srow = mysqli_fetch_array($sres);
        $suid = $srow['user_id'];

        if ($guname != $suname) {
            echo ("<script>window.open('profile.php?user_id=$suid','_self');</script>");
        }
    }
}
include("includes/header.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY Posts</title>
    <?php 
        require_once("includes/head.php");
    ?>
    <link rel="stylesheet" href="style/home_style2.css">
</head>
<body>
    <div class="row">
        <div class="col-sm-3"></div>
        <div class="col-sm-6">
            <!-- Display user posts -->
            <?php

            global $conn;
            if (isset($_GET['user_id'])) {
                $user_id = $_GET['user_id'];
            }
            $get_posts = "select * from posts where user_id='$user_id' order by 1 desc LIMIT 5";
            $result = mysqli_query($conn, $get_posts);
            while ($post_result = mysqli_fetch_array($result)) {
                $post_id = $post_result['post_id'];
                $user_id = $post_result['user_id'];
                $content = $post_result['post_content'];
                $upload_image = $post_result['upload_image'];
                $post_date = $post_result['post_date'];
                global $user_id;
                $user = "select * from users where user_id='$user_id' AND posts='yes'";
                $ur = mysqli_query($conn, $user);
                $row = mysqli_fetch_array($ur);

                $user_name = $row['username'];
                $user_image = $row['user_image'];


                $lq = "select * from likes where post_id=$post_id";
                $rq = mysqli_query($conn, $lq);
                $rescount = mysqli_num_rows($rq);
                if ($rescount == 0) {
                    $like_count = 0;
                }
                if ($rescount > 0) {
                    $like_count = $rescount;
                }

                if ($content == "NO" && strlen($upload_image) >= 1) {
                    echo ("
                       
                            <div id='posts'>
                                <div class='row'>
                                    <div class='col-sm-2'>
                                        <p><img src='$user_image' class='img-circle' width='75px' height='75px'></p>
                                    </div>
                                    <div class='col-sm-6'>
                                        <h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                                        <h4 ><small>$post_date</small></h4>
                                    </div>
                                    <div class='col-sm-4'></div>
                                </div>
                                <div class='row'>
                                <div class='col-sm-12'>
                                    <img src='$upload_image' id='posts-img' style='height:350px;'>
                                </div>
                                </div><br>
                                <a href='single.php?post_id=$post_id' style='float:right;margin-right:15px;'><button class='btn btn-info'>View</button></a>
                                <a href='delete.php?post_id=$post_id' style='float:right;margin-right:15px;'><button class='btn btn-success'><i class='glyphicon glyphicon-trash'></i>&nbsp; Delete</button></a>
                            </div>
                            <br>
                    ");
                } else if (strlen($content) >= 1 && strlen($upload_image) >= 1) {
                    echo ("
                   
                        <div id='posts' >
                            <div class='row'>
                                <div class='col-sm-2'>
                                    <p><img src='$user_image' class='img-circle' width='75px' height='75px'></p>
                                </div>
                                <div class='col-sm-6'>
                                    <h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                                    <h4 ><small>$post_date</small></h4>
                                </div>
                                <div class='col-sm-4'></div>
                            </div>
                            <div class='row'>
                            <div class='col-sm-12'>
                                <h4><p align='left'>$content</p></h4>
                                <img src='$upload_image' id='posts-img' style='height:350px;'>
                            </div>
                            </div><br>
                            <a href='single.php?post_id=$post_id' style='float:right;margin-right:15px;'><button class='btn btn-info'>View</button></a>
                            <a href='edit_post.php?post_id=$post_id' style='float:right;margin-right:15px;'><button class='btn btn-warning'>Edit</button></a>
                            <a href='delete.php?post_id=$post_id' style='float:right;margin-right:15px;'><button class='btn btn-success'><i class='glyphicon glyphicon-trash'></i>&nbsp; Delete</button></a>
                        </div>
                        <br>
                ");
                } else {
                    echo ("
                    
                        <div id='posts' >
                            <div class='row'>
                                <div class='col-sm-2'>
                                    <p><img src='$user_image' class='img-circle' width='75px' height='75px'></p>
                                </div>
                                <div class='col-sm-6'>
                                    <h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                                    <h4 ><small>$post_date</small></h4>
                                </div>
                                <div class='col-sm-4'></div>
                            </div>
                            <div class='row'>
                            <div class='col-sm-12'>
                                <h3 align='left' > <p>$content</p></h3>
                            </div>
                            </div><br>
                            <a href='single.php?post_id=$post_id' style='float:right;margin-right:15px;'><button class='btn btn-info'>View</button></a>
                            <a href='edit_post.php?post_id=$post_id' style='float:right;margin-right:15px;'><button class='btn btn-warning'>Edit</button></a>
                            <a href='delete.php?post_id=$post_id' style='float:right;margin-right:15px;'><button class='btn btn-success'><i class='glyphicon glyphicon-trash'></i>&nbsp; Delete</button></a>
                        </div>
                        <br>
                ");
                }
            }

            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
</body>
</html>