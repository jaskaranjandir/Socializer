<!DOCTYPE html>
<?php 
session_start();
include("includes/header.php");
if (!isset($_SESSION['username'])) {
    header("location:index.php");
}else{
    $suser = $_SESSION['username'];
    $sq = "select * from users where username='$suser'";
    $sres = mysqli_query($conn,$sq);
    $srow = mysqli_fetch_array($sres);
    $su_id = $srow['user_id'];
    $su_name = $srow['username'];
    $su_image = $srow['user_image'];
}
?>
<html lang="en">
<head>
    
    <?php 
        require_once("includes/head.php");
    ?>
    <title>Messages</title>
    <link rel="stylesheet" href="style/home_style2.css">
</head>
<body>
<div class="row">
    <div class="col-sm-3"></div>
    <div class="col-sm-6" id='post'>
    <nav class="navbar "  >
        <ul class="nav  navbar-nav ">
            <?php
                $fq = "select * from friends where my_id='$su_id' or my_id!='$su_id'";
                $fres = mysqli_query($conn,$fq);
                $fc = mysqli_num_rows($fres);
                if ($fc>0) {
                    while($frow = mysqli_fetch_array($fres)){
                        $fu_id = $frow['user_id'] ;
                        $my_id = $frow['my_id'];
                        $user_fq = "select username,user_image from users where user_id='$fu_id'";
                        $user_fres = mysqli_query($conn,$user_fq);
                        if (mysqli_num_rows($user_fres)>0) {
                            $friend_row = mysqli_fetch_array($user_fres);
                            $friend_name = $friend_row['username'];
                            $friend_image = $friend_row['user_image'];
                            
                           if($fu_id == $su_id){
                                $qq = "select my_id from friends where user_id='$su_id'";
                                $qrws = mysqli_query($conn,$qq);
                                $coc = mysqli_num_rows($qrws);
                                if($coc >=1){
                                    $crow = mysqli_fetch_array($qrws);
                                    $my_id = $crow['my_id'];
                                    
                                    $rq = "Select * from users where user_id='$my_id'";
                                    $rres = mysqli_query($conn,$rq);
                                    $rcc = mysqli_num_rows($rres);
                                    if($rcc>=1){
                                        $ccrow = mysqli_fetch_array($rres);
                                        $cuser_id = $ccrow['user_id'];
                                        $cuser = $ccrow['username'];
                                        $cuser_image = $ccrow['user_image'];

                                        echo("
                                        <li>
                                            
                                                <a href='chat.php?user_id=$cuser_id'>
                                                    <img src='$cuser_image' class='img-circle' width='50' height='50'>
                                                    <p>$cuser</p>
                                                </a>
                                            
                                        </li>
                                    ");
                                 }
                                    }
                                }
                           }
                           if($my_id == $su_id){
                            echo("
                            <li>
                                
                                    <a href='chat.php?user_id=$fu_id'>
                                        <img src='$friend_image' class='img-circle' width='50' height='50'>
                                        <p>$friend_name</p>
                                    </a>
                                
                            </li>
                        ");

                           }
                           
                                
                                
                            }
                     
                           }
                    
                
            ?>
        </ul>
    </nav>
    </div>
    <div class="col-sm-3"></div>
</div>
<div class='row'>
        <div class='col-sm-3'></div>
        <div id='posts' class='col-sm-6'>
            <?php
                $message_query = "select * from friends where (my_id='$su_id'or my_id!='$su_id') and chat_active='YES'";
                $message_result = mysqli_query($conn,$message_query);
                $message_row = mysqli_num_rows($message_result);

                if ($message_row>0 ) {
                    while ($mess = mysqli_fetch_array($message_result)) {
                        $to_id = $mess['user_id'];
                        $my_id = $mess['my_id'];
                        $its = "Select * from users where user_id='$to_id'";
                        $qrs = mysqli_query($conn,$its);
                        if (mysqli_num_rows($qrs)>0) {
                            $friend_row = mysqli_fetch_array($qrs);
                            $friend_user_id = $friend_row['user_id'];
                            $friend_name = ucwords($friend_row['username']);
                            $friend_image = $friend_row['user_image'];

                            
                            if($my_id == $su_id){
                                
                                echo("
                            <div class='row'>
                                <div class='col-sm-2'>
                                     <p><img src='$friend_image' class='img-circle' width='55px' height='55px' style='margin-top:15px;'></p>
                                </div>
                                <div class='col-sm-6' >
                                    <h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='chat.php?user_id=$friend_user_id'>$friend_name</a></h3>
                                    
                                </div>
                                <div class='col-sm-4'></div>
                            </div>
                            <br><hr>
                            ");
                            }

                            if($to_id == $su_id){
                                
                             $rq = "Select * from users where user_id='$my_id'";
                                    $rres = mysqli_query($conn,$rq);
                                    $rcc = mysqli_num_rows($rres);
                                    if($rcc>=1){
                                        $ccrow = mysqli_fetch_array($rres);
                                        $cuser_id = $ccrow['user_id'];
                                        $cuser = $ccrow['username'];
                                        $cuser_image = $ccrow['user_image'];

                                        echo("
                            <div class='row'>
                                <div class='col-sm-2'>
                                     <p><img src='$cuser_image' class='img-circle' width='55px' height='55px' style='margin-top:15px;'></p>
                                </div>
                                <div class='col-sm-6' >
                                    <h3><a style='text-decoration:none; cursor:pointer;color:#3897f0;' href='chat.php?user_id=$cuser_id'>$cuser</a></h3>
                                    
                                </div>
                                <div class='col-sm-4'></div>
                            </div>
                            <br><hr>
                            ");
                                 }
                                    }
                                }
                            
                        } 
                    }
                 else {
                    echo("<center>No messages </center>");
                }
                

            ?>
        </div>
</div>

    
</body>
</html>