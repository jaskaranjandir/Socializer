<!DOCTYPE html>
<?php
session_start();
require_once("includes/conn.php");
include("includes/header.php");
if (!isset($_SESSION['username'])) {
    header("location:index.php");
} else {
    $suser = $_SESSION['username'];
    $sq = "select * from users where username='$suser'";
    $sres = mysqli_query($conn, $sq);
    $srow = mysqli_fetch_array($sres);
    $su_id = $srow['user_id'];
}
?>
<html lang="en">

<head>

    <?php
    require_once("includes/head.php");
    ?>
    <title>Find People</title>
    <link rel="stylesheet" href="style/home_style2.css">
</head>

<body>

    <div class='row'>
        <div class='col-sm-3'></div>
        <div id='posts' class='col-sm-6'>
            <?php
            $get_users = "select * from users where user_id!='$su_id'";
            $gres = mysqli_query($conn, $get_users);

            

            while ($row = mysqli_fetch_array($gres)) {
                $user_id = $row['user_id'];
                $user_name = ucwords($row['username']);
                $user_image = $row['user_image'];

                $fq = "select * from friends where my_id='$su_id' and user_id='$user_id'";
                $fr = mysqli_query($conn,$fq);
                $fc = mysqli_num_rows($fr);

                if ($fc >= 1) {
                    echo ("
                    <div class='row'>
                        <div class='col-sm-2'>
                             <p><img src='$user_image' class='img-circle' width='55px' height='55px' style='margin-top:15px;'></p>
                        </div>
                        <div class='col-sm-6' >
                            <h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                            <p><a href='remove_friend.php?user_id=$user_id'><button class='btn btn-info'>Remove Friend</button></p>
                        </div>
                        <div class='col-sm-4'></div>
                    </div>
                    <br><hr>
                ");
                } else {
                    echo ("
                    <div class='row'>
                        <div class='col-sm-2'>
                             <p><img src='$user_image' class='img-circle' width='55px' height='55px' style='margin-top:15px;'></p>
                        </div>
                        <div class='col-sm-6' >
                            <h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='user_profile.php?user_id=$user_id'>$user_name</a></h3>
                            <p><a href='add_friend.php?user_id=$user_id'><button class='btn btn-info'>Add Friend</button></p>
                        </div>
                        <div class='col-sm-4'></div>
                    </div>
                    <br><hr>
                ");
                }
                

               
                
            }

            ?>
        </div>
        <div class="col-sm-3"></div>
    </div>
  

</body>

</html>