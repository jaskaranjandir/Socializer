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
        $guser_id = $grow['user_id'];
        $gfullname = $grow['fullname'];
        $gusername = $grow['username'];
        $gemail = $grow['email'];
        $gpassword = $grow['password'];
        $gcountry = $grow['country'];
        $ggender = $grow['gender'];
        $gdob = $grow['dob'];
        $gstatus = $grow['status'];
        $guser_image = $grow['user_image'];
        $guser_cover = $grow['user_cover'];
        $gdescribe_user = $grow['describe_user'];
        $grelationship = $grow['relationship'];
        $grecovery = $grow['recovery_account'];
        $greg_date = $grow['user_registration_date'];
    }
}
include("includes/header.php");
?>
<html lang="en">

<head>

    <?php
    require_once("includes/head.php");
    ?>
    <title><?php echo (ucfirst($gusername)); ?> | Profile</title>
    <link rel="stylesheet" href="style/home_style2.css">
</head>

<body>
    <div class="row">
        <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <?php

            echo ("
                <div>
                    <div >
                        <img src='$guser_cover' id='cover-img' class='img-rounded' alt='cover'  >
                    </div>
                </div>
                <div id='profile-img' >
                    <img src='$guser_image' alt='Profile' class='img-circle' width='180px' height='185px'>
                    
                </div><br>
                ");

            ?>

            
        </div>
        <div class="col-sm-2"></div>
    </div>
    <!-- USER INFO -->
    <div class="row">

        <div >

            <div class="row">
                <div class="col-sm-2"></div>             
                <div class="col-sm-2" id="user_info" >
                    <?php
                    $tname = ucwords($gfullname);


                    echo ("
                <center><h2><strong>About</strong></h2></center>
                <h4><strong>Name: $tname</strong></h4>
                <p><strong>Date of Birth: </strong>$gdob</p><br>
                <p><strong><i style='color:grey;'>$gdescribe_user</i></strong></p><br>
                <p><strong>Relationship Status: </strong>$grelationship</p><br>
                <p><strong>Lives in: </strong>$gcountry</p><br>
                <p><strong>Member Since: </strong>($greg_date)</p><br>
                <p><strong>Gender: </strong>$ggender</p><br>
                
                
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
                                    <img src='$upload_image' id='posts-img' style='height:350px; width:100%;'>
                                </div>
                                </div><br>
                                <a href='single.php?post_id=$post_id' style='float:right;margin-right:15px;'><button class='btn btn-info'>View</button></a>
                               
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
                                <img src='$upload_image' id='posts-img' style='height:350px; width:100%;'>
                            </div>
                            </div><br>
                            <a href='single.php?post_id=$post_id' style='float:right;margin-right:15px;'><button class='btn btn-info'>View</button></a>
                            
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
                           
                        </div>
                        <br>

                ");
                        }
                    }

                    ?>
                </div>
                <div class="col-sm-2"></div>
            </div>
        </div>

    </div>

</body>

</html>