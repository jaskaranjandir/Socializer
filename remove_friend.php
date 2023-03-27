<?php
session_start();
require_once("includes/conn.php");
if(!isset($_SESSION['username'])){
    header("location:index.php");
}else {
    $suser = $_SESSION['username'];
    $sq = "select * from users where username='$suser'";
    $sres = mysqli_query($conn,$sq);
    $srow = mysqli_fetch_array($sres);
    $su_id = $srow['user_id'];

    if (isset($_GET['user_id'])) {
        $guid = $_GET['user_id'];

        $fq = "delete from  friends where my_id='$su_id' and user_id='$guid'";
        mysqli_query($conn,$fq);
        echo("<script>window.open('find.php','_self');</script>");
    }
}
?>