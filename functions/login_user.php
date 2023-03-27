<?php
session_start();
include("includes/conn.php");
if (isset($_POST["login"])) {
    $username = htmlentities(mysqli_real_escape_string($conn, strtolower($_POST["username"])));
    $password = htmlentities(mysqli_real_escape_string($conn, $_POST["password"]));
    $encpass = md5($password);

    $query = "Select * from users where username='$username' and password = '$encpass'";
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    $rescount = mysqli_affected_rows($conn);
    mysqli_close($conn);
    if ($rescount == 1) {
        $_SESSION['username'] = $username;
        if (isset($_SESSION['username'])) {
            echo ("<script>alert('Logged in Successfully');</script>");
            echo ("<script>window.open('home.php','_self');</script>");
        } else {
            echo ("<script>alert('Something went wrong!');</script>");
            echo ("<script>window.open('login.php','_self');</script>");
        }
    } else {
        echo ("<script>alert('Invalid Username/Password');</script>");
    }
}
