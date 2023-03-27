<?php
require_once("includes/conn.php");
if (isset($_POST["signup"])) {
    $fullname = htmlentities(mysqli_real_escape_string($conn,$_POST["fullname"]));
    $username = htmlentities(mysqli_real_escape_string($conn,strtolower($_POST["username"])));
    $email = htmlentities(mysqli_real_escape_string($conn,$_POST["email"]));
    $password = htmlentities(mysqli_real_escape_string($conn,$_POST["password"]));
    if(strlen($password)<8){
        echo("<script>alert('Password must be 8 characters long');</script>");
    }
    $country = htmlentities(mysqli_real_escape_string($conn,$_POST["country"]));
    $gender = htmlentities(mysqli_real_escape_string($conn,$_POST["gender"]));
    $dob = htmlentities(mysqli_real_escape_string($conn,$_POST["dob"]));
    $status = "verified";
    $posts = "no";
    $user_image = "users/user.png";
    $user_cover = "cover/default_cover.jpg";
    $describe_user = "Hey! Socializer";
    $relationship = "...";
    $recovery = "...";
    $encpass = md5($password);
    
    $exquery = "select username,email from users where username='$username' or email='$email'";
    mysqli_query($conn, $exquery);
    $exrescount = mysqli_affected_rows($conn);
    if ($exrescount == 0) {
        $query = "INSERT INTO users( fullname, username, email, password, country,gender, dob, describe_user, relationship, user_image, user_cover, status, posts, recovery_account) VALUES ('$fullname', '$username', '$email', '$encpass', '$country', '$gender', '$dob', '$describe_user', '$relationship', '$user_image', '$user_cover', '$status', '$posts', '$recovery')";
        mysqli_query($conn, $query);
        $rescount = mysqli_affected_rows($conn);
        mysqli_close($conn);
        if ($rescount == 1) {
            echo ("<script>alert('Congratulation $username . Please Login to continue');</script>");
            echo ("<script>window.location.href='login.php';</script>");
        }
    } else {
        echo ("<script>alert('User Already Exists.');</script>");
        echo ("<script>window.location.href='signup.php';</script>");
    }
    
    
}

?>