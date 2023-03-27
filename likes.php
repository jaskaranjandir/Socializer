<?php
require_once("includes/conn.php");
session_start();
    if(!isset($_SESSION['username'])){
        header("Location:index.php");
    }else{
        $suser = $_SESSION['username'];
        $sq = "select * from users where username='$suser'";
        $sres = mysqli_query($conn,$sq);
        $srow = mysqli_fetch_array($sres);
        $user_id = $srow['user_id'];
    }

    if(isset($_GET['post_id'])){
        $post_id=$_GET['post_id'];
        $like_count=1;
        $lq = "select * from likes where post_id = '$post_id' and user_id = '$user_id'";
        $lres = mysqli_query($conn,$lq);
        $lc = mysqli_num_rows($lres);

        if($lc==0){
            $like_query = "insert into likes(post_id,user_id,like_count) values('$post_id','$user_id','$like_count')";
             mysqli_query($conn,$like_query);
            
            echo("<script>window.open('home.php','_self');</script>");
            

        }else{
            $like_query = "delete from likes where post_id='$post_id' AND user_id='$user_id'";
            mysqli_query($conn,$like_query);
            echo("<script>window.open('home.php','_self');</script>");
        }

        

        
        



    }
?>