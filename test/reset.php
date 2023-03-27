<?php
include("includes/conn.php"); 
if(isset($POST["resetpass"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    $conpass = $_POST["conpass"];
    $encpass = md5($password);

    echo($conpass.$password.$encpass);
    if ($conpass==$password) {
        $query = "UPDATE `users` SET `password`='$encpass' WHERE username='$username';";
        $mysqli_query($conn,$query);
        $res = mysqli_affected_rows($conn);
        if ($res == 1) {
            echo("<script>alert('Password changed successfully');</script>");
        }
        else{
            echo("<script>alert('Something went wrong!');</script>");
        }
    }else{
       
        echo("<script>alert('Password did not match');</script>");
    }
}
?>