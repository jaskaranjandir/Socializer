<?php
    require_once("includes/conn.php");
    global $conn;
    
    if(isset($_GET['post_id'])){
        $post_id = $_GET['post_id'];
        $del = "delete from posts where post_id='$post_id'";
        mysqli_query($conn,$del);
        $res = mysqli_affected_rows($conn);
        if($res==1){
            echo("<script>alert('Post deleted Succesfully');</script>");
            echo("<script>window.open('profile.php','_self');</script>");
        }

    }
?>