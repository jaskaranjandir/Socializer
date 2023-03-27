<?php
require_once("includes/conn.php");

//function for insertting posts
function insertPosts()
{
    if (isset($_POST["submit_post"])) {
        global $conn;
        global $user_id;
        $user = $_SESSION['username'];
        $content = htmlentities($_POST["content"]);
        $upload_image = $_FILES["upload_image"]["name"];
        $upload_tmp = $_FILES["upload_image"]["tmp_name"];
        $date = date('ymjhis');
        if (strlen($content) > 250) {
            echo ("<script>alert('Please use 250 or less than 255 characters');</script>");
            echo ("<script>window.open('home.php','_self');</script>");
        } else {
            if (strlen($upload_image) >= 1 && strlen($content) >= 1) {
                $post_upload_path = "post/post_" . $user . "_" . $date . "_" . $upload_image;
                move_uploaded_file($upload_tmp, $post_upload_path);
                $post_upload_query = "INSERT INTO posts(user_id, post_content, upload_image) VALUES ('$user_id','$content','$post_upload_path')";
                mysqli_query($conn, $post_upload_query);
                $post_result = mysqli_affected_rows($conn);
                if ($post_result == 1) {
                    echo ("<script>alert('Post Updated Successfully');</script>");
                    echo ("<script>window.open('home.php','_self');</script>");
                    $update_user_post_column = "update users set posts='yes' where user_id='$user_id'";
                    mysqli_query($conn, $update_user_post_column);
                } else {
                    echo ("<script>alert('Something Went Wrong');</script>");
                    echo ("<script>window.open('home.php','_self');</script>");
                }
                exit();
            } else {
                if ($upload_image == "" && $content == "") {
                    echo ("<script>alert('Something Went Wrong');</script>");
                    echo ("<script>window.open('home.php','_self');</script>");
                } else {
                    if ($content == "") {
                        $post_upload_path = "post/post_" . $user . "_" . $date . "_" . $upload_image;
                        move_uploaded_file($upload_tmp, $post_upload_path);
                        $post_upload_query = "INSERT INTO posts(user_id, post_content, upload_image) VALUES ('$user_id','NO','$post_upload_path')";
                        mysqli_query($conn, $post_upload_query);
                        $post_result = mysqli_affected_rows($conn);
                        if ($post_result == 1) {
                            echo ("<script>alert('Post Updated Successfully');</script>");
                            echo ("<script>window.open('home.php','_self');</script>");
                            $update_user_post_column = "update users set posts='yes' where user_id='$user_id'";
                            mysqli_query($conn, $update_user_post_column);
                        } else {
                            echo ("<script>alert('Something Went Wrong');</script>");
                            echo ("<script>window.open('home.php','_self');</script>");
                        }
                        exit();
                    }else{
                        $post_upload_query = "INSERT INTO posts(user_id, post_content) VALUES ('$user_id','$content')";
                        mysqli_query($conn, $post_upload_query);
                        $post_result = mysqli_affected_rows($conn);
                        if ($post_result == 1) {
                            echo ("<script>alert('Post Updated Successfully');</script>");
                            echo ("<script>window.open('home.php','_self');</script>");
                            $update_user_post_column = "update users set posts='yes' where user_id='$user_id'";
                            mysqli_query($conn, $update_user_post_column);
                        } else {
                            echo ("<script>alert('Something Went Wrong');</script>");
                            echo ("<script>window.open('home.php','_self');</script>");
                        }
                        exit();
                    }
                }
            }
        }
    }
}

function getPosts(){
    global $conn;
    $per_page = 4;
    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 1;
    }
    $start_from = ($page -1) * $per_page;

    $get_posts = "select * from posts ORDER by 1 DESC LIMIT $start_from,$per_page";
    $run_posts = mysqli_query($conn,$get_posts);
    while ($row_posts = mysqli_fetch_array($run_posts)) {
        $post_id = $row_posts['post_id'];
        $user_id = $row_posts['user_id'];
        $content = substr($row_posts['post_content'],0,40);
        $upload_image = $row_posts['upload_image'];
        $post_date = $row_posts['post_date'];
        $user_query = "select * from users where user_id='$user_id' AND posts='yes'";
        $user_res = mysqli_query($conn,$user_query);
        $user_arr = mysqli_fetch_array($user_res);
        $user_name = ucfirst($user_arr['username']);
        $user_profile_image = $user_arr['user_image'];
        
        $lq="select * from likes where post_id=$post_id";
        $rq = mysqli_query($conn,$lq);
        $rescount = mysqli_num_rows($rq);
        if($rescount==0){
            $like_count = 0;
        }
        if($rescount>0){
            $like_count = $rescount;
        }

        if($content=="NO" && strlen($upload_image)>=1){
            echo("
                <div class='row'>
                    <div class='col-sm-3'></div>
                    <div id='posts' class='col-sm-6'>
                        <div class='row'>
                            <div class='col-sm-2'>
                                <p><img src='$user_profile_image' class='img-circle' width='75px' height='75px'></p>
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
                </div><br><br>
            ");
        }
        else if(strlen($content)>=1 && strlen($upload_image)>=1){
            echo("
            <div class='row'>
                <div class='col-sm-3'></div>
                <div id='posts' class='col-sm-6'>
                    <div class='row'>
                        <div class='col-sm-2'>
                            <p><img src='$user_profile_image' class='img-circle' width='75px' height='75px'></p>
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
                    <p style='font-size:23px;float:left;border:1px solid #4aaee7;border-radius:2px; margin-right:8px; padding:5px;color:#4aaee7;'>$like_count&nbsp;<a href='likes.php?post_id=$post_id'><i class='glyphicon glyphicon-thumbs-up ' style='padding:3px 0;'></i>&nbsp;Like</a><i></i></p>
                    <p style='font-size:23px;float:left;border:1px solid #4aaee7;border-radius:2px; margin-right:8px; padding:5px;'><a href='single.php?post_id=$post_id'><i class='glyphicon glyphicon-comment ' style='padding:3px 0;'></i>&nbsp;Comment</a><i></i></p>
                    </div>
                   
                </div>
                </div>
                <div class='col-sm-3'></div>
            </div><br><br>
        ");
        }else{
            echo("
            <div class='row'>
                <div class='col-sm-3'></div>
                <div id='posts' class='col-sm-6'>
                    <div class='row'>
                        <div class='col-sm-2'>
                            <p><img src='$user_profile_image' class='img-circle' width='75px' height='75px'></p>
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
                            <p style='font-size:23px;float:left;border:1px solid #4aaee7;border-radius:2px; margin-right:8px; padding:5px;color:#4aaee7;'>$like_count&nbsp;<a href='likes.php?post_id=$post_id'><i class='glyphicon glyphicon-thumbs-up ' style='padding:3px 0;'></i>&nbsp;Like</a><i></i></p>
                            <p style='font-size:23px;float:left;border:1px solid #4aaee7;border-radius:2px; margin-right:8px; padding:5px;'><a href='single.php?post_id=$post_id'><i class='glyphicon glyphicon-comment ' style='padding:3px 0;'></i>&nbsp;Comment</a><i></i></p>
                            </div>
                           
                        </div>
                </div>
                <div class='col-sm-3'></div>
            </div><br><br>
        ");
        }
    }
    require_once("pagination.php");
}


?>