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

    <?php
    require_once("includes/head.php");
    ?>
    <title><?php echo (ucfirst($user)); ?> | Profile</title>
    <link rel="stylesheet" href="style/home_style2.css">
</head>

<body>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <?php

            echo ("
                <div>
                    <div>
                        <img src='$user_cover' id='cover-img' class='img-rounded' alt='cover'>
                    </div>
                    <form action='profile.php?user_id=$user_id' method='post' enctype='multipart/form-data'>
                        <ul class='nav pull-left' style='position:absolute;top:10px;left:40px;'>
                            <li class='dropdown'>
                                <button class='dropdown-toggle btn btn-default' data-toggle='dropdown'>Change Cover </button>
                                <div class='dropdown-menu'>
                                    <center> 
                                        <p>Click <strong>Select Cover</strong> and then click the<br>
                                        <strong>Update Cover</strong>
                                        </p>
                                        <label class='btn btn-info'>
                                            Select Cover <input type='file' name='user_cover' size='60'>
                                        </label><br><br>
                                        <button name='update_cover' class='btn btn-info'>Update Cover</button>
                                    </center>

                                </div>
                            </li>
                        </ul>
                    </form>
                </div>
                <div id='profile-img'>
                    <img src='$user_image' alt='Profile' class='img-circle' width='180px' height='185px'>
                    <form action='profile.php?user_id='$user_id' method='post' enctype='multipart/form-data'>
                        <label id='update_profile'>
                        Profile Picture <input type='file' name='user_image' size='60'>
                        </label><br><br>
                        <button id='button_profile' name='update_image' class='btn btn-info'>Update Profile</button>
                    </form>
                </div><br>
                ");

            ?>
            <?php
            if (isset($_POST["update_cover"])) {
                $user_new_cover = $_FILES["user_cover"]["name"];
                $cover_tmp = $_FILES["user_cover"]["tmp_name"];
                $date = date('ymjhis');
                if ($user_new_cover == '') {
                    echo ("<script>alert('Please Select a Cover Image');</script>");
                    echo ("<script>window.open('profile.php?user_id=$user_id','_self');</script>");
                    exit();
                } else {
                    $new_cover_path = "cover/" . "cover_" . $user . "_" . $date . "_" . $user_new_cover;
                    move_uploaded_file($cover_tmp, $new_cover_path);
                    $update_cover_query = "update users set user_cover='$new_cover_path' where user_id='$user_id'";
                    mysqli_query($conn, $update_cover_query);
                    $count = mysqli_affected_rows($conn);
                    if ($count == 1) {
                        echo ("<script>alert('Cover Image updated Successfully');</script>");
                        echo ("<script>window.open('profile.php?user_id=$user_id','_self');</script>");
                        exit();
                    } else {
                        echo ("<script>alert('Something went wrong');</script>");
                        echo ("<script>window.open('profile.php?user_id=$user_id','_self');</script>");
                        exit();
                    }
                }
            }

            if (isset($_POST["update_image"])) {
                $user_new_profile = $_FILES["user_image"]["name"];
                $profile_tmp = $_FILES["user_image"]["tmp_name"];
                $date = date('ymjhis');
                if ($user_new_profile == '') {
                    echo ("<script>alert('Please Select a Cover Image');</script>");
                    echo ("<script>window.open('profile.php?user_id=$user_id','_self');</script>");
                    exit();
                } else {
                    $new_profile_path = "users/" . "profile_" . $user . "_" . $date . "_" . $user_new_profile;
                    move_uploaded_file($profile_tmp, $new_profile_path);
                    $update_user_profile_query = "update users set user_image='$new_profile_path' where user_id='$user_id'";
                    mysqli_query($conn, $update_user_profile_query);
                    $count = mysqli_affected_rows($conn);
                    if ($count == 1) {
                        echo ("<script>alert('Profile Picture updated Successfully');</script>");
                        echo ("<script>window.open('profile.php?user_id=$user_id','_self');</script>");
                        exit();
                    } else {
                        echo ("<script>alert('Something went wrong');</script>");
                        echo ("<script>window.open('profile.php?user_id=$user_id','_self');</script>");
                        exit();
                    }
                }
            }
            ?>
        </div>
        <div class="col-sm-2"></div>
    </div>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-2" id="user_info">
            <?php
            $tname = ucwords($fullname);


            echo ("
                <center><h2><strong>About</strong></h2></center>
                <h4><strong>Name: $tname</strong></h4>
                <p><strong>Date of Birth: </strong>$dob</p><br>
                <p><strong><i style='color:grey;'>$describe_user</i></strong></p><br>
                <p><strong>Relationship Status: </strong>$relationship</p><br>
                <p><strong>Lives in: </strong>$country</p><br>
                <p><strong>Member Since: </strong>($reg_date)</p><br>
                <p><strong>Gender: </strong>$gender</p><br>
                
                
                ");
            ?>
        </div>
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
    </div>

</body>

</html>